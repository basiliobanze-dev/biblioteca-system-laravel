<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>📚 Catálogo de Livros Disponíveis</h2>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Digite o título ou autor...">

    <table class="table table-hover table-striped" id="booksTable">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Disponíveis</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <a href="<?php echo e(route('books.show', $book->id)); ?>">
                        <?php echo e($book->title); ?>

                    </a>
                </td>
                <td><?php echo e($book->author); ?></td>
                <td><?php echo e($book->publisher); ?></td>
                <td><?php echo e($book->year); ?></td>
                <td><?php echo e($book->quantity_available); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#booksTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/catalog.blade.php ENDPATH**/ ?>