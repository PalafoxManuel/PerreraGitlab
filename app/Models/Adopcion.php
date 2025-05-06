<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    protected $table = 'adopcion';
    protected $primaryKey = 'Id_Adopcion';
    public $timestamps = false;
    protected $fillable = [
        'Id_Mascota',
        'Id_Cliente',
        'Fecha_Adopcion',
        'NotasAdicionales',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'Id_Cliente', 'Id_Cliente');
    }
}
