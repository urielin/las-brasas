<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class PrecioCamion extends Model
{
    protected $table="dbo.Precios_Camiones(1, '', '')";
    public $timestamps=false;

    // public function scopeClasificacion($query, $clasificacion)
    // {
    //     $query->where('',$clasificacion);
    // }
}
