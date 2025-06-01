<?php $__env->startSection('content'); ?>
<div class="forgot-container">
    <div class="forgot-wrapper">
        <h2 class="authentication-title">Recuperar Senha</h2>

        <p class="forgot-info">Informe seu e-mail abaixo para receber um link e redefinir sua senha.</p>

        <?php if(session('status')): ?>
            <div class="forgot-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.email')); ?>" class="forgot-form">
            <?php echo csrf_field(); ?>

            <div class="forgot-group">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="forgot-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="forgot-actions">
                <button type="submit"'>Enviar link de redefinição</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>