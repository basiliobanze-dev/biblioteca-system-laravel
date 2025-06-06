@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🔍 Rastrear Empréstimo por Protocolo</h2>

    <form method="GET" action="{{ route('loans.track') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="protocol" class="form-control" placeholder="Digite o protocolo ex: EMP-665F1C2B" required>
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @if(request()->has('protocol') && !$loan)
        <div class="alert alert-warning">Nenhum empréstimo encontrado com esse protocolo.</div>
    @endif

    @if($loan)
        <div class="card">
            <div class="card-header">
                <strong>Protocolo:</strong> {{ $loan->protocol }}<br>
                <strong>Usuário:</strong> {{ $loan->user->name }} ({{ $loan->user->email }})<br>
                <strong>Status:</strong> {{ ucfirst($loan->status) }}<br>
                <strong>Multa:</strong> {{ number_format($loan->fine_amount, 2, ',', '.') }} MZN
            </div>
            <div class="card-body">
                <p><strong>Data do Empréstimo:</strong> {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</p>
                <p><strong>Data de Devolução:</strong> {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</p>

                <h5>📚 Livros emprestados:</h5>
                <ul>
                    @foreach ($loan->items as $item)
                        <li>{{ $item->book->title ?? 'Livro removido' }} ({{ $item->quantity }}x)</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@endsection
