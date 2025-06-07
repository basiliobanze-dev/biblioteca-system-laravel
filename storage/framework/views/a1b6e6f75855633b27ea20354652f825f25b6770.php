<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Histórico de Ações de Empréstimo</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Ação</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($log->user->name ?? 'Sistema'); ?></td>
                <td><?php echo e(ucfirst($log->action)); ?></td>
                <td><?php echo e($log->description); ?></td>
                <td><?php echo e($log->created_at->format('d/m/Y H:i')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4" class="text-center">Nenhum log encontrado.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($logs->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/audit_logs/index.blade.php ENDPATH**/ ?>