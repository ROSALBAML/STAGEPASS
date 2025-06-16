<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $table = 'boletos';

    protected $fillable = [
        'evento_id',
        'seccion_id',
        'precio_unitario',
        'estado',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'seccion_id');
    }
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_boleto', 'boleto_id', 'compra_id')
                    ->withPivot('cantidad');
    }

}
