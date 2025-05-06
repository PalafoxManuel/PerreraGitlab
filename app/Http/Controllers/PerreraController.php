<?php

namespace App\Http\Controllers;

use App\Models\Perrera;
use Illuminate\Http\Request;

class PerreraController extends Controller
{
    /**
     * Mostrar listado de perreras.
     */
    public function index()
    {
        $perreras = Perrera::all();
        return view('perreras.index', compact('perreras'));
    }

    /**
     * Formulario para crear una nueva perrera.
     */
    public function create()
    {
        return view('perreras.create');
    }

    /**
     * Almacenar una perrera en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre'          => 'required|string|max:100',
            'Ubicacion'       => 'required|string|max:100',
            'Tamano_Personal' => 'nullable|integer|min:0',
        ]);

        Perrera::create($data);

        return redirect()
            ->route('perreras.index')
            ->with('success', 'Perrera creada correctamente.');
    }

    /**
     * Mostrar detalle de una perrera.
     */
    public function show($id)
    {
        $perrera = Perrera::findOrFail($id);
        return view('perreras.show', compact('perrera'));
    }

    /**
     * Formulario para editar una perrera existente.
     */
    public function edit($id)
    {
        $perrera = Perrera::findOrFail($id);
        return view('perreras.edit', compact('perrera'));
    }

    /**
     * Actualizar los datos de una perrera.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre'          => 'required|string|max:100',
            'Ubicacion'       => 'required|string|max:100',
            'Tamano_Personal' => 'nullable|integer|min:0',
        ]);

        $perrera = Perrera::findOrFail($id);
        $perrera->update($data);

        return redirect()
            ->route('perreras.index')
            ->with('success', 'Perrera actualizada correctamente.');
    }

    /**
     * Eliminar una perrera.
     */
    public function destroy($id)
    {
        Perrera::destroy($id);

        return redirect()
            ->route('perreras.index')
            ->with('success', 'Perrera eliminada correctamente.');
    }
}
