@extends('layouts.app')

@section('content')
    <div class="admin-container">

        <div class="library-banner">
            <div class="banner-overlay">
                <h1 class="admin-title"><i class="fas fa-chart-line"></i> Painel Administrativo</h1>
                <!-- <p class="welcome-message">Bem-vindo ao seu espaço literário, {{ Auth::user()->name }}!</p>            -->
                <p class="welcome-message">Bem-vindo(a) {{ Auth::user()->name }}, você está logado(a) como <strong>{{ Auth::user()->role_label }}(a)</strong>.</p>
            </div>
        </div>
        
        <div class="admin-grid">
            <div class="admin-card">
                <h3 class="card-title"><i class="fas fa-cog"></i> Gerenciamento</h3>
                <div class="card-links">
                    <a href="{{ route('books.index') }}" class="admin-link">
                        <i class="fas fa-book"></i> Gerenciar Livros
                    </a>
                    <a href="{{ route('users.index') }}" class="admin-link">
                        <i class="fas fa-users"></i> Gerenciar Usuários
                    </a>
                    <a href="{{ route('loans.index') }}" class="admin-link">
                        <i class="fas fa-exchange-alt"></i> Empréstimos & Devoluções
                    </a>
                </div>
            </div>
            
            <div class="admin-card">
                <h3 class="card-title"><i class="fas fa-chart-pie"></i> Relatórios</h3>
                <div class="card-links">
                    <a href="{{ route('reports.top-books') }}" class="admin-link">
                        <i class="fas fa-chart-bar"></i> Relatório: Livros
                    </a>
                    <a href="{{ route('reports.top-users') }}" class="admin-link">
                        <i class="fas fa-chart-bar"></i></i> Relatório: Usuários
                    </a>
                    <a href="{{ route('audit_logs.index') }}" class="admin-link">
                        <i class="fas fa-clipboard-list"></i> Logs de Auditoria
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection