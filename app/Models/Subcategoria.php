<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategorias';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'creado_por_admin',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'creado_por_admin', 'usuario_id');
    }
}
