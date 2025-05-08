<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Thêm Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles') <!-- Thêm các style tùy chỉnh khác nếu cần -->
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="bg-light p-3" style="width: 250px;">
            @include('partials.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="container-fluid p-4">
            <header class="d-flex justify-content-between mb-3">
                <!-- Hello User -->
                <div>
                    @auth
                        <span class="text-muted">Xin chào, {{ Auth::user()->name }}</span>
                    @endauth
                </div>

                <!-- Logout Button -->
                @auth
                    <div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </div>
                @endauth
            </header>

            <!-- Content Area -->
            <section class="main-content">
                @yield('content')
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-4">
        <p class="mb-0">© 2025 Admin Panel</p>
    </footer>

    <!-- Thêm Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts') <!-- Thêm các script tùy chỉnh khác nếu cần -->
</body>
</html>
