<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

// Rutas de autenticación para invitados
Route::middleware('guest')->group(function () {
    // Mostrar formulario de login
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    // Procesar el POST del login
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    // Mostrar formulario de registro
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    // Procesar el POST del registro
    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.post');
});

// Cerrar sesión (solo usuarios autenticados)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Redirigir la raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas (solo para usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
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
});
