<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="col-lg-12 shadow-lg">

            <div class="d-flex flex-column justify-content-center pt-1 align-items-center">
                <img src="{{ asset('/images/badge.png') }}" width="200px" height="150px">
                <div class="d-block mt-3 ps-4">
                    <h3 class="text-center">AlabTech</h3>
                    <p class="text-muted ">Login to explore the AlabTech</p>
                </div>
            </div>

            <div class="d-flex flex-column justify-content-center pt-1 align-items-center fs-5">
                <form method="POST" action="{{ route('login') }}" class="w-75">
                    @csrf

                    <div class="mb-3 ms-3">
                        <label for="email" class="fw-bold col-md-4 col-form-label">{{ __('Email Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 ms-3">
                        <label for="password" class="fw-bold col-md-4 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
    <div class="col-md-6">
        <div class="form-check ms-2">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label fs-5" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>
    <div class="col-md-6 text-md-end text-start mt-2 mt-md-0">
        @if (Route::has('password.request'))
            <a class="btn btn-link px-0 fs-5" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>
</div>

                    <div class="row mb-0">
                        <div class="w-50 row mx-auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Login') }}
                            </button>
                            <p class="mt-2 text-center fs-5">Create a new acoount ? <a href="{{route('register')}}" class="fs-5">Register</a></p>
                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>
</body>

</html>