<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
   protected $table = 'detallepedidos';

    protected $primaryKey = 'iddetalle';
    public $timestamps = true;

    protected $fillable = [
        'cantidad',
        'idproducto',
        'idpedido',
        'descripcion'
    ];
}
