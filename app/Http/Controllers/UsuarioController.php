<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perrera;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado de usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::with(['perrera', 'cliente'])->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $perreras = Perrera::all();
        $clientes = Cliente::all();
        return view('Register', compact('perreras', 'clientes'));
    }

    /**
     * Almacenar un usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // 1) Reglas base para todos
        $rules = [
            'Nombre_Usuario' => 'required|string|max:50|unique:usuario,Nombre_Usuario',
            'Contrasena'     => 'required|string|min:6|confirmed',
        ];

        if (session('perfil') === 'admin') {
            // El admin puede crear usuarios de ambos tipos
            $rules['rol']        = 'required|in:usuario,admin';
            $rules['Id_Perrera'] = 'nullable|exists:perrera,Id_Perrera';
            // Solo si elige rol=usuario, el Id_Cliente es obligatorio
            $rules['Id_Cliente'] = 'required_if:rol,usuario|exists:cliente,Id_Cliente';
        } else {
            // Usuario normal al auto-registrarse: debe crear un cliente nuevo
            $rules['Nombre_Completo']    = 'required|string|max:200';
            $rules['Numero_Contacto']    = 'nullable|string|max:20';
            $rules['Correo_Electronico'] = 'nullable|email|max:100';
            $rules['Calle']              = 'nullable|string|max:100';
            $rules['Codigo_Postal']      = 'nullable|string|max:20';
        }

        // 2) Validamos todo junto
        $data = $request->validate($rules);

        // 3) Creamos o asignamos el cliente
        if (session('perfil') === 'admin') {
            // Si es admin y rol=usuario, usará el Id_Cliente validado
            $clienteId = $data['rol'] === 'usuario'
                    ? $data['Id_Cliente']
                    : null;
        } else {
            // Usuario normal: creamos un cliente con los datos enviados
            $cliente = Cliente::create([
                'Nombre_Completo'    => $data['Nombre_Completo'],
                'Numero_Contacto'    => $data['Numero_Contacto']    ?? null,
                'Correo_Electronico' => $data['Correo_Electronico'] ?? null,
                'Calle'              => $data['Calle']              ?? null,
                'Codigo_Postal'      => $data['Codigo_Postal']      ?? null,
            ]);
            $clienteId = $cliente->Id_Cliente;
        }

        // 4) Preparamos valores de rol y perrera
        $rol       = session('perfil') === 'admin' ? $data['rol'] : 'usuario';
        $perreraId = session('perfil') === 'admin'
                ? ($data['Id_Perrera'] ?? null)
                : null;

        // 5) Creamos el usuario
        Usuario::create([
            'Nombre_Usuario' => $data['Nombre_Usuario'],
            'Contrasena'     => $data['Contrasena'],  // <-- raw, mutator la encripta
            'rol'            => $rol,
            'Id_Perrera'     => $perreraId,
            'Id_Cliente'     => $clienteId,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar detalle de un usuario.
     */
    public function show($id)
    {
        $usuario = Usuario::with(['perrera', 'cliente'])->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Formulario para editar un usuario existente.
     */
    public function edit($id)
    {
        $usuario  = Usuario::findOrFail($id);
        $perreras = Perrera::all();
        $clientes = Cliente::all();
        return view('usuarios.edit', compact('usuario', 'perreras', 'clientes'));
    }

    /**
     * Actualizar los datos de un usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $rules = [
            'Nombre_Usuario' => "required|string|max:50|unique:usuario,Nombre_Usuario,{$id},Id_Usuario",
            'Id_Perrera'     => 'nullable|exists:perrera,Id_Perrera',
            'Id_Cliente'     => 'nullable|exists:cliente,Id_Cliente',
        ];

        // Hacer la contraseña opcional en edición
        if ($request->filled('Contrasena')) {
            $rules['Contrasena'] = 'string|min:6';
        }

        $data = $request->validate($rules);

        if ($request->filled('Contrasena')) {
            $data['Contrasena'] = Hash::make($data['Contrasena']);
        } else {
            unset($data['Contrasena']);
        }

        $usuario->update($data);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        Usuario::destroy($id);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
