<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\HistorialMedico;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    /**
     * Mostrar el historial médico de una mascota específica.
     */
    public function index(Request $request)
    {
        $mascotas = Mascota::all();

        $selected = null;
        $historial = collect();
        $vacunaciones = collect();
        $servicios = collect();

        if ($request->has('mascota') && $request->mascota) {
            $selected = Mascota::find($request->mascota);

            if ($selected) {
                $historial = $selected->historialMedico;
                $vacunaciones = $selected->vacunaciones;
                $servicios = $selected->reservaServicios()->with(['reserva', 'servicio'])->get();
            }
        }

        return view('historial-mascota', compact('mascotas', 'selected', 'historial', 'vacunaciones', 'servicios'));
    }
}
