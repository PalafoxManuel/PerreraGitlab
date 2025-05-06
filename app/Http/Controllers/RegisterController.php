<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Perrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Mostrar formulario de registro.
     * Solo el administrador puede ver la opción de crear otro admin.
     */
    public function showRegistrationForm()
    {
        $perreras = [];
        if (session('perfil') === 'admin') {
            // Solo los admins pueden asignar nuevas perreras al crear otro admin
            $perreras = Perrera::all();
        }

        // La vista auth.register debe manejar condicionalmente el campo Id_Perrera o Id_Cliente
        return view('auth.register', compact('perreras'));
    }

    /**
     * Procesar registro de un nuevo usuario.
     * Solo un admin puede crear otro admin.
     */
    public function register(Request $request)
    {
        // Reglas básicas
        $rules = [
            'Nombre_Usuario' => 'required|string|max:50|unique:usuario,Nombre_Usuario',
            'Contrasena'     => 'required|string|min:6|confirmed',
            'type'           => 'required|in:admin,usuario',
        ];

        // Validaciones condicionales según tipo
        if ($request->input('type') === 'admin') {
            $rules['Id_Perrera'] = 'required|exists:perrera,Id_Perrera';
        } else {
            $rules['Id_Cliente'] = 'required|exists:cliente,Id_Cliente';
        }

        $data = $request->validate($rules);

        // Solo admin puede crear admin
        if ($data['type'] === 'admin' && session('perfil') !== 'admin') {
            abort(403, 'Solo administradores pueden registrar a otros administradores.');
        }

        // Preparar datos de creación
        $userData = [
            'Nombre_Usuario' => $data['Nombre_Usuario'],
            'Contrasena'     => Hash::make($data['Contrasena']),
            'Id_Perrera'     => $data['type'] === 'admin'   ? $data['Id_Perrera'] : null,
            'Id_Cliente'     => $data['type'] === 'usuario' ? $data['Id_Cliente'] : null,
        ];

        Usuario::create($userData);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }
}
