<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductoTerminado extends Model
{
    protected $table = "dbo.ADM_CODIGOS_PADRE";
    protected $table2 = "dbo.ADM_CODIGOS";
    protected $fillable = ['id_catalogo' ,'CODI_RCODIGO' ,'CODI_PADRE' ,'factor_multi' ,
                           'factor_div' ,'tipo' ,'ESTADO','USUARIO','FECHA_REG','USUARIO_AUT',
                           'FECHA_AUT', 'RECLAZAR_SOBREPROD'];
     public function findAllSon($params) {
        return ProductoTerminado::where('CODI_PADRE', $params['id'])->get();
     }

     public function updateProduct($params) {
       DB::table($this->table)
           ->where('CODI_RCODIGO', $params['code'])
           ->update([
             'CODI_RCODIGO' => $params['code'],
             'factor_multi' => $params['factor_multi'],
             'factor_div' => $params['factor_div'],
             'tipo' => $params['tipo'],
             'estado' => $params['estado'],
           ]);
     }
}
