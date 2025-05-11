<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerreraController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReservaServicioController;
use App\Http\Controllers\VacunacionController;

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

// Página principal (requiere sólo sesión)
Route::get('/home', fn() => view('home'))->name('home');

// Páginas públicas
Route::get('/adoptar',  fn() => view('adoptar-mascota'))->name('adoptar');
Route::post('/adoptar', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
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

// CRUD Reserva de Servicios
Route::resource('reserva_servicios', ReservaServicioController::class)
    ->only(['create','store','index','show']);

// API Disponibilidad de servicio
Route::get('api/disponibilidad/{servicio}', function($servicio){
    $d = \App\Models\DisponibilidadServicio::where('Id_Servicio',$servicio)->value('Disponible');
    return response()->json(['disponible' => $d ?? 0]);
});

// CRUD Vacunación
Route::resource('vacunacion', VacunacionController::class)->names([
    'index'   => 'vacunacion',        // así route('vacunacion') funcionará
    'create'  => 'vacunacion.create',
    'store'   => 'vacunacion.store',
    'show'    => 'vacunacion.show',
    'edit'    => 'vacunacion.edit',
    'update'  => 'vacunacion.update',
    'destroy' => 'vacunacion.destroy',
]);

// Raíz → login
Route::get('/', fn() => redirect()->route('login'));
