@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <div class="table-header d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('users.create') }}" class="btn btn-add mb-3">Adicionar Usuário</a>

            <form method="GET" action="{{ route('users.index') }}" class="search-form d-flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar por nome ou email..." class="search-input form-control form-control-sm">
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
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->account && $user->account->profile_image)
                                <img src="{{ asset('storage/profiles/' . $user->account->profile_image) }}"
                                    alt="Foto de Perfil"
                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=50&rounded=true"
                                    alt="Avatar Padrão"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_label }}</td>
                        <td>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-view"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-remove" onclick="return confirm('Tem certeza?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
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

