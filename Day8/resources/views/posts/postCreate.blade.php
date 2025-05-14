@extends('layouts.custom')

@section('title', 'Tạo bài viết mới')

@section('content')
<h2>Tạo bài viết mới</h2>
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="5" required></textarea>
    </div>
    <button class="btn btn-success">Đăng bài</button>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">← Quay lại</a>
</form>
@endsection
