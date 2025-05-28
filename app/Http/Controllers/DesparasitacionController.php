<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Desparasitacion;
use App\Models\HistorialMedico;
use Illuminate\Http\Request;

class DesparasitacionController extends Controller
{
    public function index()
    {
        $regs = Desparasitacion::with('mascota')
            ->orderByDesc('Fecha_Desparasitado')
            ->paginate(15);

        return view('desparasitaciones.index', compact('regs'));
    }

    public function create()
    {
        // antes: Mascota::orderBy('Nombre')->get();
        $mascotas = Mascota::where('Despa', 0)
            ->orderBy('Nombre')
            ->get();

        return view('desparasitaciones.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Mascota' => 'required|exists:mascota,Id_Mascota',
            'Desparasitado' => 'nullable|boolean',
            'Fecha_Desparasitado' => 'required|date',
            'Fecha_Proxima' => 'nullable|date|after_or_equal:Fecha_Desparasitado',
            'Diagnostico' => 'nullable|string|max:255',
            'Tratamiento' => 'nullable|string|max:255',
            'Veterinario' => 'required|string|max:100',   // <-- ahora es required
            'Observaciones' => 'nullable|string',
        ]);

        // Checkbox
        $data['Desparasitado'] = $request->has('Desparasitado') ? 1 : 0;

        // ** Elimina este bloque que forzaba el nombre del auth()->user() **
        // $data['Veterinario'] = trim($data['Veterinario'])
        //     ?: (auth()->user()->Nombre_Usuario ?? auth()->user()->name);

        // 1) registrar desparasitación
        Desparasitacion::create([
            'Id_Mascota' => $data['Id_Mascota'],
            'Desparasitado' => $data['Desparasitado'],
            'Fecha_Desparasitado' => $data['Fecha_Desparasitado'],
            'Fecha_Proxima' => $data['Fecha_Proxima'],
        ]);

        // 2) marcar mascota
        Mascota::where('Id_Mascota', $data['Id_Mascota'])
            ->update(['Despa' => 1]);

        // 3) registrar en historial médico usando **exactamente** lo que escribió el usuario
        HistorialMedico::create([
            'Id_Mascota' => $data['Id_Mascota'],
            'Fecha' => $data['Fecha_Desparasitado'],
            'Diagnostico' => $data['Diagnostico'],
            'Tratamiento' => $data['Tratamiento'],
            'Veterinario' => $data['Veterinario'],
            'Observaciones' => $data['Observaciones'],
        ]);

        return redirect()
            ->route('home') // Redirige al home
            ->with('success', 'Desparasitación y registro en historial médico OK.');
    }




    public function show(Desparasitacion $desparasitacione)
    {
        return view('desparasitaciones.show', compact('desparasitacione'));
    }

    public function edit(Desparasitacion $desparasitacione)
    {
        $mascotas = Mascota::orderBy('Nombre')->get();
        return view('desparasitaciones.edit', compact('desparasitacione', 'mascotas'));
    }

    public function update(Request $request, Desparasitacion $desparasitacione)
    {
        $data = $request->validate([
            'Id_Mascota' => 'required|exists:mascota,Id_Mascota',
            'Desparasitado' => 'nullable|boolean',
            'Fecha_Desparasitado' => 'required|date',
            'Fecha_Proxima' => 'nullable|date|after_or_equal:Fecha_Desparasitado',
        ]);

        $data['Desparasitado'] = $request->has('Desparasitado') ? 1 : 0;

        $desparasitacione->update($data);

        return redirect()
            ->route('desparasitaciones.index')
            ->with('success', 'Registro actualizado.');
    }

    public function destroy(Desparasitacion $desparasitacione)
    {
        $desparasitacione->delete();

        return redirect()
            ->route('desparasitaciones.index')
            ->with('success', 'Registro eliminado.');
    }
}
