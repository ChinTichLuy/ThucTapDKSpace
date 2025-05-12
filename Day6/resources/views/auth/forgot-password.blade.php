@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Quên mật khẩu</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Gửi email đặt lại mật khẩu</button>
        </form>
    </div>
@endsection
