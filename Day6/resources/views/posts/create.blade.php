@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Post</h2>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="6" class="form-control" required>{{ old('content') }}</textarea>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
