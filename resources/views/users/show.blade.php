@extends('layouts.app')

@section('content')
    <div class="user-card">
        <p><strong>Nome:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Perfil:</strong>
            @if ($user->role === 'admin')
                Administrador
            @elseif ($user->role === 'librarian')
                Bibliotecário
            @else
                Leitor
            @endif
        </p>

        <a href="{{ route('users.index') }}" class="btn-user-back">Voltar</a>
    </div>
@endsection
