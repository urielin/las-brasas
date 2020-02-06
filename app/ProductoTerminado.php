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
        return ProductoTerminado::where('CODI_PADRE', $params['id'])
                                  ->where('ESTADO', 'like', '%'. $params['state'] . '%')
                                  ->get();
     }

     public function updateProduct($params) {
       $father = DB::table($this->table2)
                      ->where('CODI_RCODIGO', $params['code'])
                      ->where('TPCO_CODIGO', '2')->get();
       if (isset($father[0])) {
         $flat = DB::table($this->table)
                      ->where('CODI_RCODIGO', $params['code'])->get();
                if (isset($flat[0])) {
                  DB::table($this->table)
                      ->where('CODI_RCODIGO', $params['code'])
                      ->update([
                        'CODI_RCODIGO' => $params['code'],
                        'factor_multi' => $params['factor_multi'],
                        'factor_div' => $params['factor_div'],
                        'tipo' => $params['tipo'],
                        'estado' => $params['estado'],
                      ]);
                } else {
                  DB::table($this->table)
                      ->where('CODI_RCODIGO', $params['code'])
                      ->insert([
                        'CODI_PADRE' => $params['parent'],
                        'CODI_RCODIGO' => $params['code'],
                        'factor_multi' => $params['factor_multi'],
                        'factor_div' => $params['factor_div'],
                        'tipo' => $params['tipo'],
                        'estado' => $params['estado'],
                      ]);
                }

             return 'ok';
       }
       return 'error';

     }
     public function deleteProduct($params) {
       ProductoTerminado::where('CODI_RCODIGO', $params['id'])->delete();
     }
}
