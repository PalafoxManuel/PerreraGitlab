<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerreraController;

// Invitados: login + registro
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login'])->name('login.post');

    Route::get('/register', [UsuarioController::class,'create'])->name('register');
    Route::post('/register',[UsuarioController::class,'store'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class,'logout'])
     ->middleware('auth')
     ->name('logout');

// La raíz
Route::get('/', fn() => redirect()->route('login'));

// Autenticados
Route::middleware('auth')->group(function () {
    // Panel común
    Route::get('/home',       fn() => view('welcome'))->name('home');
    Route::get('/adoptar',    fn() => view('adoptar'))->name('adoptar');
    Route::get('/vacunacion', fn() => view('vacunacion'))->name('vacunacion');
    Route::get('/contacto',   fn() => view('contacto'))->name('contacto');
    Route::get('/donaciones', fn() => view('donaciones'))->name('donaciones');

    // CRUD Usuarios
    Route::resource('usuarios', UsuarioController::class)
         ->only(['index','create','store','show','edit','update','destroy']);

    // CRUD Perreras (solo admin podrá usar create/store/edit/update/destroy)
    Route::resource('perreras', PerreraController::class)
         ->only(['index','create','store','show','edit','update','destroy']);
});
