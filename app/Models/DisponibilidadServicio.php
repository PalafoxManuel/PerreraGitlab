<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisponibilidadServicio extends Model
{
    protected $table = 'disponibilidad_servicios';
    protected $primaryKey = 'Id_Disponibilidad';
    public $timestamps = false;
    protected $fillable = [
        'Id_Servicio',
        'Disponible',
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'Id_Servicio', 'Id_Servicio');
    }
}
