@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('books.create') }}" class="btn btn-add mb-3">Adicionar Livro</a>

            <form method="GET" action="{{ route('books.index') }}" class="search-form d-flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar por título, autor ou ano..." class="search-input form-control form-control-sm">
                <button type="submit" class="search-button btn btn-primary btn-sm ml-2">Pesquisar</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <!-- <th>Editora</th> -->
                    <!-- <th>Description</th> -->
                    <th>Ano</th>
                    <!-- <th>ISBN</th> -->
                    <th>Estado</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="Capa" style="width: 50px; height: 50px; border-radius: 4px;">
                            @else
                                <p class="no-cover2">Sem capa.</p>
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <!-- <td>{{ $book->publisher }}</td> -->
                        <!-- <td>{{ $book->description }}</td> -->
                        <td>{{ $book->year }}</td>
                        <!-- <td>{{ $book->isbn }}</td> -->
                        <td>{{ $book->status }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-view" data-bs-toggle="modal" data-bs-target="#bookDetailsModal{{ $book->id }}">
                                <i class="fas fa-eye"></i>
                            </a>

                            @include('books.show_modal', ['book' => $book])
                            
                            <!-- <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-remove" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash-alt"></i></button>
                            </form> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $books->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // remove após o fade
                }, 3000); // 3 segundos
            }
        });
    </script>
@endsection
