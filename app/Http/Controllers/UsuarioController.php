<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perrera;
use App\Models\Cliente;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Listado de usuarios (solo admin).
     */
    public function index()
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403, 'No tienes permiso.');
        }

        $usuarios = Usuario::with(['perrera', 'cliente'])->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario de registro / creación de usuario.
     * Invitados => auto‐registro usuario normal.
     * Admins  => pueden crear usuario/cliente/admin.
     */
    public function create()
    {
        $perreras    = Perrera::all();
        $clientes    = Cliente::all();
        // Comprueba si ya existe al menos un admin:
        $adminExists = Usuario::where('rol', 'admin')->exists();

        // Si ya estás logeado y NO eres admin, y ya hay un admin, no puedes crear más:
        if (session('usuario_id')
            && session('perfil') !== 'admin'
            && $adminExists
        ) {
            abort(403, 'No tienes permiso para crear usuarios.');
        }

        return view('Register', compact('perreras','clientes','adminExists'));
    }

    /**
     * Procesar registro/creación de usuario.
     */
    public function store(Request $request)
    {
        // ¿Es el primer admin?
        $isFirstAdmin = ! Usuario::where('rol','admin')->exists();

        // Reglas base
        $rules = [
            'Nombre_Usuario' => 'required|string|max:50|unique:usuario,Nombre_Usuario',
            'Contrasena'     => 'required|string|min:6|confirmed',
            'Id_Perrera'     => 'required|exists:perrera,Id_Perrera',
        ];

        if ($isFirstAdmin || session('perfil') === 'admin') {
            // Primer admin o ya logeado como admin
            $rules['rol']        = 'required|in:usuario,admin';
            // Si crea un usuario común, debe elegir cliente existente:
            $rules['Id_Cliente'] = 'exclude_if:rol,admin|required_if:rol,usuario|exists:cliente,Id_Cliente';
        } else {
            // Registro normal: capturamos datos para crear cliente
            $rules['Nombre_Completo']    = 'required|string|max:200';
            $rules['Numero_Contacto']    = 'nullable|string|max:20';
            $rules['Correo_Electronico'] = 'nullable|email|max:100';
            $rules['Calle']              = 'nullable|string|max:100';
            $rules['Codigo_Postal']      = 'nullable|string|max:20';
        }

        $data = $request->validate($rules);

        // 1) Creamos o asignamos el cliente
        if ($isFirstAdmin || session('perfil') === 'admin') {
            // Si rol=usuario usamos Id_Cliente, si rol=admin => null
            $clienteId = ($data['rol'] ?? '') === 'usuario'
                       ? $data['Id_Cliente']
                       : null;
        } else {
            // Auto-registro normal => creamos cliente
            $cliente = Cliente::create([
                'Nombre_Completo'    => $data['Nombre_Completo'],
                'Numero_Contacto'    => $data['Numero_Contacto']    ?? null,
                'Correo_Electronico' => $data['Correo_Electronico'] ?? null,
                'Calle'              => $data['Calle']              ?? null,
                'Codigo_Postal'      => $data['Codigo_Postal']      ?? null,
            ]);
            $clienteId = $cliente->Id_Cliente;
        }

        // 2) Determinamos rol y perrera
        $rol       = ($isFirstAdmin || session('perfil')==='admin')
                   ? $data['rol']
                   : 'usuario';
        $perreraId = $data['Id_Perrera'];

        // 3) Creamos el usuario (tu mutator en Usuario hará el bcrypt)
        Usuario::create([
            'Nombre_Usuario' => $data['Nombre_Usuario'],
            'Contrasena'     => $data['Contrasena'],
            'rol'            => $rol,
            'Id_Perrera'     => $perreraId,
            'Id_Cliente'     => $clienteId,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar detalle de un usuario (solo admin).
     */
    public function show($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $usuario = Usuario::with(['perrera','cliente'])->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Formulario de edición (solo admin).
     */
    public function edit($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $usuario  = Usuario::findOrFail($id);
        $perreras = Perrera::all();
        $clientes = Cliente::all();
        return view('usuarios.edit', compact('usuario','perreras','clientes'));
    }

    /**
     * Actualizar usuario (solo admin).
     */
    public function update(Request $request, $id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $usuario = Usuario::findOrFail($id);
        $rules   = [
            'Nombre_Usuario' => "required|string|max:50|unique:usuario,Nombre_Usuario,{$id},Id_Usuario",
            'Id_Perrera'     => 'required|exists:perrera,Id_Perrera',
            'Id_Cliente'     => 'exclude_if:rol,admin|required_if:rol,usuario|exists:cliente,Id_Cliente',
        ];
        if ($request->filled('Contrasena')) {
            $rules['Contrasena'] = 'string|min:6|confirmed';
        }

        $data = $request->validate($rules);

        // Si cambian contraseña, el mutator la encripta
        if (! $request->filled('Contrasena')) {
            unset($data['Contrasena']);
        }

        $usuario->update($data);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario (solo admin).
     */
    public function destroy($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        Usuario::destroy($id);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
