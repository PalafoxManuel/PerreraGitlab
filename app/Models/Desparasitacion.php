<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desparasitacion extends Model
{
    // Nombre de la tabla (singular, según tu DDL)
    protected $table = 'desparasitacion';

    // Clave primaria personalizada
    protected $primaryKey = 'Id_Desparasitacion';

    // No usamos timestamps automáticos
    public $timestamps = false;

    // Campos asignables
    protected $fillable = [
        'Id_Mascota',
        'Desparasitado',
        'Fecha_Desparasitado',
        'Fecha_Proxima',
    ];

    // Relación con Mascota
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }
}
