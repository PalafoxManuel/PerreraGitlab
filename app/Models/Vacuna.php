<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    protected $table = 'vacuna';
    protected $primaryKey = 'Id_Vacuna';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Id_TipoMascota',
        'Fabricante',
        'Sintomas_Adversos',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoMascota::class, 'Id_TipoMascota', 'Id_TipoMascota');
    }

    public function vacunaciones()
    {
        return $this->hasMany(Vacunacion::class, 'Id_Vacuna', 'Id_Vacuna');
    }
}
