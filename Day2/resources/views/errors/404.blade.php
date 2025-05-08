@extends('layouts.admin')

@section('title', 'Trang không tồn tại')

@section('content')
    <div style="text-align: center; padding: 50px;">
        <h1>404 - Không tìm thấy trang</h1>
        <p>Trang bạn đang tìm không tồn tại hoặc đã bị xoá.</p>
        <a href="{{ route('admin.posts.index') }}">← Quay về trang bài viết</a>
    </div>
@endsection
