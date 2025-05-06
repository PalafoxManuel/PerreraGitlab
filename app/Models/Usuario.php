<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'Id_Usuario';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Usuario',
        'Contrasena',
        'Id_Perrera',
        'Id_Cliente',
    ];

    public function perrera()
    {
        return $this->belongsTo(Perrera::class, 'Id_Perrera', 'Id_Perrera');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'Id_Cliente', 'Id_Cliente');
    }

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'Id_Usuario', 'Id_Usuario');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'Id_Usuario', 'Id_Usuario');
    }

    public function notificaciones()
    {
        return $this->hasMany(NotificacionReserva::class, 'Id_Usuario', 'Id_Usuario');
    }
}
