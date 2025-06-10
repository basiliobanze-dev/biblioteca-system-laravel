@extends('layouts.auth')

@section('content')
    <div class="forgot-container">
        <div class="forgot-wrapper">
            <h2 class="authentication-title">Recuperar Senha</h2>

            <p class="forgot-info">Informe seu e-mail abaixo para receber um link e redefinir sua senha.</p>

            @if (session('status'))
                <div class="forgot-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="forgot-form">
                @csrf

                <div class="forgot-group">
                    <label for="email">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="forgot-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="forgot-actions">
                    <button type="submit"'>Enviar link de redefinição</button>
                </div>
            </form>
        </div>
    </div>
@endsection
