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
            <th>Ações/Estado</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($loans as $loan)
            <tr>
                <td>{{ $loan->protocol }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->loan_date->format('d/m/Y H:i') }}</td>
                <td>{{ $loan->due_date->format('d/m/Y') }}</td>
                <td>
                    @if($loan->return_date)
                        {{ \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y H:i') }}
                    @else
                        ————————
                    @endif
                </td>
                <td>{{ ucfirst($loan->status_label) }}</td>
                <td>{{ number_format($loan->calculated_fine ?? 0, 2, ',', '.') }}</td>
                <td>
                    <div class="loan-action-btn-container">
                        @if($loan->status === 'active')
                            <form action="{{ route('loans.return.process', $loan) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="return_date" value="{{ now()->format('Y-m-d H:i:s') }}">
                                <button type="submit" class="loan-action-btn loan-action-btn--return">Registrar Devolução</button>
                            </form>
                        @elseif($loan->status === 'pending' && in_array(auth()->user()->role, ['admin', 'librarian']))
                            <form action="{{ route('loans.approve', $loan) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="loan-action-btn loan-action-btn--approve">Confirmar Empréstimo</button>
                            </form>
                        @elseif($loan->status === 'expired')
                            <span class="text-muted">Solicitação Expirada</span>
                        @else
                            <span class="text-muted">{{ ucfirst($loan->status_label) }}</span>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="8">Nenhum resultado encontrado.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $loans->links() }}