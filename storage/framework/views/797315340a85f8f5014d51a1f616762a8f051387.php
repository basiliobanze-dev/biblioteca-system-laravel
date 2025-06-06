<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Registrar Novo Empréstimo</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Erros:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($erro); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('loans.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuário</label>
            <select name="user_id" class="form-control" required>
                <option value="">Selecione...</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Livros</label>
            <div id="livros-lista">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="books[]" value="<?php echo e($book->id); ?>" id="book_<?php echo e($book->id); ?>">
                    <label class="form-check-label text-dark" for="book_<?php echo e($book->id); ?>">
                        <?php echo e($book->title); ?> (Disponíveis: <?php echo e($book->quantity_available); ?>)
                    </label>
                    <input type="number" name="quantities[<?php echo e($book->id); ?>]" class="form-control mt-1" placeholder="Quantidade" min="1" max="<?php echo e($book->quantity_available); ?>">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Data de Devolução</label>
            <input type="date" name="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar Empréstimo</button>
        <a href="<?php echo e(route('loans.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/create.blade.php ENDPATH**/ ?>