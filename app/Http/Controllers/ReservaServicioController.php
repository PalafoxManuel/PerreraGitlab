<?php

namespace App\Http\Controllers;

use App\Models\ReservaServicio;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Mascota;
use App\Models\Usuario;
use App\Models\Vacunacion;
use App\Models\Vacuna;
use App\Models\Pago;
use App\Models\DisponibilidadServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HistorialMedico;


class ReservaServicioController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function create(Request $request)
    {
        if (!session('usuario_id')) {
            return redirect()->route('login');
        }

        $servicios = Servicio::all();
        $disponibilidades = DisponibilidadServicio::pluck('Disponible', 'Id_Servicio')->toArray();
        $mascotas = Mascota::where('Id_Usuario', session('usuario_id'))->get();
        $vacunas = Vacuna::with('sintomas')->orderBy('Nombre')->get();

        return view('reservar-servicio', compact(
            'servicios',
            'disponibilidades',
            'mascotas',
            'vacunas'                  // ← pasarlas a la vista
        ));
    }

    public function store(Request $request)
    {
        // ─────────────────────────── VALIDACIONES ───────────────────────────
        $rules = [
            'Fecha_Reserva' => 'required|date',
            'Duracion_Dias' => 'required|integer|min:1',
            'Id_Servicio'   => 'required|exists:servicio,Id_Servicio',
            'Id_Mascota'    => 'required|exists:mascota,Id_Mascota',
            'Metodo_Pago'   => 'required|string',
            'Monto'         => 'required|numeric|min:0',   // ← necesario para registrar el pago
        ];

        $service = Servicio::findOrFail($request->Id_Servicio);
        if (in_array(strtolower($service->Nombre_Servicio), ['vacunación', 'vacunacion'])) {
            $rules = array_merge($rules, [
                'Id_Vacuna'    => 'required|exists:vacuna,Id_Vacuna',
                'Numero_Lote'  => 'required|string|max:50',
                'Dosis'        => 'required|string|max:50',
            ]);
        }

        $data = $request->validate($rules);

        // ─────────────────────────── TRANSACCIÓN ───────────────────────────
        DB::transaction(function () use ($data, $service) {
            // datos de usuario/cliente/perrera
            $user       = Usuario::findOrFail(session('usuario_id'));
            $clienteId  = $user->Id_Cliente;
            $perreraId  = $user->Id_Perrera;

            // 1) RESERVA
            $reserva = Reserva::create([
                'Fecha_Reserva' => $data['Fecha_Reserva'],
                'Duracion_Dias' => $data['Duracion_Dias'],
                'Tipo_Servicio' => $service->Nombre_Servicio,
                'Estado'        => 'Confirmada',
                'Id_Cliente'    => $clienteId,
                'Id_Perrera'    => $perreraId,
            ]);

            // 2) RESERVA_SERVICIO
            ReservaServicio::create([
                'Id_Reserva'  => $reserva->Id_Reserva,
                'Id_Servicio' => $data['Id_Servicio'],
                'Id_Mascota'  => $data['Id_Mascota'],
            ]);

            // 3) VACUNACIÓN (solo si aplica)
            if (in_array(strtolower($service->Nombre_Servicio), ['vacunación', 'vacunacion'])) {
                Vacunacion::create([
                    'Id_Mascota'        => $data['Id_Mascota'],
                    'Id_Vacuna'         => $data['Id_Vacuna'],
                    'Fecha_Vacunacion'  => $data['Fecha_Reserva'],
                    'Numero_Lote'       => $data['Numero_Lote'],
                    'Dosis'             => $data['Dosis'],
                ]);

                $vacuna = Vacuna::find($data['Id_Vacuna']);
                HistorialMedico::create([
                    'Id_Mascota'    => $data['Id_Mascota'],
                    'Fecha'         => $data['Fecha_Reserva'],
                    'Diagnostico'   => 'Vacunación: ' . ($vacuna->Nombre ?? 'Vacuna'),
                    'Tratamiento'   => 'Lote ' . $data['Numero_Lote'] . ' | Dosis ' . $data['Dosis'],
                    'Veterinario'   => 'Dr. Alejandro Fernández',
                    'Observaciones' => null,
                ]);
            }

            // 4) PAGO (nuevo paso)
            Pago::create([
                'Monto'       => $data['Monto'],
                'Metodo_Pago' => $data['Metodo_Pago'],
                'Id_Reserva'  => $reserva->Id_Reserva,
            ]);
        });

        // ─────────────────────────── REDIRECCIÓN ───────────────────────────
        return redirect()
            ->route('home')
            ->with('success', 'Reserva creada y, si aplica, vacunación + registro en historial médico guardados.');
    }

    public function show($id)
    {
        $reservaServicio = ReservaServicio::with(['reserva', 'servicio', 'mascota'])
            ->findOrFail($id);
        return view('reserva_servicios.show', compact('reservaServicio'));
    }

    public function edit($id)
    {
        $reservaServicio = ReservaServicio::findOrFail($id);
        $reservas = Reserva::all();
        $servicios = Servicio::all();
        $mascotas = Mascota::all();

        // return view('reserva_servicios.edit', compact(...));
        return view('reservar-servicio-edit', compact(
            'reservaServicio',
            'reservas',
            'servicios',
            'mascotas'
        ));
    }

    public function update(Request $request, $id)
    {
        if ($request->has('Estado')) {
            // 1) Obtener la línea de reserva_servicio
            $rs = ReservaServicio::findOrFail($id);
            // 2) Cargar la reserva padre y actualizar su estado
            $reserva = Reserva::findOrFail($rs->Id_Reserva);
            $reserva->Estado = $request->input('Estado');
            $reserva->save();

            return back()->with('success', 'Reserva marcada como completada.');
        }
    }

    public function destroy($id)
    {
        ReservaServicio::destroy($id);

        return redirect()
            ->route('reserva_servicios.index')
            ->with('success', 'Reserva-Servicio eliminada correctamente.');
    }
}
