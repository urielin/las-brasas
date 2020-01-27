<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Clasificacion extends Model
{
    protected $table = "dbo.ADM_CLASIFICACIONCODIGO_2";
    protected $fillable = ["clco_codigo", 'clco_descripcion','clco_mercancia', 'clco_productos', 'icono'];

    public function list (){
       return DB::table($this->table)->get();
    }
 }
