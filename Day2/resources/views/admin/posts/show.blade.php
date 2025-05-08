@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="post-details">
            <h1 class="my-4">{{ $post->title }}</h1>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nội dung bài viết:</h5>
                    <p class="card-text">{{ $post->content }}</p>
                </div>
            </div>

            <div class="mt-3">
                <p><strong>Slug:</strong> {{ $post->slug }}</p>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                <!-- Thêm hành động khác nếu cần như chỉnh sửa, xóa -->
            </div>
        </div>
    </div>
@endsection
