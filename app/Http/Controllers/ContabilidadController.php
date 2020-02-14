<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;
use Validator;

class ContabilidadController extends Controller
{

  public function index()
  {
    return view('contabilidad.index');
  }


  public function getRetiro(Request $request)
  {
          if ($request -> ajax()) {


                  $retiros=DB::select("SELECT
                              id_retiros_indice, rd.TP_RET_DESCRIPCION, fecha_desde, fecha_hasta,
                              doc_cantidad, monto_total,estado, fecha_cierre, usuario_cierre, observacion
                              FROM dbo.MODULO_RETIROS_INDICE r
                              INNER JOIN dbo.MODULO_RETIROS_TP_INDICE rd on r.documento=rd.TP_RET_DOCUMENTO
                              WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2')");

                  if ($retiros != null) {
                    return response()->json([
                        'retiros'              =>$retiros
                        ]);

                  }else {
                    return response()->json([

                        'aviso'            =>'No se encontraron retiros, intente otra fecha'
                        ]);
                  }

        }
  }

public function getOtroRetiro(Request $request)
{
        if ($request -> ajax()) {


                $otrosRetiros=DB::select("SELECT rd.folio, ro.fecha_ingreso, ro.descripcion, s.SUCU_NOMBRE, op.OPER_DESC,rd.usuario,ro.monto FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                          INNER JOIN   dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                           left outer join dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                          left outer join dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                          left outer join dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
                          WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo='2'");

                if ($otrosRetiros != null) {
                  return response()->json([
                      'otrosRetiros'              =>$otrosRetiros
                      ]);

                }else {
                  return response()->json([

                      'aviso'            =>'No se encontraron otros retiros, intente otra fecha'
                      ]);
                }

      }
    }

  public function getRetiroDetalle(Request $request)
  {
          if ($request -> ajax()) {


                  $depositosDetalle=DB::select("SELECT rd.folio, rd.tipo, op.OPER_DESC, s.SUCU_CODIGO, s.SUCU_NOMBRE, ro.fecha_ingreso, ro.monto, ro.descripcion, ro.cartola_fecha  FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                            INNER JOIN   dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                             left outer join dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                            left outer join dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                            left outer join dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
                            WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2')");

                  if ($depositosDetalle != null) {
                    return response()->json([
                        'depositosDetalle'              =>$depositosDetalle
                        ]);

                  }else {
                    return response()->json([

                        'aviso'            =>'No se encontraron depositos, intente otra fecha'
                        ]);
                  }

        }
  }


}
