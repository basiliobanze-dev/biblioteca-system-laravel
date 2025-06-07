<h3 style="text-align: center;">👥 Relatório: Usuários com Mais Empréstimos</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Total de Empréstimos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->user->name ?? 'Usuário removido' }}</td>
            <td>{{ $item->user->email ?? '-' }}</td>
            <td>{{ $item->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>