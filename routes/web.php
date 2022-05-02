<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});


Route::resource('files', FileController::class)->names('files');
Route::resource('notes', NoteController::class)->names('notes');
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
