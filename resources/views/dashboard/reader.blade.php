@extends('layouts.app')

@section('content')
    <div class="library-dashboard">
        <div class="library-banner">
            <div class="banner-overlay">
                <h1><i class="fas fa-book"></i>Biblioteca Online</h1>
                <p class="welcome-message">Bem-vindo ao seu espaço literário, {{ Auth::user()->name }}!</p>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Cartão de Estatísticas com Estilo de Etiqueta de Livro -->
            <div class="dashboard-card book-card">
                <div class="card-spine" style="background-color: #00BFA6;"></div>
                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3>Meus Empréstimos</h3>
                    <div class="book-counter">
                        <span class="counter-number">{{ $activeLoansCount ?? '0' }}</span>
                        <span class="counter-label">livros com você</span>
                    </div>
                    <a href="{{ route('loans.my') }}" class="card-button">
                        <i class="fas fa-chevron-right"></i> Ver todos
                    </a>
                </div>
            </div>

            <!-- Cartão de Catálogo com Estilo de Ficha Catalográfica -->
            <div class="dashboard-card catalog-card">
                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Explorar Catálogo</h3>
                    <p class="card-text">Nossa biblioteca possui <strong>{{ $totalBooks ?? '1,240' }} títulos</strong> disponíveis para descoberta.</p>
                    <div class="library-stamp">DISPO<br>NÍVEL</div>
                    <a href="{{ route('books.catalog') }}" class="card-button">
                        <i class="fas fa-book-open"></i> Buscar Livros
                    </a>
                </div>
            </div>

            <!-- Cartão de Recomendações com Estilo de Página de Livro -->
            <div class="dashboard-card recommendation-card">
                <div class="page-fold"></div>
                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Sugestão</h3>
                    <div class="book-recommendation">
                        <div class="book-cover-dashboard cover">
                            @if(isset($recommendedBook->cover_image))
                                <img src="{{ asset('storage/covers/' . $recommendedBook->cover_image) }}" alt="{{ $recommendedBook->title }}" class="img-fluid" style="max-height: 120px;">
                            @else
                                <i class="fas fa-book"></i>
                            @endif
                        </div>

                        <div class="book-info">
                            <h4>{{ $recommendedBook->title ?? 'O Nome do Vento' }}</h4>
                            <p class="book-author">{{ $recommendedBook->author ?? 'Patrick Rothfuss' }}</p>
                        </div>
                    </div>
                    <a href="{{ route('books.show', $recommendedBook->id ?? 0) }}" class="card-button">
                        <i class="fas fa-chevron-right"></i> Ver detalhes
                    </a>
                </div>
            </div>

            <!-- Cartão de Novidades com Estilo de Jornal -->
            <div class="dashboard-card news-card">
                <div class="news-header">
                    <h3><i class="fas fa-newspaper"></i> Biblioteca News</h3>
                    <div class="news-date">{{ now()->format('d/m/Y') }}</div>
                </div>
                <ul class="news-items">
                    <li><i class="fas fa-bullhorn"></i> Lançada a nova Biblioteca Online – aceda de qualquer lugar!</li>
                    <li><i class="fas fa-clock"></i> Horário estendido às sextas-feiras</li>
                    <li><i class="fas fa-book"></i> A nova biblioteca online é a ponte entre o saber e o futuro digital.</li>
                </ul>
                <div class="news-footer">
                    "A leitura é uma viagem para quem não pode pegar o trem." - Francis Carco
                </div>
            </div>
        </div>

        <!-- Seção de Destaques -->
        <div class="featured-section">
            <h2><i class="fas fa-star"></i>Mais Emprestados</h2>
            <div class="featured-books">
                @foreach ($topBooks as $bookStat)
                    <div class="featured-book">
                        <div class="book-cover-dashboard large">
                            @if(isset($bookStat->book->cover_image))
                                <img src="{{ asset('storage/covers/' . $bookStat->book->cover_image) }}" alt="{{ $bookStat->book->title }}" class="img-fluid" style="max-height: 100px;">
                            @else
                                <i class="fas fa-book"></i>
                            @endif
                        </div>
                        <h4>{{ $bookStat->book->title ?? 'Livro removido' }}</h4>
                        <p>{{ $bookStat->book->author ?? '-' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection