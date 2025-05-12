@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $post->title }}</h2>
        <p class="text-muted">By {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</p>
        <hr>
        <p>{{ $post->content }}</p>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
@endsection
