@extends('layouts.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código do Empréstimo</th>
                <th>Data do Empréstimo</th>
                <th>Data Prev. Devolução</th>
                <th>Data da Devolução</th>
                <th>Estado</th>
                <th>Livros</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loans as $loan)
            <tr>
                <td>{{ $loan->protocol }}</td>
                <td>{{ $loan->loan_date->format('d/m/Y H:i') }}</td>
                <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                <td>
                    {{ $loan->return_date ? $loan->return_date->format('d/m/Y H:i') : '————————' }}
                </td>
                <td>
                    @if($loan->status === 'active' && now()->gt($loan->due_date))
                        {{ ucfirst($loan->status_label) }}
                    @else
                        {{ ucfirst($loan->status_label) }}
                    @endif
                </td>
                <td>
                    <ul>
                        @foreach ($loan->items as $item)
                            <li>{{ $item->book->title ?? 'Livro removido' }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Você ainda não fez nenhum empréstimo.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{ $loans->links() }}
@endsection
