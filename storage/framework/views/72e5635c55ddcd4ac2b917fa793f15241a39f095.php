<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <div>
        <section class="profile-container">
            <h1 class="profile-title">Meu Perfil</h1>

            <div class="profile-card">
                <div class="profile-image">
                    <?php if($user->account && $user->account->profile_image): ?>
                        <img src="<?php echo e(asset('storage/profiles/' . $user->account->profile_image)); ?>" alt="Foto de Perfil">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=ccc&color=555&size=50&rounded=true"
                            alt="Avatar Padrão"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    <?php endif; ?>
                </div>

                <div class="profile-info">
                    <h2><?php echo e($user->name); ?></h2>
                    <p><?php echo e($user->email); ?></p>
                    <p><strong>Gênero:</strong> <?php echo e($user->account->gender ?? '---'); ?></p>
                    <p><strong>Nascimento:</strong> <?php echo e($user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d-m-Y') : '---'); ?></p>
                    <p><strong>Telefone:</strong> <?php echo e($user->account->phone ?? '---'); ?></p>
                    <p><strong>Endereço:</strong> <?php echo e($user->account->address ?? '---'); ?></p>
                </div>
            </div>
        </section>

        <div class="profile-form-actions">
            <a href="<?php echo e(route('profile.edit')); ?>" class="btn-save">Editar</a>
            <a href="<?php echo e(route('home')); ?>" class="btn-back">Voltar</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500); // remove após o fade
                }, 3000); // 3 segundos
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/profile/show.blade.php ENDPATH**/ ?>