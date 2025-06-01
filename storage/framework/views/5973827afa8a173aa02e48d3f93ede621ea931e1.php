<?php $__env->startSection('content'); ?>
<div class="reset-container">
    <div class="reset-wrapper">
        <h2 class="authentication-title">Redefinir Senha</h2>

        <form method="POST" action="<?php echo e(route('password.update')); ?>" class="reset-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($token); ?>">

            <div class="reset-group">
                <label for="email">E-Mail</label>
                <input id="email" type="email" name="email" value="<?php echo e($email ?? old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="reset-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="reset-group">
                <label for="password">Nova Senha</label>
                <input id="password" type="password" name="password" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="reset-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="reset-group">
                <label for="password-confirm">Confirmar Senha</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div class="reset-actions">
                <button type="submit">Redefinir Senha</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/auth/passwords/reset.blade.php ENDPATH**/ ?>