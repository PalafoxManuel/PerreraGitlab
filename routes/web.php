<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerreraController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservaServicioController;
use App\Http\Controllers\VacunacionController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\TipoMascotaController;
use App\Http\Controllers\EnfermedadContagiosaController;
use App\Http\Controllers\TipoEnfermedadController;
use App\Http\Controllers\DesparasitacionController;
use App\Http\Controllers\PesoMascotaController;


use App\Models\Mascota;
use App\Models\Usuario;
use App\Models\Reserva;
use App\Models\Vacuna;
use App\Models\Vacunacion;
use App\Models\TipoMascota;
use App\Models\Servicio;
use App\Models\Perrera;

Route::resource('tipo_mascotas', TipoMascotaController::class)
     ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

// Invitados: login + registro
Route::middleware('guest')->group(function () {
     Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
     Route::post('/login', [AuthController::class, 'login'])->name('login.post');

     Route::get('/register', [UsuarioController::class, 'create'])->name('register');
     Route::post('/register', [UsuarioController::class, 'store'])->name('register.post');
});
Route::middleware('guest')->group(function () {
     Route::get('/home', fn() => view('home'))->name('home');
});

// Página pública para agregar vacuna
Route::get('/agregarVacuna', [VacunaController::class, 'create'])->name('agregarVacuna');
Route::post('/agregarVacuna', [VacunaController::class, 'store'])->name('vacunas.store');

// (opcional) Formulario directo para crear admin
Route::get('/usuarios/create/admin', [UsuarioController::class, 'createAdmin'])->name('usuarios.create.admin');


// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página principal (requiere sesión)

// Páginas públicas
Route::get('/adoptar', [AdopcionController::class, 'create'])->name('adoptar');
Route::post('/adoptar', [AdopcionController::class, 'store'])->name('adopciones.store');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/donaciones', fn() => view('donaciones'))->name('donaciones');

// CRUD Usuarios
Route::resource('usuarios', UsuarioController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

// CRUD Perreras
Route::resource('perreras', PerreraController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

// CRUD Servicios
Route::resource('servicios', ServicioController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

// Reportes
Route::get('/reporte', [ReporteController::class, 'index'])->name('reporte.index');
Route::get('/reportes', [ReporteController::class, 'seleccionarTipo'])->name('reportes.seleccionar');
Route::get('/reporte/crear/{tipo?}', [ReporteController::class, 'create'])->name('reporte.create');
Route::post('/reporte', [ReporteController::class, 'store'])->name('reporte.store');

// Perfil de usuario logueado
Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');

Route::resource('reservas', ReservaController::class)
     ->only(['index', 'show', 'edit', 'update', 'destroy']);

// CRUD Reserva de Servicios
Route::resource('reserva_servicios', ReservaServicioController::class)
     ->only(['create', 'store', 'index', 'show', 'update', 'destroy']);

// API Disponibilidad de servicio
Route::get('api/disponibilidad/{servicio}', function ($servicio) {
     $d = \App\Models\DisponibilidadServicio::where('Id_Servicio', $servicio)
          ->value('Disponible');
     return response()->json(['disponible' => $d ?? 0]);
});

// CRUD Vacunas
Route::resource('vacunas', VacunaController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);


// Historial de mascotas (debe ir antes de resource 'mascotas')
Route::get('/mascotas/historial', [MascotaController::class, 'historial'])
     ->name('mascotas.historial');

// CRUD Mascotas (única declaración)
Route::resource('mascotas', MascotaController::class)
     ->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

// CRUD Vacunación
Route::resource('vacunacion', VacunacionController::class)->names([
     'index' => 'vacunacion',
     'create' => 'vacunacion.create',
     'store' => 'vacunacion.store',
     'show' => 'vacunacion.show',
     'edit' => 'vacunacion.edit',
     'update' => 'vacunacion.update',
     'destroy' => 'vacunacion.destroy',
]);

Route::prefix('enfermedades-contagiosas')->group(function () {
     Route::get('/registrar', [EnfermedadContagiosaController::class, 'create'])
          ->name('enfermedades_contagiosas.create');

     Route::post('/registrar', [EnfermedadContagiosaController::class, 'store'])
          ->name('enfermedades_contagiosas.store');
});

Route::resource('tipo_enfermedades', TipoEnfermedadController::class);

Route::patch('/reservas/{reserva}/completar', [ReservaController::class, 'marcarCompletada'])
     ->name('reservas.completar');

Route::get('/admin/panel', function () {
     return view('panel-admin', [
          'usuarios' => Usuario::all(),
          'mascotas' => Mascota::with(['usuario', 'tipo'])->get(),
          'reservas' => Reserva::all(),
          'vacunas' => Vacuna::with('tipoMascota')->get(),
          'vacunaciones' => Vacunacion::with(['mascota', 'vacuna'])->get(),
          'tiposVacunas' => TipoMascota::all(),
          'servicios' => Servicio::all(),
          'perreras' => Perrera::all(),
     ]);
})->name('panel.admin');


Route::resource('desparasitaciones', DesparasitacionController::class);


Route::prefix('peso-mascota')->group(function () {
     Route::get('/registrar', [PesoMascotaController::class, 'create'])
          ->name('peso_mascota.create');
     Route::post('/registrar', [PesoMascotaController::class, 'store'])
          ->name('peso_mascota.store');
     Route::get('/historial/{idMascota}', [PesoMascotaController::class, 'historial'])
          ->name('peso_mascota.historial');
});


// Raíz → redirige a login
Route::get('/', fn() => redirect()->route('login'));
