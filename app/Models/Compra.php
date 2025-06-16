<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'comprador_id',
        'tarjeta_credito_id',
        'fecha_compra',
        'total',
    ];

    public function comprador()
    {
        return $this->belongsTo(User::class, 'comprador_id');
    }

    public function tarjetaCredito()
    {
        return $this->belongsTo(TarjetaCredito::class, 'tarjeta_credito_id');
    }
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_boleto', 'boleto_id', 'compra_id')
                    ->withPivot('cantidad');
    }

}
