@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📖 Meus Empréstimos</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Data do Empréstimo</th>
                <th>Devolução Prevista</th>
                <th>Status</th>
                <th>Livros</th>
                <th>Multa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>{{ $loan->protocol }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($loan->status) }}</td>
                    <td>
                        <ul>
                            @foreach ($loan->items as $item)
                                <li>{{ $item->book->title ?? 'Livro removido' }} ({{ $item->quantity }}x)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($loan->fine_amount, 2, ',', '.') }} MZN</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhum empréstimo encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $loans->links() }}
</div>
@endsection
