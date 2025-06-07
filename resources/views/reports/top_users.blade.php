@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Usuários com Mais Empréstimos</h2>
        <a href="{{ route('reports.top-users.pdf') }}" class="btn btn-sm btn-outline-primary">
            📄 Exportar PDF
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Total de Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->name ?? 'Usuário removido' }}</td>
                    <td>{{ $item->user->email ?? '-' }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum dado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection