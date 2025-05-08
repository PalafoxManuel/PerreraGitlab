<?php

namespace App\Http\Controllers;

use App\Models\Perrera;
use Illuminate\Http\Request;

class PerreraController extends Controller
{
    /**
     * Mostrar listado de perreras.
     * Ya no intenta cargar perreras.index, sino que redirige al home.
     */
    public function index()
    {
        // Si no hay sesión, vuelves al login
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        // Si necesitas que sólo admin vea el home de perreras, podrías:
        // if(session('perfil')!=='admin') { abort(403); }

        // Simplemente redirigimos al home para que no busque una vista inexistente
        return redirect()->route('home');
    }

    /**
     * Formulario para crear una nueva perrera.
     * Sólo admin.
     */
    public function create()
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403, 'No tienes permiso para crear perreras.');
        }

        // Carga tu vista existente: resources/views/crear-perrera.blade.php
        return view('crear-perrera');
    }

    /**
     * Almacenar una perrera en la base de datos.
     * Sólo admin.
     */
    public function store(Request $request)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'Nombre'          => 'required|string|max:100',
            'Ubicacion'       => 'required|string|max:100',
            'Tamano_Personal' => 'nullable|integer|min:0',
        ]);

        Perrera::create($data);

        // Tras crear, redirigimos al home en lugar de a perreras.index
        return redirect()
            ->route('home')
            ->with('success', 'Perrera creada correctamente.');
    }

    /**
     * Mostrar detalle de una perrera.
     * Redirige al home para no buscar una vista inexistente.
     */
    public function show($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        // Aquí podrías cargar una vista, pero si no existe, mejor:
        return redirect()->route('home');
    }

    /**
     * Formulario para editar una perrera existente.
     * Sólo admin.
     */
    public function edit($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        // Si no tienes vista perreras.edit, redirige al home
        return redirect()->route('home');
    }

    /**
     * Actualizar los datos de una perrera.
     * Sólo admin.
     */
    public function update(Request $request, $id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'Nombre'          => 'required|string|max:100',
            'Ubicacion'       => 'required|string|max:100',
            'Tamano_Personal' => 'nullable|integer|min:0',
        ]);

        $perrera = Perrera::findOrFail($id);
        $perrera->update($data);

        return redirect()
            ->route('home')
            ->with('success', 'Perrera actualizada correctamente.');
    }

    /**
     * Eliminar una perrera.
     * Sólo admin.
     */
    public function destroy($id)
    {
        if (! session('usuario_id')) {
            return redirect()->route('login');
        }
        if (session('perfil') !== 'admin') {
            abort(403);
        }

        Perrera::destroy($id);

        return redirect()
            ->route('home')
            ->with('success', 'Perrera eliminada correctamente.');
    }
}
