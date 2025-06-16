<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditorio extends Model
{
    use HasFactory;

    protected $table = 'auditorios';

    protected $fillable = [
        'nombre',
        'estado',
        'ciudad',
        'direccion',
        'capacidad',
        'comentarios',
        'imagen',
    ];

    // Relación con eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'auditorio_id');
    }
}
