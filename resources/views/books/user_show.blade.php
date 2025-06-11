@extends('layouts.app')

@section('content')
    <div class="book-details-container">
        <div class="book-cover">
            @if($book->cover_image)
                <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="Capa do livro {{ $book->title }}">
            @else
                <!-- <img src="https://via.placeholder.com/310x500?text=Sem+Capa" alt="Sem capa disponível"> -->
                <div class="no-cover-preview">
                    <span>Sem Capa.</span>
                </div>
            @endif
        </div>

        <div class="book-info">
            <h2>{{ $book->title }}</h2>

            <div class="book-field">
                <span class="label"><i class="fas fa-user"></i> Autor:</span>
                <span class="value">{{ $book->author }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-building"></i> Editora:</span>
                <span class="value">{{ $book->publisher ?? 'N/A' }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-align-left"></i> Descrição:</span>
                <span class="value">{{ $book->description }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-calendar-alt"></i> Ano:</span>
                <span class="value">{{ $book->year ?? 'N/A' }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-barcode"></i> ISBN:</span>
                <span class="value">{{ $book->isbn }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-check-circle"></i> Estado:</span>
                <span class="value">{{ ucfirst($book->status) }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-layer-group"></i> Total:</span>
                <span class="value">{{ $book->quantity_total }}</span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-book-open"></i> Disponível:</span>
                <span class="value">{{ $book->quantity_available }}</span>
            </div>

            <div class="book-actions">
                <a href="{{ url()->previous() }}" class="btn-close top-right"><i class="fas fa-times"></i></a>

                <!-- <div class="action-buttons bottom-right">
                    <a href="{{ route('books.edit', $book) }}" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
@endsection
