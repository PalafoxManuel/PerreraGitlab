<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaServicio extends Model
{
    protected $table = 'reserva_servicio';
    protected $primaryKey = 'Id_Reserva_Servicio';
    public $timestamps = false;
    protected $fillable = [
        'Id_Reserva',
        'Id_Servicio',
        'Id_Mascota',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'Id_Reserva', 'Id_Reserva');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'Id_Servicio', 'Id_Servicio');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }
}
