@extends('layouts.auth')

@section('content')
<div class="reset-container">
    <div class="reset-wrapper">
        <h2 class="reset-title">Redefinir Senha</h2>

        <form method="POST" action="{{ route('password.update') }}" class="reset-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="reset-group">
                <label for="email">E-Mail</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required>
                @error('email')
                    <span class="reset-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="reset-group">
                <label for="password">Nova Senha</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="reset-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="reset-group">
                <label for="password-confirm">Confirmar Senha</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div class="reset-actions">
                <button type="submit" class="reset-btn">Redefinir Senha</button>
            </div>
        </form>
    </div>
</div>
@endsection
