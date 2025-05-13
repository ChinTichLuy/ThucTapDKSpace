@extends('layouts.app')

@section('content')
    <div class="alert alert-info mt-4">
        <p>Vui lòng xác minh email trước khi truy cập trang này!</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary mt-2" type="submit">Gửi qua email</button>
        </form>
    </div>
@endsection
