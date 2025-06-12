@extends('layouts.app')

@section('content')
    <div class="loan-request">
        <form method="POST" action="{{ route('loans.store') }}" class="loan-request__form">
            @csrf

            <div class="loan-request__header">
                <h2 class="loan-request__title"><i class="fas fa-paper-plane"></i> Solicitar Empréstimo</h2>
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="loan-request__form-group">
                <label for="due_date" class="loan-request__label">Data Prevista da Devolução:</label>
                <input type="date" name="due_date" id="due_date" class="loan-request__input" required 
                    min="{{ now()->addDay()->format('Y-m-d') }}">
            </div>

            <div class="loan-request__form-group">
                <label for="book_search" class="loan-request__label">Pesquisar Livro</label>
                <input type="text" id="book_search" class="loan-request__input" placeholder="Pesquisar por título, autor ou ano...">
            </div>

            <div class="loan-request__books-container">
                <div id="book_list" class="loan-request__books-grid">
                    @forelse ($books as $book)
                        <div class="loan-request__book-card">
                            <a href="{{ route('books.user_show', $book->id) }}" class="loan-request__book-card-link">
                                <div class="loan-request__book-cover-container">
                                    @if($book->cover_image)
                                        <img src="{{ asset('storage/covers/' . $book->cover_image) }}" 
                                            alt="Capa do livro {{ $book->title }}"
                                            class="loan-request__book-cover">
                                    @else
                                        <div class="loan-request__book-cover-placeholder">
                                            <i class="fas fa-book"></i>
                                            <span>Sem Capa</span>
                                        </div>
                                    @endif
                                </div>
                            </a>        
                            <div class="loan-request__book-details">
                                <div class="loan-request__book-selection">
                                    <input type="checkbox" name="book_ids[]" value="{{ $book->id }}"
                                        class="loan-request__book-checkbox" id="book_{{ $book->id }}"
                                        {{ $book->quantity_available <= 0 ? 'disabled' : '' }}>
                                    <label for="book_{{ $book->id }}" class="loan-request__book-title">
                                        {{ $book->title }}
                                    </label>
                                </div>
                                <div class="loan-request__book-info">
                                    <p class="loan-request__book-meta"><strong>Autor:</strong> {{ $book->author }}</p>
                                    <p class="loan-request__book-meta"><strong>Ano:</strong> {{ $book->year }}</p>
                                    <p class="loan-request__book-availability {{ $book->quantity_available <= 0 ? 'loan-request__book-availability--unavailable' : 'loan-request__book-availability--available' }}">
                                        <strong>Disponíveis:</strong> {{ $book->quantity_available }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="loan-request__no-books">Nenhum livro disponível.</p>
                    @endforelse
                </div>
            </div>

            <div class="loan-request__submit">
                <button type="submit" class="loan-request__submit-button">
                    <i class="fas fa-paper-plane"></i> Solicitar Empréstimo
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('book_search').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const books = document.querySelectorAll('.loan-request__book-card');

            books.forEach(function (book) {
                const cardText = book.textContent.toLowerCase();
                book.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
            });
        });

        document.querySelectorAll('.loan-request__book-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const checked = document.querySelectorAll('.loan-request__book-checkbox:checked');
                if (checked.length > 3) {
                    alert('Você só pode selecionar até 3 livros.');
                    this.checked = false;
                }
            });
        });
    </script>
@endsection