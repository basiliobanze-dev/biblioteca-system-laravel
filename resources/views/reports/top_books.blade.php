@extends('layouts.app')

@section('content')
        <div class="top-header">
            <h2>Livros Mais Emprestados</h2>
            <a href="{{ route('reports.top-books.pdf') }}">
                📄 Exportar PDF
            </a>
        </div>

        <table class="table table-bordered">
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
        {{ $books->links() }}
    </div>
@endsection
