<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnfermedadContagiosa extends Model
{
    protected $table = 'enfermedades_contagiosas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_mascota',
        'nombre_enfermedad',
        'fecha_diagnostico',
        'tratamiento'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }
}
