@extends('layouts.app')

@section('content')
<h2>Rastreamento de Empréstimo</h2>

<p><strong>Código:</strong> {{ $loan->protocol }}</p>
<p><strong>Usuário:</strong> {{ $loan->user->name }} ({{ $loan->user->email }})</p>
<p><strong>Estado:</strong> {{ ucfirst($loan->status_label) }}</p>
<p><strong>Data:</strong> {{ $loan->loan_date->format('d/m/Y H:i') }}</p>
<p><strong>Data Prevista da Devolução:</strong> {{ $loan->due_date->format('d/m/Y') }}</p>
<p><strong>Data da Devolução:</strong>
    {{ $loan->return_date ? $loan->return_date->format('d/m/Y H:i') : 'Ainda não devolvido' }}
</p>
<p><strong>Multa:</strong> {{ number_format($loan->fine_amount, 2, ',', '.') }} MZN</p>

<hr>
<h4>Livros Emprestados</h4>
<ul>
    @foreach ($loan->items as $item)
        <li>
            {{ $item->book->title }} — 
            <strong>Status:</strong> {{ $item->returned ? 'Devolvido' : 'Ainda não devolvido' }}
        </li>
    @endforeach
</ul>

<a href="{{ route('loans.index') }}" class="btn btn-secondary mt-3">Voltar à Lista</a>
@endsection
