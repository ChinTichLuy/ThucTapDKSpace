@extends('layouts.custom')

@section('title', 'Cập nhật bài viết')

@section('content')
    <h2>Cập nhật bài viết</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content">Nội dung</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
