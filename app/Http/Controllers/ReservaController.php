<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Perrera;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Mostrar listado de reservas.
     */
    public function index()
    {
        $reservas = Reserva::with(['cliente', 'perrera'])->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Formulario para crear una nueva reserva.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $perreras = Perrera::all();
        return view('reservas.create', compact('clientes', 'perreras'));
    }

    /**
     * Almacenar una reserva en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Fecha_Reserva'  => 'required|date',
            'Duracion_Dias'  => 'required|integer|min:1',
            'Tipo_Servicio'  => 'nullable|string|max:100',
            'Estado'         => 'required|in:Pendiente,Confirmada,Cancelada',
            'Id_Cliente'     => 'nullable|exists:cliente,Id_Cliente',
            'Id_Perrera'     => 'nullable|exists:perrera,Id_Perrera',
        ]);

        Reserva::create($data);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva creada correctamente.');
    }

    /**
     * Mostrar detalle de una reserva.
     */
    public function show($id)
    {
        $reserva = Reserva::with(['cliente', 'perrera'])->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Formulario para editar una reserva existente.
     */
    public function edit($id)
    {
        $reserva  = Reserva::findOrFail($id);
        $clientes = Cliente::all();
        $perreras = Perrera::all();
        return view('reservas.edit', compact('reserva', 'clientes', 'perreras'));
    }

    /**
     * Actualizar los datos de una reserva.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Fecha_Reserva'  => 'required|date',
            'Duracion_Dias'  => 'required|integer|min:1',
            'Tipo_Servicio'  => 'nullable|string|max:100',
            'Estado'         => 'required|in:Pendiente,Confirmada,Cancelada',
            'Id_Cliente'     => 'nullable|exists:cliente,Id_Cliente',
            'Id_Perrera'     => 'nullable|exists:perrera,Id_Perrera',
        ]);

        $reserva = Reserva::findOrFail($id);
        $reserva->update($data);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }

    /**
     * Eliminar una reserva.
     */
    public function destroy($id)
    {
        Reserva::destroy($id);

        return redirect()
            ->route('reservas.index')
            ->with('success', 'Reserva eliminada correctamente.');
    }
}
