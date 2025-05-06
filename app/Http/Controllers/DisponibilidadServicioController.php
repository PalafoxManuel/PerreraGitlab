<?php

namespace App\Http\Controllers;

use App\Models\DisponibilidadServicio;
use App\Models\Servicio;
use Illuminate\Http\Request;

class DisponibilidadServicioController extends Controller
{
    /**
     * Mostrar listado de disponibilidades.
     */
    public function index()
    {
        $disponibilidades = DisponibilidadServicio::with('servicio')->get();
        return view('disponibilidad_servicios.index', compact('disponibilidades'));
    }

    /**
     * Formulario para crear una nueva disponibilidad.
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('disponibilidad_servicios.create', compact('servicios'));
    }

    /**
     * Almacenar una disponibilidad en la BD.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Servicio' => 'required|exists:servicio,Id_Servicio',
            'Disponible'  => 'required|boolean',
        ]);

        DisponibilidadServicio::create($data);

        return redirect()
            ->route('disponibilidad_servicios.index')
            ->with('success', 'Disponibilidad creada correctamente');
    }

    /**
     * Mostrar detalle de una disponibilidad.
     */
    public function show($id)
    {
        $disponibilidad = DisponibilidadServicio::with('servicio')->findOrFail($id);
        return view('disponibilidad_servicios.show', compact('disponibilidad'));
    }

    /**
     * Formulario para editar una disponibilidad.
     */
    public function edit($id)
    {
        $disponibilidad = DisponibilidadServicio::findOrFail($id);
        $servicios       = Servicio::all();
        return view('disponibilidad_servicios.edit', compact('disponibilidad', 'servicios'));
    }

    /**
     * Actualizar datos de la disponibilidad.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Servicio' => 'required|exists:servicio,Id_Servicio',
            'Disponible'  => 'required|boolean',
        ]);

        $disponibilidad = DisponibilidadServicio::findOrFail($id);
        $disponibilidad->update($data);

        return redirect()
            ->route('disponibilidad_servicios.index')
            ->with('success', 'Disponibilidad actualizada correctamente');
    }

    /**
     * Eliminar una disponibilidad.
     */
    public function destroy($id)
    {
        DisponibilidadServicio::destroy($id);

        return redirect()
            ->route('disponibilidad_servicios.index')
            ->with('success', 'Disponibilidad eliminada correctamente');
    }
}
