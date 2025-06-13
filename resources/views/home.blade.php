<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->



    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -260px;
                height: 100vh;
                width: 250px;
                z-index: 1050;
                background-color: #fff;
                transition: left 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 100vw;
                background-color: rgba(0, 0, 0, 0.3);
                z-index: 1049;
            }

            .overlay.active {
                display: block;
            }

            #sidebarToggle {
                z-index: 1060;

            }
        }
    </style>



</head>

<body class="bg-light" style="height:100vh; margin:0;">

    <nav class="navbar navbar-light bg-light d-md-none px-3">
        <button class="btn btn-outline-secondary" id="sidebarToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
    </nav>


    <div class="d-flex" style="height: 100vh;">
        <div id="sidebar" class="d-flex flex-column bg-white p-3 border-end sidebar" style="width: 250px; max-height: 100vh;">

            <div class="d-flex align-items-center">
                <a href="/" class="d-flex align-items-center text-decoration-none text-dark">
                    <img src="{{ asset('/images/badge.png') }}" width="45" height="45" alt="Logo">
                    <p class="mb-0 fw-bold fs-5 ms-2">AlabTech</p>
                </a>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <button class="nav-link active text-start px-3 py-2 fs-5 w-100"
                        id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        Home
                    </button>
                </li>
                @if(Auth::check() && Auth::user()->is_admin)
                <li class="nav-item mt-2">
                    <a href="{{ route('admin.page') }}" class="btn btn-primary text-start px-3 py-2 fs-5 w-100">
                        Go to Admin Panel
                    </a>
                </li>
                @endif


            </ul>
            <div class="mt-auto text-center">
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/person.jpg') }}" alt="User" width="45" height="45" class="rounded-circle">
                        <span class="fw-semibold fs-5 ms-2">{{ Auth::user()->name }} </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow mt-2">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="tab-content fs-5" id="nav-tabContent">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="shadow-lg p-5 text-center h-100">
                            <span>Blog: <a href="{{route('blog')}}">Click here</a></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="shadow-lg p-5 text-center h-100">
                            <span>Authentication: <a href="/">Click here</a></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="shadow-lg p-5 text-center h-100">
                            <span>E-Commerce: <a href="{{route('ecommerce')}}">Click here</a></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="shadow-lg p-5 text-center h-100">
                            <span>API: <a href="{{route('users')}}">Click here</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




</body>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>


</html>