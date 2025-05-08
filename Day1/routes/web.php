<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Services\Mail\WelcomeMailService;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/test', [HomeController::class, 'index']);

Route::get('/greeting', [HomeController::class, 'index']);


Route::get('/mail', function (WelcomeMailService $service) {
    $service->send('your@email.com');
    return 'Sent!';
});

use App\Services\LoggerService;

Route::get('/log', function (LoggerService $logger) {
    $logger->logInfo('truy cập thành công.');
    return 'Log written!';
});

