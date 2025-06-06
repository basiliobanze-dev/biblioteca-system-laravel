@extends('layouts.app')

@section('content')
<div class="container">
    
    <a href="{{ route('loans.track') }}" class="btn btn-outline-info w-100 mb-2">🧾 Rastrear Empréstimo por Protocolo</a>

    <a href="{{ route('loans.create') }}" class="btn btn-outline-primary w-100 mb-2">📚 Registrar Empréstimo</a>
    <h2>Empréstimos Registrados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Usuário</th>
                <th>Data do Empréstimo</th>
                <th>Data de Devolução</th>
                <th>Status</th>
                <th>Multa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr>
                <td>{{ $loan->protocol }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</td>
                <td>{{ $loan->status_label }}</td>
                <td>{{ number_format($loan->fine_amount, 2, ',', '.') }} MZN</td>
                <td>
                    @if($loan->status === 'borrowed')
                        <form action="{{ route('loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Confirmar devolução?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Devolver</button>
                        </form>
                    @else
                        <span class="text-muted">Devolvido</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $loans->links() }}
</div>
@endsection
