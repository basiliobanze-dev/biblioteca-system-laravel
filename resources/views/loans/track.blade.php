@extends('layouts.app')

@section('content')
    <p><strong>Código:</strong> {{ $loan->protocol }}</p>
    <p><strong>Usuário:</strong> {{ $loan->user->name }} ({{ $loan->user->email }})</p>
    <p><strong>Estado:</strong> {{ ucfirst($loan->status_label) }}</p>
    <p><strong>Data:</strong> {{ $loan->loan_date->format('d/m/Y H:i') }}</p>
    <p><strong>Data Prevista da Devolução:</strong> {{ $loan->due_date->format('d/m/Y') }}</p>
    <p><strong>Data da Devolução:</strong>
        {{ $loan->return_date ? $loan->return_date->format('d/m/Y H:i') : '————————' }}
    </p>
    <p><strong>Multa:</strong> {{ number_format($loan->fine_amount, 2, ',', '.') }} MZN</p>

    <h4>Livros:</h4>
    <ul>
        @foreach ($loan->items as $item)
            <li>
                {{ $item->book->title }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('loans.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
