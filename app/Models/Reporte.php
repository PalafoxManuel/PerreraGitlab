<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'Id_Reporte';
    public $timestamps = false;
    protected $fillable = [
        'Id_Tipo_Reporte',
        'Id_Mascota',
        'Id_Usuario',
        'Contenido',
        'Fecha_Reporte',
    ];

    public function tipo()
    {
        return $this->belongsTo(TipoReporte::class, 'Id_Tipo_Reporte', 'Id_Tipo_Reporte');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'Id_Mascota', 'Id_Mascota');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Id_Usuario', 'Id_Usuario');
    }
}
