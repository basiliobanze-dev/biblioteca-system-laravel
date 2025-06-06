<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>📖 Meus Empréstimos</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Protocolo</th>
                <th>Data do Empréstimo</th>
                <th>Devolução Prevista</th>
                <th>Status</th>
                <th>Livros</th>
                <th>Multa</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loan->protocol); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y')); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($loan->due_date)->format('d/m/Y')); ?></td>
                    <td><?php echo e(ucfirst($loan->status)); ?></td>
                    <td>
                        <ul>
                            <?php $__currentLoopData = $loan->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($item->book->title ?? 'Livro removido'); ?> (<?php echo e($item->quantity); ?>x)</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </td>
                    <td><?php echo e(number_format($loan->fine_amount, 2, ',', '.')); ?> MZN</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum empréstimo encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($loans->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/user_loans.blade.php ENDPATH**/ ?>