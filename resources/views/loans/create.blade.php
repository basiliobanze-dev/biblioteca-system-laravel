@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf

        <div class="mb-3">
            <label for="due_date" class="form-label">Data Prevista da Devolução:</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>

        <!-- Busca por nome ou email -->
        <div class="mb-3">
            <label for="user_search" class="form-label">Pesquisar Usuário</label>
            <input type="text" id="user_search" name="user_search" class="form-control" placeholder="Pesquisar nome ou email..." list="user_list" autocomplete="off" required>
            <datalist id="user_list">
                @foreach ($users as $user)
                    <option value="{{ $user->name }} ({{ $user->email }})" data-id="{{ $user->id }}">
                @endforeach
            </datalist>
            <input type="hidden" name="user_id" id="user_id">
        </div>

        <!-- Campo de pesquisa -->
        <div class="mb-3">
            <label for="book_search" class="form-label">Pesquisar Livro</label>
            <input type="text" id="book_search" class="form-control" placeholder="Pesquisar por título, autor ou ano...">
        </div>

        <!-- Lista de livros com checkboxes -->
        <div id="book_list" class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-3 book-item">
                    <div class="card h-100">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/covers/' . $book->cover_image) }}" class="card-img-top" alt="Capa do livro" style="height: 200px; object-fit: contain;">
                        @else
                            <div class="text-center py-5 bg-light">Sem Capa.</div>
                        @endif
                        <div class="card-body">
                            <div class="form-check">
                                <input type="checkbox" name="book_ids[]" value="{{ $book->id }}" 
                                    class="form-check-input book-checkbox" id="book_{{ $book->id }}"
                                    {{ $book->quantity_available <= 0 ? 'disabled' : '' }}>
                                <label class="form-check-label" for="book_{{ $book->id }}">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                </label>
                            </div>
                            <p class="card-text">
                                <strong>Autor:</strong> {{ $book->author }}<br>
                                <strong>Ano:</strong> {{ $book->year }}<br>
                                <strong>Disponíveis:</strong> {{ $book->quantity_available }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    <!-- Script para preencher o user_id automaticamente -->
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
        const books = document.querySelectorAll('.book-item');

        books.forEach(function (book) {
            const cardText = book.textContent.toLowerCase();
            book.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
        });
    });

    document.querySelectorAll('.book-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const checked = document.querySelectorAll('.book-checkbox:checked');
            if (checked.length > 3) {
                alert('Você só pode selecionar até 3 livros.');
                this.checked = false;
            }
        });
    });
    </script>
@endsection