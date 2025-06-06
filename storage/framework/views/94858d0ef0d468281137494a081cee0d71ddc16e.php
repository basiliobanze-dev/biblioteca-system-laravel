<?php $__env->startSection('content'); ?>
<div class="container">
    
    <a href="<?php echo e(route('loans.track')); ?>" class="btn btn-outline-info w-100 mb-2">🧾 Rastrear Empréstimo por Protocolo</a>

    <a href="<?php echo e(route('loans.create')); ?>" class="btn btn-outline-primary w-100 mb-2">📚 Registrar Empréstimo</a>
    <h2>Empréstimos Registrados</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Usuário</th>
                <th>Data do Empréstimo</th>
                <th>Data de Devolução</th>
                <th>Status</th>
                <th>Multa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loan->protocol); ?></td>
                <td><?php echo e($loan->user->name); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y')); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($loan->due_date)->format('d/m/Y')); ?></td>
                <td><?php echo e($loan->status_label); ?></td>
                <td><?php echo e(number_format($loan->fine_amount, 2, ',', '.')); ?> MZN</td>
                <td>
                    <?php if($loan->status === 'borrowed'): ?>
                        <form action="<?php echo e(route('loans.return', $loan->id)); ?>" method="POST" onsubmit="return confirm('Confirmar devolução?');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-success">Devolver</button>
                        </form>
                    <?php else: ?>
                        <span class="text-muted">Devolvido</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <?php echo e($loans->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/index.blade.php ENDPATH**/ ?>