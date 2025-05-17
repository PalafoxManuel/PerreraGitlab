<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Vacuna;
use App\Models\Vacunacion;
use App\Models\Reserva;
use App\Models\ReservaServicio;
use App\Models\Servicio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacunacionController extends Controller
{
    /**
     * Mostrar formulario de vacunación.
     */
    public function index()
    {
        $mascotas = Mascota::orderBy('Nombre')->get();
        $vacunas  = Vacuna::orderBy('Nombre')->get();

        return view('vacunas.index', compact('mascotas', 'vacunas'));
    }

    /**
     * Almacena la vacunación y genera la reserva de servicio.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Mascota'       => 'required|exists:mascota,Id_Mascota',
            'Id_Vacuna'        => 'required|exists:vacuna,Id_Vacuna',
            'Fecha_Vacunacion' => 'required|date',
            'Numero_Lote'      => 'required|string|max:50',
            'Dosis'            => 'required|string|max:50',
        ]);

        DB::transaction(function() use ($data) {
            // 1) Datos de cliente / perrera dependiendo de tu sesión
            $usuario   = Usuario::find(session('usuario_id'));
            $clienteId = $usuario->Id_Cliente;
            $perreraId = $usuario->Id_Perrera;

            // 2) Crear la reserva (duración fija 1 día para vacunación)
            $reserva = Reserva::create([
                'Fecha_Reserva'  => $data['Fecha_Vacunacion'],
                'Duracion_Dias'  => 1,
                'Tipo_Servicio'  => 'Vacunacion',
                'Estado'         => 'Confirmada',
                'Id_Cliente'     => $clienteId,
                'Id_Perrera'     => $perreraId,
            ]);

            // 3) Vincular la reserva con el servicio “Vacunación”
            $servicioVac = Servicio::where('Nombre_Servicio', 'Vacunacion')
                                   ->firstOrFail();

            ReservaServicio::create([
                'Id_Reserva'  => $reserva->Id_Reserva,
                'Id_Servicio' => $servicioVac->Id_Servicio,
                'Id_Mascota'  => $data['Id_Mascota'],
            ]);

            // 4) Finalmente, guardar la vacunación
            Vacunacion::create($data);
        });

        return redirect()
            ->route('home')
            ->with('success', 'Vacunación registrada y reserva de servicio creada correctamente.');
    }
}
