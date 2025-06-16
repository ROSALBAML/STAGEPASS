<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones';

    protected $fillable = [
        'auditorio_id',
        'nombre_seccion',
        'precio',
        'observaciones',
        'imagen',
    ];

    public function auditorio()
    {
        return $this->belongsTo(Auditorio::class, 'auditorio_id');
    }
}
