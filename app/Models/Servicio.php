<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'Id_Servicio';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Servicio',
        'Descripcion',
        'Tarifa',
    ];

    public function disponibilidad()
    {
        return $this->hasOne(DisponibilidadServicio::class, 'Id_Servicio', 'Id_Servicio');
    }

    public function reservaServicios()
    {
        return $this->hasMany(ReservaServicio::class, 'Id_Servicio', 'Id_Servicio');
    }
}
