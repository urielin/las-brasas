<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


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
                                      FROM ADM_PROVEEDOR");
      return response()->json([

        'proveedor'              =>$proveedor

      ]);
    }

  } 
  public function pagos( ) {
    return view('gestion.pagos');

  }
  public function parametros() {
    $proveedor = DB::select('SELECT id_proveedor, emp_nombre FROM ADM_PROVEEDOR');
    
    return view('gestion.parametros')->with(compact('proveedor'));
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

        'datos'              =>$datos

      ]);
    }

  }
}
