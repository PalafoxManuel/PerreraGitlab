<?php

namespace App\Http\Controllers;

use App\Models\PesoMascota;
use App\Models\Mascota;
use Illuminate\Http\Request;
use App\Models\HistorialMedico;

class PesoMascotaController extends Controller
{
    public function create()
    {
        $mascotas = Mascota::all();
        return view('peso_mascota.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_Mascota' => 'required|exists:mascota,Id_Mascota',
            'Peso' => 'required|numeric|min:0.1|max:200',
            'Doctor' => 'nullable|string|max:255',
            'Fecha' => 'required|date'
        ]);

        try {
            // Crear registro de peso
            $peso = PesoMascota::create($request->all());

            // Crear entrada en historial médico
            HistorialMedico::create([
                'Id_Mascota' => $request->Id_Mascota,
                'Fecha' => $request->Fecha,
                'Diagnostico' => 'Control de peso',
                'Tratamiento' => 'Peso registrado: ' . $request->Peso . ' kg',
                'Veterinario' => $request->Doctor ?? 'No especificado',
                'Observaciones' => 'Registro rutinario de peso corporal'
            ]);

            return redirect()->route('home', ['mascota' => $request->Id_Mascota])
                ->with('success', 'Peso registrado correctamente en historial médico');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar el peso: ' . $e->getMessage())
                ->withInput();
        }
    }

    
}