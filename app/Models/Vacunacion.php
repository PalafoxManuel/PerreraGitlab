<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    protected $table = 'vacunacion';
    protected $primaryKey = 'Id_Vacunacion';
    public $timestamps = false;
    protected $fillable = [
        'Id_Mascota',
        'Id_Vacuna',
        'Fecha_Vacunacion',
        'Numero_Lote',
        'Dosis',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class, 'Id_Vacuna', 'Id_Vacuna');
    }
}
