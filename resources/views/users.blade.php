<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>



<body class="bg-light">
    <div class="container mt-5">
        <h2><a href="{{ route('home') }}" class="">
                        Home
                    </a> / User List (Live Search with JS)</h2>
        <input type="text" id="search" class="form-control my-4" placeholder="Search by name...">
        <div class="row fs-5" id="user-list">
            <!-- User cards will appear here -->
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("search");
            const userList = document.getElementById("user-list");

            const fetchUsers = async (query = '') => {
                try {
                    const res = await fetch(`/users-data?search=${encodeURIComponent(query)}`);
                    if (!res.ok) throw new Error("Network response failed");

                    const users = await res.json();

                    userList.innerHTML = "";

                    if (users.length === 0) {
                        userList.innerHTML = '<p>No users found.</p>';
                        return;
                    }

                    users.forEach(user => {
                        const card = document.createElement("div");
                        card.className = "col-md-6";
                        card.innerHTML = `
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">${user.name}</h5>
                            <p class="card-text">
                                <strong>Email:</strong> ${user.email}<br>
                                <strong>Address:</strong> ${user.address.suite}, ${user.address.street}, ${user.address.city} - ${user.address.zipcode}
                            </p>
                        </div>
                    </div>`;
                        userList.appendChild(card);
                    });
                } catch (err) {
                    userList.innerHTML = '<p class="text-danger">Error fetching data.</p>';
                }
            };

            // Initial fetch
            fetchUsers();

            // Live search on input
            searchInput.addEventListener("input", () => {
                fetchUsers(searchInput.value);
            });
        });
    </script>
</body>

</html>