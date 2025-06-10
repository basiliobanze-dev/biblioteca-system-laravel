@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Registrar Empréstimo</a>

        <form action="{{ route('loans.track') }}" method="GET" class="d-flex">
            <input type="text" name="protocol" class="form-control me-2" placeholder="Código (ex: EMP-202506071887C8)" required>
            <button type="submit" class="btn btn-secondary">Rastrear</button>
        </form>
    </div>

    <form id="search-form" class="d-flex gap-2 mb-3">
        <input type="text" name="user" placeholder="Buscar por usuário..." class="form-control" value="">
        <input type="text" name="book" placeholder="Buscar por livro..." class="form-control" value="">
        <select name="status" class="form-select">
            <option value="">Todos</option>
            <option value="active">Ativos</option>
            <option value="pending">Pendentes</option>
        </select>
    </form>

    <div id="loan-results">
        @include('loans.list', ['loans' => $loans])
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            const $form = $('#search-form');

            function fetchResults() {
                let data = $form.serialize();

                $.ajax({
                    url: "{{ route('loans.index') }}",
                    method: 'GET',
                    data: data,
                    success: function (response) {
                        $('#loan-results').html(response);
                    },
                    error: function () {
                        alert('Erro ao buscar dados. Tente novamente.');
                    }
                });
            }

            $form.on('input change', 'input, select', function () {
                fetchResults();
            });
        });
    </script>
@endpush

