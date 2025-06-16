<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'usuario_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'puede_crear_promotores',
        'puede_crear_categorias',
        'puede_crear_subcategorias',
        'puede_cambiar_estado_evento',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
