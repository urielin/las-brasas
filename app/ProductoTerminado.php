<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
 
class ProductoTerminado extends Model
{

    protected $table = "dbo.ADM_CODIGOS_PADRE";
    protected $table2 = "dbo.ADM_CODIGOS";
    protected $fillable = ['id_catalogo' ,'CODI_RCODIGO' ,'CODI_PADRE' ,'factor_multi' ,
                           'factor_div' ,'tipo' ,'ESTADO','USUARIO','FECHA_REG','USUARIO_AUT',
                           'FECHA_AUT', 'RECLAZAR_SOBREPROD'];

     public function findAllSon($params) {
       
        return DB::table('dbo.ADM_CODIGOS_PADRE as padre')
                      ->select('padre.CODI_PADRE',
                                'padre.CODI_RCODIGO',
                                'cod.CODI_RNOMBRE',
                                'padre.factor_multi',
                                'padre.factor_div',
                                'padre.factor_div',
                                'padre.tipo',
                                'padre.ESTADO',
                                'padre.USUARIO',
                                'padre.FECHA_REG')
                      ->Join('dbo.ADM_CODIGOS as cod', 'cod.CODI_RCODIGO', '=', 'padre.CODI_RCODIGO')
                      ->where('padre.CODI_PADRE', $params['id'])
                      ->where('padre.ESTADO', 'like', '%'. $params['state'] . '%')
                      ->orderBy('padre.FECHA_REG' , 'desc')
                      ->get();

     }

     public function updateProduct($params) {
       
       $father = DB::table($this->table2)
                      ->where('CODI_RCODIGO', $params['code'])
                      ->where('TPCO_CODIGO', '2')->get();
         
       if (isset($father[0])) {
        $date = strtotime($params['FECHA_REG']); 
        $fecha =  date('d/M/Y h:i:s', $date); 
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
                        'USUARIO'=> session('user')->usuario,
                        'FECHA_REG' => $fecha,
                        'estado' => $params['estado'],
                      ]);

                  $son = DB::table($this->table2)->select('CODI_RNOMBRE')->where('CODI_RCODIGO', $params['code'])->first();
                } else {
                    DB::table($this->table)
                      ->where('CODI_RCODIGO', $params['code'])
                      ->insert([
                        'CODI_PADRE' => $params['parent'],
                        'CODI_RCODIGO' => $params['code'],
                        'factor_multi' => $params['factor_multi'],
                        'factor_div' => $params['factor_div'],
                        'tipo' => $params['tipo'],
                        'USUARIO'=> session('user')->usuario,
                        'FECHA_REG' => $fecha,
                        'estado' => $params['estado'],
                    ]);
                    $son = DB::table($this->table2)->select('CODI_RNOMBRE')->where('CODI_RCODIGO', $params['code'])->first(); 
                }

             return response()->json(['status' => 200, 'message' => 'Producto Terminado Actualizado', 'data' => $son]);
       }
       return response()->json(['status' => 500, 'message' => 'Producto no xiste']);

     }
     public function deleteProduct($params) {
       ProductoTerminado::where('CODI_RCODIGO', $params['id'])->delete();
     }
     public function products()
     {
        return $this->belongsTo('App\Product',  'CODI_RCODIGO');
     }
     public function getKeyName(){
        return "CODI_RCODIGO";
     }
     public function getLastItem($params) {
        
        $data = DB::table($this->table)->select('CODI_RCODIGO')->orderBy('CODI_RCODIGO','desc')->get();
        $codigos = [];
        $collection = collect();
        $collection2 = collect();

        $i = 0;
        foreach ($data as $key => $value) { 
          if (is_numeric($value->CODI_RCODIGO)){  
            //array_push($codigos, ['codigo' => number_format($value->CODI_RCODIGO)]);
            $collection->push(array('codigo' => $value->CODI_RCODIGO)); 
          }
        }  
     
        $variables = $collection->sortByDesc('codigo');
       
        foreach ($variables as $value) {
          $collection2->push(array('codigo' => $value['codigo']));
        }
        
        $id = intval($collection2[0]['codigo']) +1;
        return response()->json(['status' => 200 , 'message' => 'Codigo creado', 'id' => $id]);  
     }
}
