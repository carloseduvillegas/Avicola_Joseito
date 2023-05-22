<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotor extends Model
{
    protected $table = 'promotores';

    protected $primaryKey = 'idpromotor';
    public $timestamps = true;

    protected $fillable = [
        'codpromotor',
        'nombrepromotor',
        'celular',
        'correo',
        'direccion'
    ];
}
