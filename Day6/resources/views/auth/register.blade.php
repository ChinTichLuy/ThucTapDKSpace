@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Đăng ký</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">

            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">

            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control">

            </div>

            <div class="mb-3">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
@endsection
