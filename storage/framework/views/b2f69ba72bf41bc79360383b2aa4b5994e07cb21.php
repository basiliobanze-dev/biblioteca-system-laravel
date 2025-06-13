<?php $__env->startSection('content'); ?>
    <div class="loan-request">
        <form method="POST" action="<?php echo e(route('loans.store')); ?>" class="loan-request__form">
            <?php echo csrf_field(); ?>

            <div class="loan-request__header">
                <h2 class="loan-request__title"><i class="fas fa-paper-plane"></i> Solicitar Empréstimo</h2>
            </div>

            <input type="hidden" name="user_id" value="<?php echo e(auth()->id()); ?>">

            <div class="loan-request__form-group">
                <label for="due_date" class="loan-request__label">Data Prevista da Devolução:</label>
                <input type="date" name="due_date" id="due_date" class="loan-request__input" required 
                    min="<?php echo e(now()->addDay()->format('Y-m-d')); ?>">
            </div>

            <div class="loan-request__form-group">
                <label for="book_search" class="loan-request__label">Pesquisar Livro</label>
                <input type="text" id="book_search" class="loan-request__input" placeholder="Pesquisar por título, autor ou ano...">
            </div>

            <div class="loan-request__books-container">
                <div id="book_list" class="loan-request__books-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="loan-request__book-card">
                            <a href="#" class="loan-request__book-card-link" data-bs-toggle="modal" data-bs-target="#bookDetailsModal<?php echo e($book->id); ?>">
                                <div class="loan-request__book-cover-container">
                                    <?php if($book->cover_image): ?>
                                        <img src="<?php echo e(asset('storage/covers/' . $book->cover_image)); ?>" 
                                            alt="Capa do livro <?php echo e($book->title); ?>"
                                            class="loan-request__book-cover">
                                    <?php else: ?>
                                        <div class="loan-request__book-cover-placeholder">
                                            <i class="fas fa-book"></i>
                                            <span>Sem Capa</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>        
                            <div class="loan-request__book-details">
                                <div class="loan-request__book-selection">
                                    <input type="checkbox" name="book_ids[]" value="<?php echo e($book->id); ?>"
                                        class="loan-request__book-checkbox" id="book_<?php echo e($book->id); ?>"
                                        <?php echo e($book->quantity_available <= 0 ? 'disabled' : ''); ?>>
                                    <label for="book_<?php echo e($book->id); ?>" class="loan-request__book-title">
                                        <?php echo e($book->title); ?>

                                    </label>
                                </div>
                                <div class="loan-request__book-info">
                                    <p class="loan-request__book-meta"><strong>Autor:</strong> <?php echo e($book->author); ?></p>
                                    <p class="loan-request__book-meta"><strong>Ano:</strong> <?php echo e($book->year); ?></p>
                                    <p class="loan-request__book-availability <?php echo e($book->quantity_available <= 0 ? 'loan-request__book-availability--unavailable' : 'loan-request__book-availability--available'); ?>">
                                        <strong>Disponíveis:</strong> <?php echo e($book->quantity_available); ?>

                                    </p>
                                </div>
                            </div>
                        </div>

                        <?php echo $__env->make('books.show_modal', ['book' => $book], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="loan-request__no-books">Nenhum livro disponível.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="loan-request__submit">
                <button type="submit" class="loan-request__submit-button">
                    <i class="fas fa-paper-plane"></i> Solicitar Empréstimo
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('book_search').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const books = document.querySelectorAll('.loan-request__book-card');

            books.forEach(function (book) {
                const cardText = book.textContent.toLowerCase();
                book.style.display = cardText.includes(searchTerm) ? 'block' : 'none';
            });
        });

        document.querySelectorAll('.loan-request__book-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const checked = document.querySelectorAll('.loan-request__book-checkbox:checked');
                if (checked.length > 3) {
                    alert('Você só pode selecionar até 3 livros.');
                    this.checked = false;
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/request.blade.php ENDPATH**/ ?>