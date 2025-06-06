<h3>Livros Mais Emprestados</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Total de Empréstimos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->book->title ?? 'Livro removido' }}</td>
            <td>{{ $item->book->author ?? '-' }}</td>
            <td>{{ $item->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>