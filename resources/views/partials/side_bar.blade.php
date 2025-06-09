<div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i> Início</a></li>
                <li><a href="{{ route('books.index') }}" class="nav-link"><i class="fa-solid fa-book"></i> Livros</a></li>
                <li><a href="{{ route('users.index') }}" class="nav-link"><i class="fa-solid fa-users"></i> Usuários</a></li>
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