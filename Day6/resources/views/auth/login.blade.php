@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Đăng nhập</h2>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn btn-success">Đăng nhập</button>
        </form>
    </div>
@endsection
