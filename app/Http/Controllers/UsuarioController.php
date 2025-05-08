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

    public function create()
    {
        $perreras    = Perrera::all();
        $clientes    = Cliente::all();
        // ¿Hay al menos un admin registrado?
        $adminExists = Usuario::where('rol','admin')->exists();

        return view('Register', compact('perreras','clientes','adminExists'));
    }

    public function store(Request $request)
    {
        // Calcular si estamos en “primer admin”
        $isFirstAdmin = ! Usuario::where('rol','admin')->exists();

        // Reglas base
        $rules = [
            'Nombre_Usuario' => 'required|string|max:50|unique:usuario,Nombre_Usuario',
            'Contrasena'     => 'required|string|min:6|confirmed',
        ];

        // Si es primer admin o un admin logeado, validamos rol/perrera/cliente
        if ($isFirstAdmin || session('perfil') === 'admin') {
            $rules['rol']        = 'required|in:usuario,admin';
            $rules['Id_Perrera'] = 'nullable|exists:perrera,Id_Perrera';
            // Si eligen rol=usuario, forzamos cliente existente
            $rules['Id_Cliente'] = 'exclude_if:rol,admin|required_if:rol,usuario|exists:cliente,Id_Cliente';
        } else {
            // Usuario normal: datos de cliente a crear
            $rules['Nombre_Completo']    = 'required|string|max:200';
            $rules['Numero_Contacto']    = 'nullable|string|max:20';
            $rules['Correo_Electronico'] = 'nullable|email|max:100';
            $rules['Calle']              = 'nullable|string|max:100';
            $rules['Codigo_Postal']      = 'nullable|string|max:20';
        }

        $data = $request->validate($rules);

        // Asociar/crear cliente
        if ($isFirstAdmin || session('perfil') === 'admin') {
            // rol=usuario → usar Id_Cliente enviado; rol=admin → null
            $clienteId = ($data['rol'] ?? '') === 'usuario'
                    ? $data['Id_Cliente']
                    : null;
        } else {
            $cliente = Cliente::create([
                'Nombre_Completo'    => $data['Nombre_Completo'],
                'Numero_Contacto'    => $data['Numero_Contacto']    ?? null,
                'Correo_Electronico' => $data['Correo_Electronico'] ?? null,
                'Calle'              => $data['Calle']              ?? null,
                'Codigo_Postal'      => $data['Codigo_Postal']      ?? null,
            ]);
            $clienteId = $cliente->Id_Cliente;
        }

        // Determinar rol y perrera
        $rol       = ($isFirstAdmin || session('perfil')==='admin')
                ? $data['rol']
                : 'usuario';
        $perreraId = ($isFirstAdmin || session('perfil')==='admin')
                ? ($data['Id_Perrera'] ?? null)
                : null;

        // Crear usuario (mutator hará bcrypt)
        Usuario::create([
            'Nombre_Usuario' => $data['Nombre_Usuario'],
            'Contrasena'     => $data['Contrasena'],
            'rol'            => $rol,
            'Id_Perrera'     => $perreraId,
            'Id_Cliente'     => $clienteId,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success','Usuario creado correctamente.');
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
