<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\TipoMascota;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Vacunacion;
use App\Models\ReservaServicio;

class MascotaController extends Controller
{

    private function perfilAdmin()
    {
        return session('perfil') === 'admin';
    }

    /**
     * Mostrar listado de mascotas.
     */
    public function index()
    {
        $mascotas = Mascota::with(['tipo', 'usuario'])->get();
        return view('mascotas.index', compact('mascotas'));
    }

    /**
     * Formulario para crear una nueva mascota.
     */
    public function create()
    {
        $tipos    = TipoMascota::all();
        $usuarios = Usuario::all();
        return view('agregar', compact('tipos', 'usuarios'));
    }

    /**
     * Almacenar una mascota en la base de datos.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre'           => 'required|string|max:100',
            'Raza'             => 'nullable|string|max:100',
            'Edad'             => 'nullable|integer|min:0',
            'Genero'           => 'nullable|string|in:M,H',
            'Color'            => 'nullable|string|max:50',
            'Peso'             => 'nullable|numeric|min:0',
            'Historial_Medico' => 'nullable|string',
            'Id_Usuario'       => 'nullable|exists:usuario,Id_Usuario',
            'RescatadoCalle'   => 'required|boolean',
            'Id_TipoMascota'   => 'required|exists:tipo_mascotas,Id_TipoMascota',
        ]);

        Mascota::create($data);

        return redirect()
            ->route('home')
            ->with('success', 'Mascota creada correctamente.');
    }

    /**
     * Mostrar detalle de una mascota.
     */
    public function show($id)
    {
        $mascota = Mascota::with(['tipo', 'usuario'])->findOrFail($id);
        return view('mascotas.show', compact('mascota'));
    }

    /**
     * Formulario para editar una mascota existente.
     */
    public function edit($id)
    {
        $mascota  = Mascota::findOrFail($id);
        $tipos    = TipoMascota::all();
        $usuarios = Usuario::all();
        return view('mascotas.edit', compact('mascota', 'tipos', 'usuarios'));
    }

    /**
     * Actualizar los datos de una mascota.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre'           => 'required|string|max:100',
            'Raza'             => 'nullable|string|max:100',
            'Edad'             => 'nullable|integer|min:0',
            'Genero'           => 'nullable|string|in:M,H',
            'Color'            => 'nullable|string|max:50',
            'Peso'             => 'nullable|numeric|min:0',
            'Historial_Medico' => 'nullable|string',
            'Id_Usuario'       => 'nullable|exists:usuario,Id_Usuario',
            'RescatadoCalle'   => 'required|boolean',
            'Id_TipoMascota'   => 'required|exists:tipo_mascotas,Id_TipoMascota',
        ]);

        $mascota = Mascota::findOrFail($id);
        $mascota->update($data);

        return redirect()
            ->route('mascotas.index')
            ->with('success', 'Mascota actualizada correctamente.');
    }

    /**
     * Eliminar una mascota.
     */
    public function destroy($id)
    {
        Mascota::destroy($id);

        return redirect()
            ->route('mascotas.index')
            ->with('success', 'Mascota eliminada correctamente.');
    }

    public function historial(Request $request)
    {
        if (!session('usuario_id')) {
            return redirect()->route('login');
        }

        // Si es admin, mostrar todas las mascotas
        $mascotas = $this->perfilAdmin()
            ? Mascota::all()
            : Mascota::where('Id_Usuario', session('usuario_id'))->get();

        $selected     = null;
        $servicios    = collect();
        $vacunaciones = collect();

        if ($request->filled('mascota')) {
            $selected = $mascotas->firstWhere('Id_Mascota', $request->mascota);

            if ($selected) {
                $vacunaciones = Vacunacion::where('Id_Mascota', $selected->Id_Mascota)->get();

                $servicios = ReservaServicio::with(['reserva', 'servicio'])
                    ->whereHas('reserva', fn($q) => $q->where('Id_Mascota', $selected->Id_Mascota))
                    ->get();
            }
        }

        return view('historial-mascota', compact(
            'mascotas',
            'selected',
            'servicios',
            'vacunaciones'
        ));
    }
}
