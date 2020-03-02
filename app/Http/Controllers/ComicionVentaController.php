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

  public function getComision(Request $request){
    if($request -> ajax()){

      $año = $request->gestion;
      $mes = $request->mes;

      //$fechaInicio = DB::select("SELECT fecha=DATEFROMPARTS($año,$mes,1)");
      //$fechaFinal = DB::select("SELECT fecha=EOMONTH(DATEFROMPARTS($año,$mes,1))");

      $comision = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
      m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m1.fecha2");

      $comision1=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
      m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      ORDER BY m2.fecha_pago");

      $comision2=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
      m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago IS NULL
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m2.fecha_pago");

      $fecha_actual=DB::select("SELECT DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      $fecha_anterior=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($año,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($año,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      //$fecha_siguiente=DB::select("");


      return response()->json([

        'comision'    =>$comision,
        'comision1'   =>$comision1,
        'comision2'   =>$comision2,
        'fecha_actual' =>$fecha_actual,
        'fecha_anterior'=>$fecha_anterior


      ]);
    }
  }

  public function getDetalles(Request $request){

        if($request -> ajax()){

          $tabla_detalles= DB::select("SELECT m2.CODI_RNOMBRE, m1.folio, m1.ptotal, m1.sucursal, m1.cantidad, m1.codigo,
                                              m2.id_codigos
                                        FROM  MODULO_ITEM_HIST m1 INNER JOIN ADM_CODIGOS m2 ON m1.codigo = m2.CODI_RCODIGO
                                        WHERE m1.folio='$request->valores'");


          return response()->json([
            'detalles' =>$tabla_detalles
          ]);
        }
  }
  public function reporteComisionVenta(Request $request){

    $año=$request->year;
    $mes=$request->mes;
    $sucursal=$request->sucursal;
    $vendedor=$request->vendedor;

    $comision['mes-actual'] = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
    m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
    and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
    ORDER BY m1.fecha2");

    $comision['mes-anterior']=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
    m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
    and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
    ORDER BY m2.fecha_pago");

    $comision['mes-siguiente']=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional)) as comision,
    m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago IS NULL
    and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
    ORDER BY m2.fecha_pago");

    $comision['fecha-actual']=DB::select("SELECT DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

    $comision['fecha-anterior']=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($año,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($año,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

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
          $html =view('reports.comsion-venta.reporte-comision', $comision)->render();
          $mpdf->WriteHTML($html);
          $mpdf->Output();

  }
}
