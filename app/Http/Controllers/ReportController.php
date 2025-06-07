<?php

namespace App\Http\Controllers;

use App\LoanItem;
use App\Loan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function topBooks()
    {
        $books = LoanItem::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->paginate(10);

        return view('reports.top_books', compact('books'));
    }

    public function topBooksPdf()
    {
        $books = LoanItem::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10)
            ->get();

        $pdf = Pdf::loadView('reports.pdf_top_books', compact('books'));
        return $pdf->download('livros_mais_emprestados.pdf');
    }

    public function topUsers()
    {
        $users = Loan::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->paginate(10);


        return view('reports.top_users', compact('users'));
    }

    public function topUsersPdf()
    {
        $users = Loan::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->take(10)
            ->get();

        $pdf = Pdf::loadView('reports.pdf_top_users', compact('users'));
        return $pdf->download('usuarios_mais_ativos.pdf');
    }

}
