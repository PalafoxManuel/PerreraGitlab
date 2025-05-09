<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerreraController;
use App\Http\Controllers\MascotaController;


// Invitados: login + registro
Route::middleware('guest')->group(function () {
     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
     Route::post('/login', [AuthController::class, 'login'])->name('login.post');

     Route::get('/register', [UsuarioController::class, 'create'])->name('register');
     Route::post('/register', [UsuarioController::class, 'store'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home (session-based)
Route::get('/home', fn() => view('home'))->name('home');

// Páginas generales (requieren sólo session manual)
Route::get('/adoptar', fn() => view('adoptar'))->name('adoptar');
Route::get('/vacunacion', fn() => view('vacunacion'))->name('vacunacion');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/donaciones', fn() => view('donaciones'))->name('donaciones');

// CRUD Usuarios: sacado del auth-guard
Route::resource('usuarios', UsuarioController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

// CRUD Perreras: sacado del auth-guard
Route::resource('perreras', PerreraController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);


Route::resource('mascotas', MascotaController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);


// Raíz → login
Route::get('/', fn() => redirect()->route('login'));
