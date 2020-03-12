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
  public function setNew(){

    if (request()->ajax()){

        DB::insert("INSERT INTO [dbo].[ADM_PROVEEDOR]
        ([emp_codigo]
        ,[emp_tipo]
        ,[emp_rut]
        ,[emp_nombre]
        ,[emp_descripcion]
        ,[direccion_pais]
        ,[direccion_region]
        ,[direccion_direccion]
        ,[com_telefono]
        ,[com_movil]
        ,[com_fax]
        ,[com_email]
        ,[i_estado]
        ,[i_usuario]
        ,[i_datetime])
         VALUES
            ('NUEVO',0,'NUEVO','NUEVO','NUEVO','NUEVO','NUEVO','NUEVO','NUEVO','NUEVO','NUEVO','NUEVO',0,0,getdate())");
      
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
      if (request()->ajax()){

       DB::update("UPDATE ADM_PROVEEDOR
                    SET [emp_codigo] = '$request->codigo'
                    ,[emp_rut] = '$request->rut'
                    ,[emp_nombre] = '$request->empNombre'
       
                    ,[direccion_pais] = '$request->direccionPais'
         
                    ,[direccion_direccion] = '$request->direcciondire'
                    ,[com_telefono] = '$request->telefono'
                    ,[com_movil] = '$request->movil'
                    ,[com_fax] = '$request->fax'
                    ,[com_email] = '$request->email'
          
              WHERE [id_proveedor] = $request->id");

         
      
      }

    }
}
