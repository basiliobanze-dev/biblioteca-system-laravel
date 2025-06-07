<h3 style="text-align: center;">📚 Relatório: Livros Mais Emprestados</h3>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Total de Empréstimos</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($item->book->title ?? 'Livro removido'); ?></td>
            <td><?php echo e($item->book->author ?? '-'); ?></td>
            <td><?php echo e($item->total); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/reports/pdf_top_books.blade.php ENDPATH**/ ?>