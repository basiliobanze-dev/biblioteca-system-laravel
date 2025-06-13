@extends('layouts.app')

@section('content')
    <div class="library-dashboard">
        <div class="library-banner">
            <div class="banner-overlay">
                <h1><i class="fas fa-book"></i>Biblioteca Online</h1>
                <p class="welcome-message">Bem-vindo ao seu espaço literário, {{ Auth::user()->name }}!</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-grid">
            <div class="dashboard-card book-card">
                <div class="card-spine" style="background-color: #00BFA6;"></div>
                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3>Meus Empréstimos</h3>
                    <div class="book-counter">
                        <span class="counter-number">{{ $activeLoansCount ?? '0' }}</span>
                        <span class="counter-label">Livros Comigo</span>
                    </div>
                    <a href="{{ route('loans.my') }}" class="card-button">
                        <i class="fas fa-chevron-right"></i> Ver todos
                    </a>
                </div>
            </div>

            <div class="dashboard-card catalog-card">
                <div class="card-content">
                    <div class="card-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Explorar Catálogo</h3>
                    <p class="card-text">Nossa biblioteca possui <strong>{{ $totalBooks ?? '1,240' }} títulos</strong> disponíveis para descoberta.</p>
                    <div class="library-stamp">DISPO<br>NÍVEL</div>
                    <a href="{{ route('loans.request') }}" class="card-button">
                        <i class="fas fa-book-open"></i> Buscar Livros
                    </a>
                </div>
            </div>

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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#bookDetailsModal{{ $recommendedBook->id }}">
                                    <img src="{{ asset('storage/covers/' . $recommendedBook->cover_image) }}" 
                                        alt="{{ $recommendedBook->title }}" 
                                        class="img-fluid" style="max-height: 120px;">
                                </a>
                            @else
                                <a href="#" data-bs-toggle="modal" data-bs-target="#bookDetailsModal{{ $recommendedBook->id }}">
                                    <i class="fas fa-book"></i>
                                </a>
                            @endif
                        </div>

                        <div class="book-info">
                            <h4>{{ $recommendedBook->title ?? 'Title' }}</h4>
                            <p class="book-author">{{ $recommendedBook->author ?? 'Author' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="#" class="card-button" data-bs-toggle="modal" data-bs-target="#bookDetailsModal{{ $recommendedBook->id }}">
                            <i class="fas fa-chevron-right"></i> Ver detalhes
                        </a>
                    </div>
                </div>
            </div>

            @if(isset($recommendedBook))
                @include('books.show_modal', ['book' => $recommendedBook])
            @endif

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
@endsection