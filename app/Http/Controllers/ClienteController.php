<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar listado de clientes.
     */
    public function index()
    {
        // También podrías eager-load reservas o adopciones si las vas a mostrar en la lista:
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Almacenar un cliente en la BD.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre_Completo'    => 'required|string|max:200',
            'Numero_Contacto'    => 'nullable|string|max:20',
            'Correo_Electronico' => 'nullable|email|max:100',
            'Calle'              => 'nullable|string|max:100',
            'Codigo_Postal'      => 'nullable|string|max:20',
        ]);

        Cliente::create($data);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente creado correctamente');
    }

    /**
     * Mostrar detalle de un cliente.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Formulario para editar un cliente.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar datos del cliente.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre_Completo'    => 'required|string|max:200',
            'Numero_Contacto'    => 'nullable|string|max:20',
            'Correo_Electronico' => 'nullable|email|max:100',
            'Calle'              => 'nullable|string|max:100',
            'Codigo_Postal'      => 'nullable|string|max:20',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($data);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente');
    }
}
