<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMascota extends Model
{
    protected $table = 'tipo_mascotas';
    protected $primaryKey = 'Id_TipoMascota';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Tipo',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'Id_TipoMascota', 'Id_TipoMascota');
    }

    public function vacunas()
    {
        return $this->hasMany(Vacuna::class, 'Id_TipoMascota', 'Id_TipoMascota');
    }
}
