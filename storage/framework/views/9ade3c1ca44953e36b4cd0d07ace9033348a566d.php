<table class="table table-bordered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Usuário</th>
            <th>Data</th>
            <th>Data Prev.</th>
            <th>Devolução</th>
            <th>Estado</th>
            <th>Multa</th>
            <th>Ações/Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($loan->protocol); ?></td>
                <td><?php echo e($loan->user->name); ?></td>
                <td><?php echo e($loan->loan_date->format('d/m/Y H:i')); ?></td>
                <td><?php echo e($loan->due_date->format('d/m/Y')); ?></td>
                <td>
                    <?php if($loan->return_date): ?>
                        <?php echo e(\Carbon\Carbon::parse($loan->return_date)->format('d/m/Y H:i')); ?>

                    <?php else: ?>
                        ————————
                    <?php endif; ?>
                </td>
                <td><?php echo e(ucfirst($loan->status_label)); ?></td>
                <td><?php echo e(number_format($loan->calculated_fine ?? 0, 2, ',', '.')); ?></td>
                <td>
                    <div class="loan-action-btn-container">
                        <?php if($loan->status === 'active'): ?>
                            <form action="<?php echo e(route('loans.return.process', $loan)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="return_date" value="<?php echo e(now()->format('Y-m-d H:i:s')); ?>">
                                <button type="submit" class="loan-action-btn loan-action-btn--return">Registrar Devolução</button>
                            </form>
                        <?php elseif($loan->status === 'pending' && in_array(auth()->user()->role, ['admin', 'librarian'])): ?>
                            <form action="<?php echo e(route('loans.approve', $loan)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="loan-action-btn loan-action-btn--approve">Confirmar Empréstimo</button>
                            </form>
                        <?php elseif($loan->status === 'expired'): ?>
                            <span class="text-muted">Solicitação Expirada</span>
                        <?php else: ?>
                            <span class="text-muted"><?php echo e(ucfirst($loan->status_label)); ?></span>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="8">Nenhum resultado encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($loans->links()); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/list.blade.php ENDPATH**/ ?>