<div>
    <div class="user-form-container">

        <!-- <?php if($errors->any()): ?>
            <div class="user-form-errors">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?> -->

        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>" class="user-form-input" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email ?? '')); ?>" class="user-form-input" required>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Perfil</label>
                
            <select id="role" name="role" class="user-form-select" required>
                <option value="reader" <?php echo e(old('role', $user->role ?? '') === 'reader' ? 'selected' : ''); ?>>Leitor</option>
                <option value="librarian" <?php echo e(old('role', $user->role ?? '') === 'librarian' ? 'selected' : ''); ?>>Bibliotecário</option>    
                <option value="admin" <?php echo e(old('role', $user->role ?? '') === 'admin' ? 'selected' : ''); ?>>Administrador</option>
            </select>
        </div>
        
    </div>

    <div class="user-form-actions">
        <button type="submit" class="btn-save">Salvar</button>
        <a href="<?php echo e(route('users.index')); ?>" class="btn-back">Voltar</a>
    </div>
</div>
<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/users/form.blade.php ENDPATH**/ ?>