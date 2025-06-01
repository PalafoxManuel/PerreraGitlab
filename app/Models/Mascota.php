<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Desparasitacion;
use App\Models\HistorialMedico;
use App\Models\Vacunacion;
use App\Models\ReservaServicio;
use App\Models\Usuario;
use App\Models\TipoMascota;
use App\Models\Enfermedad;

class Mascota extends Model
{
    protected $table = 'mascota';
    protected $primaryKey = 'Id_Mascota';
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Raza',
        'Edad',
        'Genero',
        'Color',
        'Peso',
        'Historial_Medico',
        'Id_Usuario',
        'RescatadoCalle',
        'Id_TipoMascota',
        'Despa',
        'Esterilizacion',   // ← añadido
    ];

    protected $casts = [
        'Despa' => 'boolean',
        'Esterilizacion' => 'boolean',   // ← añadido
    ];

    public function historialMedico()
    {
        return $this->hasMany(HistorialMedico::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function pesos()
    {
        return $this->hasMany(PesoMascota::class, 'Id_Mascota');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Id_Usuario', 'Id_Usuario');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoMascota::class, 'Id_TipoMascota', 'Id_TipoMascota');
    }

    public function vacunaciones()
    {
        return $this->hasMany(Vacunacion::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function reservaServicios()
    {
        return $this->hasMany(ReservaServicio::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function desparasitaciones()
    {
        return $this->hasMany(Desparasitacion::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function enfermedades()
    {
        return $this->belongsToMany(
            Enfermedad::class,
            'mascota_enfermedad',   // nombre de la tabla pivote
            'id_mascota',           // FK en pivote que apunta a mascota
            'id_enfermedad'         // FK en pivote que apunta a tipo_enfermedades
        )
        ->withPivot(['fecha_diagnostico', 'observaciones']);
    }
}
