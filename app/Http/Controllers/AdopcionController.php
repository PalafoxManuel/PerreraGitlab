<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;

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

        // reglas
        $rules = [
            'Id_Mascota'     => 'required|exists:mascota,Id_Mascota',
            'Fecha_Adopcion' => 'required|date',
            'NotasAdicionales'=> 'nullable|string',
        ];
        // cliente: admin elige, usuario fijo
        if ($isAdmin) {
            $rules['Id_Cliente'] = 'required|exists:cliente,Id_Cliente';
        } else {
            $rules['Id_Cliente'] = 'required|exists:cliente,Id_Cliente';
        }

        $data = $request->validate($rules);

        // guardamos adopción
        Adopcion::create($data);

        // opcional: marcar mascota como adoptada (asociar usuario)
        $mascota = Mascota::find($data['Id_Mascota']);
        $mascota->update([
            'Id_Usuario' => session('usuario_id'),
        ]);

        return redirect()
            ->route('home')
            ->with('success','Adopción registrada correctamente.');
    }
}
