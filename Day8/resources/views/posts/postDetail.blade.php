@extends('layouts.custom')

@section('title', $post->title)

@section('content')
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>

        <hr>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <h4>Bình luận</h4>

        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" rows="3" class="form-control" placeholder="Viết bình luận...">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Gửi bình luận</button>
            </form>
        @else
            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.</p>
        @endauth

        <hr>

        @if ($post->comments->count())
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->user->name }}</strong>:
                        {{ $comment->content }}
                        <br>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Chưa có bình luận nào.</p>
        @endif
    </div>
@endsection
