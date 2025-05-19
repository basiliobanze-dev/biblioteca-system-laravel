<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::where('status', 'ativo')->paginate(10);
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


    
    public function show($id)
    {
        //
    }

    
    public function edit(Book $book)
    {
        return view('books.edit', compact('book')); // c/ base n data selected
    }

    
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required',
            'publisher' => 'nullable|string',
            'description'=> 'required|string|max:255',
            'year' => 'nullable|digits:4|integer',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'quantity_total' => 'required|integer|min:0',
            // 'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    
    public function destroy(Book $book)
    {
        $book->delete();
        // $book->status = 'inativo';
        // $book->save();

        return redirect()->route('books.index')->with('success', 'Livro Excluído com sucesso!');
    }
}
