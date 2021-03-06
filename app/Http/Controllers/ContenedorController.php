<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DbsysCamiones;
use App\Proveedor;
class ContenedorController extends Controller
{

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
                                      FROM ADM_PROVEEDOR ORDER BY id_proveedor DESC" );
      return response()->json([
        'proveedor' => $proveedor
      ]);
    }
  }

  public function paginadorProveedor(Request $request){


      $data= Proveedor::select("*")->orderBy('ADM_PROVEEDOR.id_proveedor', 'desc')->paginate(10);

      return response()->json([
        'pagination' => [
          'total'         => $data->total(),
          'current_page'  => $data->currentPage(),
          'per_page'      => $data->perPage(),
          'last_page'     => $data->lastPage(),
          'from'          => $data->firstItem(),
          'to'            => $data->lastItem(),
        ],
        'pagos' => $data
      ]);

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

  public function paginador(Request $request) {

    $data  = DB::table('dbsys.camiones_pagos') 
                ->join('dbsys.camiones', 'dbsys.camiones_pagos.id_camion', '=', 'dbsys.camiones.id_camion') 
                ->join('ADM_PROVEEDOR','ADM_PROVEEDOR.id_proveedor', '=', 'dbsys.camiones.proveedor')
                ->join('ADM_TP_MONEDA', 'ADM_TP_MONEDA.TMDA_CODIGO', '=', 'camiones.tipo_moneda')
                ->select(
                'dbsys.camiones.id_camion as id_camion',
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
                  ->where('dbsys.camiones.pagado','=' , 0)  
                  ->orderBy('dbsys.camiones.fecha_llegada', 'desc')
                  ->paginate(7);

    $total  = DbsysCamiones::select(DB::raw('SUM(dbsys.camiones.valor_total) as valor_total'))
                                    ->where('dbsys.camiones.pagado', '=', 0)
                                    ->get()[0]->valor_total;

    return response()->json([
      'pagination' => [
        'total'         => $data->total(),
        'current_page'  => $data->currentPage(),
        'per_page'      => $data->perPage(),
        'last_page'     => $data->lastPage(),
        'from'          => $data->firstItem(),
        'to'            => $data->lastItem(),
      ],
      'pagos' => $data,
      'total' => $total,
    ]);
  }
  public function findOne(Request $request) {
    $pago = DbsysCamiones::join('ADM_PROVEEDOR','ADM_PROVEEDOR.id_proveedor', '=', 'dbsys.camiones.proveedor')
                        ->join('ADM_TP_MONEDA', 'ADM_TP_MONEDA.TMDA_CODIGO', '=', 'camiones.tipo_moneda')
                        ->join('dbsys.parametros', 'dbsys.parametros.cod_int' , '=', 'camiones.forma_pago')
                        ->join('dbsys.camiones_pagos', 'dbsys.camiones_pagos.id_camion' , '=', 'camiones.id_camion')

                        ->select(
                          'dbsys.camiones.id_camion',
                          'dbsys.camiones.codigo',
                          'dbsys.camiones.descripcion',
                          'ADM_PROVEEDOR.emp_nombre as proveedor',

                          DB::raw("FORMAT(dbsys.camiones.fecha_resolucion, 'yyyy-MM-dd') as fecha_resolucion "),
                          DB::raw("FORMAT(dbsys.camiones.fecha_embarque, 'yyyy-MM-dd') as fecha_embarque "),
                          DB::raw("FORMAT(dbsys.camiones.fecha_llegada, 'yyyy-MM-dd') as fecha_llegada "),
                          DB::raw("FORMAT(dbsys.camiones.switf_fecha, 'yyyy-MM-dd') as switf_fecha "),
 
                          DB::raw("FORMAT(dbsys.camiones.fecha_pago, 'yyyy-MM-dd') as fecha_pago "),
                          DB::raw("FORMAT(dbsys.camiones.forward_fecha, 'yyyy-MM-dd') as forward_fecha "),
                          'dbsys.camiones.cierre_items',
                          'dbsys.parametros.desc01 as forma_pago',
                          'dbsys.camiones.despues_dias',
                          'dbsys.camiones.despues_fecha',
                          'dbo.ADM_TP_MONEDA.TMDA_DESCRIPCION as tipo_moneda',
                          'dbsys.camiones.valor_total',
                          'dbsys.camiones_pagos.monto_pago as pagado',
                          'dbsys.camiones_pagos.monto_pago as total_pagos' )
                          ->where('dbsys.camiones.codigo', $request->id)->first();
    return response()->json(['data' => $pago]);
  }
  public function parametros() {
    $proveedor = DB::select('SELECT id_proveedor, emp_nombre FROM ADM_PROVEEDOR');

    return view('gestion.parametros')->with(compact('proveedor'));
  }
  public function parametros1(){
    $proveedor = DB::select('SELECT id_proveedor, emp_nombre FROM ADM_PROVEEDOR');

    return view('gestion.parametros1')->with(compact('proveedor'));

  }
  public function getDato(Request $request){

    if (request()->ajax()){

        $datos= DB::select("SELECT id_proveedor,
        ISNULL(emp_codigo,'') as emp_codigo,
        ISNULL(emp_rut,'') as emp_rut,
        ISNULL(emp_nombre,'') as emp_nombre,
        ISNULL(direccion_pais,'') as direccion_pais,
        ISNULL(direccion_direccion,'') as direccion_direccion,
        ISNULL(com_telefono,'') as com_telefono,
        ISNULL(com_movil,'') as com_movil,
        ISNULL(com_fax,'') as com_fax,
        ISNULL(com_email,'') as com_email
        FROM ADM_PROVEEDOR WHERE id_proveedor = $request->valor");

        return response()->json([

        'datos' =>$datos

      ]);
    }

  }
  public function setNew(Request $request){

    if ($request->ajax()){

        DB::insert("INSERT INTO [dbo].[ADM_PROVEEDOR]
        ([emp_codigo]
        ,[emp_rut]
        ,[emp_nombre]
        ,[direccion_pais]
        ,[direccion_direccion]
        ,[com_telefono]
        ,[com_movil]
        ,[com_fax]
        ,[com_email]
        ,[i_datetime])
         VALUES
            ( '$request->codigo_nuevo',
              '$request->rut_nuevo',
              '$request->empresa_nuevo',
              '$request->pais_nuevo',
              '$request->direccion_nuevo',
              '$request->telefono_nuevo',
              '$request->movil_nuevo',
              '$request->fax_nuevo',
              '$request->email_nuevo',
              getdate())");

      }
    }

    public function getNew(){
      if (request()->ajax()){

        $new = DB::select("SELECT TOP 1 * from ADM_PROVEEDOR order by id_proveedor desc");

      }
      return response()->json([

        'new'              =>$new

      ]);
    }

    public function updateProveedor(Request $request){
      if ($request->ajax()){

       DB::update("UPDATE ADM_PROVEEDOR
                    SET [emp_codigo] = '$request->codigo_edit'
                    ,[emp_rut] = '$request->rut_edit'
                    ,[emp_nombre] = '$request->empNombre_edit'

                    ,[direccion_pais] = '$request->direccionPais_edit'

                    ,[direccion_direccion] = '$request->direcciondire_edit'
                    ,[com_telefono] = '$request->telefono_edit'
                    ,[com_movil] = '$request->movil_edit'
                    ,[com_fax] = '$request->fax_edit'
                    ,[com_email] = '$request->email_edit'

              WHERE [id_proveedor] = $request->id_edit");
      }

    }
  public function update(Request $request) {

    $result = DB::table('dbsys.camiones')
        ->where('codigo', $request->code)
        ->update([
          'forward' => $request->forward ,
          'forward_fecha' => $request->forward_fecha ,
          'forward_compromiso' => $request->forward_compromiso,
          'swift' => $request->swift,
          'switf_fecha' => $request->switf_fecha,
        ]);
    if(isset($result)) { 
      $validate = DB::table('dbsys.camiones_historial_pagos')
                    //->where('id', $request->id)
                    ->insert([
                      'id_camion' => $request->id,
                      'forward' => $request->forward ,
                      'forward_fecha' => $request->forward_fecha ,
                      'forward_compromiso' => $request->forward_compromiso,
                      'swift' => $request->swift,
                      'switf_fecha' => $request->switf_fecha,
                    ]);
      return response()->json(['status' => 200, 'message' => 'Actualizacion Exitosa']);
    } else {
      return response()->json(['status' => 500, 'message' => 'Error Interno']);
    }

  }
  public function check(Request $request) {
      // die(json_encode($request->all()));  
      if($request->id_camion) {
        $result = DB::table('dbsys.camiones_pagos')
          ->where('id_camion',  $request->id_camion)
          ->update([
            'tipo_pago' => $request->tipo_pago,
            'fecha_pago' => $request->fecha_pago,
            'tipo_cambio' => $request->tipo_cambio,
            'monto_pago' => $request->monto_pagado,
            'observaciones' => $request->observaciones, 
          ]);

          

        if(isset($result)) {
          $result = DB::table('dbsys.camiones')
                      ->where('id_camion',  $request->id_camion)
                      ->update(['dbsys.camiones.estado_pagado' => 2 , 'dbsys.camiones.pagado' => 1]); 
          return response()->json(['status' => 200, 'message' => 'El camion a sido pagado']);
        } else {
          return response()->json(['status' => 500, 'message' => 'Error interno']);
        }
      } else {
        return response()->json(['status' => 500, 'message' => 'No se encontro el camion']);
      } 
  } 
  public function histories(Request $request) {
    $data  = DbsysCamiones::join('ADM_PROVEEDOR','ADM_PROVEEDOR.id_proveedor', '=', 'dbsys.camiones.proveedor')
      ->join('ADM_TP_MONEDA', 'ADM_TP_MONEDA.TMDA_CODIGO', '=', 'camiones.tipo_moneda')
      ->join('dbsys.parametros', 'dbsys.parametros.cod_int' , '=', 'camiones.forma_pago')
      ->join('dbsys.camiones_pagos', 'dbsys.camiones_pagos.id_camion', '=', 'dbsys.camiones.id_camion') 

      ->select(
        'dbsys.camiones.id_camion',
        'dbsys.camiones.codigo',
        'ADM_PROVEEDOR.emp_nombre as proveedor', 
        'dbsys.camiones.descripcion',
        DB::raw("FORMAT(dbsys.camiones.fecha_resolucion, 'yyyy-MM-dd') as fecha_resolucion "),
        DB::raw("FORMAT(dbsys.camiones.fecha_embarque, 'yyyy-MM-dd') as fecha_embarque "),
        DB::raw("FORMAT(dbsys.camiones.fecha_llegada, 'yyyy-MM-dd') as fecha_llegada "),
        DB::raw("FORMAT(dbsys.camiones.fecha_pago, 'yyyy-MM-dd') as fecha_pago "),
        DB::raw("FORMAT(dbsys.camiones.switf_fecha, 'yyyy-MM-dd') as switf_fecha "), 
        DB::raw("FORMAT(dbsys.camiones.forward_fecha, 'yyyy-MM-dd') as forward_fecha "),
        'dbsys.camiones.cierre_items',
        'dbsys.parametros.desc01 as forma_pago',
        'dbsys.camiones.despues_dias',
        'dbsys.camiones.despues_fecha',
        'dbo.ADM_TP_MONEDA.TMDA_DESCRIPCION as tipo_moneda',
        'dbsys.camiones.valor_total',
        'dbsys.camiones_pagos.monto_pago as pagado',
        'dbsys.camiones_pagos.monto_pago as total_pagos')
        ->where('dbsys.camiones.estado_pagado', '=' ,2 )
        ->where('dbsys.parametros.tabla', 'CAMIONES_FORMA_PAGO' ) 
      ->paginate(10); 

      return response()->json([
        'pagination' => [
          'total'         => $data->total(),
          'current_page'  => $data->currentPage(),
          'per_page'      => $data->perPage(),
          'last_page'     => $data->lastPage(),
          'from'          => $data->firstItem(),
          'to'            => $data->lastItem(),
        ],
        'histories' => $data,
      ]);

    }
}
/*
    $result = DB::table('dbsys.camiones')
        ->where('codigo', $request->codigo)
        ->update([ 'pagado' => 1 , ]);
    if(isset($result)) {
      return response()->json(['status' => 200, 'message' => 'Guardado Exitosamente']);
    } else {
      return response()->json(['status' => 500, 'message' => 'Error Interno']);
    }*/
/*
    delete from MODULO_COMISION_VENTA_HIST



ALTER TABLE MODULO_COMISION_VENTA_HIST ADD
cartola bigint, 
iva numeric(18, 2),
año NVARCHAR(4),
mes NVARCHAR(15),
sucursal NVARCHAR(5),
vendedor NVARCHAR(5)*/