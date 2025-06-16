<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
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
                        <a href="#" class="btn-close top-right" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </a>

                        <div class="action-buttons bottom-right">
                            <a href="<?php echo e(route('profile.edit', $user)); ?>" class="btn-edit123" title="Editar" style="color: #A4A4A5; padding: 8px 10px; border-radius: 4px; font-size: 1rem; transition: background-color 0.3s ease;"><i class="fas fa-pencil-alt"></i></a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/profile/show_modal.blade.php ENDPATH**/ ?>