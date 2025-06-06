<?php

namespace App\Http\Controllers;

use App\User;
use App\Loan;
use App\LoanItem;
use DB;
use PDF;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Most Borrowed Books Report
    public function topBooks()
    {
        $books = LoanItem::select('book_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10)
            ->get();

        return view('reports.top_books', compact('books'));
    }

    // Report of users with the most loans
    public function topUsers()
    {
        $users = Loan::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->take(10)
            ->get();

        return view('reports.top_users', compact('users'));
    }


    public function topBooksPdf()
    {
        $books = LoanItem::select('book_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10)
            ->get();

        $pdf = PDF::loadView('reports.pdf_top_books', compact('books'));
        return $pdf->download('livros_mais_emprestados.pdf');
    }

    public function topUsersPdf()
    {
        $users = Loan::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->take(10)
            ->get();

        $pdf = PDF::loadView('reports.pdf_top_users', compact('users'));
        return $pdf->download('usuarios_mais_ativos.pdf');
    }

}
