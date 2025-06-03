<div class="form-container">    
        <!-- c1 -->
        <div>
            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-input" value="<?php echo e(old('title', $book->title ?? '')); ?>" required>
            </div>

            <div class="form-group">
                <label for="author" class="form-label">Autor</label>
                <input type="text" id="author" name="author" class="form-input" value="<?php echo e(old('author', $book->author ?? '')); ?>" required>
            </div>

            <div class="form-group">
                <label for="publisher" class="form-label">Editora</label>
                <input type="text" id="publisher" name="publisher" class="form-input" value="<?php echo e(old('publisher', $book->publisher ?? '')); ?>">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Descrição</label>
                <textarea id="description" name="description" class="form-textarea" rows="4" required><?php echo e(old('description', $book->description ?? '')); ?></textarea>
            </div>
        </div>

        <!-- c2 -->
        <div>
            <div class="form-group">
                <label for="year" class="form-label">Ano</label>
                <input type="number" id="year" name="year" class="form-input" value="<?php echo e(old('year', $book->year ?? '')); ?>">
            </div>

            <div class="form-group">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-input" value="<?php echo e(old('isbn', $book->isbn ?? '')); ?>" required>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label for="quantity_total" class="form-label">Quantidade</label>
                    <input type="number" id="quantity_total" name="quantity_total" class="form-input" value="<?php echo e(old('quantity_total', $book->quantity_total ?? '')); ?>" required>
                
                    <?php $__errorArgs = ['quantity_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Estado</label>

                    <select id="status" name="status" class="form-input">
                        <option value="ativo" <?php echo e(old('status', $book->status ?? '') === 'ativo' ? 'selected' : ''); ?>>Ativo</option>
                        <option value="inativo" <?php echo e(old('status', $book->status ?? '') === 'inativo' ? 'selected' : ''); ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="cover_image" class="form-label">Foto da Capa</label>

                <div class="cover-file-container">
                    <div class="cover-preview" id="coverPreviewWrapper" style="<?php echo e(empty($book->cover_image) ? 'display:none;' : ''); ?>">
                        <img
                            id="coverPreview"
                            src="<?php echo e(!empty($book->cover_image) ? asset('storage/covers/' . $book->cover_image) : ''); ?>"
                            alt="Capa do livro"
                            class="cover-image-preview-small"
                        >
                    </div>

                    <script>
                        function previewCoverImage(event) {
                            const file = event.target.files[0];
                            const preview = document.getElementById('coverPreview');
                            const previewWrapper = document.getElementById('coverPreviewWrapper');
                            const noCoverText = document.getElementById('noCoverText');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    previewWrapper.style.display = 'block';
                                    noCoverText.style.display = 'none';
                                };
                                reader.readAsDataURL(file);
                            } else {
                                previewWrapper.style.display = 'none';
                                noCoverText.style.display = 'block';
                            }
                        }
                    </script>


                    <p class="no-cover" id="noCoverText" style="<?php echo e(!empty($book->cover_image) ? 'display:none;' : ''); ?>">
                        Sem capa.
                    </p>

                    <input type="file" id="cover_image" name="cover_image" class="form-input-file" accept="image/*" onchange="previewCoverImage(event)">
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-save">Salvar</button>
        <a href="<?php echo e(route('books.index')); ?>" class="btn-back">Cancelar</a>
    </div>
</div>



    
<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/form.blade.php ENDPATH**/ ?>