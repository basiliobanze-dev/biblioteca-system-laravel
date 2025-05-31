@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div>
        <section class="profile-container">
            <h1 class="profile-title">Meu Perfil</h1>

            <div class="profile-card">
                <div class="profile-image">
                    @if ($user->account && $user->account->profile_image)
                        <img src="{{ asset('storage/profiles/' . $user->account->profile_image) }}" alt="Foto de Perfil">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=50&rounded=true"
                            alt="Avatar Padrão"
                            style="width: 50px; height: 50px; border-radius: 50%;">
                    @endif
                </div>

                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <p><strong>Gênero:</strong> {{ $user->account->gender ?? '---' }}</p>
                    <p><strong>Nascimento:</strong> {{ $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d-m-Y') : '---' }}</p>
                    <p><strong>Telefone:</strong> {{ $user->account->phone ?? '---' }}</p>
                    <p><strong>Endereço:</strong> {{ $user->account->address ?? '---' }}</p>
                </div>
            </div>
        </section>

        <div class="profile-form-actions">
            <a href="{{ route('profile.edit') }}" class="btn-save">Editar</a>
            <a href="{{ route('home') }}" class="btn-back">Voltar</a>
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
