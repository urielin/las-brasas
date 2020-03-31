<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
     protected $table = "dbo.ADM_CODIGOS";
    protected $table1 = 'dbo.ADM_CLASIFICACIONCODIGO';
    protected $table2 = 'dbo.ADM_CLASIFICACIONCODIGO_2';
    protected $table3 = 'dbo.ADM_CODIGOS_NUTRICION';
    protected $table4 = "dbo.ADM_CODIGOS_PADRE";


    protected $fillable = ['CODI_RCODIGO' ,'TUME_CODIGO' ,'TUME_MULT' ,'TPCO_CODIGO' ,'CODI_RNOMBRE' ,'CODI_RDESCRIP',
                           'CODI_RCODADU' ,'CODI_RAFECTO5' ,'CODI_PESO' ,'IMP_ADICIONAL' ,'CODI_P_VENTA' ,'codi_arancelario',
                           'codi_p_factor' ,'codi_p_venta_x_m1' ,'codi_p_margen', 'codi_p_venta_x_m2' ,'clco_codigo' ,'clco_codigo2',
                           'clco_informacion' ,'prod_mayor' ,'estado' ,'iuser' ,'ifecha', 'codigo_padre' ,'CODI_PADRE' ,'codi_p_venta2',
                           'codi_rperecible' ,'codi_rporcensobprod' ,'codi_descuento' ,'codi_sbodega', 'RESOLUCION',
                           'codigo_padre_gourtmet' ,'adm_dia_vence' ,'rend_x_min' ,'tipo_manejo' ,'ventas' ,'factor_aux'];

    public function filter($params) {
      $description = $params['description'] ?? '';
      $code = $params['code'] ?? '';
      $clasification = $parms['clasification'] ?? '';
      $tipo = $params['tipo'] ?? '';

      return DB::table($this->table)->where('CODI_RNOMBRE', 'like', '%'. $description . '%')
                                    ->where('CODI_RCODIGO', 'like', '%'. $code . '%')
                                    ->where('clco_codigo2', 'like', '%'. $clasification . '%')
                                    ->where('TPCO_CODIGO', 'like', '%'. $tipo . '%')
                                    ->get();
    }
    public function findOne($params) {
      return DB::table($this->table)->where('CODI_RCODIGO', 'like', '%'. $params['id'] . '%')->get();
    }
    public function updateSon($request){
      DB::table($this->table)
          ->where('CODI_RCODIGO', $request['CODI_RCODIGO'])
          ->update([
                'CODI_RCODIGO' => $request['CODI_RCODIGO'],
                'CODI_RNOMBRE' => $request['CODI_RNOMBRE'],
                'TUME_CODIGO' => $request['TUME_CODIGO'],
                'TUME_MULT' => $request['TUME_MULT'],
                'TPCO_CODIGO' => $request['TPCO_CODIGO'],
                'CODI_RDESCRIP' => $request['CODI_RDESCRIP'],
                'CODI_PESO' => $request['CODI_PESO'],
                'CODI_RAFECTO5' => $request['CODI_RAFECTO5'],
                'IMP_ADICIONAL' => $request['IMP_ADICIONAL'],
                'codi_arancelario' => $request['codi_arancelario'],
                'clco_codigo' => $request['clco_codigo'],
                'clco_codigo2' => $request['clco_codigo2'],
                'prod_mayor' => $request['prod_mayor'],
                'estado' => $request['estado'],
            ]);
    }
    public function create($request){
      DB::table($this->table)
          ->insert([
              //'CODI_PADRE' => $request['CODI_PADRE'],
              'CODI_RCODIGO' => $request['CODI_RCODIGO'],
              'TUME_CODIGO' => $request['TUME_CODIGO'],
              'CODI_RNOMBRE' => $request['CODI_RNOMBRE'],
              'TUME_CODIGO' => $request['TUME_CODIGO'],
              'TUME_MULT' => $request['TUME_MULT'],
              'TPCO_CODIGO' => 2,
              'CODI_RDESCRIP' => $request['CODI_RDESCRIP'],
              'CODI_PESO' => $request['CODI_PESO'],
              'CODI_RAFECTO5' => $request['CODI_RAFECTO5'],
              'IMP_ADICIONAL' => $request['IMP_ADICIONAL'],
              'codi_arancelario' => $request['codi_arancelario'],
              'clco_codigo' => $request['clco_codigo'] ?? 0,
              'clco_codigo2' => $request['clco_codigo2'],
              'prod_mayor' => $request['prod_mayor'],
              'estado' => $request['estado'],
          ]);
    }
    public function clasifications() {
      return DB::table($this->table1)->get();
    }
    public function clasifications2() {
      return DB::table($this->table2)->get();
    }
    public function nutricionals($request) {
      return DB::table($this->table3)->where('codigo', $request['id'])->get();
    }
    public function updateNutricional($request) {
      DB::table($this->table3)
          ->where('codigo', $request['codigo'])
          ->update([
            'codigo' => $request['codigo'],
            'porcion' => $request['porcion'],
            'energia' => $request['energia'],
            'grasa_total' => $request['grasa_total'],
            'ac_grasa_sat' => $request['ac_grasa_sat'],
            'ac_grasa_trans' => $request['ac_grasa_trans'],
            'ac_grasa_mono' => $request['ac_grasa_mono'],
            'ac_grasa_poli' => $request['ac_grasa_poli'],
            'colesterol' => $request['colesterol'],
            'sodio' => $request['sodio'],
            'hidrato_carbono' => $request['hidrato_carbono'],
            'azucar' => $request['azucar'],
            'proteina' => $request['proteina'],
            'vitaminaa' => $request['vitaminaa'],
            'vitaminac' => $request['vitaminac'],
            'calcio' => $request['calcio'],
            'hierro' => $request['hierro'],
          ]);
          return response()->json(['status' => 200, 'message' => 'Codigo Actualizado']);

    }
    public function productoTerminado () {
      return $this->hasMany('App\ProductoTerminado', 'CODI_PADRE' ,'CODI_RCODIGO');
    }
    public function getKeyName(){
       return "CODI_RCODIGO";
   }
}
