<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel Blog</title>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('styles/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light-subtle">
        <div class="container">
            <a class="navbar-brand" href="{{ route('posts.index') }}">My Blog</a>
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index', 'archive') }}">Archive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <hr>
                <div>
                    @auth
                        @can('admin')
                            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm text-light"> Create Post </a>
                            <a href="{{ route('post.categories') }}" class="btn btn-dark btn-sm text-light"> Categories </a>
                        @endcan
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success btn-sm text-light"> Login </a>
                        <a href="{{ route('register') }}" class="btn btn-dark btn-sm text-light"> Register </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 My Laravel Blog. All Rights Reserved.</p>
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
