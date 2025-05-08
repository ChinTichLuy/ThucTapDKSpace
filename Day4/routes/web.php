<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/khoa-hoc-5b', [CourseController::class, 'index']);
Route::get('/tag-laravel', [LessonController::class, 'index']);
Route::get('/top-3user', [TeacherController::class, 'index']);
Route::get('/count-cmt', [LessonController::class, 'countCmt']);
Route::get('/course-lesson', [CourseController::class, 'course2']);

Route::get('/course-eager', [CourseController::class, 'eagerCourse']);
Route::get('/lesson/{lessonId}/eager-cmt', [LessonController::class, 'eagerCmt']);


