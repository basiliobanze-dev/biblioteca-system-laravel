<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div>
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <a href="<?php echo e(route('books.create')); ?>" class="btn btn-add mb-3">Adicionar Livro</a>

            <form method="GET" action="<?php echo e(route('books.index')); ?>" class="search-form d-flex">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Pesquisar por título, autor ou ano..." class="search-input form-control form-control-sm">
                <button type="submit" class="search-button btn btn-primary btn-sm ml-2">Pesquisar</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <!-- <th>Editora</th> -->
                    <!-- <th>Description</th> -->
                    <th>Ano</th>
                    <!-- <th>ISBN</th> -->
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($book->cover_image): ?>
                                <img src="<?php echo e(asset('storage/covers/' . $book->cover_image)); ?>" alt="Capa" style="width: 50px; height: 50px; border-radius: 4px;">
                            <?php else: ?>
                                <p class="no-cover2">Sem capa.</p>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($book->title); ?></td>
                        <td><?php echo e($book->author); ?></td>
                        <!-- <td><?php echo e($book->publisher); ?></td> -->
                        <!-- <td><?php echo e($book->description); ?></td> -->
                        <td><?php echo e($book->year); ?></td>
                        <!-- <td><?php echo e($book->isbn); ?></td> -->
                        <td><?php echo e($book->status); ?></td>
                        <td>
                            <a href="<?php echo e(route('books.show', $book)); ?>" class="btn btn-sm btn-view"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('books.edit', $book)); ?>" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                            <form action="<?php echo e(route('books.destroy', $book)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-remove" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($books->links()); ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // remove após o fade
                }, 3000); // 3 segundos
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/index.blade.php ENDPATH**/ ?>