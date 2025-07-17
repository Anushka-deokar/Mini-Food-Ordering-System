<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite('resources/css/app.css')
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
        }

        main {
            flex: 1;
            background-color: #f8f9fa;
            padding: 2rem 0;
        }

        footer {
            padding: 1rem 0;
            background-color: #fff;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-utensils me-2"></i>TasteHub Admin
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.foods.*') ? 'active' : '' }}"
                                href="{{ route('admin.foods.index') }}">
                                <i class="fas fa-hamburger me-1"></i> Foods
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} TasteHub Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>