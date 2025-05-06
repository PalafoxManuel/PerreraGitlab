<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Cliente;
use App\Models\Perrera;
use App\Models\TipoMascota;
use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\Mascota;
use App\Models\Reserva;
use App\Models\DisponibilidadServicio;
use App\Models\Adopcion;
use App\Models\TipoReporte;
use App\Models\Reporte;
use App\Models\Pago;
use App\Models\NotificacionReserva;
use App\Models\Vacuna;
use App\Models\Vacunacion;
use App\Models\ReservaServicio;

/**
 * Controlador base con métodos CRUD básicos.
 * Ubícalo en app/Http/Controllers/BaseController.php
 */
abstract class BaseController extends Controller
{
    /**
     * Modelo Eloquent asociado.
     *
     * @var string
     */
    protected $model;

    /**
     * Listar todos los registros.
     */
    public function index()
    {
        $items = ($this->model)::all();
        return response()->json($items, Response::HTTP_OK);
    }

    /**
     * Almacenar un nuevo registro.
     */
    public function store(Request $request)
    {
        $item = ($this->model)::create($request->all());
        return response()->json($item, Response::HTTP_CREATED);
    }

    /**
     * Mostrar un registro específico.
     */
    public function show($id)
    {
        $item = ($this->model)::findOrFail($id);
        return response()->json($item, Response::HTTP_OK);
    }

    /**
     * Actualizar un registro.
     */
    public function update(Request $request, $id)
    {
        $item = ($this->model)::findOrFail($id);
        $item->update($request->all());
        return response()->json($item, Response::HTTP_OK);
    }

    /**
     * Eliminar un registro.
     */
    public function destroy($id)
    {
        ($this->model)::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

// Controladores específicos (cada uno en su propio archivo, por ejemplo ClienteController.php)
class ClienteController extends BaseController
{
    protected $model = Cliente::class;
}

class PerreraController extends BaseController
{
    protected $model = Perrera::class;
}

class TipoMascotaController extends BaseController
{
    protected $model = TipoMascota::class;
}

class ServicioController extends BaseController
{
    protected $model = Servicio::class;
}

class UsuarioController extends BaseController
{
    protected $model = Usuario::class;
}

class MascotaController extends BaseController
{
    protected $model = Mascota::class;
}

class ReservaController extends BaseController
{
    protected $model = Reserva::class;
}

class DisponibilidadServicioController extends BaseController
{
    protected $model = DisponibilidadServicio::class;
}

class AdopcionController extends BaseController
{
    protected $model = Adopcion::class;
}

class TipoReporteController extends BaseController
{
    protected $model = TipoReporte::class;
}

class ReporteController extends BaseController
{
    protected $model = Reporte::class;
}

class PagoController extends BaseController
{
    protected $model = Pago::class;
}

class NotificacionReservaController extends BaseController
{
    protected $model = NotificacionReserva::class;
}

class VacunaController extends BaseController
{
    protected $model = Vacuna::class;
}

class VacunacionController extends BaseController
{
    protected $model = Vacunacion::class;
}

class ReservaServicioController extends BaseController
{
    protected $model = ReservaServicio::class;
}
