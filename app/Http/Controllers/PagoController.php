<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Reserva;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Mostrar listado de pagos.
     */
    public function index()
    {
        $pagos = Pago::with('reserva')->get();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Formulario para registrar un nuevo pago.
     */
    public function create()
    {
        $reservas = Reserva::all();
        return view('pagos.create', compact('reservas'));
    }

    /**
     * Almacenar un pago en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Monto'       => 'required|numeric|min:0',
            'Metodo_Pago' => 'required|string|max:50',
            'Id_Reserva'  => 'required|exists:reserva,Id_Reserva',
        ]);

        Pago::create($data);

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Mostrar detalle de un pago.
     */
    public function show($id)
    {
        $pago = Pago::with('reserva')->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    /**
     * Formulario para editar un pago existente.
     */
    public function edit($id)
    {
        $pago     = Pago::findOrFail($id);
        $reservas = Reserva::all();
        return view('pagos.edit', compact('pago', 'reservas'));
    }

    /**
     * Actualizar datos de un pago.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Monto'       => 'required|numeric|min:0',
            'Metodo_Pago' => 'required|string|max:50',
            'Id_Reserva'  => 'required|exists:reserva,Id_Reserva',
        ]);

        $pago = Pago::findOrFail($id);
        $pago->update($data);

        return redirect()
            ->route('pagos.index')
            ->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Eliminar un pago.
     */
    public function destroy($id)
    {
        Pago::destroy($id);

        return redirect()
            ->route('panel.admin')
            ->with('success', 'Pago eliminado correctamente.');
    }
}
