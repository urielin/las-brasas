<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use App\DbsysCamiones;
class ContenedorController extends Controller
{
  protected $table = "dbsys.camiones";
  public function getProveedor() {

    if (request() -> ajax()){

      $proveedor= DB::select("SELECT id_proveedor,
                                      ISNULL(emp_codigo,'') as emp_codigo,
                                      ISNULL(emp_rut,'') as emp_rut,
                                      ISNULL(emp_nombre,'') as emp_nombre,
                                      ISNULL(direccion_pais,'') as direccion_pais,
                                      ISNULL(direccion_direccion,'') as direccion_direccion,
                                      ISNULL(com_telefono,'') as com_telefono,
                                      ISNULL(com_movil,'') as com_movil,
                                      ISNULL(com_fax,'') as com_fax,
                                      ISNULL(com_email,'') as com_email
                                      FROM ADM_PROVEEDOR");
      return response()->json([ 
        'proveedor' => $proveedor 
      ]);
    }
  }
  public function list() {
    $camiones  = DbsysCamiones::all();
    return response()->json([ 'camiones' => $camiones  ]);
  }
  public function pagos() {
    $paginator  = DbsysCamiones::join('ADM_PROVEEDOR','ADM_PROVEEDOR.id_proveedor', '=', 'dbsys.camiones.proveedor')
       ->join('ADM_TP_MONEDA', 'ADM_TP_MONEDA.TMDA_CODIGO', '=', 'camiones.tipo_moneda') 
       ->select(
        'ADM_PROVEEDOR.emp_nombre as proveedor', 
        'dbsys.camiones.codigo as codigo', 
        'dbsys.camiones.valor_total', 
        'dbo.ADM_TP_MONEDA.TMDA_DESCRIPCION as tipo_moneda', 
        'dbsys.camiones.descripcion',   
         DB::raw("FORMAT(dbsys.camiones.forward_fecha, 'yyyy-MM-dd') as forward_fecha "), 
         DB::raw("FORMAT(dbsys.camiones.fecha_llegada, 'yyyy-MM-dd') as fecha_llegada "), 
         DB::raw("FORMAT(dbsys.camiones.forward_compromiso, 'yyyy-MM-dd') as forward_compromiso "), 
         DB::raw("FORMAT(dbsys.camiones.switf_fecha, 'yyyy-MM-dd') as switf_fecha "),
        'dbsys.camiones.forward', 
        'dbsys.camiones.swift',
        'dbsys.camiones.pagado', 
        'dbsys.camiones.pagado_fecha') 
         ->where('dbsys.camiones.estado_pagado', 0) 
      ->orderBy('dbsys.camiones.fecha_llegada', 'desc')
      ->paginate(8); 
      
    $histories  = DbsysCamiones::join('ADM_PROVEEDOR','ADM_PROVEEDOR.id_proveedor', '=', 'dbsys.camiones.proveedor')
      ->join('ADM_TP_MONEDA', 'ADM_TP_MONEDA.TMDA_CODIGO', '=', 'camiones.tipo_moneda') 
      ->select(
        'dbsys.camiones.id_camion',
        'dbsys.camiones.codigo',
        'dbsys.camiones.descripcion',
        DB::raw("FORMAT(dbsys.camiones.fecha_resolucion, 'yyyy-MM-dd') as fecha_resolucion "), 
        DB::raw("FORMAT(dbsys.camiones.fecha_embarque, 'yyyy-MM-dd') as fecha_embarque "), 
        DB::raw("FORMAT(dbsys.camiones.fecha_llegada, 'yyyy-MM-dd') as fecha_llegada "), 
        DB::raw("FORMAT(dbsys.camiones.fecha_pago, 'yyyy-MM-dd') as fecha_pago "), 
        DB::raw("FORMAT(dbsys.camiones.forward_fecha, 'yyyy-MM-dd') as forward_fecha "), 
        'dbsys.camiones.cierre_items',
        'dbsys.camiones.forma_pago',
        'dbsys.camiones.despues_dias',
        'dbsys.camiones.despues_fecha',
        'dbo.ADM_TP_MONEDA.TMDA_DESCRIPCION as tipo_moneda', 
        'dbsys.camiones.valor_total',
        'dbsys.camiones.pagado' )
        ->where('dbsys.camiones.estado_pagado', 2 )
      ->paginate(8);
        
      $total  = DbsysCamiones::select(DB::raw('SUM(dbsys.camiones.valor_total) as valor_total'))->where('dbsys.camiones.estado_pagado', 0)
      ->get()[0]->valor_total;

    return view('gestion.pagos' ,compact('paginator', 'histories', 'total'));

  }
  public function parametros() {
    return view('gestion.parametros');
  }
  public function update(Request $request) { 
 
    $result = DB::table($this->table)
        ->where('codigo', $request->code)
        ->update([ 
          'forward' => $request->forward ,
          'forward_fecha' => $request->forward_fecha ,
          'forward_compromiso' => $request->forward_compromiso,
          'swift' => $request->swift, 
          'switf_fecha' => $request->switf_fecha,
        ]);
    if(isset($result)) {
      return response()->json(['status' => 200, 'message' => 'Actualizacion Exitosa']); 
    } else {
      return response()->json(['status' => 500, 'message' => 'Error Interno']); 
    }
    
  }
  public function check(Request $request) { 
 
    $result = DB::table($this->table)
        ->where('codigo', $request->codigo)
        ->update([ 
          'pagado' => 1 , 
        ]);
    if(isset($result)) {
      return response()->json(['status' => 200, 'message' => 'Actualizacion Exitosa']); 
    } else {
      return response()->json(['status' => 500, 'message' => 'Error Interno']); 
    }
    
  }
}
