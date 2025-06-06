@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Novo Empréstimo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros:</strong>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select name="user_id" class="form-control" required>
                <option value="">Selecione...</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Livros</label>
            <div id="livros-lista">
                @foreach($books as $book)
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="books[]" value="{{ $book->id }}" id="book_{{ $book->id }}">
                    <label class="form-check-label text-dark" for="book_{{ $book->id }}">
                        {{ $book->title }} (Disponíveis: {{ $book->quantity_available }})
                    </label>
                    <input type="number" name="quantities[{{ $book->id }}]" class="form-control mt-1" placeholder="Quantidade" min="1" max="{{ $book->quantity_available }}">
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Data de Devolução</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar Empréstimo</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
