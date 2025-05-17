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
        $vacunas = Vacuna::with('tipo')->get();
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
            ->route('vacunas.index')
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

    /**
     * Eliminar una vacuna.
     */
    public function destroy($id)
    {
        Vacuna::destroy($id);

        return redirect()
            ->route('vacunas.index')
            ->with('success', 'Vacuna eliminada correctamente.');
    }
}
