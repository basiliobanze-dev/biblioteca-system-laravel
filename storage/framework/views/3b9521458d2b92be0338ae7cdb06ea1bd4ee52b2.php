<div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <ul class="list-unstyled">
                <li><a href="<?php echo e(route('dashboard')); ?>" class="nav-link"><i class="fa-solid fa-house"></i> Início</a></li>
                
                <?php if(in_array(auth()->user()->role, ['admin', 'librarian'])): ?>
                    <li><a href="<?php echo e(route('books.index')); ?>" class="nav-link"><i class="fa-solid fa-book"></i> Gerenciar Livros</a></li>
                <?php endif; ?>
                
                <?php if(auth()->user()->role === 'admin'): ?>
                    <li><a href="<?php echo e(route('users.index')); ?>" class="nav-link"><i class="fa-solid fa-users"></i> Gerenciar Usuários</a></li>
                <?php endif; ?>
                
                <?php if(in_array(auth()->user()->role, ['admin', 'librarian'])): ?>
                    <li><a href="<?php echo e(route('loans.index')); ?>" class="nav-link"><i class="fas fa-exchange-alt"></i> Empréstimos & Devoluções</a></li>
                    <li><a href="<?php echo e(route('reports.top-books')); ?>" class="nav-link"><i class="fas fa-chart-pie"></i> Relatório: Livros</a></li>
                    <li><a href="<?php echo e(route('reports.top-users')); ?>" class="nav-link"><i class="fas fa-chart-pie"></i> Relatório: Usuários</a></li>
                <?php endif; ?>
                
                <?php if(auth()->user()->role === 'admin'): ?>
                    <li><a href="<?php echo e(route('audit_logs.index')); ?>" class="nav-link"><i class="fa-solid fa-users"></i> Logs de Auditoria</a></li>
                <?php endif; ?>

                <?php if(in_array(auth()->user()->role, ['admin', 'reader'])): ?>
                    <li><a href="<?php echo e(route('loans.my')); ?>" class="nav-link"><i class="fas fa-bookmark"></i> Meus Empréstimos</a></li>
                    <li><a href="<?php echo e(route('loans.request')); ?>" class="nav-link"><i class="fas fa-book-open"></i> Buscar Livros</a></li>
                <?php endif; ?>
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
</div><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/partials/side_bar.blade.php ENDPATH**/ ?>