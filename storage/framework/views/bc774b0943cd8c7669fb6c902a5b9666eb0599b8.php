<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $__env->yieldContent('title', 'Biblioteca'); ?></title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?php echo e(asset('css/email.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/reset.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/register.css')); ?>">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>

    <body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh background-color: #f1f1f1;;" >

        <div class="container mt-4">
            <?php echo $__env->yieldContent('content'); ?> <!-- container to exib content of the views  -->
        </div>

    </body>
</html><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/layouts/auth.blade.php ENDPATH**/ ?>