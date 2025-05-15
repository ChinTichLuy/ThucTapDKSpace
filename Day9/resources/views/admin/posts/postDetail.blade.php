@extends('layouts.custom')

@section('title', $post->title)

@section('content')
<div class="container mt-4">
    {{-- Tiêu đề bài viết --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $post->title }}</h4>
        </div>
        <div class="card-body">
            <p>{{ $post->content }}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-between">
            <span>Đăng bởi: <strong>{{ $post->user->name }}</strong></span>
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">← Quay lại danh sách</a>
        </div>
    </div>

    {{-- Khu vực bình luận --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Bình luận</h5>
        </div>
        <div class="card-body">
            @auth
                {{-- Form bình luận --}}
                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <textarea name="content" rows="3" class="form-control" placeholder="Viết bình luận...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Gửi bình luận</button>
                </form>
            @else
                <p class="text-muted">
                    Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.
                </p>
            @endauth

            {{-- Danh sách bình luận --}}
            @if ($post->comments->count())
                <ul class="list-group">
                    @foreach ($post->comments as $comment)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0">{{ $comment->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted mt-3">Chưa có bình luận nào.</p>
            @endif
        </div>
    </div>
</div>
@endsection
