@php
    $routeName = \Request::route()->getName();

    switch ($routeName) {
        case 'books.index':
            $pageTitle = 'Livros';
            break;
        case 'books.create':
            $pageTitle = 'Adicionar';
            break;
        case 'books.edit':
            $pageTitle = 'Editar';
            break;
        default:
            $pageTitle = 'Livros';
    }
@endphp

<div style="background-color: #dcdcdc; border-bottom: 2px solid #1d2a3a; border-top: 2px solid #1d2a3a;">
    <div class="container-fluid py-2 d-flex align-items-center">
        <button class="btn p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar" aria-controls="menuSidebar">
            <i class="fas fa-bars fa-lg" style="color: #1d2a3a;"></i>
        </button>
        <span class="fw-semibold" style="color: #1d2a3a;">{{ $pageTitle }}</span>
    </div>
</div>
