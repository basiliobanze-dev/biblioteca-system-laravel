<?php $__env->startSection('content'); ?>
<h2>Registrar Devolução</h2>

<form action="<?php echo e(route('loans.return.process', $loan)); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <p><strong>Usuário:</strong> <?php echo e($loan->user->name); ?></p>
    <p><strong>Protocolo:</strong> <?php echo e($loan->protocol); ?></p>
    <p><strong>Data do Empréstimo:</strong> <?php echo e($loan->loan_date->format('d/m/Y H:i')); ?></p>
    <p><strong>Data Prevista de Devolução:</strong> <?php echo e($loan->due_date->format('d/m/Y H:i')); ?></p>

    <div class="mb-3">
        <label for="return_date" class="form-label">Data de Devolução Real</label>
        <input type="datetime-local" name="return_date" class="form-control" value="<?php echo e(now()->format('Y-m-d\TH:i')); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Confirmar Devolução</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/return.blade.php ENDPATH**/ ?>