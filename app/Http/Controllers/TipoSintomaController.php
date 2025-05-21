<?php

namespace App\Http\Controllers;

use App\Models\TipoSintoma;
use Illuminate\Http\Request;

class TipoSintomaController extends Controller
{
    public function index()
    {
        $sintomas = TipoSintoma::all();
        return view('tipo_sintoma.index', compact('sintomas'));
    }

    public function create()
    {
        return view('tipo_sintoma.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'que_hacer' => 'required|string|max:255',
        ]);

        TipoSintoma::create($data);

        return redirect()->route('tipo_sintoma.index')
            ->with('success', 'Síntoma creado correctamente.');
    }

    public function edit($id)
    {
        $sintoma = TipoSintoma::findOrFail($id);
        return view('tipo_sintoma.edit', compact('sintoma'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'que_hacer' => 'required|string|max:255',
        ]);

        $sintoma = TipoSintoma::findOrFail($id);
        $sintoma->update($data);

        return redirect()->route('tipo_sintoma.index')
            ->with('success', 'Síntoma actualizado correctamente.');
    }

    public function destroy($id)
    {
        TipoSintoma::destroy($id);
        return redirect()->route('tipo_sintoma.index')
            ->with('success', 'Síntoma eliminado correctamente.');
    }
}
