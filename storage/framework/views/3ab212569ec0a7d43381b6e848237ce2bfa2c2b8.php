<?php
    $routeName = \Request::route()->getName();

    if ($routeName === 'home') {
        $pageTitle = 'Início';
    } elseif ($routeName === 'profile.show') {
        $pageTitle = 'Perfil';
    } elseif ($routeName === 'profile.edit') {
        $pageTitle = 'Editar Perfil';
    } else {
        $segments = explode('.', $routeName); // Ex: books.create => ['books', 'create']
        $resource = $segments[0] ?? 'livros';
        $action = $segments[1] ?? 'index';

        $resourceTitles = [
            'books' => 'Livro',
            'users' => 'Usuário',
        ];

        switch ($action) {
            case 'index':
                $pageTitle = 'Gestão de ' . ($resourceTitles[$resource] ?? ucfirst($resource));
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
                $pageTitle = ucfirst($resource);
        }
    }
?>

<div>
    <div class="top-bar"></div>
    <div class="header d-flex justify-content-between align-items-center px-3 bg-white border-bottom">
        <h4 class="m-0 text-center w-100">
            <i class="fa-solid fa-book icon-color"></i> BIBLIOTECA ONLINE
        </h4>

        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('profile.show')); ?>" class="d-flex align-items-center gap-2 text-decoration-none" style="position: absolute; right: 15px;">
                <span class="fw-semibold text-dark">
                    <?php echo e(Auth::user()->name); ?>

                </span>

                <?php if(Auth::user()->account && Auth::user()->account->profile_image): ?>
                    <img src="<?php echo e(asset('storage/profiles/' . Auth::user()->account->profile_image)); ?>"
                        alt="Perfil" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                <?php else: ?>
                    <i class="fa-solid fa-user-circle fa-2x" style="color: #1d2a3a;"></i>
                <?php endif; ?>
            </a>
        <?php endif; ?>

    </div>
</div>

<div class="menu-bar">
    <div class="container-fluid py-2 d-flex align-items-center">

        <button class="btn p-0 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar" aria-controls="menuSidebar">
            <i class="fas fa-bars fa-lg icon-color"></i>
        </button>

        <span class="fw-semibold text-primary-custom"><?php echo e($pageTitle); ?></span>
    </div>
</div>
<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/partials/header.blade.php ENDPATH**/ ?>