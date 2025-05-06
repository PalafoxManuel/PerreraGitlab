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
        return view('usuarios.create', compact('perreras', 'clientes'));
    }

    /**
     * Almacenar un usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Usuario' => 'required|string|max:50|unique:usuario,Nombre_Usuario',
            'Contrasena'     => 'required|string|min:6',
            'Id_Perrera'     => 'nullable|exists:perrera,Id_Perrera',
            'Id_Cliente'     => 'nullable|exists:cliente,Id_Cliente',
        ]);

        // Hashear la contraseña
        $data['Contrasena'] = Hash::make($data['Contrasena']);

        Usuario::create($data);

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
