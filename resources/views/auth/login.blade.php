@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <div class="login-top">
            <div class="icon-box">
                <i class="fa-solid fa-book" style="color:rgb(255, 255, 255); font-size: 50px;"></i>
            </div>
            <p class="welcome-text">Olá! Seja muito bem-vindo à nossa biblioteca.</p>
        </div>

        <div class="login-box">
            <h2 class="login-title">LOGIN</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit">Entrar</button>
            </form>
        </div>

        <div class="login-footer">
            <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
            <a href="{{ route('register') }}">Não tem uma conta? Criar Agora</a>
        </div>
    </div>
@endsection
