<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MascotaEnfermedad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mascota_enfermedad';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_mascota',
        'id_enfermedad',
        'fecha_diagnostico',
        'observaciones'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_diagnostico' => 'date',
        'es_contagiosa' => 'boolean'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relación con el modelo Mascota.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }

    /**
     * Relación con el modelo Enfermedad.
     */
    public function enfermedad()
    {
        return $this->belongsTo(Enfermedad::class, 'id_enfermedad');
    }
}