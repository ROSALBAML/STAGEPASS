<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEvento extends Model
{
    use HasFactory;

    protected $table = 'estados_evento';

    protected $fillable = [
        'nombre',
    ];
}
