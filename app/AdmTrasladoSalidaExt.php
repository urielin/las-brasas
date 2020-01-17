<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmTrasladoSalidaExt extends Model
{
    protected $table = "dbo.ADM_TRASLADO_SALIDA_EXT";
    public $timestamps=false;
      protected $dates = ['fecha_viza'];
}
