<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UnidadMedida extends Model
{
    protected $table = "dbo.ADM_TP_UNIDMEDIDA";
    protected $fillable = ["TUME_CODIGO", 'TUME_DESCR','tume_estado', 'tume_sigla', 'tume_tratamiento',
                          'xmayor', 'mercancia', 'cod_anterior'];

    public function list (){
       return DB::table($this->table)->where('tume_estado', 1)->get();
    }
 }
