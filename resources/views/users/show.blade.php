@extends('layouts.app')

@section('content')
    <div>
        <section class="profile-container">
            <!-- <h1 class="profile-title">Usuário</h1> -->
            <p class="id"><strong>ID:</strong>{{ $user->id }}</p>
            <div class="profile-card">
                <div class="profile-image">
                    @if ($user->account && $user->account->profile_image)
                        <img src="{{ asset('storage/profiles/' . $user->account->profile_image) }}" alt="Foto de Perfil">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=50&rounded=true"
                            alt="Avatar Padrão"
                            style="width: 120px; height: 120px; border-radius: 50%;">
                    @endif
                </div>
                
                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                    <p><strong><i class="fa-solid fa-circle-user"></i> Tipo de Perfil:</strong>
                        @if ($user->role === 'admin')
                            Administrador
                        @elseif ($user->role === 'librarian')
                            Bibliotecário
                        @else
                            Leitor
                        @endif
                    </p>
                    <p><i class="fas fa-venus-mars"></i> <strong>Gênero:</strong> {{ $user->account && $user->account->gender ? $user->account->gender : '---' }}</p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Nascimento:</strong> {{ $user->account && $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d/m/Y') : '---' }}</p>
                    <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> {{ $user->account && $user->account->phone ? $user->account->phone : '---' }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Endereço:</strong> {{ $user->account && $user->account->address ? $user->account->address : '---' }}</p>
                </div>
            </div>
        </section>

        <div class="profile-form-actions">
            <!-- <a href="{{ route('users.index') }}" class="btn-back">Voltar</a> -->
            <a href="{{ route('users.index') }}" class="btn-user-back">Voltar</a>
        </div>
    </div>
@endsection

