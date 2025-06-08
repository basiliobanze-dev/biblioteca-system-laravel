@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Registrar Empréstimo</a>

        <form action="{{ route('loans.track') }}" method="GET" class="d-flex">
            <input type="text" name="protocol" class="form-control me-2" placeholder="Código (ex: EMP-202506071887C8)" required>
            <button type="submit" class="btn btn-secondary">Rastrear</button>
        </form>
    </div>

    <form method="GET" action="{{ route('loans.index') }}" class="d-flex gap-2 mb-3">
        <input type="text" name="user" placeholder="Buscar por usuário..." class="form-control" value="{{ request('user') }}">
        <input type="text" name="book" placeholder="Buscar por livro..." class="form-control" value="{{ request('book') }}">
        <select name="status" class="form-select">
            <option value="">-- Todos --</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Somente Ativos</option>
        </select>
        <button class="btn btn-outline-primary">Filtrar</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>Data Prev.</th>
                <th>Devolução</th>
                <th>Estado</th>
                <th>Multa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr>
                <td>{{ $loan->protocol }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->loan_date->format('d/m/Y H:i') }}</td>
                <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                <td>
                    @if($loan->return_date)
                        {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y H:i') }}
                    @else
                        Ainda não devolvido
                    @endif
                </td>
                <td>
                    @if($loan->status === 'active' && now()->gt($loan->due_date))
                        {{ ucfirst($loan->status_label) }}
                    @else
                        {{ ucfirst($loan->status_label) }}
                    @endif
                </td>
                <!-- <td>{{ number_format($loan->fine_amount, 2, ',', '.') }}</td> -->
                <td>{{ number_format($loan->calculated_fine ?? 0, 2, ',', '.') }}</td>
                <td>
                    @if($loan->status === 'active')
                        <form action="{{ route('loans.return.process', $loan) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="return_date" value="{{ now()->format('Y-m-d H:i:s') }}">
                            <!-- <input type="hidden" name="return_date" value="{{ $loan->due_date->addDays(3)->format('Y-m-d H:i:s') }}"> -->

                            <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Confirma a devolução deste empréstimo?')">Registrar Devolução</button>
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
@endsection
