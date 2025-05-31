<?php $__env->startSection('content'); ?>
    <div class="login-container">
        <div class="login-top">
            <div class="icon-box">
                <i class="fa-solid fa-book" style="color:rgb(255, 255, 255); font-size: 50px;"></i>
            </div>
            <p class="welcome-text">Olá! Seja muito bem-vindo à nossa biblioteca.</p>
        </div>

        <div class="login-box">
            <h2 class="login-title">LOGIN</h2>
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>
        </div>

        <div class="login-footer">
            <a href="<?php echo e(route('password.request')); ?>">Esqueceu sua senha?</a>
            <a href="<?php echo e(route('register')); ?>">Não tem uma conta? Criar Agora</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>