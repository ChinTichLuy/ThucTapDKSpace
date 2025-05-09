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
