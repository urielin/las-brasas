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
}
