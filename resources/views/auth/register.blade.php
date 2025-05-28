@extends('layouts.auth')

@section('content')
    <div class="register-container">
        <div class="register-top">
            <div class="icon-box">
                <i class="fa-solid fa-book" style="color:rgb(255, 255, 255); font-size: 50px;"></i>
            </div>
            <p class="subtitle">Abre as portas do saber — cria sua conta gratuita agora mesmo.</p>
        </div>

        <div class="register-box">
            <h2>CADASTRO</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input id="name" type="text" name="name" placeholder="Nome" value="{{ old('name') }}" required autofocus>
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input id="password" type="password" name="password" placeholder="Senha" required>
                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar Senha" required>

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
@endsection