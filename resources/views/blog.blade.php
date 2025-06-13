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
        .dark-mode .card {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        .dark-mode .form-control {
            background-color: #2c2c2c;
            color: #ffffff;
            border-color: #444;
        }

        .dark-mode .btn-outline-primary {
            color: #ffffff;
            border-color: #0d6efd;
        }

        .dark-mode .btn-outline-secondary {
            color: #ffffff;
            border-color: #6c757d;
        }

        .dark-mode .form-control::placeholder {
            color: #cccccc;
        }


        #themeIcon.bi-sun-fill {
            color: #000 !important;
        }

        .dark-mode #themeIcon.bi-moon-fill {
            color: #fff !important;
        }

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
                <div class="text-end ms-4 mt-1">
                    <button id="darkModeToggle" class="btn btn-sm btn-outline-secondary">
                        <i id="themeIcon" class="bi bi-moon-fill"></i>
                    </button>
                </div>
            </div>
            <hr>

            <!-- Navigation Tabs -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <button class="nav-link active text-start px-3 py-2 fs-5 w-100"
                        id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        Create Post
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link text-start px-3 py-2 fs-5 w-100"
                        id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        Posts
                    </button>
                </li>
                <hr>
                <li class="nav-item mt-2">
                    <a href="{{ route('home') }}" class="btn btn-warning text-start px-3 py-2 fs-5 w-100">
                        Home
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->is_admin)
                <li class="nav-item mt-2">
                    <a href="{{ route('admin.page') }}" class="btn btn-primary text-start px-3 py-2 fs-5 w-100">
                        Go to Admin Panel
                    </a>
                </li>
                @endif
            </ul>

            <!-- User dropdown at bottom -->
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
                        <div class="card tweet-card shadow-sm p-4 bg-light mt-2">
                            <form action="{{ route('post')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="d-flex flex-column flex-md-row mb-3 align-items-start">

                                    <img src="{{ asset('images/person.jpg') }}"
                                        class="rounded-circle me-md-3 mb-3 mb-md-0"
                                        width="48" height="48" alt="Profile">
                                    <div class="flex-grow-1 w-100">

                                        <input name="title" id="title"
                                            class="form-control border border-secondary shadow-lg fs-5 mb-2"
                                            placeholder="Title"
                                            value="{{ old('title') }}">

                                        <textarea name="content" id="content"
                                            class="form-control border border-secondary shadow-lg fs-5"
                                            rows="5"
                                            placeholder="Write a Blog.."></textarea>
                                    </div>
                                </div>

                                <!-- File input and post button -->
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-2 gap-3 gap-sm-0">
                                    <div class="tweet-icons d-flex align-items-center">
                                        <input type="file" name="postimage" id="postimage" accept="image/*" hidden>
                                        <label for="postimage" class="mb-0" style="cursor: pointer;">
                                            <i class="bi bi-image text-info fs-5 ps-2 ms-5"></i>
                                        </label>
                                    </div>

                                    <button type="submit" class="btn rounded-pill px-4 text-white bg-primary">
                                        Post
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @foreach($blogs as $blog)
                        <div class="card mb-2 shadow-sm">
                            <div class="card-body">
                                <!-- Post Header -->
                                <div class="d-flex align-items-center ">
                                    <img src="{{ asset('images/person.jpg') }}" alt="User" width="45" height="45" class="rounded-circle me-2">
                                    <h5 class="card-title mb-0">{{ $blog->user->name }}</h5>
                                </div>

                                <!-- Post Content -->
                                <div class="card tweet-card shadow-sm p-4 mt-1 blog-post bg-white text-dark mb-1">
                                    <h3 class="fw-bold">{{ $blog->title }}</h3>

                                    <div class="d-inline">
                                        <span class="blog-content" data-full="{{ $blog->content }}" data-short="{{ \Illuminate\Support\Str::limit($blog->content, 150) }}">
                                            {{ \Illuminate\Support\Str::limit($blog->content, 150) }}
                                        </span>

                                        @if(strlen($blog->content) > 150)
                                        <button class="btn btn-link btn-sm p-0 ms-2 align-baseline read-more-btn fw-bold" style="font-size: 0.875rem;">Read More</button>
                                        @endif
                                    </div>

                                    @if($blog->postimage)
                                    <img src="{{ asset('images/' . $blog->postimage) }}"
                                        alt="Post Image"
                                        class="img-fluid rounded mt-2 mb-3"
                                        style="width: 40%; max-height: 300px; object-fit: cover;">
                                    @endif

                                </div>



                                <div class="d-flex flex-column flex-md-row gap-3 align-items-start justify-content-between">
                                    <!-- Comment Input -->
                                    <div class="card flex-grow-1 bg-light p-3">
                                        <form action="{{ route('comment') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="postid" value="{{ $blog->id }}">
                                            <div class="d-flex align-items-start mb-2">
                                                <img src="{{ asset('images/person.jpg') }}" class="rounded-circle me-2" width="32" height="32" alt="Profile">
                                                <textarea name="comment_content" class="form-control border border-primary fs-6 w-75" rows="1" placeholder="Write your comment..."></textarea>
                                                <button type="submit" class="btn btn-sm rounded-pill px-3 text-white bg-primary ms-3 mt-2">Post Comment</button>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- See Comments Button -->
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-outline-secondary mt-2 mt-md-0"
                                            data-bs-toggle="modal" data-bs-target="#commentModal{{ $blog->id }}">
                                            See Comments
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for this post -->
                        <div class="modal fade" id="commentModal{{ $blog->id }}" tabindex="-1" aria-labelledby="commentModalLabel{{ $blog->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="commentModalLabel{{ $blog->id }}">Comments</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($blog->comments->count())
                                        @foreach($blog->comments as $comment)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/person.jpg') }}" width="32" height="32" class="rounded-circle me-2" alt="User">
                                                <strong>{{ $comment->user->name }}</strong>
                                            </div>
                                            <p class="mb-0 ms-5">{{ $comment->comment_content }}</p>
                                            <hr>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>No comments yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
        document.querySelectorAll(".read-more-btn").forEach(button => {
            button.addEventListener("click", function() {
                const contentPara = this.previousElementSibling;
                const fullContent = contentPara.getAttribute("data-full");
                const shortContent = contentPara.getAttribute("data-short");

                if (this.textContent === "Read More") {
                    contentPara.textContent = fullContent;
                    this.textContent = "Read Less";
                } else {
                    contentPara.textContent = shortContent;
                    this.textContent = "Read More";
                }
            });
        });


        const toggleButton = document.getElementById("darkModeToggle");
        const body = document.body;
        const icon = document.getElementById("themeIcon");

        // Set initial mode from localStorage
        if (localStorage.getItem("dark-mode") === "enabled") {
            body.classList.add("dark-mode");
            icon.classList.replace("bi-moon-fill", "bi-sun-fill");
        }

        toggleButton.addEventListener("click", function() {
            body.classList.toggle("dark-mode");

            const isDark = body.classList.contains("dark-mode");

            // Toggle icon
            icon.classList.toggle("bi-moon-fill", !isDark);
            icon.classList.toggle("bi-sun-fill", isDark);

            // Save preference
            localStorage.setItem("dark-mode", isDark ? "enabled" : "disabled");
        });
    });
</script>



</html>