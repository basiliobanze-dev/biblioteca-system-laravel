@extends('layouts.app')

@section('content')
    <div class="book-details-container">
        <div class="book-cover">
            @if($book->cover_image)
                <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="Capa do livro {{ $book->title }}">
            @else
                <img src="https://via.placeholder.com/250x350?text=Sem+Capa" alt="Sem capa disponível">
            @endif
        </div>
        <div class="book-info">
            <h2>{{ $book->title }}</h2>
            <p><strong>Autor:</strong> {{ $book->author }}</p>
            <p><strong>Editora:</strong> {{ $book->publisher ?? 'N/A' }}</p>
            <p><strong>Descrição:</strong> {{ $book->description }}</p>
            <p><strong>Ano:</strong> {{ $book->year ?? 'N/A' }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($book->status) }}</p>
            <p><strong>Quantidade total:</strong> {{ $book->quantity_total }}</p>
            <p><strong>Quantidade disponível:</strong> {{ $book->quantity_available }}</p>
            <a href="{{ route('books.index') }}" class="btn-back2">Voltar</a>
        </div>
    </div>
@endsection