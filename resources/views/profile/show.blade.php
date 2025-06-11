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
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=100&rounded=true"
                            alt="Avatar Padrão">
                    @endif
                </div>

                <div class="profile-info">
                    <h2>{{ $user->name }}</h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                    <p><i class="fas fa-venus-mars"></i> <strong>Gênero:</strong> {{ $user->account && $user->account->gender ? $user->account->gender : '---' }}</p>
                    <p><i class="fas fa-birthday-cake"></i> <strong>Nascimento:</strong> {{ $user->account && $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d/m/Y') : '---' }}</p>
                    <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> {{ $user->account && $user->account->phone ? $user->account->phone : '---' }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Endereço:</strong> {{ $user->account && $user->account->address ? $user->account->address : '---' }}</p>
                </div>
            </div>

            <div class="profile-actions">
                <a href="{{ url()->previous() }}" class="btn-close top-right"><i class="fas fa-times"></i></a>

                <div class="action-buttons bottom-right">
                    <a href="{{ route('profile.edit', $user) }}" class="btn-edit123" title="Editar" style="color: #A4A4A5; padding: 8px 10px; border-radius: 4px; font-size: 1rem; transition: background-color 0.3s ease;"><i class="fas fa-pencil-alt"></i></a>
                </div>
            </div>
        </section>
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
