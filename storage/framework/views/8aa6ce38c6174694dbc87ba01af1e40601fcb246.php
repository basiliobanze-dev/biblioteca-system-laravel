<?php $__env->startSection('content'); ?>
    <div>
        <section class="profile-container">
            <h1 class="profile-title">Usuário</h1>
            <div class="profile-card">
                <div class="profile-image">
                    <?php if($user->account && $user->account->profile_image): ?>
                        <img src="<?php echo e(asset('storage/profiles/' . $user->account->profile_image)); ?>" alt="Foto de Perfil">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=ccc&color=555&size=50&rounded=true"
                            alt="Avatar Padrão"
                            style="width: 120px; height: 120px; border-radius: 50%;">
                    <?php endif; ?>
                </div>
                
                <div class="profile-info">
                    <h2><?php echo e($user->name); ?></h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i> <?php echo e($user->email); ?></p>
                    <p><strong><i class="fa-solid fa-circle-user"></i> Tipo de Perfil:</strong>
                        <?php if($user->role === 'admin'): ?>
                            Administrador
                        <?php elseif($user->role === 'librarian'): ?>
                            Bibliotecário
                        <?php else: ?>
                            Leitor
                        <?php endif; ?>
                    </p>
                    <p><i class="fas fa-venus-mars"></i> <strong>Gênero:</strong> <?php echo e($user->account && $user->account->gender ? $user->account->gender : '---'); ?></p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Nascimento:</strong> <?php echo e($user->account && $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d/m/Y') : '---'); ?></p>
                    <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> <?php echo e($user->account && $user->account->phone ? $user->account->phone : '---'); ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Endereço:</strong> <?php echo e($user->account && $user->account->address ? $user->account->address : '---'); ?></p>
                </div>
            </div>

            <div class="profile-actions">
                <a href="<?php echo e(route('users.index')); ?>" class="btn-close top-right"><i class="fas fa-times"></i></a>

                <div class="action-buttons bottom-right">
                    <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                    <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/users/show.blade.php ENDPATH**/ ?>