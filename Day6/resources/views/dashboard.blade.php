@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Chào mừng, {{ auth()->user()->name }}!</h2>
    <form action="{{ url('/logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger">Đăng xuất</button>
    </form>
</div>
@endsection
