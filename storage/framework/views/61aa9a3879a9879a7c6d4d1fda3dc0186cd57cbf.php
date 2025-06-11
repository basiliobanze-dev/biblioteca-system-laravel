<?php $__env->startSection('content'); ?>
    <div class="admin-container">

        <div class="library-banner">
            <div class="banner-overlay">
                <h1 class="admin-title"><i class="fas fa-chart-line"></i> Painel Administrativo</h1>
                <!-- <p class="welcome-message">Bem-vindo ao seu espaço literário, <?php echo e(Auth::user()->name); ?>!</p>            -->
                <p class="welcome-message">Bem-vindo(a) <?php echo e(Auth::user()->name); ?>, você está logado(a) como <strong><?php echo e(Auth::user()->role_label); ?>(a)</strong>.</p>
            </div>
        </div>
        
        <div class="admin-grid">
            <div class="admin-card">
                <h3 class="card-title"><i class="fas fa-cog"></i> Gerenciamento</h3>
                <div class="card-links">
                    <a href="<?php echo e(route('books.index')); ?>" class="admin-link">
                        <i class="fas fa-book"></i> Gerenciar Livros
                    </a>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('users.index')); ?>" class="admin-link">
                            <i class="fas fa-users"></i> Gerenciar Usuários
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo e(route('loans.index')); ?>" class="admin-link">
                        <i class="fas fa-exchange-alt"></i> Empréstimos & Devoluções
                    </a>
                </div>
            </div>
            
            <div class="admin-card">
                <h3 class="card-title"><i class="fas fa-chart-pie"></i> Relatórios</h3>
                <div class="card-links">
                    <a href="<?php echo e(route('reports.top-books')); ?>" class="admin-link">
                        <i class="fas fa-chart-bar"></i> Relatório: Livros
                    </a>
                    <a href="<?php echo e(route('reports.top-users')); ?>" class="admin-link">
                        <i class="fas fa-chart-bar"></i></i> Relatório: Usuários
                    </a>
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('audit_logs.index')); ?>" class="admin-link">
                            <i class="fas fa-clipboard-list"></i> Logs de Auditoria
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>