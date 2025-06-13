<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>

<body class="bg-light text-dark d-flex flex-column justify-content-center align-items-center min-vh-100 p-4">



    <div class="container bg-white text-dark p-4 p-lg-5 shadow rounded-bottom rounded-lg-start">

        <p class="mb-4 d-flex align-items-center gap-3 fs-1">
            <img src="{{ asset('/images/badge.png') }}" class="img-fluid rounded" alt="Builder Badge" width="60" height="60">
            <span class="fs-1">Alab Technology</span>
        </p>

        <p class="text-secondary mb-4 fs-3">
            In the Software Technology major, you’ll learn how to control computers by programming them. You’ll gain skills and experience in software, programming languages, structured programming, programming practice, research and development, project planning and project delivery. The computers you’ll command include the smallest embedded devices, the largest centralised servers and everything in between.
        </p>

        @if (Route::has('login'))
        <nav class="d-flex justify-content-end gap-3">
            @auth
            <a href="{{ url('/home') }}" class="btn btn-outline-dark btn-lg">Home</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </div>

</body>



</html>