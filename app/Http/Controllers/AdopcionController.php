<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\TipoReporte;
use Illuminate\Support\Facades\DB;

class AdopcionController extends Controller
{
    public function create()
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }

        // Mascotas sin dueño
        $mascotas = Mascota::whereNull('Id_Usuario')->get();

        // Si eres admin, también cargo clientes…
        $isAdmin  = session('perfil') === 'admin';
        $clientes = $isAdmin ? Cliente::all() : null;

        // Si no eres admin, determino tu cliente asociado
        $clienteId = $isAdmin
            ? null
            : Usuario::find(session('usuario_id'))?->Id_Cliente;

        return view('adoptar-mascota', compact(
            'mascotas','clientes','isAdmin','clienteId'
        ));
    }

    public function store(Request $request)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }

        $isAdmin = session('perfil') === 'admin';

        // reglas de validación
        $rules = [
            'Id_Mascota'       => 'required|exists:mascota,Id_Mascota',
            'Fecha_Adopcion'   => 'required|date',
            'NotasAdicionales' => 'nullable|string',
            'Id_Cliente'       => 'required|exists:cliente,Id_Cliente',
        ];

        $data = $request->validate($rules);

        DB::transaction(function() use($data) {
            // 1) Guardar adopción
            $adopcion = Adopcion::create([
                'Id_Mascota'      => $data['Id_Mascota'],
                'Id_Cliente'      => $data['Id_Cliente'],
                'Fecha_Adopcion'  => $data['Fecha_Adopcion'],
                'NotasAdicionales'=> $data['NotasAdicionales'] ?? null,
            ]);

            // 2) Crear reporte de adopción
            $tipo = TipoReporte::where('Nombre', 'Adopción')->firstOrFail();

            Reporte::create([
                'Id_Tipo_Reporte' => $tipo->Id_Tipo_Reporte,
                'Id_Mascota'      => $adopcion->Id_Mascota,
                'Id_Usuario'      => session('usuario_id'),
                'Contenido'       => $data['NotasAdicionales'] ?? null,
                'Fecha_Reporte'   => $data['Fecha_Adopcion'], // o now()
            ]);

            // 3) Marcar mascota como adoptada
            Mascota::find($data['Id_Mascota'])
                ->update(['Id_Usuario' => session('usuario_id')]);
        });

        return redirect()
            ->route('home')
            ->with('success','Adopción y reporte creados correctamente.');
    }
}
