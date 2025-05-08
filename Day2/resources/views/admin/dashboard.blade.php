@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
    <!-- Nếu muốn thêm CSS tùy chỉnh -->
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">Welcome to the Admin Dashboard</h1>

        <div class="row">
            <!-- Tổng số bài viết -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Posts</h5>
                        <p class="card-text display-4">3000</p>
                        <a href="#" class="btn btn-primary">Manage Posts</a>
                    </div>
                </div>
            </div>

            <!-- Tổng số người dùng -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text display-4">99990</p>
                        <a href="#" class="btn btn-primary">Manage Users</a>
                    </div>
                </div>
            </div>

            <!-- Tổng số bình luận -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Comments</h5>
                        <p class="card-text display-4">999999</p>
                        <a href="#" class="btn btn-primary">Manage Comments</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Thống kê khác có thể thêm ở đây -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Latest Posts</h5>
                    </div>
                    <div class="card-body">
                        <!-- Display the latest posts -->
                        <ul class="list-group">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Các script tùy chỉnh nếu cần -->
@endpush
