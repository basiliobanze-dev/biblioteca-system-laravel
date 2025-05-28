<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Biblioteca')</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh background-color: #f1f1f1;;" >

    <!-- <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        @yield('content')
    </div> -->

    <div class="container mt-4">
         @yield('content') <!-- container to exib content of the views  -->
    </div>

</body>
</html>