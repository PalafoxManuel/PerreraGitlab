<?php

namespace App\Http\Controllers;

use App\Models\TipoMascota;
use Illuminate\Http\Request;

class TipoMascotaController extends Controller
{
    /**
     * Mostrar listado de tipos de mascota.
     */
    public function index()
    {
        $tipos = TipoMascota::all();
        return view('tipo_mascotas.index', compact('tipos'));
    }

    /**
     * Formulario para crear un nuevo tipo de mascota.
     */
    public function create()
    {
        return view('tipo_mascotas.create');
    }

    /**
     * Almacenar un tipo de mascota en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Tipo' => 'required|string|max:100',
        ]);

        TipoMascota::create($data);

        return redirect()
            ->route('tipo_mascotas.index')
            ->with('success', 'Tipo de mascota creado correctamente.');
    }

    /**
     * Mostrar detalle de un tipo de mascota.
     */
    public function show($id)
    {
        $tipo = TipoMascota::findOrFail($id);
        return view('tipo_mascotas.show', compact('tipo'));
    }

    /**
     * Formulario para editar un tipo de mascota existente.
     */
    public function edit($id)
    {
        $tipo = TipoMascota::findOrFail($id);
        return view('tipo_mascotas.edit', compact('tipo'));
    }

    /**
     * Actualizar los datos de un tipo de mascota.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre_Tipo' => 'required|string|max:100',
        ]);

        $tipo = TipoMascota::findOrFail($id);
        $tipo->update($data);

        return redirect()
            ->route('tipo_mascotas.index')
            ->with('success', 'Tipo de mascota actualizado correctamente.');
    }

    /**
     * Eliminar un tipo de mascota.
     */
    public function destroy($id)
    {
        TipoMascota::destroy($id);

        return redirect()
            ->route('tipo_mascotas.index')
            ->with('success', 'Tipo de mascota eliminado correctamente.');
    }
}
