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
        return view('Login');
    }

    /**
     * Procesar intento de autenticación.
     */
    public function login(Request $request)
    {
        // 1) Validamos
        $credentials = $request->validate([
            'Nombre_Usuario' => 'required|string',
            'Contrasena'     => 'required|string',
        ]);

        // 2) Intentamos buscar al usuario
        $usuario = Usuario::where('Nombre_Usuario', $credentials['Nombre_Usuario'])
                          ->first();

        if (! $usuario || ! Hash::check($credentials['Contrasena'], $usuario->Contrasena)) {
            return back()
                ->withErrors(['login' => 'Credenciales inválidas'])
                ->withInput();
        }

        // 3) Regeneramos sesión y guardamos el perfil
        $request->session()->regenerate();
        // Usamos el campo 'rol' que ya tienes en tu Usuario
        session([
            'usuario_id'     => $usuario->Id_Usuario,
            'usuario_nombre' => $usuario->Nombre_Usuario,
            'perfil'         => $usuario->rol, // 'admin' o 'usuario'
        ]);

        // 4) Redirigimos al home para ambos perfiles
        return redirect()->route('home');
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
