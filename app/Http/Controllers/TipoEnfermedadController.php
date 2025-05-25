<?php

namespace App\Http\Controllers;

use App\Models\TipoEnfermedad;
use Illuminate\Http\Request;

class TipoEnfermedadController extends Controller
{
    // Mostrar lista de enfermedades
    public function index()
    {
        $enfermedades = TipoEnfermedad::all();
        return view('tipo_enfermedades.index', compact('enfermedades'));
    }

    // Mostrar formulario de creación

    public function create()
    {
        $enfermedades = TipoEnfermedad::all();
        return view('agregar', compact('enfermedades')); // cambiar 'agregar' si usas otra vista
    }





    // Guardar nueva enfermedad
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Es_Contagiosa' => 'required|boolean',
        ]);

        TipoEnfermedad::create($request->all());

        return redirect()->route('tipo_enfermedades.index')
            ->with('success', 'Enfermedad creada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $enfermedad = TipoEnfermedad::findOrFail($id);
        $enfermedades = TipoEnfermedad::all(); // si necesitas listado aquí también
        return view('tipo_enfermedades.edit', compact('enfermedad', 'enfermedades'));
    }


    // Actualizar enfermedad
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
            'Es_Contagiosa' => 'required|boolean',
        ]);

        $enfermedad = TipoEnfermedad::findOrFail($id);
        $enfermedad->update($request->all());

        return redirect()->route('tipo_enfermedades.index')
            ->with('success', 'Enfermedad actualizada correctamente.');
    }

    // Eliminar enfermedad
    public function destroy($id)
    {
        $enfermedad = TipoEnfermedad::findOrFail($id);
        $enfermedad->delete();

        return redirect()->route('tipo_enfermedades.index')
            ->with('success', 'Enfermedad eliminada correctamente.');
    }
}
