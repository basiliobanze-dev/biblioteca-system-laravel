<?php $__env->startSection('content'); ?>
<div class="container" style="margin-bottom: 200px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body text-center">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                    <?php endif; ?>

                    <h3>Bem-vindo, <?php echo e(Auth::user()->name); ?> 👋</h3>
                    <p class="lead mt-3">Você está logado como <strong><?php echo e(Auth::user()->role_label); ?></strong>.</p>

                    <div class="mt-4">
                        <p>Aqui você pode acessar funcionalidades do sistema conforme seu perfil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/home.blade.php ENDPATH**/ ?>