@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Đặt lại mật khẩu</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <label>Mật khẩu mới</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-success">Đặt lại mật khẩu</button>
        </form>
    </div>
@endsection
