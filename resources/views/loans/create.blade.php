@extends('layouts.app')

@section('content')
    <div class="loan-request">
        <form method="POST" action="{{ route('loans.store') }}" class="loan-request__form">
            @csrf

            <div class="loan-request__header">
                <h2 class="loan-request__title"><i class="fa fa-file-signature"></i> Resgistrar Empréstimo</h2>
            </div>

            <div class="loan-request__form-group">
                <label for="due_date" class="loan-request__label">Data Prevista da Devolução:</label>
                <input type="date" name="due_date" id="due_date" class="loan-request__input" required 
                    min="{{ now()->addDay()->format('Y-m-d') }}">
            </div>


            <div class="loan-request__form-group">
                <label for="user_search" class="loan-request__label">Pesquisar Usuário</label>
                <input type="text" id="user_search" name="user_search" class="loan-request__input" placeholder="Pesquisar nome ou email..." list="user_list" autocomplete="off" required>
                <datalist id="user_list">
                    @foreach ($users as $user)
                        <option value="{{ $user->name }} ({{ $user->email }})" data-id="{{ $user->id }}">
                    @endforeach
                </datalist>
                <input type="hidden" name="user_id" id="user_id">
            </div>


            <div class="loan-request__form-group">
                <label for="book_search" class="loan-request__label">Pesquisar Livro</label>
                <input type="text" id="book_search" class="loan-request__input" placeholder="Pesquisar por título, autor ou ano...">
            </div>

            <div class="loan-request__books-container">
                <div id="book_list" class="loan-request__books-grid">
                    @forelse ($books as $book)
                        <div class="loan-request__book-card">
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
                    <i class="fa-solid fa-book"></i> Registrar Empréstimo
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

    <script>
        document.getElementById('user_search').addEventListener('change', function () {
            const selectedText = this.value;
            const datalist = document.getElementById('user_list').options;

            for (let i = 0; i < datalist.length; i++) {
                if (datalist[i].value === selectedText) {
                    document.getElementById('user_id').value = datalist[i].dataset.id;
                    break;
                }
            }
        });

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