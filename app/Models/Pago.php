<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'Id_Pago';
    public $timestamps = false;
    protected $fillable = [
        'Monto',
        'Metodo_Pago',
        'Id_Reserva',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'Id_Reserva', 'Id_Reserva');
    }
}
