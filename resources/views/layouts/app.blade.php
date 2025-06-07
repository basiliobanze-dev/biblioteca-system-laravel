<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
        <link rel="stylesheet" href="{{ asset('css/books.css') }}">
        <link rel="stylesheet" href="{{ asset('css/users.css') }}">
        <link rel="stylesheet" href="{{ asset('css/side_bar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dashboard-reader.css') }}">
    </head>

    <body>
        @include('partials.header')

        <div class="container mt-4">
            @yield('content') <!-- container to exib content of the views  -->
        </div>

        @include('partials.footer')

        @include('partials.side_bar')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>