<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';
    protected $primaryKey = 'Id_Reserva';
    public $timestamps = false;
    protected $fillable = [
        'Fecha_Reserva',
        'Duracion_Dias',
        'Tipo_Servicio',
        'Estado',
        'Id_Cliente',
        'Id_Perrera',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'Id_Cliente', 'Id_Cliente');
    }

    public function perrera()
    {
        return $this->belongsTo(Perrera::class, 'Id_Perrera', 'Id_Perrera');
    }

    public function reservaServicios()
    {
        return $this->hasMany(ReservaServicio::class, 'Id_Reserva', 'Id_Reserva');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'Id_Reserva', 'Id_Reserva');
    }

    public function notificaciones()
    {
        return $this->hasMany(NotificacionReserva::class, 'Id_Reserva', 'Id_Reserva');
    }
}
