@php
    $routeName = \Request::route()->getName();
    $segments = explode('.', $routeName); // Ex: books.create => ['books', 'create']
    $resource = $segments[0] ?? 'livros';
    $action = $segments[1] ?? 'index';

    $resourceTitles = [
        'books' => 'Livro',
        'users' => 'Usuário',
    ];

    $pluralTitles = [
        'books' => 'Livros',
        'users' => 'Usuários',
    ];

    switch ($action) {
        case 'index':
            $pageTitle = $pluralTitles[$resource] ?? ucfirst($resource);
            break;
        case 'create':
            $pageTitle = 'Adicionar ' . ($resourceTitles[$resource] ?? ucfirst($resource));
            break;
        case 'edit':
            $pageTitle = 'Editar ' . ($resourceTitles[$resource] ?? ucfirst($resource));
            break;
        case 'show':
            $pageTitle = 'Detalhes do ' . ($resourceTitles[$resource] ?? ucfirst($resource));
            break;
        default:
            $pageTitle = $pluralTitles[$resource] ?? ucfirst($resource);
    }
@endphp


<div style="background-color:rgb(196, 196, 196); border-bottom: 2px solid #1d2a3a; border-top: 2px solid #1d2a3a;">
    <div class="container-fluid py-2 d-flex align-items-center">
        
        <button class="btn p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar" aria-controls="menuSidebar">
            <i class="fas fa-bars fa-lg" style="color: #1d2a3a;"></i>
        </button>

        <span class="fw-semibold" style="color: #1d2a3a;">{{ $pageTitle }}</span>
    </div>
</div>
