<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'idfamilia','codigo','nombre','precio_venta','stock','descripcion','condicion','idsucursal'
    ];

}
