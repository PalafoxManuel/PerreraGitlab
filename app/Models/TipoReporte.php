<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoReporte extends Model
{
    protected $table = 'tipo_reporte';
    protected $primaryKey = 'Id_Tipo_Reporte';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'Id_Tipo_Reporte', 'Id_Tipo_Reporte');
    }
}
