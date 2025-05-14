@extends('layouts.custom')

@section('title', 'Top bài viết hôm nay')

@section('content')

@section('content')
    <div class="container">
        <h2>Top 5 bài viết hôm nay</h2>
        <div class="list-group mb-4">
            @foreach ($topPosts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="list-group-item list-group-item-action">
                    <strong>{{ $post->title }}</strong>
                    <span class="badge bg-secondary float-end">{{ $post->views }} lượt xem</span>
                </a>
            @endforeach
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            Thêm mới bài viết
        </a>

        <h3>Tất cả bài viết</h3>
        @foreach ($allPosts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $allPosts->links() }}
        </div>
    </div>
@endsection
