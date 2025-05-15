@extends('layouts.app')

@section('content')
<h2>Lista de Livros</h2>

<a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Novo Livro</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Ano</th>
            <th>ISBN</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ $book->isbn }}</td>
            <td>
                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $books->links() }}
@endsection
