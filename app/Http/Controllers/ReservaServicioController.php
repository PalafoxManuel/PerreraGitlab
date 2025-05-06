<?php

namespace App\Http\Controllers;

use App\Models\ReservaServicio;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Mascota;
use Illuminate\Http\Request;

class ReservaServicioController extends Controller
{
    /**
     * Mostrar listado de reserva-servicios.
     */
    public function index()
    {
        $reservaServicios = ReservaServicio::with(['reserva', 'servicio', 'mascota'])->get();
        return view('reserva_servicios.index', compact('reservaServicios'));
    }

    /**
     * Formulario para crear una nueva relación reserva-servicio.
     */
    public function create()
    {
        $reservas  = Reserva::all();
        $servicios = Servicio::all();
        $mascotas  = Mascota::all();
        return view('reserva_servicios.create', compact('reservas', 'servicios', 'mascotas'));
    }

    /**
     * Almacenar una nueva relación reserva-servicio en la BD.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Reserva'  => 'required|exists:reserva,Id_Reserva',
            'Id_Servicio' => 'required|exists:servicio,Id_Servicio',
            'Id_Mascota'  => 'nullable|exists:mascota,Id_Mascota',
        ]);

        ReservaServicio::create($data);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio creada correctamente.');
    }

    /**
     * Mostrar detalle de una relación reserva-servicio.
     */
    public function show($id)
    {
        $reservaServicio = ReservaServicio::with(['reserva', 'servicio', 'mascota'])
            ->findOrFail($id);
        return view('reserva_servicios.show', compact('reservaServicio'));
    }

    /**
     * Formulario para editar una relación reserva-servicio existente.
     */
    public function edit($id)
    {
        $reservaServicio = ReservaServicio::findOrFail($id);
        $reservas        = Reserva::all();
        $servicios       = Servicio::all();
        $mascotas        = Mascota::all();

        return view('reserva_servicios.edit', compact(
            'reservaServicio', 'reservas', 'servicios', 'mascotas'
        ));
    }

    /**
     * Actualizar los datos de una relación reserva-servicio.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Reserva'  => 'required|exists:reserva,Id_Reserva',
            'Id_Servicio' => 'required|exists:servicio,Id_Servicio',
            'Id_Mascota'  => 'nullable|exists:mascota,Id_Mascota',
        ]);

        $reservaServicio = ReservaServicio::findOrFail($id);
        $reservaServicio->update($data);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio actualizada correctamente.');
    }

    /**
     * Eliminar una relación reserva-servicio.
     */
    public function destroy($id)
    {
        ReservaServicio::destroy($id);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio eliminada correctamente.');
    }
}
