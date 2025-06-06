@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Usuários com Mais Empréstimos</h2>
        <a href="{{ route('reports.top-users.pdf') }}" class="btn btn-sm btn-outline-primary">
            📄 Exportar PDF
        </a>
    </div>


    <!-- <h2 class="form-check-label text-dark">Usuários com Mais Empréstimos</h2> -->

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
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->user->name ?? 'Usuário removido' }}</td>
                    <td>{{ $user->user->email ?? '-' }}</td>
                    <td>{{ $user->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum dado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
