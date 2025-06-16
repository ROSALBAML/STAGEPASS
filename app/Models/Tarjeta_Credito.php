<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaCredito extends Model
{
    use HasFactory;

    protected $table = 'tarjeta_credito';

    protected $fillable = [
        'usuario_id',
        'numero_enmascarado',
        'token_seguro',
        'nombre_titular',
        'vencimiento',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
