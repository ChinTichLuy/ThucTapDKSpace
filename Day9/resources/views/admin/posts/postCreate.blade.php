@extends('layouts.custom')

@section('title', 'Tạo bài viết mới')

@section('content')
    <h2>Tạo bài viết mới</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" placeholder="Title" value="{{ old('title') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Content" required>{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <select name="status" class="form-control">
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        <button class="btn btn-success">Đăng bài</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
