@extends('layouts.app')

@section('content')
    <div>
        <section class="profile-container">
            <h1 class="profile-title">Usuário</h1>

            <div class="profile-card">
                <div class="profile-image">
                    @if ($user->account && $user->account->profile_image)
                        <img src="{{ asset('storage/profiles/' . $user->account->profile_image) }}" alt="Foto de Perfil">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=50&rounded=true"
                            alt="Avatar Padrão"
                            style="width: 100px; height: 100px; border-radius: 50%;">
                    @endif
                </div>
                
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <p><strong>Tipo de Perfil:</strong>
                        @if ($user->role === 'admin')
                            Administrador
                        @elseif ($user->role === 'librarian')
                            Bibliotecário
                        @else
                            Leitor
                        @endif
                    </p>
                    <p><strong>Gênero:</strong> {{ $user->account->gender ?? '---' }}</p>
                    <p><strong>Nascimento:</strong> {{ $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d-m-Y') : '---' }}</p>
                    <p><strong>Telefone:</strong> {{ $user->account->phone ?? '---' }}</p>
                    <p><strong>Endereço:</strong> {{ $user->account->address ?? '---' }}</p>
                </div>
            </div>
        </section>

        <div class="profile-form-actions">
            <!-- <a href="{{ route('users.index') }}" class="btn-back">Voltar</a> -->
            <a href="{{ route('users.index') }}" class="btn-user-back">Voltar</a>
        </div>
    </div>
@endsection

