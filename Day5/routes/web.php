<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
