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
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=ccc&color=555&size=100&rounded=true"
                            alt="Avatar Padrão">
                    <?php endif; ?>
                </div>

                <div class="profile-info">
                    <h2><?php echo e($user->name); ?></h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i> <?php echo e($user->email); ?></p>
                    <p><i class="fas fa-venus-mars"></i> <strong>Gênero:</strong> <?php echo e($user->account && $user->account->gender ? $user->account->gender : '---'); ?></p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Nascimento:</strong> <?php echo e($user->account && $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d/m/Y') : '---'); ?></p>
                    <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> <?php echo e($user->account && $user->account->phone ? $user->account->phone : '---'); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Endereço:</strong> <?php echo e($user->account && $user->account->address ? $user->account->address : '---'); ?></p>
                </div>
            </div>

            <div class="profile-actions">
                <a href="<?php echo e(url()->previous()); ?>" class="btn-close top-right"><i class="fas fa-times"></i></a>

                <div class="action-buttons bottom-right">
                    <a href="<?php echo e(route('profile.edit', $user)); ?>" class="btn-edit123" title="Editar" style="color: #A4A4A5; padding: 8px 10px; border-radius: 4px; font-size: 1rem; transition: background-color 0.3s ease;"><i class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
        </section>
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