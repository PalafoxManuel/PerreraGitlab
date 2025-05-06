<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'Id_Cliente';
    public $timestamps = false;
    protected $fillable = [
        'Nombre_Completo',
        'Numero_Contacto',
        'Correo_Electronico',
        'Calle',
        'Codigo_Postal',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'Id_Cliente', 'Id_Cliente');
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'Id_Cliente', 'Id_Cliente');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'Id_Cliente', 'Id_Cliente');
    }
}
