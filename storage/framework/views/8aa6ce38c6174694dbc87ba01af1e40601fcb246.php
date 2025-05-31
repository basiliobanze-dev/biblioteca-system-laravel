<?php $__env->startSection('content'); ?>
    <div class="user-card">
        <p><strong>Nome:</strong> <?php echo e($user->name); ?></p>
        <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
        <p><strong>Perfil:</strong>
            <?php if($user->role === 'admin'): ?>
                Administrador
            <?php elseif($user->role === 'librarian'): ?>
                Bibliotecário
            <?php else: ?>
                Leitor
            <?php endif; ?>
        </p>

        <a href="<?php echo e(route('users.index')); ?>" class="btn-user-back">Voltar</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/users/show.blade.php ENDPATH**/ ?>