<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('books.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('books.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/books/create.blade.php ENDPATH**/ ?>