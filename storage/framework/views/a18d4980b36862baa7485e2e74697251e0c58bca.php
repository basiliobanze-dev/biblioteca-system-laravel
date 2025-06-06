<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1><i class="fas fa-tachometer-alt"></i> Meu Painel</h1>
        <p class="welcome-message">Bem-vindo de volta! Aqui está o resumo das suas atividades.</p>
    </div>

    <div class="dashboard-grid">
        <!-- Cartão de Estatísticas -->
        <div class="dashboard-card highlight-card">
            <div class="card-icon">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="card-content">
                <h3>Meus Empréstimos Ativos</h3>
                <p class="card-value"><?php echo e($activeLoansCount ?? '0'); ?></p>
                <p class="card-subtext">livros em sua posse</p>
                <a href="<?php echo e(route('loans.mine')); ?>" class="card-button">
                    Ver detalhes <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <!-- Cartão de Ação Rápida -->
        <div class="dashboard-card action-card">
            <div class="card-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="card-content">
                <h3>Explore o Catálogo</h3>
                <p class="card-text">Descubra novos livros para expandir seus conhecimentos.</p>
                <a href="<?php echo e(route('books.catalog')); ?>" class="card-button">
                    Buscar Livros <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <!-- Cartão de Recomendações -->
        <div class="dashboard-card recommendation-card">
            <div class="card-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="card-content">
                <h3>Recomendado para Você</h3>
                <p class="card-text">Baseado no seu histórico de leitura:</p>
                <div class="recommendation">
                    <i class="fas fa-book"></i>
                    <span><?php echo e($recommendedBook ?? 'O Poder do Hábito - Charles Duhigg'); ?></span>
                </div>
                <a href="<?php echo e(route('books.catalog')); ?>" class="card-button">
                    Ver sugestões <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

        <!-- Cartão de Mensagem Motivacional -->
        <div class="dashboard-card quote-card">
            <div class="card-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <div class="card-content">
                <h3>Inspiração do Dia</h3>
                <blockquote>
                    "Um leitor vive mil vidas antes de morrer. O homem que nunca lê vive apenas uma."
                </blockquote>
                <p class="quote-author">- George R.R. Martin</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECTS\LARAVEL\biblioteca-system-laravel\resources\views/dashboard/reader.blade.php ENDPATH**/ ?>