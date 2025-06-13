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

<body class="p-5">
    <h2 class="mb-4"><a href="{{ route('home') }}" class="">
                        Home
                    </a> / MySql Queries</h2>
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
    <div class="accordion fs-5" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Fetching all products with more than 10 stock.
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container mt-4">
                        <h3 class="mb-3">Available Products (Stock > 10)</h3>

                        @foreach($products as $product)
                        <div class="card mb-3 p-3 shadow-sm">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ $product->description }}</p>
                            <strong>Price:</strong> ₹{{ $product->price }} <br>
                            <strong>Stock:</strong> {{ $product->stock }}
                        </div>
                        @endforeach

                        @if($products->isEmpty())
                        <p>No products available with stock > 10.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Fetching all orders placed by a specific user & Dcrement stock if mark as received
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="container mt-4">
                        <h3 class="mb-3">My Orders</h3>

                        @foreach($orders as $order)
                        <div class="card mb-3 shadow-sm p-3 bg-light">
                            <h5>Order #{{ $order->id }}</h5>
                            <p><strong>Total Price:</strong> ₹{{ number_format($order->total_price, 2) }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge 
                    @if($order->status === 'Completed') bg-success 
                    @elseif($order->status === 'Pending') bg-warning text-dark 
                    @else bg-secondary 
                    @endif">
                                    {{ $order->status }}
                                </span>
                            </p>

                            @if(strtolower($order->status) !== 'completed')
                            <form action="{{ route('orders.markAsReceived', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm btn-outline-primary mt-2">Mark as Received</button>
                            </form>
                            @endif
                        </div>
                        @endforeach

                        @if($orders->isEmpty())
                        <p>No orders found.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
       
    </div>

</body>

</html>