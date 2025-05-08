<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\TipoMascota;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Mostrar listado de mascotas.
     */
    public function index()
    {
        $mascotas = Mascota::with(['tipo', 'usuario'])->get();
        return view('mascotas.index', compact('mascotas'));
    }

    /**
     * Formulario para crear una nueva mascota.
     */
    public function create()
    {
        $tipos    = TipoMascota::all();
        $usuarios = Usuario::all();
        return view('agregar', compact('tipos', 'usuarios'));
    }

    /**
     * Almacenar una mascota en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre'           => 'required|string|max:100',
            'Raza'             => 'nullable|string|max:100',
            'Edad'             => 'nullable|integer|min:0',
            'Genero'           => 'nullable|string|in:M,H',
            'Color'            => 'nullable|string|max:50',
            'Peso'             => 'nullable|numeric|min:0',
            'Historial_Medico' => 'nullable|string',
            'Id_Usuario'       => 'nullable|exists:usuario,Id_Usuario',
            'RescatadoCalle'   => 'required|boolean',
            'Id_TipoMascota'   => 'required|exists:tipo_mascotas,Id_TipoMascota',
        ]);

        Mascota::create($data);

        return redirect()
            ->route('mascotas.index')
            ->with('success', 'Mascota creada correctamente.');
    }

    /**
     * Mostrar detalle de una mascota.
     */
    public function show($id)
    {
        $mascota = Mascota::with(['tipo', 'usuario'])->findOrFail($id);
        return view('mascotas.show', compact('mascota'));
    }

    /**
     * Formulario para editar una mascota existente.
     */
    public function edit($id)
    {
        $mascota  = Mascota::findOrFail($id);
        $tipos    = TipoMascota::all();
        $usuarios = Usuario::all();
        return view('mascotas.edit', compact('mascota', 'tipos', 'usuarios'));
    }

    /**
     * Actualizar los datos de una mascota.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre'           => 'required|string|max:100',
            'Raza'             => 'nullable|string|max:100',
            'Edad'             => 'nullable|integer|min:0',
            'Genero'           => 'nullable|string|in:M,H',
            'Color'            => 'nullable|string|max:50',
            'Peso'             => 'nullable|numeric|min:0',
            'Historial_Medico' => 'nullable|string',
            'Id_Usuario'       => 'nullable|exists:usuario,Id_Usuario',
            'RescatadoCalle'   => 'required|boolean',
            'Id_TipoMascota'   => 'required|exists:tipo_mascotas,Id_TipoMascota',
        ]);

        $mascota = Mascota::findOrFail($id);
        $mascota->update($data);

        return redirect()
            ->route('mascotas.index')
            ->with('success', 'Mascota actualizada correctamente.');
    }

    /**
     * Eliminar una mascota.
     */
    public function destroy($id)
    {
        Mascota::destroy($id);

        return redirect()
            ->route('mascotas.index')
            ->with('success', 'Mascota eliminada correctamente.');
    }
}
