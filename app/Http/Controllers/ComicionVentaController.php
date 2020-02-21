<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ComicionVentaController extends Controller
{
  public function index() {

    $gestion = DB::select('SELECT TP_GESTION, TP_GESTION as ges FROM ADM_TP_GESTION order by TP_GESTION desc');

    

 

    return view('contabilidad.comicion-por-venta')->with(compact('gestion'));
  }

  public function getMes(){

    if (request() -> ajax()){

      $meses= DB::select('SELECT TP_MES, TP_DESC FROM ADM_TP_MESES ORDER BY TP_MES');
      return response()->json([

        'meses'              =>$meses

      ]);

    }
 

  }

  public function getSucursal(){

    if (request() -> ajax()){

      $sucursal= DB::select('SELECT SUCU_CODIGO, SUCU_NOMBRE FROM ADM_SUCURSAL WHERE (SUCU_ESTADO = 1) ORDER BY SUCU_CODIGO');
      return response()->json([

        'sucursal'              =>$sucursal
                
      ]);

    }
 

  }

  
  public function getVendedor(Request $request){

    if ($request -> ajax()){

      $vendedor = DB::select("SELECT vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal FROM MODULO_VENTA_HIST vh LEFT OUTER JOIN ADM_VENDEDORES av ON vh.cod_vendedor = av.VEND_CODIGO 
                              WHERE YEAR(vh.fecha) = '$request->gestion' AND MONTH(vh.fecha) = '$request->mes'  AND vh.sucursal = '$request->sucursal'
                              GROUP BY vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal");
    
      
      return response()->json([

        'vendedor'              =>$vendedor
                
      ]);

    }
 

  }
  


 


}