<?php $__env->startSection('content'); ?>
    <div class="book-details-container">
        <div class="book-cover">
            <?php if($book->cover_image): ?>
                <img src="<?php echo e(asset('storage/covers/' . $book->cover_image)); ?>" alt="Capa do livro <?php echo e($book->title); ?>">
            <?php else: ?>
                <!-- <img src="https://via.placeholder.com/310x500?text=Sem+Capa" alt="Sem capa disponível"> -->
                <div class="no-cover-preview">
                    <span>Sem Capa.</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="book-info">
            <h2><?php echo e($book->title); ?></h2>

            <div class="book-field">
                <span class="label"><i class="fas fa-user"></i> Autor:</span>
                <span class="value"><?php echo e($book->author); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-building"></i> Editora:</span>
                <span class="value"><?php echo e($book->publisher ?? 'N/A'); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-align-left"></i> Descrição:</span>
                <span class="value"><?php echo e($book->description); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-calendar-alt"></i> Ano:</span>
                <span class="value"><?php echo e($book->year ?? 'N/A'); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-barcode"></i> ISBN:</span>
                <span class="value"><?php echo e($book->isbn); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-check-circle"></i> Estado:</span>
                <span class="value"><?php echo e(ucfirst($book->status)); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-layer-group"></i> Total:</span>
                <span class="value"><?php echo e($book->quantity_total); ?></span>
            </div>

            <div class="book-field">
                <span class="label"><i class="fas fa-book-open"></i> Disponível:</span>
                <span class="value"><?php echo e($book->quantity_available); ?></span>
            </div>

            <div class="book-actions">
                <a href="<?php echo e(url()->previous()); ?>" class="btn-close top-right"><i class="fas fa-times"></i></a>

                <!-- <div class="action-buttons bottom-right">
                    <a href="<?php echo e(route('books.edit', $book)); ?>" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                    <form action="<?php echo e(route('books.destroy', $book)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/user_show.blade.php ENDPATH**/ ?>