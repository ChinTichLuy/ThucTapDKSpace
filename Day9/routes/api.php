
<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CommentApiController;
use App\Http\Controllers\Api\PostApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('posts', PostApiController::class);

    Route::apiResource('posts.comments', CommentApiController::class);

    Route::post('/logout', [AuthApiController::class, 'logout']);
});
