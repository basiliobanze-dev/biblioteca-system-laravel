<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>🔍 Rastrear Empréstimo por Protocolo</h2>

    <form method="GET" action="<?php echo e(route('loans.track')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="protocol" class="form-control" placeholder="Digite o protocolo ex: EMP-665F1C2B" required>
            <button class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <?php if(request()->has('protocol') && !$loan): ?>
        <div class="alert alert-warning">Nenhum empréstimo encontrado com esse protocolo.</div>
    <?php endif; ?>

    <?php if($loan): ?>
        <div class="card">
            <div class="card-header">
                <strong>Protocolo:</strong> <?php echo e($loan->protocol); ?><br>
                <strong>Usuário:</strong> <?php echo e($loan->user->name); ?> (<?php echo e($loan->user->email); ?>)<br>
                <strong>Status:</strong> <?php echo e(ucfirst($loan->status)); ?><br>
                <strong>Multa:</strong> <?php echo e(number_format($loan->fine_amount, 2, ',', '.')); ?> MZN
            </div>
            <div class="card-body">
                <p><strong>Data do Empréstimo:</strong> <?php echo e(\Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y')); ?></p>
                <p><strong>Data de Devolução:</strong> <?php echo e(\Carbon\Carbon::parse($loan->due_date)->format('d/m/Y')); ?></p>

                <h5>📚 Livros emprestados:</h5>
                <ul>
                    <?php $__currentLoopData = $loan->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item->book->title ?? 'Livro removido'); ?> (<?php echo e($item->quantity); ?>x)</li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/track.blade.php ENDPATH**/ ?>