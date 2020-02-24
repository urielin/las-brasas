<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;
use Validator;

class IngresoCartolaController extends Controller
{

  public function index()
  {
      $cuentas=DB::select("SELECT COD_CUENTA, DESCRIPCION_CUENTA
                          FROM   CARTOLA_TP_CUENTAS");

      $gestion=DB::select("SELECT TP_GESTION, TP_GESTION as tp
                            FROM    ADM_TP_GESTION
                            ORDER BY TP_GESTION DESC");

      return view('cartola.index')->with(compact('cuentas'))->with(compact('gestion'));
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
