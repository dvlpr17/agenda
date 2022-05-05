<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
    return view('auth/login');
});


Route::get('files/{activity}', [FileController::class,'crearFile'])->name('files.create');
Route::post('file', [FileController::class, 'store'])->name('files.store');

Route::get('notes/{activity}', [NoteController::class, 'crearNota'])->name('notes.create');
Route::post('note', [NoteController::class, 'store'])->name('notes.store');

Route::delete('activities', [ActivityController::class, 'involucradosRemover'])->name('activities.involucradosRemover');

Route::resource('users', UserController::class)->names('users');
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
