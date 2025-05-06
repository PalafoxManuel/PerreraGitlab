<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificacionReserva extends Model
{
    protected $table = 'notificacionReservas';
    protected $primaryKey = 'Id_Notificacion';
    public $timestamps = false;
    protected $fillable = [
        'Tipo_Notificacion',
        'Contenido',
        'Fecha',
        'Id_Usuario',
        'Id_Reserva',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Id_Usuario', 'Id_Usuario');
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'Id_Reserva', 'Id_Reserva');
    }
}
