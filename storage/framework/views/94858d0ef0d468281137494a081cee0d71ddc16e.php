<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<h2>Lista de Empréstimos</h2>

<div class="d-flex justify-content-between mb-3">
    <a href="<?php echo e(route('loans.create')); ?>" class="btn btn-primary">Registrar Empréstimo</a>

    <form action="<?php echo e(route('loans.track')); ?>" method="GET" class="d-flex">
        <input type="text" name="protocol" class="form-control me-2" placeholder="Código (ex: EMP-202506071887C8)" required>
        <button type="submit" class="btn btn-secondary">Rastrear</button>
    </form>
</div>

<form method="GET" action="<?php echo e(route('loans.index')); ?>" class="d-flex gap-2 mb-3">
    <input type="text" name="user" placeholder="Buscar por usuário..." class="form-control" value="<?php echo e(request('user')); ?>">
    <input type="text" name="book" placeholder="Buscar por livro..." class="form-control" value="<?php echo e(request('book')); ?>">
    <select name="status" class="form-select">
        <option value="">-- Todos --</option>
        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Somente Ativos</option>
    </select>
    <button class="btn btn-outline-primary">Filtrar</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Usuário</th>
            <th>Data</th>
            <th>Data Prev.</th>
            <th>Devolução</th>
            <th>Estado</th>
            <th>Multa</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loan->protocol); ?></td>
            <td><?php echo e($loan->user->name); ?></td>
            <td><?php echo e($loan->loan_date->format('d/m/Y H:i')); ?></td>
            <td><?php echo e($loan->due_date->format('d/m/Y')); ?></td>
            <td>
                <?php if($loan->return_date): ?>
                    <?php echo e(\Carbon\Carbon::parse($loan->return_date)->format('d/m/Y H:i')); ?>

                <?php else: ?>
                    Ainda não devolvido
                <?php endif; ?>
            </td>
            <td>
                <?php if($loan->status === 'active' && now()->gt($loan->due_date)): ?>
                    <?php echo e(ucfirst($loan->status_label)); ?>

                <?php else: ?>
                    <?php echo e(ucfirst($loan->status_label)); ?>

                <?php endif; ?>
            </td>
            <!-- <td><?php echo e(number_format($loan->fine_amount, 2, ',', '.')); ?></td> -->
            <td>
                <?php if($loan->status === 'active'): ?>
                    <p><strong>Multa estimada (se devolver hoje):</strong> 
                        <?php echo e(number_format($loan->calculated_fine, 2, ',', '.')); ?> MZN
                    </p>
                <?php endif; ?>
            </td>
            <td>
                <?php if($loan->status === 'active'): ?>
                    <form action="<?php echo e(route('loans.return.process', $loan)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <!-- <input type="hidden" name="return_date" value="<?php echo e(now()->format('Y-m-d H:i:s')); ?>"> -->
                        <input type="hidden" name="return_date" value="<?php echo e($loan->due_date->addDays(3)->format('Y-m-d H:i:s')); ?>">

                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Confirma a devolução deste empréstimo?')">Registrar Devolução</button>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/index.blade.php ENDPATH**/ ?>