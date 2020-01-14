<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCambio extends Model
{
    protected $table="dbo.ADM_TP_CAMBIO";
    public $timestamps=false;

    // protected $fillable = [ 
    //     'CAMB_FECHA',  'CAMB_CAMBIO','CAMB_USUARIO',
    // ];
    // public function getDateFormat()
    // {
    //     return 'Y-m-d H:i:s.v';
    // }
    protected $dates = ['CAMB_FECHA'];
    // public $timestamps  = false;
}
