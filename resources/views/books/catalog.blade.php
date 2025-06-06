@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📚 Catálogo de Livros Disponíveis</h2>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Digite o título ou autor...">

    <table class="table table-hover table-striped" id="booksTable">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Disponíveis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>
                    <a href="{{ route('books.show', $book->id) }}">
                        {{ $book->title }}
                    </a>
                </td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->quantity_available }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#booksTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endpush
