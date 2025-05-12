@extends('layouts.app')

@section('content')
    <div class="alert alert-info mt-4">
        <p>Please verify your email before accessing this page.</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary mt-2" type="submit">Resend verification email</button>
        </form>
    </div>
@endsection
