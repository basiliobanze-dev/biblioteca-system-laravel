<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div style="height: 50px; background-color: #1d2a3a;"></div>

    <div class="text-center bg-white border-bottom" style="padding: 20px 0;">
        <h4 class="m-0">GESTÃO DE LIVROS</h4>
    </div>

    @include('partials.header')

    <div class="container mt-4">
         @yield('content') <!-- container to exib content of the views  -->
    </div>


    {{-- Sidebar de navegação --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="menuSidebarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <!-- <li><a href="{{ route('books.create') }}" class="nav-link">Cadastrar Livro</a></li> -->
                
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>