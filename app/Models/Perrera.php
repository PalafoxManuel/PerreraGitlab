<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perrera extends Model
{
    protected $table = 'perrera';
    protected $primaryKey = 'Id_Perrera';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Ubicacion',
        'Tamano_Personal',
    ];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'Id_Perrera', 'Id_Perrera');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'Id_Perrera', 'Id_Perrera');
    }
}
