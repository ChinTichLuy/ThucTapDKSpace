@extends('layouts.custom')

@section('title', 'Top bài viết hôm nay')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Bài viết mới nhất</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                + Thêm bài viết
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
        @forelse ($posts as $post)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h4>
                    <p class="text-muted mb-1">
                        Đăng bởi <strong>{{ $post->user->name }} - {{ $post->status }}</strong>
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">
                Không có bài viết nào để hiển thị.
            </div>
        @endforelse

        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
