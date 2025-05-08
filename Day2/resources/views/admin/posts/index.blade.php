@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="container">
        <h1 class="my-4">Danh sách bài viết</h1>

        {{-- Hiển thị thông báo thành công --}}
        @if(session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        <div class="mb-3">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">+ Tạo bài viết mới</a>
        </div>

        <!-- Table danh sách bài viết -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-info btn-sm">Xem</a>
                            <!-- Thêm các hành động khác như chỉnh sửa, xóa nếu cần -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
