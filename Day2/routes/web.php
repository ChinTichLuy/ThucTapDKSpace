<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Trang chính
Route::get('/', function () {
    return view('welcome');
});

// Route group cho admin
Route::prefix('admin')
    ->middleware(['auth', CheckRole::class . ':admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('posts', PostController::class)->except(['edit', 'destroy']);
        Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
    });

// Fallback route 404
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
