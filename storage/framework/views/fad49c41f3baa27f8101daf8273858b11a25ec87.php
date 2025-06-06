<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📚 Livros Mais Emprestados</h2>
        <a href="<?php echo e(route('reports.top-books.pdf')); ?>" class="btn btn-sm btn-outline-primary">
            📄 Exportar PDF
        </a>
    </div>

    <!-- <h2 class="form-check-label text-dark">Livros Mais Emprestados</h2> -->

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Total de Empréstimos</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($item->book->title ?? 'Livro removido'); ?></td>
                    <td><?php echo e($item->book->author ?? '-'); ?></td>
                    <td><?php echo e($item->total); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center">Nenhum dado encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/reports/top_books.blade.php ENDPATH**/ ?>