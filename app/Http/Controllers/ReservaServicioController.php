<?php

namespace App\Http\Controllers;

use App\Models\ReservaServicio;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Mascota;
use App\Models\Usuario;
use App\Models\Pago;
use App\Models\DisponibilidadServicio;
use Illuminate\Http\Request;


class ReservaServicioController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function create(Request $request)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }

        // traemos todos los servicios
        $servicios = Servicio::all();

        // mapa de cupos: [ Id_Servicio => Disponible ]
        $disponibilidades = DisponibilidadServicio::pluck('Disponible','Id_Servicio')->toArray();

        // mascotas del usuario
        $mascotas = Mascota::where('Id_Usuario', session('usuario_id'))->get();

        return view('reservar-servicio', [
            'servicios'          => $servicios,
            'disponibilidades'   => $disponibilidades,
            'mascotas'           => $mascotas,
        ]);
    }

    public function store(Request $request)
    {
        // 1) Validación
        $data = $request->validate([
            'Fecha_Reserva'  => 'required|date',
            'Duracion_Dias'  => 'required|integer|min:1',
            'Id_Servicio'    => 'required|exists:servicio,Id_Servicio',
            'Id_Mascota'     => 'required|exists:mascota,Id_Mascota',
            'Monto'          => 'required|numeric|min:0',
            'Metodo_Pago'    => 'required|string',
        ]);

        // 2) Recuperamos el usuario logueado
        $usuario = Usuario::findOrFail(session('usuario_id'));

        // 3) Creamos la reserva usando su cliente y perrera
        $reserva = Reserva::create([
            'Fecha_Reserva'  => $data['Fecha_Reserva'],
            'Duracion_Dias'  => $data['Duracion_Dias'],
            'Tipo_Servicio'  => Servicio::find($data['Id_Servicio'])->Nombre_Servicio,
            'Estado'         => 'Pendiente',
            'Id_Cliente'     => $usuario->Id_Cliente,   // <-- aquí viene tu cliente
            'Id_Perrera'     => $usuario->Id_Perrera,   // <-- aquí la perrera
        ]);

        // 4) Ligamos reserva ↔ servicio ↔ mascota
        ReservaServicio::create([
            'Id_Reserva'   => $reserva->Id_Reserva,
            'Id_Servicio'  => $data['Id_Servicio'],
            'Id_Mascota'   => $data['Id_Mascota'],
        ]);

        // 5) Grabamos el pago
        Pago::create([
            'Monto'        => $data['Monto'],
            'Metodo_Pago'  => $data['Metodo_Pago'],
            'Id_Reserva'   => $reserva->Id_Reserva,
        ]);

        return redirect()
            ->route('home')
            ->with('success','Reserva, servicio y pago registrados con éxito.');
    }

    public function show($id)
    {
        $reservaServicio = ReservaServicio::with(['reserva','servicio','mascota'])
                              ->findOrFail($id);
        return view('reserva_servicios.show', compact('reservaServicio'));
    }

    public function edit($id)
    {
        $reservaServicio = ReservaServicio::findOrFail($id);
        $reservas        = Reserva::all();
        $servicios       = Servicio::all();
        $mascotas        = Mascota::all();

        // return view('reserva_servicios.edit', compact(...));
        return view('reservar-servicio-edit', compact(
            'reservaServicio','reservas','servicios','mascotas'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Reserva'  => 'required|exists:reserva,Id_Reserva',
            'Id_Servicio' => 'required|exists:servicio,Id_Servicio',
            'Id_Mascota'  => 'required|exists:mascota,Id_Mascota',
        ]);

        $r = ReservaServicio::findOrFail($id);
        $r->update($data);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio actualizada correctamente.');
    }

    public function destroy($id)
    {
        ReservaServicio::destroy($id);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio eliminada correctamente.');
    }
}
