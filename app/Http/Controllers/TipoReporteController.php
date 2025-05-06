<?php

namespace App\Http\Controllers;

use App\Models\TipoReporte;
use Illuminate\Http\Request;

class TipoReporteController extends Controller
{
    /**
     * Mostrar listado de tipos de reporte.
     */
    public function index()
    {
        $tipos = TipoReporte::all();
        return view('tipo_reportes.index', compact('tipos'));
    }

    /**
     * Formulario para crear un nuevo tipo de reporte.
     */
    public function create()
    {
        return view('tipo_reportes.create');
    }

    /**
     * Almacenar un tipo de reporte en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:200',
        ]);

        TipoReporte::create($data);

        return redirect()
            ->route('tipo_reportes.index')
            ->with('success', 'Tipo de reporte creado correctamente.');
    }

    /**
     * Mostrar detalle de un tipo de reporte.
     */
    public function show($id)
    {
        $tipo = TipoReporte::findOrFail($id);
        return view('tipo_reportes.show', compact('tipo'));
    }

    /**
     * Formulario para editar un tipo de reporte existente.
     */
    public function edit($id)
    {
        $tipo = TipoReporte::findOrFail($id);
        return view('tipo_reportes.edit', compact('tipo'));
    }

    /**
     * Actualizar los datos de un tipo de reporte.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:200',
        ]);

        $tipo = TipoReporte::findOrFail($id);
        $tipo->update($data);

        return redirect()
            ->route('tipo_reportes.index')
            ->with('success', 'Tipo de reporte actualizado correctamente.');
    }

    /**
     * Eliminar un tipo de reporte.
     */
    public function destroy($id)
    {
        TipoReporte::destroy($id);

        return redirect()
            ->route('tipo_reportes.index')
            ->with('success', 'Tipo de reporte eliminado correctamente.');
    }
}
