<?php

namespace App\Http\Controllers;

use App\Models\NotificacionReserva;
use App\Models\Usuario;
use App\Models\Reserva;
use Illuminate\Http\Request;

class NotificacionReservaController extends Controller
{
    /**
     * Mostrar listado de notificaciones de reservas.
     */
    public function index()
    {
        $notificaciones = NotificacionReserva::with(['usuario', 'reserva'])->get();
        return view('notificacion_reservas.index', compact('notificaciones'));
    }

    /**
     * Formulario para crear una nueva notificación.
     */
    public function create()
    {
        $usuarios = Usuario::all();
        $reservas = Reserva::all();
        return view('notificacion_reservas.create', compact('usuarios', 'reservas'));
    }

    /**
     * Almacenar una notificación en la BD.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Tipo_Notificacion' => 'required|string|max:100',
            'Contenido'         => 'nullable|string',
            'Fecha'             => 'required|date',
            'Id_Usuario'        => 'nullable|exists:usuario,Id_Usuario',
            'Id_Reserva'        => 'nullable|exists:reserva,Id_Reserva',
        ]);

        NotificacionReserva::create($data);

        return redirect()
            ->route('notificacion_reservas.index')
            ->with('success', 'Notificación creada correctamente.');
    }

    /**
     * Mostrar detalle de una notificación.
     */
    public function show($id)
    {
        $notificacion = NotificacionReserva::with(['usuario', 'reserva'])->findOrFail($id);
        return view('notificacion_reservas.show', compact('notificacion'));
    }

    /**
     * Formulario para editar una notificación.
     */
    public function edit($id)
    {
        $notificacion = NotificacionReserva::findOrFail($id);
        $usuarios     = Usuario::all();
        $reservas     = Reserva::all();
        return view('notificacion_reservas.edit', compact('notificacion', 'usuarios', 'reservas'));
    }

    /**
     * Actualizar los datos de una notificación.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Tipo_Notificacion' => 'required|string|max:100',
            'Contenido'         => 'nullable|string',
            'Fecha'             => 'required|date',
            'Id_Usuario'        => 'nullable|exists:usuario,Id_Usuario',
            'Id_Reserva'        => 'nullable|exists:reserva,Id_Reserva',
        ]);

        $notificacion = NotificacionReserva::findOrFail($id);
        $notificacion->update($data);

        return redirect()
            ->route('notificacion_reservas.index')
            ->with('success', 'Notificación actualizada correctamente.');
    }

    /**
     * Eliminar una notificación.
     */
    public function destroy($id)
    {
        NotificacionReserva::destroy($id);

        return redirect()
            ->route('notificacion_reservas.index')
            ->with('success', 'Notificación eliminada correctamente.');
    }
}
