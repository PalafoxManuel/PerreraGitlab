<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSintoma extends Model
{
    protected $table = 'tipo_sintoma';
    protected $primaryKey = 'id_sintoma';
    public $timestamps = false;

    protected $fillable = ['nombre', 'que_hacer'];

    public function vacunas()
    {
        return $this->belongsToMany(Vacuna::class, 'vacuna_sintoma_adverso', 'id_sintoma', 'id_vacuna');
    }
}
