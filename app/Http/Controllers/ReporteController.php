<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\TipoReporte;
use App\Models\Mascota;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Vacuna;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::with(['tipo', 'mascota', 'usuario'])->get();
        return view('reportes.index', compact('reportes'));
    }


    /**
     * Formulario para crear un nuevo reporte (con tipo opcional).
     */
    public function create($idTipo = null)
    {
        $tipos     = TipoReporte::all();
        $mascotas  = Mascota::all();
        $usuarios  = Usuario::all();
        $vacunas   = Vacuna::all(); // 👈 Agregado aquí

        $tipoSeleccionado = null;

        if ($idTipo) {
            $tipoSeleccionado = TipoReporte::find($idTipo);
        }

        return view('reportes.create', compact('tipos', 'mascotas', 'usuarios', 'tipoSeleccionado', 'vacunas'));
    }


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

    public function show($id)
    {
        $reporte = Reporte::with(['tipo', 'mascota', 'usuario'])->findOrFail($id);
        return view('reportes.show', compact('reporte'));
    }

    public function edit($id)
    {
        $reporte  = Reporte::findOrFail($id);
        $tipos    = TipoReporte::all();
        $mascotas = Mascota::all();
        $usuarios = Usuario::all();
        return view('reportes.edit', compact('reporte', 'tipos', 'mascotas', 'usuarios'));
    }

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

    public function destroy($id)
    {
        Reporte::destroy($id);

        return redirect()
            ->route('reportes.index')
            ->with('success', 'Reporte eliminado correctamente.');
    }
}
