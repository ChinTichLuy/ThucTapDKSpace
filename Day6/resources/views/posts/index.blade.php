@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>

        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $post->title }}</h4>
                    <p>{{ Str::limit($post->content, 150) }}</p>
                    <p><small>By {{ $post->user->name }}</small></p>

                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-info">View</a>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    @endcan

                    @can('delete', $post)
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
@endsection
