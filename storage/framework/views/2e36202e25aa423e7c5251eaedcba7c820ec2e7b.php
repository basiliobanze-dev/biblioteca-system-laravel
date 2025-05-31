<?php $__env->startSection('content'); ?>
    <div class="book-details-container">
        <div class="book-cover">
            <?php if($book->cover_image): ?>
                <img src="<?php echo e(asset('storage/covers/' . $book->cover_image)); ?>" alt="Capa do livro <?php echo e($book->title); ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/250x350?text=Sem+Capa" alt="Sem capa disponível">
            <?php endif; ?>
        </div>
        <div class="book-info">
            <h2><?php echo e($book->title); ?></h2>
            <p><strong>Autor:</strong> <?php echo e($book->author); ?></p>
            <p><strong>Editora:</strong> <?php echo e($book->publisher ?? 'N/A'); ?></p>
            <p><strong>Descrição:</strong> <?php echo e($book->description); ?></p>
            <p><strong>Ano:</strong> <?php echo e($book->year ?? 'N/A'); ?></p>
            <p><strong>ISBN:</strong> <?php echo e($book->isbn); ?></p>
            <p><strong>Estado:</strong> <?php echo e(ucfirst($book->status)); ?></p>
            <p><strong>Quantidade total:</strong> <?php echo e($book->quantity_total); ?></p>
            <p><strong>Quantidade disponível:</strong> <?php echo e($book->quantity_available); ?></p>
            
            <a href="<?php echo e(route('books.index')); ?>" class="btn-back2">Voltar</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/show.blade.php ENDPATH**/ ?>