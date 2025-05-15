@extends('layouts.custom')

@section('title', 'Top bài viết hôm nay')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Quản lý bài viết</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Thêm bài viết mới
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Tìm bài viết theo tiêu đề..."
                value="{{ old('search', $search ?? '') }}" class="px-4 py-2 border rounded">
            <button type="submit" class="px-4 py-2 bg-blue-500 rounded">Tìm kiếm</button>
        </form>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <strong>Danh sách tất cả bài viết</strong>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info">Xem</a>

                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Sửa</a>
                                    @endcan

                                    @can('delete', $post)
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                            class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Không có bài viết nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
