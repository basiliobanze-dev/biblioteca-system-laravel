@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Bem-vindo, {{ Auth::user()->name }} 👋</h3>
                    <p class="lead mt-3">Você está logado como <strong>{{ Auth::user()->role_label }}</strong>.</p>

                    <div class="mt-4">
                        <p>Aqui você pode acessar funcionalidades do sistema conforme seu perfil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
