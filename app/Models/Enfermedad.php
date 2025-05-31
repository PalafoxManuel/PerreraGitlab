<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipo_enfermedades';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_enfermedad';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'description',
        'es_contagiosa'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'es_contagiosa' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relación con las mascotas que tienen esta enfermedad.
     */
    public function mascotas()
    {
        return $this->belongsToMany(Mascota::class, 'mascota_enfermedad', 'id_enfermedad', 'id_mascota')
                    ->withPivot('fecha_diagnostico', 'observaciones')
                    ->withTimestamps();
    }
}