<?php

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\Loan;
use App\LoanItem;
use App\AuditLog;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('user')->orderByDesc('created_at')->paginate(10);
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
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        // Valida manualmente só os índices selecionados
        foreach ($request->books as $bookId) {
            if (!isset($request->quantities[$bookId]) || !is_numeric($request->quantities[$bookId]) || $request->quantities[$bookId] < 1) {
                return back()->withErrors([
                    "A quantidade do livro selecionado (ID {$bookId}) deve ser um número maior ou igual a 1."
                ]);
            }
        }

        DB::beginTransaction();

        try {
            $loan = Loan::create([
                'user_id' => $request->user_id,
                'protocol' => strtoupper(uniqid('EMP-')),
                'loan_date' => Carbon::now(),
                'due_date' => $request->due_date,
                'status' => 'borrowed',
            ]);

            foreach ($request->books as $bookId) {
                $book = Book::findOrFail($bookId);

                $quantity = $request->quantities[$bookId];

                if ($book->quantity_available < $quantity) {
                    throw new \Exception("Quantidade insuficiente do livro: " . $book->title);
                }

                $book->decrement('quantity_available', $quantity);

                LoanItem::create([
                    'loan_id' => $loan->id,
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                    'returned' => false,
                ]);
            }

            DB::commit();

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'criação de empréstimo',
                'target_type' => 'Empréstimo',
                'target_id' => $loan->id,
                'description' => 'Criou o empréstimo ' . $loan->protocol . ' para ' . $loan->user->name,
            ]);

            return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withErrors(['error' => 'Erro: ' . $e->getMessage()]);
            }        
    }

    public function return($loanId)
    {
        $loan = Loan::with('items.book')->findOrFail($loanId);

        DB::beginTransaction();

        try {
            foreach ($loan->items as $item) {
                if (!$item->returned) {
                    $item->book->increment('quantity_available', $item->quantity);
                    $item->update(['returned' => true]);
                }
            }

            $loan->returned_at = now();

            // Fine calculation
            if (now()->gt(Carbon::parse($loan->due_date))) {
                $dias = now()->diffInDays(Carbon::parse($loan->due_date));
                $loan->fine_amount = $dias * 150; // 150MZN/day
                $loan->status = 'late';
            } else {
                $loan->status = 'returned';
            }

            $loan->save();

            DB::commit();

            AuditLog::create([
                'user_id' => auth()->id(),
                'action' => 'devolução de empréstimo',
                'target_type' => 'Empréstimo',
                'target_id' => $loan->id,
                'description' => 'Devolveu o empréstimo ' . $loan->protocol . ' com multa de ' . number_format($loan->fine_amount, 2, ',', '.') . ' MZN',
            ]);

            return redirect()->route('loans.index')->with('success', 'Empréstimo devolvido com sucesso!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withErrors(['error' => 'Erro ao devolver: ' . $e->getMessage()]);
            }
    }

    public function userLoans()
    {
        $loans = Loan::with('items.book')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('loans.user_loans', compact('loans'));
    }

    public function track(Request $request)
    {
        $loan = null;

        if ($request->has('protocol')) {
            $loan = Loan::with(['user', 'items.book'])
                ->where('protocol', $request->protocol)
                ->first();
        }

        return view('loans.track', compact('loan'));
    }

    public function createSelf()
    {
        $books = Book::where('quantity_available', '>', 0)->get();
        return view('loans.create_self', compact('books'));
    }

    public function storeSelf(Request $request)
    {
        $request->validate([
            'books' => 'required|array|min:1|max:5',
            'books.*' => 'exists:books,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'integer|min:1',
            'due_date' => 'required|date|after:today',
        ]);

        DB::beginTransaction();

        try {
            $loan = Loan::create([
                'user_id' => auth()->id(),
                'protocol' => strtoupper(uniqid('EMP-')),
                'loan_date' => now(),
                'due_date' => $request->due_date,
                'status' => 'emprestado',
            ]);

            foreach ($request->books as $index => $bookId) {
                $book = Book::findOrFail($bookId);
                $quantity = $request->quantities[$index];

                if ($book->quantity_available < $quantity) {
                    throw new \Exception("Livro '{$book->title}' com quantidade insuficiente.");
                }

                $book->decrement('quantity_available', $quantity);

                LoanItem::create([
                    'loan_id' => $loan->id,
                    'book_id' => $book->id,
                    'quantity' => $quantity,
                ]);
            }

            DB::commit();

            return redirect()->route('loans.mine')->with('success', 'Empréstimo realizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['erro' => $e->getMessage()]);
        }
    }

}
