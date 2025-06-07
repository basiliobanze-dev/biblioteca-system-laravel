<?php $__env->startSection('content'); ?>
<div class="admin-container">
    <h2 class="admin-title"><i class="fas fa-chart-line"></i> Painel Administrativo</h2>
    
    <div class="admin-grid">
        <div class="admin-card">
            <h3 class="card-title"><i class="fas fa-cog"></i> Gerenciamento</h3>
            <div class="card-links">
                <a href="<?php echo e(route('books.index')); ?>" class="admin-link">
                    <i class="fas fa-book"></i> Gerenciar Livros
                </a>
                <a href="<?php echo e(route('users.index')); ?>" class="admin-link">
                    <i class="fas fa-users"></i> Gerenciar Usuários
                </a>
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
                <a href="<?php echo e(route('audit_logs.index')); ?>" class="admin-link">
                    <i class="fas fa-clipboard-list"></i> Logs de Auditoria
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>