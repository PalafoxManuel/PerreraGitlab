<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// AUTH
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/Home', function () {
    return view('welcome');
})->name('home');

Route::get('/adoptar', function () {
    return view('adoptar');
})->name('adoptar');

Route::get('/vacunacion', function () {
    return view('vacunacion');
})->name('vacunacion');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/donaciones', function () {
    return view('donaciones');
})->name('donaciones');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
