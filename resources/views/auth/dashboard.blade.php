{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Dashboard</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <ul class="navbar-nav ml-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Sign Out</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('register') }}">Register</a>
                </li>
            @endauth
        </ul>
    </nav>




    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}




<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .qr-code-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>

        <div class="container mt-4">

            <div class="card">
                <div class="card-header">
                    <h2>Profile Scan</h2>
                </div>
                <div class="card-body">
                    {!! QrCode::size(300)->generate(url('/profile')) !!}
                </div>
            </div>
            <li class="nav-item">

                <a href="{{ url('users') }}"><button type="button" class="btn btn-link nav-link">All Users List</button></a>

            </li>

            <li class="nav-item">
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Sign Out</button>
                </form>
            </li>

        </div>
    </div>
</body>
</html>
