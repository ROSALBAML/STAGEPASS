<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // explícito aunque por convención es igual
    protected $primaryKey = 'id';
    public $timestamps = false; // porque no tienes created_at ni updated_at

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'contrasena_hash',
        'creado_en',
        'activo',
        'rol_id',
    ];

    // Relación con Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuario_rol', 'usuario_id', 'rol_id');
    }

}
