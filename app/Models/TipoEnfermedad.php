<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEnfermedad extends Model
{
    protected $table = 'tipo_enfermedades';
    protected $primaryKey = 'Id_Enfermedad';
    public $timestamps = true;

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Es_Contagiosa',
    ];
}
