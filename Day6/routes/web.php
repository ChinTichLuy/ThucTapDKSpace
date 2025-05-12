<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register-form', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/forgot-password-form', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Hiển thị form đặt lại mật khẩu (từ link trong email)
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');

// Xử lý đặt lại mật khẩu
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Hiển thị thông báo yêu cầu xác minh
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Xử lý khi người dùng nhấn vào link xác minh trong email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/posts');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Gửi lại email xác minh
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Đã gửi lại email xác minh!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', PostController::class);
});
