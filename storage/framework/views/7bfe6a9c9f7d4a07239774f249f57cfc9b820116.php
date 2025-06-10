<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BIBLIOTECA ONLINE</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>">   
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>">Início</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Entrar</a>
                        <!-- <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?> -->
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="title m-b-md">
                BIBLIOTECA ONLINE
            </div> 
        </div>
    </body>
</html>
<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/welcome.blade.php ENDPATH**/ ?>