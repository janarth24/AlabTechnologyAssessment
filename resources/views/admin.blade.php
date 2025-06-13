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
                        Users
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start px-3 py-2 fs-6 w-100"
                        id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        Manage Blogs
                    </button>
                </li>
                <hr>
                <li class="nav-item mt-2">
                    <a href="{{ route('home') }}" class="btn btn-warning text-start px-3 py-2 fs-5 w-100">
                        Home
                    </a>
                </li>

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
        <div class="flex-grow-1 p-4 bg-light" style="overflow-y: auto; height: 100vh;">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            <div class="col-lg-8 col-sm-9 col-md-10 p-4">
                <div class="tab-content fs-5" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container mt-4">
                            <h2>Users</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" style="width: 10%">Id</th>
                                            <th style="width: 30%">Name</th>
                                            <th style="width: 30%">Email</th>
                                            <th class="text-center" style="width: 30%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <th class="text-center">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('deleteuser',$user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete user?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-warning d-inline" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                                                    Update Request
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No users found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="container mt-4">
        <h2>Blog Details</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" style="width: 10%">Id</th>
                        <th style="width: 20%">Title</th>
                        <th style="width: 30%">Content</th>
                        <th style="width: 20%">Post Image</th>
                        <th style="width: 20%">User</th>
                        <th class="text-center" style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr>
                        <th class="text-center">{{ $blog->id }}</th>
                        <td>{{ $blog->title }}</td>
                        <td>{{ Str::limit($blog->content, 50) }}</td> 
                        <td><img src="{{ asset('images/' . $blog->postimage) }}" alt="{{ $blog->title }}" style="max-width: 100px; height: auto;"></td>
                        <td>{{ $blog->user->name ?? 'Unknown' }}</td> 
                        <td class="text-center">
                            <form action="{{ route('deletepost',$blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete blog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No blogs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $user->id }}">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updatename', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>


                            <label for="requestname">Name</label>
                            <input type="text" name="requestname" id="requestname" class="form-control @error('requestname') is-invalid @enderror p-2" placeholder="Name..." value="{{ $user->name }}">
                            @error('requestname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
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