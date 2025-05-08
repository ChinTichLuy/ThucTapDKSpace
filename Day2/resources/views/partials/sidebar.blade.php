<aside class="bg-light p-3" style="width: 200px; height: 100vh; position: fixed;">
    <nav>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door"></i> Bảng điều khiển
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.posts.index') }}">
                    <i class="bi bi-file-earmark-post"></i> Quản lý bài viết
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.posts.create') }}">
                    <i class="bi bi-pencil-square"></i> Tạo bài viết mới
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>

    <!-- Form logout (ẩn) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</aside>
