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
        
            <div class="col-lg-12 p-5 shadow-lg">
               
                    <div class="d-flex flex-column justify-content-center pt-1 align-items-center">
                        <img src="{{ asset('/images/badge.png') }}" width="200px" height="150px">
                        <div class="d-block mt-3 ps-4">
                            <h3 class="text-center">AlabTech</h3>
                            <p class="text-muted ">Register to explore the AlabTech</p>
                        </div>
                    </div>

                    <div class="d-flex flex-column justify-content-center pt-1 align-items-center fs-5">
                        <form method="POST" action="{{  route('register') }}" class="w-75">
                            @csrf
                            <div class="mb-2 ms-3">
                                <label for="name" class="fw-bold col-md-4 col-form-label ">{{ __('Name') }}</label>

                                <div class="col-md-12">
                                    <input id="name"  type="text" class=" w-100 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="mb-3 ms-3">
                                <label for="email" class="fw-bold col-md-4 col-form-label ">{{ __('Email Address') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class=" w-100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                    <input id="password" type="password" class=" w-100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="mb-3 ms-3">
                                <label for="password-confirm" class=" fw-bold col-md-4 col-form-label">{{ __('Confirm Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="w-100 form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="w-50 row mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('Register') }}
                                    </button>
                                    <p class="mt-2 text-center">Already Have an acoount ? <a href="{{route('login')}}">Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                 

               
            </div>
       
    </div>
</body>

</html>