<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerreraController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaServicioController;

// Invitados: login + registro
Route::middleware('guest')->group(function () {
    // Formulario y POST de login
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Formulario y POST de registro
    Route::get('/register', [UsuarioController::class, 'create'])->name('register');
    Route::post('/register', [UsuarioController::class, 'store'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página principal (requiere solo sesión manual)
Route::get('/home', fn() => view('home'))->name('home');

// Páginas públicas (requieren solo sesión manual)
Route::get('/adoptar',    fn() => view('adoptar-mascota'))->name('adoptar');
Route::post('/adoptar',   [AdopcionController::class, 'store'])->name('adopciones.store');
Route::get('/vacunacion', fn() => view('vacunacion'))->name('vacunacion');
Route::get('/contacto',   fn() => view('contacto'))->name('contacto');
Route::get('/donaciones', fn() => view('donaciones'))->name('donaciones');

// CRUD Usuarios
Route::resource('usuarios', UsuarioController::class)
     ->only(['index','create','store','show','edit','update','destroy']);

// CRUD Perreras
Route::resource('perreras', PerreraController::class)
     ->only(['index','create','store','show','edit','update','destroy']);

// CRUD Mascotas
Route::resource('mascotas', MascotaController::class)
     ->only(['index','create','store','show','edit','update','destroy']);

// CRUD Servicios
Route::resource('servicios', ServicioController::class)
     ->only(['index','create','store','show','edit','update','destroy']);

// Perfil de usuario logueado
Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');

Route::resource('reserva_servicios', ReservaServicioController::class)
    ->only(['create','store','index','show']);

Route::get('api/disponibilidad/{servicio}', function($servicio){
    $d = \App\Models\DisponibilidadServicio::where('Id_Servicio',$servicio)->value('Disponible');
    return response()->json(['disponible' => $d ?? 0]);
});

// Raíz → login
Route::get('/', fn() => redirect()->route('login'));
