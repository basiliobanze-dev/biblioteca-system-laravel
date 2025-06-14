<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%")
                ->orWhere('year', 'like', "%{$search}%");
            });
        }

        $books = $query->paginate(10)->appends($request->only('search'));

        return view('books.index', compact('books'));
    }

    
    public function create()
    {
        return view('books.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required',
            'publisher' => 'nullable|string',
            'description'=> 'required|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'isbn' => 'required|unique:books',
            'quantity_total' => 'required|integer|min:0',
            'status' => 'required|in:ativo,inativo',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // we use object to receive, valid e manipul data via form
        $validated['quantity_available'] = $validated['quantity_total'];

        // Verif.. if a img was sent
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('public/covers');
            $validated['cover_image'] = basename($path);
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Livro cadastrado com sucesso!');
    } // Process and saveee


    
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
    
    public function edit(Book $book)
    {
        return view('books.edit', compact('book')); // c/ base n data selected
    }

    
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'author' => 'required',
            'publisher' => 'nullable|string',
            'description'=> 'required|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'isbn' => 'required',
            'quantity_total' => 'required|integer|min:0',
            'status' => 'required|in:ativo,inativo',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($book->quantity_available > $validated['quantity_total']) {
            return back()->withErrors(['quantity_total' => 'A nova quantidade total não pode ser menor que a quantidade disponível.']);
        }

        // verifi.. if a new img was sent
        if ($request->hasFile('cover_image')) {
            // Remove the last img if necessary
            if ($book->cover_image && \Storage::exists('public/covers/' . $book->cover_image)) {
                \Storage::delete('public/covers/' . $book->cover_image);
            }

            $path = $request->file('cover_image')->store('public/covers');
            $validated['cover_image'] = basename($path);
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Livro actualizado com sucesso!');
    }

    
    public function destroy(Book $book)
    {
        $book->delete();
        // $book->status = 'inativo';
        // $book->save();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }

    
    // public function search(Request $request)
    // {
    //     $query = $request->query('q');
    //     $books = Book::where('title', 'like', '%' . $query . '%')
    //         ->where('quantity_available', '>', 0)
    //         ->limit(10)
    //         ->get(['id', 'title', 'quantity_available']);

    //     return response()->json($books);
    // }


}
