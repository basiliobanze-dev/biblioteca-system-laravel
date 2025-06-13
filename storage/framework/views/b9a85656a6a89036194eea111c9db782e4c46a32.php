<div class="modal fade" id="bookDetailsModal<?php echo e($book->id); ?>" tabindex="-1" aria-labelledby="bookDetailsLabel<?php echo e($book->id); ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="book-details-container">
                <div class="book-cover">
                    <?php if($book->cover_image): ?>
                        <img src="<?php echo e(asset('storage/covers/' . $book->cover_image)); ?>" alt="Capa do livro <?php echo e($book->title); ?>" class="img-fluid">
                    <?php else: ?>
                        <div class="no-cover-preview">
                            <i class="fas fa-book"></i>
                            <span>Sem Capa</span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="book-info">
                    <h2><?php echo e($book->title); ?></h2>

                    <div class="book-field">
                        <span class="label"><i class="fas fa-user"></i> Autor:</span>
                        <span class="value"><?php echo e($book->author); ?></span>
                    </div>

                    <?php if($book->publisher): ?>
                    <div class="book-field">
                        <span class="label"><i class="fas fa-building"></i> Editora:</span>
                        <span class="value"><?php echo e($book->publisher); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if($book->description): ?>
                    <div class="book-field">
                        <span class="label"><i class="fas fa-align-left"></i> Descrição:</span>
                        <span class="value"><?php echo e($book->description); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if($book->year): ?>
                    <div class="book-field">
                        <span class="label"><i class="fas fa-calendar-alt"></i> Ano:</span>
                        <span class="value"><?php echo e($book->year); ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if($book->isbn): ?>
                    <div class="book-field">
                        <span class="label"><i class="fas fa-barcode"></i> ISBN:</span>
                        <span class="value"><?php echo e($book->isbn); ?></span>
                    </div>
                    <?php endif; ?>

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
                        <a href="#" class="btn-close top-right" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </a>

                        <?php if(in_array(auth()->user()->role, ['admin', 'librarian'])): ?>
                            <div class="action-buttons bottom-right">
                                <a href="<?php echo e(route('books.edit', $book)); ?>" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <form action="<?php echo e(route('books.destroy', $book)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/show_modal.blade.php ENDPATH**/ ?>