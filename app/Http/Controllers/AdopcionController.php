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
        // forzamos sesión manual
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }

        // obtenemos solo mascotas sin dueño
        $mascotas = Mascota::whereNull('Id_Usuario')->get();

        // si eres admin, necesitas la lista de clientes
        $isAdmin  = session('perfil') === 'admin';
        $clientes = $isAdmin ? Cliente::all() : null;

        // si eres cliente normal, tu Id_Cliente viene de tu usuario
        $clienteId = null;
        if (! $isAdmin) {
            $usuario   = Usuario::find(session('usuario_id'));
            $clienteId = $usuario?->Id_Cliente;
        }

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
