<?php

namespace App\Http\Controllers;

use App\Models\Vacuna;
use App\Models\TipoMascota;
use Illuminate\Http\Request;

class VacunaController extends Controller
{
    /**
     * Mostrar listado de vacunas.
     */
    public function index()
    {
        // $vacunas = Vacuna::with('tipo')->get();
        $vacunas = Vacuna::with('sintomas')->get();
        return view('vacunas.index', compact('vacunas'));
    }

    /**
     * Formulario para crear una nueva vacuna.
     */
    public function create()
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }

        $isAdmin = session('perfil') === 'admin';

        // Obtener tipos de mascota (puede usarse tanto para admin como para usuario normal)
        $tipos = TipoMascota::all();

        return view('agregar-vacuna', compact('tipos', 'isAdmin'));
    }


    /**
     * Almacenar una vacuna en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre'             => 'required|string|max:100',
            'Descripcion'        => 'nullable|string',
            'Id_TipoMascota'     => 'required|exists:tipo_mascotas,Id_TipoMascota',
            'Fabricante'         => 'required|string|max:100',
            'Sintomas_Adversos'  => 'nullable|string',
        ]);

        Vacuna::create($data);

        return redirect()
            ->route('home')
            ->with('success', 'Vacuna creada correctamente.');
    }

    /**
     * Mostrar detalle de una vacuna.
     */
    public function show($id)
    {
        $vacuna = Vacuna::with('tipo')->findOrFail($id);
        return view('vacunas.show', compact('vacuna'));
    }

    /**
     * Formulario para editar una vacuna existente.
     */
    public function edit($id)
    {
        $vacuna = Vacuna::findOrFail($id);
        $tipos  = TipoMascota::all();
        return view('vacunas.edit', compact('vacuna', 'tipos'));
    }

    /**
     * Actualizar los datos de una vacuna.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre'             => 'required|string|max:100',
            'Descripcion'        => 'nullable|string',
            'Id_TipoMascota'     => 'required|exists:tipo_mascotas,Id_TipoMascota',
            'Fabricante'         => 'required|string|max:100',
            'Sintomas_Adversos'  => 'nullable|string',
        ]);

        $vacuna = Vacuna::findOrFail($id);
        $vacuna->update($data);

        return redirect()
            ->route('vacunas.index')
            ->with('success', 'Vacuna actualizada correctamente.');
    }

    public function eliminarSintoma($vacunaId, $sintomaId)
    {
        // 1) Buscar vacuna (404 si no existe)
        $vacuna = Vacuna::findOrFail($vacunaId);

        // 2) Detach del sintoma en la tabla pivot
        $vacuna->sintomas()->detach($sintomaId);

        // 3) Redirigir de vuelta al panel con mensaje
        return redirect()
            ->route('panel.admin')
            ->with('success', 'Síntoma adverso eliminado de la vacuna correctamente.');
    }

    /**
     * Eliminar una vacuna.
     */
    public function destroy($id)
    {
        Vacuna::destroy($id);

        return redirect()
            ->route('panel.admin')
            ->with('success', 'Vacuna eliminada correctamente.');
    }
}
