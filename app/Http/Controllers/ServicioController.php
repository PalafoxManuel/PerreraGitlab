<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Models\DisponibilidadServicio;

class ServicioController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function create()
    {
        // Solo admin
        if (session('perfil') !== 'admin') {
            abort(403, 'No tienes permiso.');
        }

        return view('agregar-servicio');
    }

    public function store(Request $request)
    {
        // 1) Validación, ahora con 'Disponible'
        $data = $request->validate([
            'Nombre_Servicio' => 'required|string|max:100',
            'Descripcion'     => 'nullable|string',
            'Tarifa'          => 'required|numeric|min:0',
            'Disponible'      => 'required|integer|min:0',  // ó boolean si usas select
        ]);

        // 2) Creamos el servicio
        $servicio = Servicio::create([
            'Nombre_Servicio' => $data['Nombre_Servicio'],
            'Descripcion'     => $data['Descripcion']  ?? null,
            'Tarifa'          => $data['Tarifa'],
        ]);

        // 3) Creamos la disponibilidad ligada a ese servicio
        DisponibilidadServicio::create([
            'Id_Servicio' => $servicio->Id_Servicio,
            'Disponible'  => $data['Disponible'],
        ]);

        // 4) Rediriges donde quieras (por ejemplo al listado)
        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio y disponibilidad creados correctamente.');
    }

    public function show($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('servicios.show', compact('servicio'));
    }

    public function edit($id)
    {
        if (session('perfil') !== 'admin') {
            abort(403, 'Solo los administradores pueden editar servicios.');
        }

        $servicio = Servicio::findOrFail($id);
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'Nombre_Servicio' => 'required|string|max:100',
            'Descripcion'     => 'nullable|string',
            'Tarifa'          => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update($data);

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        Servicio::destroy($id);

        return redirect()
            ->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
