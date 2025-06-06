@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📚 Livros Mais Emprestados</h2>
        <a href="{{ route('reports.top-books.pdf') }}" class="btn btn-sm btn-outline-primary">
            📄 Exportar PDF
        </a>
    </div>

    <!-- <h2 class="form-check-label text-dark">Livros Mais Emprestados</h2> -->

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Total de Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->book->title ?? 'Livro removido' }}</td>
                    <td>{{ $item->book->author ?? '-' }}</td>
                    <td>{{ $item->total }}</td>
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