<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    protected $table = 'historial_medico';
    protected $primaryKey = 'Id_Historial';
    public $timestamps = false;

    protected $fillable = [
        'Id_Mascota',
        'Fecha',
        'Diagnostico',
        'Tratamiento',
        'Observaciones',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }
}
