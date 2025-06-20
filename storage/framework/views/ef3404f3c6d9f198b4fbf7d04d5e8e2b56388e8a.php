<section class="edit-profile-container">
    <!-- C1 -->
    <div class="profile-column">
        <label for="profile_image" class="upload-image-wrapper">
            <input type="file" name="profile_image" id="profile_image" accept="image/*" onchange="previewProfileImage(event)">
            <?php if($user->account && $user->account->profile_image): ?>
                <img id="preview" src="<?php echo e(asset('storage/profiles/' . $user->account->profile_image)); ?>" alt="Foto de Perfil">
            <?php else: ?>
                <img id="preview" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=ccc&color=555&size=100&rounded=true" alt="Avatar Padrão">
            <?php endif; ?>
        </label>
        <p class="upload-hint">Clique na imagem para alterar</p>
    </div>

    <!-- C2 -->
    <div class="form-column">
        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-input" value="<?php echo e(old('name', $user->name)); ?>" required>
        </div>

        <div class="form-group">
            <label for="gender" class="form-label">Gênero</label>
            <select name="gender" id="gender" class="form-input">
                <option value="">--</option>
                <option value="M" <?php echo e(old('gender', $user->account->gender ?? '') == 'M' ? 'selected' : ''); ?>>M</option>
                <option value="F" <?php echo e(old('gender', $user->account->gender ?? '') == 'F' ? 'selected' : ''); ?>>F</option>
            </select>
        </div>

        <div class="form-group">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" name="birth_date" id="birth_date" class="form-input" value="<?php echo e(old('birth_date', $user->account->birth_date ?? '')); ?>">
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" name="phone" id="phone" class="form-input" value="<?php echo e(old('phone', $user->account->phone ?? '')); ?>">
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" name="address" id="address" class="form-input" value="<?php echo e(old('address', $user->account->address ?? '')); ?>">
        </div>
    </div>
</section>

<div class="profile-edit-form-actions">
    <button type="submit" class="btn-save" form="edit-profile-form">Salvar</button>
    <a href="<?php echo e(url()->previous()); ?>" class="btn-back">Cancelar</a>
</div>

<script>
    function previewProfileImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/profile/form.blade.php ENDPATH**/ ?>