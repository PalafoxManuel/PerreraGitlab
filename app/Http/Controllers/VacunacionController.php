<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Vacuna;
use App\Models\Vacunacion;
use Illuminate\Http\Request;

class VacunacionController extends Controller
{
    /**
     * Show the form to vacunar una mascota.
     */
    public function index()
    {
        // Traemos todas las mascotas y vacunas para poblar los <select>
        $mascotas = Mascota::orderBy('Nombre')->get();
        $vacunas  = Vacuna::orderBy('Nombre')->get();

        return view('vacunas', compact('mascotas', 'vacunas'));
    }

    /**
     * Almacena la vacunación.
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

        Vacunacion::create($data);

        return redirect()
            ->route('home')
            ->with('success', 'Mascota vacunada correctamente.');
    }

    // ... Si no vas a usar show/edit/update/destroy puedes omitirlos
}
