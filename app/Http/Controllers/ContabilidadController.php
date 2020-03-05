<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;
use Validator;
use File;

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
// -----------------------


// ------------------------------------
      public function IncluirRetiro(Request $request)
      {
          if ($request -> ajax()) {

            $estado = DB::select("SELECT  estado FROM  MODULO_RETIROS_INDICE WHERE id_retiros_indice = '$request->id_retiro_indice'");
            foreach($estado as $est)
            {
                  $estado=$est->estado;
            }

            if ($estado == '0') {
                  DB::raw("exec [dbo].[Retiros_Tools_Incluir_Depositos] '".$request->id_retiro_indice."','".$request->texto."'");
                  $resultado= '0';
                  $depositosDetalle1=DB::select("SELECT rd.id_retiro_detalle,rc.folio, rd.tipo, op.OPER_DESC, ipc.id_sucursal,s.SUCU_NOMBRE , rc.num_caja, rc.n_deposito, rc.fecha_caja, rc.monto, rc.obs, rc.cartola_fecha
                                        FROM dbo.MODULO_RETIROS_INDICE ri
                                        LEFT JOIN dbo.MODULO_RETIROS_INDICE_DETALLE rd on ri.id_retiros_indice = rd.id_retiros_indice
                                        LEFT JOIN dbo.MODULO_RETIROS_CAJA rc on rd.folio =rc.folio
                                        LEFT JOIN dbo.MODULO_RETIROS_CAJA_DETALLE rcd on rc.folio=rcd.id_folio
                                        LEFT JOIN ID_PUNTEROS_CAJAS ipc on rc.num_caja = ipc.id_caja
	                                      LEFT JOIN dbo.ADM_SUCURSAL s on ipc.id_sucursal =s.SUCU_CODIGO
                                        LEFT JOIN dbo.MODULO_TP_OPERACION op on rc.cod_op= op.OPER_COD
                                        WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo ='1'");

                  $depositosDetalle2=DB::select("SELECT rd.id_retiro_detalle,rd.folio, rd.tipo, op.OPER_DESC, s.SUCU_CODIGO, s.SUCU_NOMBRE, ro.deposito, ro.fecha_ingreso, ro.monto, ro.descripcion, ro.cartola_fecha
                                        FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                                        LEFT JOIN dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                                        LEFT JOIN dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                                        LEFT JOIN dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                                        LEFT JOIN dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
                                        WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo='2'");

                    $depositoIncluir=DB::select("SELECT rd.id_retiro_detalle,rc.folio,  rd.tipo, op.OPER_DESC, ipc.id_sucursal,s.SUCU_NOMBRE , rc.num_caja, rc.n_deposito, rc.fecha_caja, rc.monto, rc.obs, rc.cartola_fecha
                                          FROM MODULO_RETIROS_CAJA rc
                                           LEFT JOIN dbo.MODULO_RETIROS_INDICE_DETALLE rd on rd.folio =rc.folio
                                          left JOIN dbo.MODULO_RETIROS_CAJA_DETALLE rcd on rc.folio=rcd.id_folio
                                          left JOIN ID_PUNTEROS_CAJAS ipc on rc.num_caja = ipc.id_caja
  	                                      left JOIN dbo.ADM_SUCURSAL s on ipc.id_sucursal =s.SUCU_CODIGO
                                          left JOIN dbo.MODULO_TP_OPERACION op on rc.cod_op= op.OPER_COD
                                          WHERE rc.n_deposito = '$request->texto'");
            } else {
                  $resultado = '1';
                 // $resultado= 'El depósito esta completo, no es posible agregar un retiro.';
            }


            //
              // $resultado= 'Retiro incluido';
          return response()->json([

                'depositosDetalle1'              =>$depositosDetalle1,
                'depositosDetalle2'              =>$depositosDetalle2,
                'depositoIncluir'                =>$depositoIncluir,
                'resultado'                      =>$resultado

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
                          VALUES (1 , DATEADD(DAY, -3, dbo.todate_only(GETDATE())), dbo.todate_only(GETDATE()), 0 )");
                      }


                        return response()->json([
                            'numRetiro'   =>$numRetiro
                        ]);
            }
    }
  public function deleteItemRetiro(Request $request)
  {
          if ($request -> ajax()) {


                  $retiro_indice=DB::select("SELECT  id_retiros_indice FROM MODULO_RETIROS_INDICE_DETALLE WHERE id_retiro_detalle = '$request->id_retiro_detalle'");

                  if ($retiro_indice != null) {
                        foreach($retiro_indice as $idr)
                        {
                              $id_retiros_indice=$idr->id_retiros_indice;
                        }

                        $estado_indice = DB::select("SELECT estado FROM  MODULO_RETIROS_INDICE WHERE id_retiros_indice = $id_retiros_indice");
                        foreach($estado_indice as $estado)
                        {
                              $estado=$estado->estado;
                        }

                        if ($estado == '0') {

                          DB::table('MODULO_RETIROS_INDICE_DETALLE')->where('id_retiro_detalle', '=', $request->id_retiro_detalle)->delete();

                          DB::raw("exec [dbo].[Retiros_Consolidar] '".$id_retiros_indice."'");

                            $b='eliminado';

                        } else {
                            $b='noEliminado';
                        }




                  } else {
                     $retiro_indice= 'esta vacio';
                  }

                    return response()->json([

                          // 'id_retiros_indice'              =>$id_retiros_indice,
                          'a'                              =>$retiro_indice,
                          'b'                              =>$b
                        ]);


        }
  }
  public function getRetiroDetalle(Request $request)
  {
          if ($request -> ajax()) {


                  $depositosDetalle1=DB::select("SELECT rd.id_retiro_detalle,rc.folio, rd.tipo, op.OPER_DESC, ipc.id_sucursal,s.SUCU_NOMBRE , rc.num_caja, rc.n_deposito, rc.fecha_caja, rc.monto, rc.obs, rc.cartola_fecha
                                        FROM dbo.MODULO_RETIROS_INDICE ri
                                        LEFT JOIN dbo.MODULO_RETIROS_INDICE_DETALLE rd on ri.id_retiros_indice = rd.id_retiros_indice
                                        LEFT JOIN dbo.MODULO_RETIROS_CAJA rc on rd.folio =rc.folio
                                        LEFT JOIN dbo.MODULO_RETIROS_CAJA_DETALLE rcd on rc.folio=rcd.id_folio
                                        LEFT JOIN ID_PUNTEROS_CAJAS ipc on rc.num_caja = ipc.id_caja
	                                      LEFT JOIN dbo.ADM_SUCURSAL s on ipc.id_sucursal =s.SUCU_CODIGO
                                        LEFT JOIN dbo.MODULO_TP_OPERACION op on rc.cod_op= op.OPER_COD
                                        WHERE fecha_desde = convert(date,'$request->fecha1') and fecha_hasta = convert(date,'$request->fecha2') and rd.tipo ='1'");

                  $depositosDetalle2=DB::select("SELECT rd.id_retiro_detalle,rd.folio, rd.tipo, op.OPER_DESC, s.SUCU_CODIGO, s.SUCU_NOMBRE, ro.deposito, ro.fecha_ingreso, ro.monto, ro.descripcion, ro.cartola_fecha
                                        FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
                                        LEFT JOIN dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
                                        LEFT JOIN dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
                                        LEFT JOIN dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
                                        LEFT JOIN dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
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

  public function prueba()
  {
    $filename =  public_path('txt/prueba.txt');
    $prueba = fopen($filename, "r") or die ("error al leer");

    while ( !feof($prueba)) {
      $linea = fgets($prueba);
      $saltodelinea[] = nl2br($linea);
      // echo $saltodelinea;
    }
    fclose($prueba);
    // $nueva_cadena = chunk_split(("hola1  hola2   hola3    hola4     hola5"));
    // dd($nueva_cadena);
    foreach ($saltodelinea as $val) {

          $porciones[] = explode(" ", $val);
    }
    dd($porciones);
  }

  public function reporteResumenProsegur(Request $request)
  {
    $fecha1= $request->fecha1 ? strval($request->fecha1) : NULL;
    $fecha2= $request->fecha2 ? strval($request->fecha2) : NULL;
    // if ($request -> ajax()) {
    if ($fecha1 && $fecha2 ) {
        //  if ($request->id) {
          $fecha1=(string)$fecha1;
          $fecha2=(string)$fecha2;
          $datos['fecha1']= $fecha1;
          $datos['fecha2']= $fecha2;
          $datos['resumen_ventas']=DB::select("SELECT  FRPG_CODIGO, FRPG_DESCRIPCION , SUM(total) as sub_total
          FROM [dbo].[MODULO_VENTA_HIST]
          INNER JOIN  [dbo].[ADM_FORMAPAGO] ON forma_pago = FRPG_CODIGO
          where fecha BETWEEN convert(date,'$fecha1') and convert(date,'$fecha2')
          GROUP BY FRPG_CODIGO, FRPG_DESCRIPCION");
          // where fecha BETWEEN convert(date,'2019-07-13') and convert(date,'2019-07-17')
          $datos['depositosDetalle1']=DB::select("SELECT rc.folio, rd.tipo, op.OPER_DESC, ipc.id_sucursal,s.SUCU_NOMBRE , rc.num_caja, rc.n_deposito, rc.fecha_caja as fecha_cierre, rc.monto, rc.obs, rc.cartola_fecha
          FROM dbo.MODULO_RETIROS_INDICE ri
          INNER JOIN dbo.MODULO_RETIROS_INDICE_DETALLE rd on ri.id_retiros_indice = rd.id_retiros_indice
          INNER JOIN dbo.MODULO_RETIROS_CAJA rc on rd.folio =rc.folio
          INNER JOIN dbo.MODULO_RETIROS_CAJA_DETALLE rcd on rc.folio=rcd.id_folio
          INNER JOIN ID_PUNTEROS_CAJAS ipc on rc.num_caja = ipc.id_caja
          INNER JOIN dbo.ADM_SUCURSAL s on ipc.id_sucursal =s.SUCU_CODIGO
          INNER JOIN dbo.MODULO_TP_OPERACION op on rc.cod_op= op.OPER_COD
          WHERE fecha_desde = convert(date,'$fecha1') and fecha_hasta = convert(date,'$fecha2') and rd.tipo ='1'");

          $datos['depositosDetalle2']=DB::select("SELECT rd.folio, rd.tipo, op.OPER_DESC, s.SUCU_CODIGO as id_sucursal, s.SUCU_NOMBRE, NULL as num_caja, ro.deposito as n_deposito, ro.fecha_ingreso as fecha_cierre, ro.monto, ro.descripcion as obs, ro.cartola_fecha
          FROM  dbo.MODULO_RETIROS_INDICE_DETALLE rd
          INNER JOIN dbo.MODULO_RETIROS_INDICE ri on ri.id_retiros_indice = rd.id_retiros_indice
          INNER JOIN dbo.MODULO_OTROS_RETIROS_PROSEGUR ro on rd.folio= ro.folio
          INNER JOIN dbo.ADM_SUCURSAL s on ro.sucursal =s.SUCU_CODIGO
          INNER JOIN dbo.MODULO_TP_OPERACION op on ro.t_oper= op.OPER_COD
          WHERE fecha_desde = convert(date,'$fecha1') and fecha_hasta = convert(date,'$fecha2') and rd.tipo='2'");
          // estilos de pdf
          $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
          ]);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Resumen de transacciones");
          $mpdf->SetAuthor("Las Brasas");
          $mpdf->SetWatermarkText("LAS BRASAS");
          $mpdf->showWatermarkText = true;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->SetDisplayMode('fullpage');
          $html =view('reports.prosegur.resumen-retiros',$datos)->render();

          $mpdf->WriteHTML($html);
          $mpdf->Output();

    }




  }
}
