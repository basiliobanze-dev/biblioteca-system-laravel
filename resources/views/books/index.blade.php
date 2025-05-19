@extends('layouts.app')

@section('content')
    <a href="{{ route('books.create') }}" class="btn btn-add mb-3">Adicionar Livro</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <!-- <th>Description</th> -->
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
                <!-- <td>{{ $book->description }}</td> -->
                <td>{{ $book->year }}</td>
                <td>{{ $book->isbn }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-view"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-remove" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $books->links() }}
@endsection
