<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $primaryKey = 'idpedido';
    public $timestamps = true;

    protected $fillable = [
        'idcliente',
        'idpromotor',
        'observacion',
    ];
}
