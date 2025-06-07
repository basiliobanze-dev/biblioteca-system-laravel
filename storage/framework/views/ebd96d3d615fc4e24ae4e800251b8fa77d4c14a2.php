<?php $__env->startSection('content'); ?>
<h2>📚 Meus Empréstimos</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Código do Empréstimo</th>
            <th>Data do Empréstimo</th>
            <th>Data Prev. Devolução</th>
            <th>Data da Devolução</th>
            <th>Estado</th>
            <th>Livros</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($loan->protocol); ?></td>
            <td><?php echo e($loan->loan_date->format('d/m/Y H:i')); ?></td>
            <td><?php echo e($loan->due_date->format('d/m/Y')); ?></td>
            <td>
                <?php echo e($loan->return_date ? $loan->return_date->format('d/m/Y H:i') : 'Ainda não devolvido'); ?>

            </td>
            <td>
                <?php if($loan->status === 'active' && now()->gt($loan->due_date)): ?>
                    <?php echo e(ucfirst($loan->status_label)); ?>

                <?php else: ?>
                    <?php echo e(ucfirst($loan->status_label)); ?>

                <?php endif; ?>
            </td>
            <td>
                <ul>
                    <?php $__currentLoopData = $loan->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item->book->title ?? 'Livro removido'); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6" class="text-center">Você ainda não fez nenhum empréstimo.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($loans->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/my.blade.php ENDPATH**/ ?>