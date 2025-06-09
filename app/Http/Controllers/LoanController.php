<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanItem;
use App\Book;
use App\User;
use App\AuditLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = Loan::with(['user', 'items.book'])
        ->when($request->status === 'active', fn($q) => $q->where('status', 'active'))
        ->when($request->status === 'pending', fn($q) => $q->where('status', 'pending'))
        ->when($request->user, fn($q, $user) =>
            $q->whereHas('user', fn($sub) =>
                $sub->where('name', 'like', "%$user%")
                    ->orWhere('email', 'like', "%$user%")
            )
        )
        ->when($request->book, fn($q, $book) =>
            $q->whereHas('items.book', fn($sub) =>
                $sub->where('title', 'like', "%$book%")
            )
        )
        ->orderByDesc('loan_date')
        ->paginate(20);


        // Calcular multa prevista para empréstimos ativos
        foreach ($loans as $loan) {
            if ($loan->status === 'active') {
                $now = now();
                if ($now->gt($loan->due_date)) {
                    $daysLate = $loan->due_date->diffInDays($now);
                    $loan->calculated_fine = $daysLate * 100;
                } else {
                    $loan->calculated_fine = 0;
                }
            } else {
                $loan->calculated_fine = $loan->fine_amount; // multa já calculada e salva
            }
        }

        return view('loans.index', compact('loans'));
    }


    public function create()
    {
        $users = User::all();
        $books = Book::where('quantity_available', '>', 0)->get();

        return view('loans.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_ids' => 'required|array|min:1|max:3',
            'book_ids.*' => 'exists:books,id',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        DB::beginTransaction();

        try {
            // Verifica se o usuário já tem 3 livros ativos
            $activeLoans = Loan::where('user_id', $request->user_id)
                ->where('status', 'active')
                ->withCount('items')
                ->get()
                ->sum('items_count');

            if (($activeLoans + count($request->book_ids)) > 3) {
                return back()->with('error', 'Usuário excedeu o limite de 3 livros.');
            }

            // Cria empréstimo
            // $loan = Loan::create([
            //     'user_id' => $request->user_id,
            //     'loan_date' => now(),
            //     'due_date' => $request->due_date,
            //     'protocol' => $this->generateProtocol(),
            //     'status' => 'active',
            // ]);
            // Verifica se é um reader
            $isReader = auth()->user()->role === 'reader';

            // Cria empréstimo
            $loan = Loan::create([
                'user_id' => $isReader ? auth()->id() : $request->user_id,
                'loan_date' => now(),
                'due_date' => $request->due_date,
                'protocol' => $this->generateProtocol(),
                'status' => $isReader ? 'pending' : 'active',
            ]);

            foreach ($request->book_ids as $book_id) {
                LoanItem::create([
                    'loan_id' => $loan->id,
                    'book_id' => $book_id,
                ]);

                // Só decrementa o estoque se o empréstimo for ativo (admin/librarian)
                if (!$isReader) {
                    $book = Book::find($book_id);
                    $book->quantity_available -= 1;
                    $book->save();
                }
            }

            DB::commit();

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => $isReader ? 'solicitação de empréstimo' : 'criação de empréstimo',
                'target_type' => 'Empréstimo',
                'target_id' => $loan->id,
                'description' => $isReader
                    ? 'Usuário solicitou empréstimo ' . $loan->protocol
                    : 'Criou o empréstimo ' . $loan->protocol . ' para ' . $loan->user->name,
            ]);
            return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao registrar empréstimo.');
        }
    }

    private function generateProtocol()
    {
        $prefix = 'EMP-';
        $datePart = now()->format('YmdH');
        $randomPart = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));

        return $prefix . $datePart . $randomPart;
    }

    public function returnProcess(Request $request, Loan $loan)
    {
        $request->validate([
            'return_date' => 'required|date',
            // removi validação de multa porque não vai mais ser recebida do formulário
        ]);

        DB::transaction(function () use ($loan, $request) {
            $returnDate = Carbon::parse($request->return_date);

            // Calcula multa automaticamente (100 MZN por dia de atraso)
            $autoFine = 0;
            if ($returnDate->gt($loan->due_date)) {
                $daysLate = $loan->due_date->diffInDays($returnDate);
                $autoFine = $daysLate * 100; // 100 MZN por dia
            }

            // Atualiza empréstimo
            $loan->update([
                'return_date' => $returnDate,
                'status' => 'returned',
                'fine_amount' => $autoFine,
            ]);

            // Atualiza estoque dos livros e marca itens como devolvidos
            foreach ($loan->items as $item) {
                $item->update(['returned' => true]);
                $item->book->increment('quantity_available');
            }
        });


        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'devolução de empréstimo',
            'target_type' => 'Empréstimo',
            'target_id' => $loan->id,
            'description' => 'Devolveu o empréstimo ' . $loan->protocol . ' com multa de ' . number_format($loan->fine_amount, 2, ',', '.') . ' MZN',
        ]);
        return redirect()->route('loans.index')->with('success', 'Devolução registrada com sucesso.');
    }

    public function track(Request $request)
    {
        $request->validate([
            'protocol' => 'required|string',
        ]);

        $loan = Loan::with(['user', 'items.book'])
            ->where('protocol', $request->protocol)
            ->first();

        if (!$loan) {
            return back()->with('error', 'Nenhum empréstimo encontrado com esse Código.');
        }

        return view('loans.track', compact('loan'));
    }


    public function myLoans()
    {
        $loans = Loan::with('items.book')
            ->where('user_id', Auth::id())
            ->orderByDesc('loan_date')
            ->paginate(10);

        return view('loans.my', compact('loans'));
    }

    public function readerDashboard()
    {
        $userId = Auth::id();

        // Contar total de livros com status "active" do usuário logado
        $activeLoansCount = LoanItem::whereHas('loan', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', 'active');
        })->count();

        // Pegar top 3 livros mais emprestados
        $topBooks = LoanItem::select('book_id', DB::raw('COUNT(*) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(3)
            ->get();

        // Primeiro da lista como sugestão
        $recommendedBook = $topBooks->first()->book ?? null;

        // Total de livros disponíveis
        $totalBooks = Book::count();

        return view('dashboard.reader', compact('activeLoansCount', 'topBooks', 'recommendedBook', 'totalBooks'));
    }

    public function requestForm()
    {
        $books = Book::where('quantity_available', '>', 0)->get();

        return view('loans.request', compact('books'));
    }

    public function approve(Loan $loan)
    {
        // Verificar se o usuário tem permissão para aprovar
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Você não tem permissão para confirmar empréstimos.');
        }

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Esse empréstimo já foi confirmado ou não está pendente.');
        }

        DB::transaction(function () use ($loan) {
            // Atualizar o empréstimo
            $loan->update([
                'status' => 'active',
                'loan_date' => now() // Definir a data de empréstimo como agora
            ]);

            // Atualizar o estoque dos livros
            foreach ($loan->items as $item) {
                $book = $item->book;
                if ($book->quantity_available <= 0) {
                    throw new \Exception("O livro {$book->title} não está mais disponível.");
                }
                $book->decrement('quantity_available');
            }
        });

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'confirmação de empréstimo',
            'target_type' => 'Empréstimo',
            'target_id' => $loan->id,
            'description' => 'Confirmou o empréstimo ' . $loan->protocol,
        ]);
        return back()->with('success', 'Empréstimo confirmado com sucesso!');
    }


}


