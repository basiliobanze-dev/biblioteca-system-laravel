<div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <ul class="list-unstyled">
                <li><a href="<?php echo e(route('home')); ?>" class="nav-link"><i class="fa-solid fa-house"></i> Início</a></li>
                <li><a href="<?php echo e(route('books.index')); ?>" class="nav-link"><i class="fa-solid fa-book"></i> Livros</a></li>
                <li><a href="<?php echo e(route('users.index')); ?>" class="nav-link"><i class="fa-solid fa-users"></i> Usuários</a></li>
            </ul>
        </div>

        <?php if(auth()->guard()->check()): ?>
            <div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">   
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="nav-link btn btn-link text-start w-100">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/partials/side-bar.blade.php ENDPATH**/ ?>