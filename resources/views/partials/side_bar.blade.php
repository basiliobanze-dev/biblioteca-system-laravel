<div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i> Início</a></li>
                
                @if(in_array(auth()->user()->role, ['admin', 'librarian']))
                    <li><a href="{{ route('books.index') }}" class="nav-link"><i class="fa-solid fa-book"></i> Gerenciar Livros</a></li>
                @endif
                
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('users.index') }}" class="nav-link"><i class="fa-solid fa-users"></i> Gerenciar Usuários</a></li>
                @endif
                
                @if(in_array(auth()->user()->role, ['admin', 'librarian']))
                    <li><a href="{{ route('loans.index') }}" class="nav-link"><i class="fas fa-exchange-alt"></i> Empréstimos & Devoluções</a></li>
                    <li><a href="{{ route('reports.top-books') }}" class="nav-link"><i class="fas fa-chart-pie"></i> Relatório: Livros</a></li>
                    <li><a href="{{ route('reports.top-users') }}" class="nav-link"><i class="fas fa-chart-pie"></i> Relatório: Usuários</a></li>
                @endif
                
                @if(auth()->user()->role === 'admin')
                    <li><a href="{{ route('audit_logs.index') }}" class="nav-link"><i class="fa-solid fa-users"></i> Logs de Auditoria</a></li>
                @endif

                @if(in_array(auth()->user()->role, ['admin', 'reader']))
                    <li><a href="{{ route('loans.my') }}" class="nav-link"><i class="fas fa-bookmark"></i> Meus Empréstimos</a></li>
                    <li><a href="{{ route('loans.request') }}" class="nav-link"><i class="fas fa-book-open"></i> Buscar Livros</a></li>
                @endif
            </ul>
        </div>

        @auth
            <div>
                <form action="{{ route('logout') }}" method="POST">   
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            </div>
        @endauth
    </div>
</div>