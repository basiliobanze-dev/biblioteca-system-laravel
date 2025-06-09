<?php $__env->startSection('content'); ?>
    <p><strong>Código:</strong> <?php echo e($loan->protocol); ?></p>
    <p><strong>Usuário:</strong> <?php echo e($loan->user->name); ?> (<?php echo e($loan->user->email); ?>)</p>
    <p><strong>Estado:</strong> <?php echo e(ucfirst($loan->status_label)); ?></p>
    <p><strong>Data:</strong> <?php echo e($loan->loan_date->format('d/m/Y H:i')); ?></p>
    <p><strong>Data Prevista da Devolução:</strong> <?php echo e($loan->due_date->format('d/m/Y')); ?></p>
    <p><strong>Data da Devolução:</strong>
        <?php echo e($loan->return_date ? $loan->return_date->format('d/m/Y H:i') : 'Ainda não devolvido'); ?>

    </p>
    <p><strong>Multa:</strong> <?php echo e(number_format($loan->fine_amount, 2, ',', '.')); ?> MZN</p>

    <hr>
    <h4>Livros Emprestados</h4>
    <ul>
        <?php $__currentLoopData = $loan->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <?php echo e($item->book->title); ?> — 
                <strong>Status:</strong> <?php echo e($item->returned ? 'Devolvido' : 'Ainda não devolvido'); ?>

            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <a href="<?php echo e(route('loans.index')); ?>" class="btn btn-secondary mt-3">Voltar à Lista</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/track.blade.php ENDPATH**/ ?>