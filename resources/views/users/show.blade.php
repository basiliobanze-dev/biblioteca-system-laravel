
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-TOP: 60px;">

        <div class="card">
            <div class="card-body">
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
            </div>
        </div>

        <div style="margin-bottom: 120px;">
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Voltar</a>
        </div>
        
    </div>
@endsection
