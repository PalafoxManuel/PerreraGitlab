<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
    public function historialMedico()
    {
        return $this->hasMany(HistorialMedico::class, 'Id_Mascota', 'Id_Mascota');
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

    public function adopcion()
    {
        return $this->hasOne(Adopcion::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function reservaServicios()
    {
        return $this->hasMany(ReservaServicio::class, 'Id_Mascota', 'Id_Mascota');
    }
}
