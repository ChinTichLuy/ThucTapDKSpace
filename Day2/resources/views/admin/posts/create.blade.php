@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">Tạo Bài Viết Mới</h1>

        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf
            <!-- Tiêu đề -->
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <x-alert type="danger" :message="$message"></x-alert>
                @enderror

            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung bài viết</label>
                <textarea class="form-control" id="content" name="content" rows="5">{{ old('content') }}</textarea>
                @error('content')
                    <x-alert type="danger" :message="$message"></x-alert>
                @enderror
            </div>

            <!-- Nút gửi -->
            <button type="submit" class="btn btn-primary">Tạo bài viết</button>
        </form>
    </div>
@endsection
