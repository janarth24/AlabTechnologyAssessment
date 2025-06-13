<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">User List</h2>

    @if($error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    <form method="GET" action="{{ route('users') }}" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
    </form>

    <div class="row">
        @forelse ($users as $user)
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user['name'] }}</h5>
                        <p class="card-text">
                            <strong>Email:</strong> {{ $user['email'] }}<br>
                            <strong>Address:</strong> {{ $user['address']['suite'] }}, {{ $user['address']['street'] }}, {{ $user['address']['city'] }} - {{ $user['address']['zipcode'] }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No users found.</p>
            </div>
        @endforelse
    </div>
</div>

<div class="bd-example m-0 border-0">
    <nav>
        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false" tabindex="-1">Home</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" tabindex="-1">Profile</button>
            <button class="nav-link active" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="true">Contact</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <p>This is some placeholder content the <strong>Home tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <p>This is some placeholder content the <strong>Profile tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>
        <div class="tab-pane fade active show" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <p>This is some placeholder content the <strong>Contact tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
        </div>
    </div>
</div>

</body>
</html>



