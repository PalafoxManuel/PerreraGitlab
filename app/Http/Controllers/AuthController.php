<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar intento de autenticación.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'Nombre_Usuario' => 'required|string',
            'Contrasena'     => 'required|string',
        ]);

        $usuario = Usuario::where('Nombre_Usuario', $data['Nombre_Usuario'])->first();

        if (! $usuario || ! Hash::check($data['Contrasena'], $usuario->Contrasena)) {
            return back()
                ->withErrors(['login' => 'Credenciales inválidas'])
                ->withInput(['Nombre_Usuario' => $data['Nombre_Usuario']]);
        }

        // Guardar datos en sesión
        session([
            'usuario_id'     => $usuario->Id_Usuario,
            'usuario_nombre' => $usuario->Nombre_Usuario,
            // Perfil según asociación:
            'perfil'         => $usuario->Id_Perrera ? 'admin' : 'usuario',
        ]);

        // Redirigir según perfil
        if ($usuario->Id_Perrera) {
            return redirect()->route('perreras.index');
        }

        return redirect()->route('reservas.index');
    }

    /**
     * Cerrar sesión.
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
