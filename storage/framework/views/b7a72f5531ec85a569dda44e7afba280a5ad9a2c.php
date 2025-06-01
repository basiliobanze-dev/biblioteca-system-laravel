<?php $__env->startSection('content'); ?>
    <div class="register-container">
        <div class="register-top">
            <div class="icon-box">
                <i class="fa-solid fa-book" style="color:rgb(255, 255, 255); font-size: 50px;"></i>
            </div>
            <p class="subtitle">Abre as portas do saber — cria sua conta gratuita agora mesmo.</p>
        </div>

        <div class="register-box">
            <h2 class="authentication-title">CADASTRO</h2>
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <input id="name" type="text" name="name" placeholder="Nome" value="<?php echo e(old('name')); ?>" required>
                <input id="email" type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                <input id="password" type="password" name="password" placeholder="Senha" required>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Senha" required>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>