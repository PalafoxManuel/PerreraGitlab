<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\Cliente;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    /**
     * Mostrar listado de adopciones.
     */
    public function index()
    {
        $adopciones = Adopcion::with(['mascota', 'cliente'])->get();
        return view('adopciones.index', compact('adopciones'));
    }

    /**
     * Formulario para crear una nueva adopción.
     */
    public function create()
    {
        $mascotas = Mascota::all();
        $clientes = Cliente::all();
        return view('adopciones.create', compact('mascotas', 'clientes'));
    }

    /**
     * Almacenar una adopción en la BD.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Mascota'       => 'required|exists:mascota,Id_Mascota',
            'Id_Cliente'       => 'required|exists:cliente,Id_Cliente',
            'Fecha_Adopcion'   => 'required|date',
            'NotasAdicionales' => 'nullable|string',
        ]);

        Adopcion::create($data);

        return redirect()
            ->route('adopciones.index')
            ->with('success', 'Adopción registrada correctamente');
    }

    /**
     * Mostrar detalle de una adopción.
     */
    public function show($id)
    {
        $adopcion = Adopcion::with(['mascota', 'cliente'])->findOrFail($id);
        return view('adopciones.show', compact('adopcion'));
    }

    /**
     * Formulario para editar una adopción.
     */
    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $mascotas = Mascota::all();
        $clientes = Cliente::all();
        return view('adopciones.edit', compact('adopcion', 'mascotas', 'clientes'));
    }

    /**
     * Actualizar datos de la adopción.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Mascota'       => 'required|exists:mascota,Id_Mascota',
            'Id_Cliente'       => 'required|exists:cliente,Id_Cliente',
            'Fecha_Adopcion'   => 'required|date',
            'NotasAdicionales' => 'nullable|string',
        ]);

        $adopcion = Adopcion::findOrFail($id);
        $adopcion->update($data);

        return redirect()
            ->route('adopciones.index')
            ->with('success', 'Adopción actualizada correctamente');
    }

    /**
     * Eliminar una adopción.
     */
    public function destroy($id)
    {
        Adopcion::destroy($id);

        return redirect()
            ->route('adopciones.index')
            ->with('success', 'Adopción eliminada correctamente');
    }
}
