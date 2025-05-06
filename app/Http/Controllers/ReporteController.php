<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\TipoReporte;
use App\Models\Mascota;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Mostrar listado de reportes.
     */
    public function index()
    {
        $reportes = Reporte::with(['tipo', 'mascota', 'usuario'])->get();
        return view('reportes.index', compact('reportes'));
    }

    /**
     * Formulario para crear un nuevo reporte.
     */
    public function create()
    {
        $tipos    = TipoReporte::all();
        $mascotas = Mascota::all();
        $usuarios = Usuario::all();
        return view('reportes.create', compact('tipos', 'mascotas', 'usuarios'));
    }

    /**
     * Almacenar un reporte en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Tipo_Reporte' => 'required|exists:tipo_reporte,Id_Tipo_Reporte',
            'Id_Mascota'      => 'nullable|exists:mascota,Id_Mascota',
            'Id_Usuario'      => 'nullable|exists:usuario,Id_Usuario',
            'Contenido'       => 'nullable|string',
            'Fecha_Reporte'   => 'required|date',
        ]);

        Reporte::create($data);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte creado correctamente.');
    }

    /**
     * Mostrar detalle de un reporte.
     */
    public function show($id)
    {
        $reporte = Reporte::with(['tipo', 'mascota', 'usuario'])->findOrFail($id);
        return view('reportes.show', compact('reporte'));
    }

    /**
     * Formulario para editar un reporte existente.
     */
    public function edit($id)
    {
        $reporte  = Reporte::findOrFail($id);
        $tipos    = TipoReporte::all();
        $mascotas = Mascota::all();
        $usuarios = Usuario::all();
        return view('reportes.edit', compact('reporte', 'tipos', 'mascotas', 'usuarios'));
    }

    /**
     * Actualizar los datos de un reporte.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Id_Tipo_Reporte' => 'required|exists:tipo_reporte,Id_Tipo_Reporte',
            'Id_Mascota'      => 'nullable|exists:mascota,Id_Mascota',
            'Id_Usuario'      => 'nullable|exists:usuario,Id_Usuario',
            'Contenido'       => 'nullable|string',
            'Fecha_Reporte'   => 'required|date',
        ]);

        $reporte = Reporte::findOrFail($id);
        $reporte->update($data);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte actualizado correctamente.');
    }

    /**
     * Eliminar un reporte.
     */
    public function destroy($id)
    {
        Reporte::destroy($id);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte eliminado correctamente.');
    }
}
