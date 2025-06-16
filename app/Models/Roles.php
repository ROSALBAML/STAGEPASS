<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'roles';

    // Llave primaria (opcional si es 'id')
    protected $primaryKey = 'id';

    // No usa timestamps (created_at, updated_at)
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',
    ];

    // Relación: Un rol puede tener muchos usuarios (si tienes esta relación)
    public function usuarios()
    {
        return $this->belongsToMany(Roles::class, 'usuario_rol', 'usuario_id', 'rol_id');


    }
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'rol_id', 'permiso_id');
    }

}
