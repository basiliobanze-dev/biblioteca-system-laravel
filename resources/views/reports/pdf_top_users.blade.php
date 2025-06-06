<h3>Usuários com Mais Empréstimos</h3>
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
        @foreach ($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->user->name ?? 'Removido' }}</td>
            <td>{{ $user->user->email ?? '-' }}</td>
            <td>{{ $user->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>