<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'creado_por_admin',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'creado_por_admin', 'usuario_id');
    }
}
