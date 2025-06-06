<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/books.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/users.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/side_bar.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-admin.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-reader.css')); ?>">
    </head>

    <body>
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="container mt-4">
            <?php echo $__env->yieldContent('content'); ?> <!-- container to exib content of the views  -->
        </div>

        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('partials.side_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>