<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Mostrar listado de servicios.
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Formulario para crear un nuevo servicio.
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Almacenar un servicio en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Servicio' => 'required|string|max:100',
            'Descripcion'     => 'nullable|string',
            'Tarifa'          => 'required|numeric|min:0',
        ]);

        Servicio::create($data);

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    /**
     * Mostrar detalle de un servicio.
     */
    public function show($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Formulario para editar un servicio existente.
     */
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Actualizar los datos de un servicio.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre_Servicio' => 'required|string|max:100',
            'Descripcion'     => 'nullable|string',
            'Tarifa'          => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($data);

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Eliminar un servicio.
     */
    public function destroy($id)
    {
        Servicio::destroy($id);

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
