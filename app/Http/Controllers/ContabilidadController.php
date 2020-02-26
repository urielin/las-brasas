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
                                         WHERE fecha_desde >= convert(date,'$request->fecha1') and fecha_hasta <= convert(date,'$request->fecha2')");

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

                $otrosRetiros=DB::select("SELECT rd.folio, ro.fecha_ingreso, ro.descripcion, s.SUCU_NOMBRE, op.OPER_DESC,rd.usuario,ro.deposito,ro.monto FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                          INNER JOIN   dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                           left outer join dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                          left outer join dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                          left outer join dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
                          WHERE fecha_desde >= convert(date,'$request->fecha1') and fecha_hasta <= convert(date,'$request->fecha2') and rd.tipo='2'
                          order by ro.fecha_ingreso desc");

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


    public function upOtroRetiro(Request $request)
    {
            if ($request -> ajax()) {

                     $numOtroRetiro= DB::SELECT("SELECT COUNT(*) as otroNum FROM MODULO_OTROS_RETIROS_PROSEGUR WHERE estado = 0");
                     foreach($numOtroRetiro as $num)
                     {
                           $otroConteo=$num->otroNum;
                     }
                     // $num= $numRetiro;
                     // $a = count($numRetiro);
                    if ($otroConteo == '0') {
                        $puntero= DB::SELECT("SELECT * FROM  ID_PUNTEROS  WHERE (id_puntero = 20)");

                        foreach($puntero as $p)
                        {
                              $valor=$p->Valor;
                        }
                        DB::update("UPDATE dbo.ID_PUNTEROS set Valor = Valor + 1 where (id_puntero = 20)");


                        DB::insert("INSERT INTO MODULO_OTROS_RETIROS_PROSEGUR (folio, descripcion, estado, usuario, fecha_ingreso, monto, t_oper )
                        VALUES ( '$valor' , '',0, 'laura',GETDATE(),0,1)");
                    }


                      return response()->json([
                          'numOtroRetiro'   =>$numOtroRetiro
                      ]);
          }
    }
    public function upRetiro(Request $request)
    {
            if ($request -> ajax()) {

                     $numRetiro= DB::SELECT("SELECT COUNT(*)  as num FROM MODULO_RETIROS_INDICE WHERE estado = '0'");
                     foreach($numRetiro as $num)
                     {
                           $conteo=$num->num;
                     }
                     // $num= $numRetiro;
                     // $a = count($numRetiro);
                    if ($conteo == '0') {
                        DB::insert("INSERT INTO MODULO_RETIROS_INDICE (documento, fecha_desde, fecha_hasta,estado )
                        VALUES (1 , DATEADD(DAY, -3, dbo.todate_only(GETDATE())), GETDATE(), 0 )");
                    }


                      return response()->json([
                          'numRetiro'   =>$numRetiro
                      ]);
          }
  }

  public function getRetiroDetalle(Request $request)
  {
          if ($request -> ajax()) {


                  $depositosDetalle1=DB::select("SELECT rd.id_retiro_detalle,rc.folio, rd.tipo, op.OPER_DESC, ipc.id_sucursal,s.SUCU_NOMBRE , rc.num_caja, rc.n_deposito, rc.fecha_caja, rc.monto, rc.obs, rc.cartola_fecha
                                        FROM dbo.MODULO_RETIROS_INDICE ri
                                        INNER JOIN dbo.MODULO_RETIROS_INDICE_DETALLE rd on ri.id_retiros_indice = rd.id_retiros_indice
                                        INNER JOIN dbo.MODULO_RETIROS_CAJA rc on rd.folio =rc.folio
                                        INNER JOIN dbo.MODULO_RETIROS_CAJA_DETALLE rcd on rc.folio=rcd.id_folio
                                        INNER JOIN ID_PUNTEROS_CAJAS ipc on rc.num_caja = ipc.id_caja
	                                      INNER JOIN dbo.ADM_SUCURSAL s on ipc.id_sucursal =s.SUCU_CODIGO
                                        INNER JOIN dbo.MODULO_TP_OPERACION op on rc.cod_op= op.OPER_COD
                                        WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo ='1'");

                  $depositosDetalle2=DB::select("SELECT rd.id_retiro_detalle,rd.folio, rd.tipo, op.OPER_DESC, s.SUCU_CODIGO, s.SUCU_NOMBRE, ro.deposito, ro.fecha_ingreso, ro.monto, ro.descripcion, ro.cartola_fecha
                                        FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                                        INNER JOIN dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                                        INNER JOIN dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                                        INNER JOIN dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                                        INNER JOIN dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
                                        WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo='2'");




                  if ($depositosDetalle2 != null) {
                    return response()->json([

                          'depositosDetalle1'              =>$depositosDetalle1,
                          'depositosDetalle2'              =>$depositosDetalle2

                        ]);

                  }else {
                    return response()->json([

                        'aviso'            =>'No se encontraron depositos, intente otra fecha'
                        ]);
                  }

        }
  }

  public function getRetiroPendiente(Request $request)
  {
          if ($request -> ajax()) {


                  $retirosPendientes1=DB::select("SELECT  rc.folio, rc.monto, rc.fecha_caja, tp.OPER_DESC, tc.TPCHEQUE_DESC, rc.n_deposito
                                        FROM MODULO_RETIROS_CAJA rc
                                        LEFT JOIN CARTOLA_BANCOS cb on rc.n_deposito = cb.deposito
                                        inner join MODULO_TP_OPERACION tp on rc.cod_op=tp.OPER_COD
                                        inner join MODULO_TP_CHEQUES tc on rc.tipo_cheque = tc.TDCHEQUE_COD
                                        WHERE  (fecha_caja between convert(date,'$request->fecha1') AND convert(date,'$request->fecha2'))
                                        AND (ISNULL(cb.deposito , '') = '')
                                        AND rc.cod_op = '1'");

                  $retirosPendientes2=DB::select("SELECT  rc.folio, rc.monto, rc.fecha_caja, tp.OPER_DESC, tc.TPCHEQUE_DESC, rc.n_deposito
                                        FROM MODULO_OTROS_RETIROS_PROSEGUR ro
                                        inner join MODULO_RETIROS_CAJA rc on ro.deposito = rc.n_deposito
                                        LEFT join CARTOLA_BANCOS cb on ro.fecha_ingreso = cb.fecha
                                        inner join MODULO_TP_OPERACION tp on rc.cod_op=tp.OPER_COD
                                        inner join MODULO_TP_CHEQUES tc on rc.tipo_cheque = tc.TDCHEQUE_COD
                                        WHERE  (fecha_caja between convert(date,'$request->fecha1') AND convert(date,'$request->fecha2'))
                                        AND (ISNULL(cb.deposito , '') = '')
                                        AND rc.cod_op = '2'
                                        AND rc.tipo_cheque= '2'");

                  $retirosPendientes3=DB::select("SELECT  rc.folio, rc.monto, rc.fecha_caja, tp.OPER_DESC, tc.TPCHEQUE_DESC, rc.n_deposito
                                        FROM MODULO_RETIROS_CAJA rc
                                        LEFT JOIN CARTOLA_BANCOS cb on rc.n_deposito = cb.deposito
                                        inner join MODULO_TP_OPERACION tp on rc.cod_op=tp.OPER_COD
                                        inner join MODULO_TP_CHEQUES tc on rc.tipo_cheque = tc.TDCHEQUE_COD
                                        WHERE  (fecha_caja between convert(date,'$request->fecha1') AND convert(date,'$request->fecha2'))
                                        AND (ISNULL(cb.deposito , '') = '')
                                        AND rc.cod_op = '4'
                                        AND rc.tipo_cheque= '6'");




                  if ($retirosPendientes1 != null) {
                    return response()->json([

                          'retirosPendientes1'              =>$retirosPendientes1,
                          'retirosPendientes2'              =>$retirosPendientes2,
                          'retirosPendientes3'              =>$retirosPendientes3,
                        ]);

                  }else {
                    return response()->json([

                        'aviso'            =>'No se encontraron depositos pendientes, intente otra fecha'
                        ]);
                  }

        }
  }



}
