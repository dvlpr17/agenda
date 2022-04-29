<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});

Route::resource('activities', ActivityController::class)->names('activities');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
