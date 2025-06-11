@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="audit-log-header">
            <h2>Histórico de Ações de Empréstimo</h2>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Ação</th>
                    <th>Descrição</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'Sistema' }}</td>
                    <td>{{ ucfirst($log->action) }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum log encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $logs->links() }}
    </div>
@endsection
