<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'Id_Usuario';
    public $timestamps = false;

    // Campos “fillables”, incluyendo el nuevo rol
    protected $fillable = [
        'Nombre_Usuario',
        'Contrasena',
        'Id_Perrera',
        'Id_Cliente',
        'rol',
    ];

    // Ocultamos la contraseña en arrays/JSON
    protected $hidden = [
        'Contrasena',
    ];

    // Casting de atributos
    protected $casts = [
        'rol' => 'string',
    ];

    // Mutator para que al asignar Contrasena se encripte automáticamente
    public function setContrasenaAttribute($value)
    {
        $this->attributes['Contrasena'] = bcrypt($value);
    }

    // Relaciones (igual que antes)…
    public function perrera()
    {
        return $this->belongsTo(Perrera::class, 'Id_Perrera', 'Id_Perrera');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'Id_Cliente', 'Id_Cliente');
    }

    // …

    // Helpers para el rol
    public function isAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function isUsuario(): bool
    {
        return $this->rol === 'usuario';
    }
}
