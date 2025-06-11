<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
        
        <a href="<?php echo e(route('loans.create')); ?>" class="loan-custom-btn loan-custom-btn--primary">
            <i class="fa fa-file-signature"></i> Registrar Empréstimo
        </a>
        <form action="<?php echo e(route('loans.track')); ?>" method="GET" class="d-flex">
            <input type="text" name="protocol" class="loan-custom-input" placeholder="Código (ex: EMP-202506071887C8)" required style="width: 281px;">
            <button type="submit" class="loan-custom-btn loan-custom-btn--secondary">Rastrear</button>
        </form>
    </div>

    <form id="search-form" class="d-flex gap-2 mb-3">
        <input type="text" name="user" placeholder="Buscar por usuário..." class="loan-custom-input" value="">
        <input type="text" name="book" placeholder="Buscar por livro..." class="loan-custom-input" value="">
        <select name="status" class="loan-custom-select">
            <option value="">Todos</option>
            <option value="active">Ativos</option>
            <option value="pending">Pendentes</option>
        </select>
    </form>

    <div id="loan-results">
        <?php echo $__env->make('loans.list', ['loans' => $loans], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3000);
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            const $form = $('#search-form');

            function fetchResults() {
                let data = $form.serialize();

                $.ajax({
                    url: "<?php echo e(route('loans.index')); ?>",
                    method: 'GET',
                    data: data,
                    success: function (response) {
                        $('#loan-results').html(response);
                    },
                    error: function () {
                        alert('Erro ao buscar dados. Tente novamente.');
                    }
                });
            }

            $form.on('input change', 'input, select', function () {
                fetchResults();
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/loans/index.blade.php ENDPATH**/ ?>