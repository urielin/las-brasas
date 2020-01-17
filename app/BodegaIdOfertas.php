<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodegaIdOfertas extends Model
{
    protected $table='dbo.bodega_id_ofertas';
    public $timestamps=false;
    protected $guarded = ['id_oferta_precio'];
    // public function scopeOfertas($query, $id_camion)
    // {
    //     return $query->where([
    //         ['id_camion', '=', $id_camion],
    //         ['id_corte', '<>', $id_camion],
    //     ]);
    // }
}
