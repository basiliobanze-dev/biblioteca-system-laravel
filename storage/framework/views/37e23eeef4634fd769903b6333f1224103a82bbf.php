<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div>
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-add mb-3">Adicionar Usuário</a>

            <form method="GET" action="<?php echo e(route('users.index')); ?>" class="search-form d-flex">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Pesquisar por nome ou email..." class="search-input search-user form-control form-control-sm">
                <button type="submit" class="search-button btn btn-sm ml-2">Pesquisar</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfil</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($user->account && $user->account->profile_image): ?>
                                <img src="<?php echo e(asset('storage/profiles/' . $user->account->profile_image)); ?>"
                                    alt="Foto de Perfil"
                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=ccc&color=555&size=50&rounded=true"
                                    alt="Avatar Padrão"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->role_label); ?></td>
                        <td>
                            <a href="<?php echo e(route('users.show', $user)); ?>" class="btn btn-sm btn-view"><i class="fas fa-eye"></i></a>
                            <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                            <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-remove" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($users->links()); ?>

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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/users/index.blade.php ENDPATH**/ ?>