<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesoMascota extends Model
{
    use HasFactory;

    protected $table = 'peso_mascota';
    protected $primaryKey = 'Id_Peso';
    public $timestamps = false;

    protected $fillable = [
        'Id_Mascota',
        'Peso',
        'Doctor',
        'Fecha'
    ];

    protected $casts = [
        'Fecha' => 'date',
    ];

    // Relación con la mascota
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota');
    }
}