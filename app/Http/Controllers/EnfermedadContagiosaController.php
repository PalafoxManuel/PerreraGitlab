<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Enfermedad;
use App\Models\MascotaEnfermedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnfermedadContagiosaController extends Controller
{
    /**
     * Muestra el formulario para registrar una nueva enfermedad a mascota
     */
    public function create()
    {
        // Obtener todas las mascotas y enfermedades para los selects
        $mascotas = Mascota::orderBy('Nombre')->get();
        $enfermedades = Enfermedad::orderBy('nombre')->get();

        return view('agregar-enfermedad-contagiosa', [
            'mascota' => $mascotas,
            'enfermedades' => $enfermedades
        ]);
    }

    /**
     * Almacena un nuevo registro de enfermedad en mascota
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'Id_Mascota' => 'required|exists:mascota,Id_Mascota',
            'id_enfermedad' => 'required|exists:tipo_enfermedades,id_enfermedad',
            'fecha_diagnostico' => 'nullable|date',
            'observaciones' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            // Crear el registro en la tabla pivote
            $registro = MascotaEnfermedad::create([
                'id_mascota' => $request->Id_Mascota,
                'id_enfermedad' => $request->id_enfermedad,
                'fecha_diagnostico' => $request->fecha_diagnostico ?? now(),
                'observaciones' => $request->observaciones
            ]);

            DB::commit();

            return redirect()->route('home')
                ->with('success', 'Enfermedad registrada correctamente a la mascota.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al registrar la enfermedad: ' . $e->getMessage());
        }
    }

    /**
     * Obtener enfermedades por mascota (para posibles futuras peticiones AJAX)
     */
    public function getEnfermedadesMascota($idMascota)
    {
        $mascota = Mascota::with('enfermedades')->findOrFail($idMascota);
        return response()->json($mascota->enfermedades);
    }
}