<?php

namespace App\Http\Controllers;

use App\Models\EnfermedadContagiosa;
use App\Models\Mascota;
use App\Models\TipoEnfermedad;
use Illuminate\Http\Request;

class EnfermedadContagiosaController extends Controller
{
    // Mostrar formulario para registrar una enfermedad contagiosa
    public function index()
    {
        $mascota = Mascota::all();
        $tipoEnfermedades = TipoEnfermedad::all(); // Enfermedades disponibles

        return view('agregar-enfermedad-contagiosa', [
            'mascota' => $mascota,
            'enfermedades' => $tipoEnfermedades, // renombrar para que coincida con la vista
        ]);
    }
    // Guardar nueva enfermedad contagiosa
    public function store(Request $request)
    {
        $request->validate([
            'Id_Mascota'     => 'required|exists:mascota,Id_Mascota',
            'Id_Enfermedad'  => 'required|exists:tipo_enfermedad,id_enfermedad',
        ]);

        EnfermedadContagiosa::create([
            'Id_Mascota'    => $request->Id_Mascota,
            'Id_Enfermedad' => $request->Id_Enfermedad,
        ]);

        return redirect()->route('home')->with('success', 'Enfermedad contagiosa registrada correctamente.');
    }
}
