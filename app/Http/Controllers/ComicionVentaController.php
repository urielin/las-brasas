<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Libreria\Mail\PHPMailer;
use App\Libreria\Mail\Exception;
use App\Comision;

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

  public function validacion(Request $request){
    if($request -> ajax()){
      $año = $request->gestion;
      $mes = $request->mes;
      $vendedor=$request->vendedor;
      $sucursal=$request->sucursal;

      $datos=DB::select("SELECT * FROM MODULO_COMISION_VENTA_HIST WHERE 
                          año='$año' AND 
                          mes='$mes'");

      return response()->json([
        'datos' =>$datos
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
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
      m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,u.id_cartola_bancos
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m1.fecha2");

      $comisionvalidado = DB::select("SELECT *
      FROM MODULO_COMISION_VENTA_HIST m1
      WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$año'
      and m1.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m1.fecha2");

      $comision1=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
      m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,u.id_cartola_bancos
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      ORDER BY m2.fecha_pago");
    
      $comisionvalidado1 =   DB::select("SELECT *
      FROM MODULO_COMISION_VENTA_HIST m1
      WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$año'
      and m1.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      ORDER BY m1.fecha_pago");

      $comision2=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
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
        'fecha_anterior'=>$fecha_anterior,
        'comisionvalidado' =>$comisionvalidado,
        'comisionvalidado1' =>$comisionvalidado1


      ]);
    }
  }

  public function getDetalles(Request $request){

    if($request -> ajax()){

      $año = $request->gestion;
      $mes = $request->mes;

      //$fechaInicio = DB::select("SELECT fecha=DATEFROMPARTS($año,$mes,1)");
      //$fechaFinal = DB::select("SELECT fecha=EOMONTH(DATEFROMPARTS($año,$mes,1))");

      $detalle = DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $validado = DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
      FROM MODULO_COMISION_VENTA_HIST m2
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal' and m2.año='$año' and m2.mes='$mes'
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m2.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $detalle1=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $validado1=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
      FROM MODULO_COMISION_VENTA_HIST m2
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal'  and m2.año='$año' and m2.mes='$mes'
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m2.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $detalle2=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago IS NULL
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $fecha_actual=DB::select("SELECT DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      $fecha_anterior=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($año,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($año,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      //$fecha_siguiente=DB::select("");


      return response()->json([

        'detalle'    =>$detalle,
        'detalle1'   =>$detalle1,
        'detalle2'   =>$detalle2,
        'fecha_actual' =>$fecha_actual,
        'fecha_anterior'=>$fecha_anterior,
        'validado'    =>$validado,
        'validado1'   =>$validado1

      ]);
    }
  }
  public function reporteComisionVenta(Request $request){

    $year = $request->year;
    $mes = $request->mes;
    $sucursal = $request->sucursal;
    $vendedor = $request->vendedor;

    $comision['year'] = $request->year;
    //$comision['mes'] = DB::select("SELECT DATENAME(MONTH,DATEFROMPARTS($year,$mes,1))");
    //$comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE SUCU_ESTADO = 1 AND SUCU_CODIGO= $sucursal");
    //$comision['vendedor'] = DB::select("SELECT VEND_NOMBRE FROM ADM_VENDEDORES WHERE VEND_NOMBRE='$vendedor'");

    $comision['mes'] = $request->mes;
    $comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE (SUCU_ESTADO = 1) AND SUCU_CODIGO=$request->sucursal");
    $comision['vendedor'] = DB::select("SELECT av.VEND_NOMBRE FROM MODULO_VENTA_HIST vh LEFT OUTER JOIN ADM_VENDEDORES av ON vh.cod_vendedor = av.VEND_CODIGO
    WHERE YEAR(vh.fecha) = '$year' AND MONTH(vh.fecha) = '$request->mes'  AND vh.sucursal = '$request->sucursal' AND vh.cod_vendedor='$request->vendedor'
    GROUP BY vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal");
    
    $comision['mesactual'] = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, FORMAT(m1.fecha2,'yyyy/MM/dd') as fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
    FORMAT(m2.fecha_pago,'yyyy/MM/dd') as fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    ORDER BY m1.fecha2");

    $comision['mesanterior']=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, FORMAT(m1.fecha2,'yyyy/MM/dd') as fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
    FORMAT(m2.fecha_pago,'yyyy/MM/dd') as fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($year,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($year,$mes,1),-1)
    ORDER BY m2.fecha_pago");

    $comision['messiguiente']=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, FORMAT(m1.fecha2,'yyyy/MM/dd') as fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
    FORMAT(m2.fecha_pago,'yyyy/MM/dd') as fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago IS NULL
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    ORDER BY m2.fecha_pago");

    $comision['fechaactual']=DB::select("SELECT DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['fechaanterior']=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($year,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($year,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Resumen de transacciones_'$vendedor'_'$year'_'$mes'");
          $mpdf->SetAuthor("Las Brasas");
          $mpdf->SetWatermarkText("LAS BRASAS");
          $mpdf->showWatermarkText = true;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->SetDisplayMode('fullpage');
          $html =view('reports.comision-venta.reporte-comision',$comision)->render();

          $mpdf->WriteHTML($html);
          $mpdf->Output();

  }

  public function reporteComisionVenta1(Request $request){

    $year = $request->year;
    $mes = $request->mes;
    $sucursal = $request->sucursal;
    $vendedor = $request->vendedor;

    $comision['year'] = $request->year;
    //$comision['mes'] = DB::select("SELECT DATENAME(MONTH,DATEFROMPARTS($year,$mes,1))");
    //$comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE SUCU_ESTADO = 1 AND SUCU_CODIGO= $sucursal");
    //$comision['vendedor'] = DB::select("SELECT VEND_NOMBRE FROM ADM_VENDEDORES WHERE VEND_NOMBRE='$vendedor'");

    $comision['mes'] = $request->mes;
    $comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE (SUCU_ESTADO = 1) AND SUCU_CODIGO=$request->sucursal");
    $comision['vendedor'] = DB::select("SELECT av.VEND_NOMBRE FROM MODULO_VENTA_HIST vh LEFT OUTER JOIN ADM_VENDEDORES av ON vh.cod_vendedor = av.VEND_CODIGO
    WHERE YEAR(vh.fecha) = '$year' AND MONTH(vh.fecha) = '$request->mes'  AND vh.sucursal = '$request->sucursal' AND vh.cod_vendedor='$request->vendedor'
    GROUP BY vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal");
    
    $comision['mesactual'] = DB::select("SELECT *
    FROM MODULO_COMISION_VENTA_HIST m1
    WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$year'
    and m1.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    ORDER BY m1.fecha2");

    $comision['mesanterior']=DB::select("SELECT *
    FROM MODULO_COMISION_VENTA_HIST m1
    WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$year'
    and m1.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($year,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($year,$mes,1),-1)
    ORDER BY m1.fecha_pago");

    $comision['messiguiente']=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, FORMAT(m1.fecha2,'yyyy/MM/dd') as fecha2, m1.forma_pago,
    m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
    m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
    FORMAT(m2.fecha_pago,'yyyy/MM/dd') as fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago IS NULL
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    ORDER BY m2.fecha_pago");

    $comision['fechaactual']=DB::select("SELECT DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['fechaanterior']=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($year,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($year,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Resumen de transacciones_'$vendedor'_'$year'_'$mes'");
          $mpdf->SetAuthor("Las Brasas");
          $mpdf->SetWatermarkText("LAS BRASAS");
          $mpdf->showWatermarkText = true;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->SetDisplayMode('fullpage');
          $html =view('reports.comision-venta.reporte-comision',$comision)->render();

          $mpdf->WriteHTML($html);
          $mpdf->Output();

  }

  public function reportesComisionVenta(Request $request){
    $year = $request->year;
    $mes = $request->mes;
    $sucursal = $request->sucursal;
    $vendedor = $request->vendedor;

    $comision['year'] = $request->year;
    //$comision['mes'] = DB::select("SELECT DATENAME(MONTH,DATEFROMPARTS($year,$mes,1))");
    //$comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE SUCU_ESTADO = 1 AND SUCU_CODIGO= $sucursal");
    //$comision['vendedor'] = DB::select("SELECT VEND_NOMBRE FROM ADM_VENDEDORES WHERE VEND_NOMBRE='$vendedor'");

    $comision['mes'] = $request->mes;
    $comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE (SUCU_ESTADO = 1) AND SUCU_CODIGO=$request->sucursal");
    $comision['vendedor'] = DB::select("SELECT av.VEND_NOMBRE FROM MODULO_VENTA_HIST vh LEFT OUTER JOIN ADM_VENDEDORES av ON vh.cod_vendedor = av.VEND_CODIGO
    WHERE YEAR(vh.fecha) = '$year' AND MONTH(vh.fecha) = '$request->mes'  AND vh.sucursal = '$request->sucursal' AND vh.cod_vendedor='$request->vendedor'
    GROUP BY vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal");



    $comision['mesactual'] = DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
    INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO

    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

    $comision['mesanterior']=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
    INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($year,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($year,$mes,1),-1)
    GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

    $comision['messiguiente']=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio 
    INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago IS NULL
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");


    $comision['fechaactual']=DB::select("SELECT DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['fechaanterior']=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($year,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($year,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['niveles']=DB::select("SELECT * from ADM_VENDEDOR_PARAMETROS_COMISION WHERE id_vendedor=$vendedor");

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Resumen de transacciones_'$vendedor'_'$year'_'$mes'");
          $mpdf->SetAuthor("Las Brasas");
          $mpdf->SetWatermarkText("LAS BRASAS");
          $mpdf->showWatermarkText = true;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->SetDisplayMode('fullpage');
          $html =view('reports.comision-venta.reporte-detalles',$comision)->render();

          $mpdf->WriteHTML($html);
          $mpdf->Output();

  }
  public function reportesComisionVenta1(Request $request){
    $year = $request->year;
    $mes = $request->mes;
    $sucursal = $request->sucursal;
    $vendedor = $request->vendedor;

    $comision['year'] = $request->year;
    //$comision['mes'] = DB::select("SELECT DATENAME(MONTH,DATEFROMPARTS($year,$mes,1))");
    //$comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE SUCU_ESTADO = 1 AND SUCU_CODIGO= $sucursal");
    //$comision['vendedor'] = DB::select("SELECT VEND_NOMBRE FROM ADM_VENDEDORES WHERE VEND_NOMBRE='$vendedor'");

    $comision['mes'] = $request->mes;
    $comision['sucursal'] = DB::select("SELECT SUCU_NOMBRE FROM ADM_SUCURSAL WHERE (SUCU_ESTADO = 1) AND SUCU_CODIGO=$request->sucursal");
    $comision['vendedor'] = DB::select("SELECT av.VEND_NOMBRE FROM MODULO_VENTA_HIST vh LEFT OUTER JOIN ADM_VENDEDORES av ON vh.cod_vendedor = av.VEND_CODIGO
    WHERE YEAR(vh.fecha) = '$year' AND MONTH(vh.fecha) = '$request->mes'  AND vh.sucursal = '$request->sucursal' AND vh.cod_vendedor='$request->vendedor'
    GROUP BY vh.cod_vendedor, av.VEND_NOMBRE, vh.sucursal");



    $comision['mesactual'] = DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
    FROM MODULO_COMISION_VENTA_HIST m2
    INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
    WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal' and m2.año='$year' and m2.mes='$mes'
    and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    and m2.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

    $comision['mesanterior']=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
      FROM MODULO_COMISION_VENTA_HIST m2
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal'  and m2.año='$year' and m2.mes='$mes'
      and m2.fecha_pago BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
      and m2.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($year,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($year,$mes,1),-1)
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

    $comision['messiguiente']=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
    FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio 
    INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
    WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
    and m2.fecha_pago IS NULL
    and m1.fecha2 BETWEEN DATEFROMPARTS($year,$mes,1) AND EOMONTH(DATEFROMPARTS($year,$mes,1))
    GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");


    $comision['fechaactual']=DB::select("SELECT DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['fechaanterior']=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($year,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($year,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($year,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($year,$mes,1)) as año");

    $comision['niveles']=DB::select("SELECT * from ADM_VENDEDOR_PARAMETROS_COMISION WHERE id_vendedor=$vendedor");

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Resumen de transacciones_'$vendedor'_'$year'_'$mes'");
          $mpdf->SetAuthor("Las Brasas");
          $mpdf->SetWatermarkText("LAS BRASAS");
          $mpdf->showWatermarkText = true;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
          $mpdf->watermarkTextAlpha = 0.1;
          $mpdf->SetDisplayMode('fullpage');
          $html =view('reports.comision-venta.reporte-detalles',$comision)->render();

          $mpdf->WriteHTML($html);
          $mpdf->Output();

  }





  
  //ya esta
  public function setDatos(Request $request){
    if($request -> ajax()){

      $año = $request->gestion;
      $mes = $request->mes;
      $vendedor=$request->vendedor;
      $sucursal=$request->sucursal;
      //$estado= "lleno";
      /*$datosOriginal=DB::select("SELECT folio FROM MODULO_COMISION_VENTA_HIST WHERE fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH(DATEFROMPARTS($año,$mes,1))");

      $datos2=DB::select("SELECT m1.folio FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m1.fecha2");

      $datos3 = DB::select("SELECT m1.folio FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
                            WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
                            and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
                            and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
                          ");


      $datosFinal=array_merge($datos2,$datos3);*/
      //$result = array_diff($datosOriginal,$datosFinal);
      /*if(empty($datosOriginal)){*/

          /*$estado = "vacio";
          $estado_final=1;*/
         /* $comision = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
          m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
          m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
          m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos
          FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
          WHERE m1.cod_vendedor='$vendedor' and m1.sucursal='$sucursal' and m1.estado=1
          and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          ORDER BY m1.fecha2");*/

          $comision = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
          m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
          m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
          m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos, m1.cod_vendedor,m1.sucursal
          FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
          WHERE m1.estado=1 and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          ORDER BY m1.fecha2");
      
         /* $comision1=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
          m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
          m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
          m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos
          FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
          WHERE m1.cod_vendedor='$vendedor' and m1.sucursal='$sucursal' and m1.estado=1
          and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
          ORDER BY m2.fecha_pago");*/
    
          $comision1=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
          m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
          m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
          m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos, m1.cod_vendedor,m1.sucursal
          FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
          WHERE m1.estado=1 and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
          and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
          ORDER BY m2.fecha_pago");
          foreach($comision as $num)
          {
            $folio=$num->folio;
            $id_venta=$num->id_venta;
            $proc_folio_pedido=$num->proc_folio_pedido;
            $fecha2=$num->fecha2;
            $forma_pago=$num->forma_pago;
            $cod_vendedor=$num->cod_vendedor;
            $ptotal=$num->ptotal;
            $impuesto=$num->impuesto;
            $adicional=$num->adicional;
            $total=$num->total;
            $rut_cliente=$num->rut_cliente;
            $comision=$num->comision;
            $fecha_pago=$num->fecha_pago;
            $monto=$num->monto;
            $tipo_documento=$num->tipo_documento;
            $n_deposito=$num->n_deposito;
            $iva=$num->iva;
            $cartola=$num->id_cartola_bancos;
            $id_vendedor=$num->cod_vendedor;
            $id_sucursal=$num->sucursal;
      
            if($proc_folio_pedido==null){
      
              $proc_folio_pedido='NULL';
            }
              
              DB::insert("INSERT INTO MODULO_COMISION_VENTA_HIST
              (folio,id_venta,proc_folio_pedido,fecha2,forma_pago,cod_vendedor,ptotal,impuesto,adicional,total,rut_cliente,
              comision,fecha_pago,monto,tipo_documento,n_deposito,año,mes,sucursal,vendedor,iva,cartola)
              VALUES
      
              (convert(varchar,'$num->folio'),	$num->id_venta,$proc_folio_pedido,	convert(date,'$num->fecha2'),	$num->forma_pago,	$num->cod_vendedor,	$num->ptotal,	$num->impuesto,	
              $num->adicional,	$num->total,	convert(varchar,'$num->rut_cliente'),	$num->comision,	convert(date,'$num->fecha_pago'),	$num->monto,	$num->tipo_documento	,'$num->n_deposito',
              '$año','$mes','$id_sucursal','$id_vendedor',$iva,$cartola)");
      
          }
          foreach($comision1 as $num)
          {
                  $folio=$num->folio;
                  $id_venta=$num->id_venta;
                  $proc_folio_pedido=$num->proc_folio_pedido;
                  $fecha2=$num->fecha2;
                  $forma_pago=$num->forma_pago;
                  $cod_vendedor=$num->cod_vendedor;
                  $ptotal=$num->ptotal;
                  $impuesto=$num->impuesto;
                  $adicional=$num->adicional;
                  $total=$num->total;
                  $rut_cliente=$num->rut_cliente;
                  $comision=$num->comision;
                  $fecha_pago=$num->fecha_pago;
                  $monto=$num->monto;
                  $tipo_documento=$num->tipo_documento;
                  $n_deposito=$num->n_deposito;
                  $iva=$num->iva;
                  $cartola=$num->id_cartola_bancos;
                  $id_vendedor=$num->cod_vendedor;
                  $id_sucursal=$num->sucursal;
      
                  if($proc_folio_pedido==null){
      
                    $proc_folio_pedido='NULL';
                  }
                    
                    DB::insert("INSERT INTO MODULO_COMISION_VENTA_HIST
                    (folio,id_venta,proc_folio_pedido,fecha2,forma_pago,cod_vendedor,ptotal,impuesto,adicional,total,rut_cliente,
                    comision,fecha_pago,monto,tipo_documento,n_deposito,año,mes,sucursal,vendedor,iva,cartola)
                    VALUES
      
                    (convert(varchar,'$num->folio'),	$num->id_venta,$proc_folio_pedido,	convert(date,'$num->fecha2'),	$num->forma_pago,	$num->cod_vendedor,	$num->ptotal,	$num->impuesto,	
                    $num->adicional,	$num->total,	convert(varchar,'$num->rut_cliente'),	$num->comision,	convert(date,'$num->fecha_pago'),	$num->monto,	$num->tipo_documento	,'$num->n_deposito',
                    '$año','$mes','$id_sucursal','$id_vendedor',$iva,$cartola)");
      
          }
        /*} 
        else{
          //$result = array_diff($datosOriginal,$datosFinal);
            $estado = "NO REPETIDO";
            foreach($datosOriginal as $valor1){
              foreach($datosFinal as $valor2){
                if($valor1->folio == $valor2->folio){
                  $estado="REPETIDO";
                  break 2;
                }
              }
            }
            if($estado == "NO REPETIDO"){

                $estado_final=1;
                $comision = DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
                m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
                m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
                m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos
                FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
                WHERE m1.cod_vendedor='$vendedor' and m1.sucursal='$sucursal' and m1.estado=1
                and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
                and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
                ORDER BY m1.fecha2");
            
                $comision1=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
                m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
                m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
                m2.fecha_pago, m2.monto, m2.tipo_documento, m2.n_deposito,m1.iva,u.id_cartola_bancos
                FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio INNER JOIN CARTOLA_BANCOS u ON m2.n_deposito = u.deposito OR m2.n_deposito = u.documento 
                WHERE m1.cod_vendedor='$vendedor' and m1.sucursal='$sucursal' and m1.estado=1
                and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
                and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
                ORDER BY m2.fecha_pago");
      
                foreach($comision as $num)
                {
                  $folio=$num->folio;
                  $id_venta=$num->id_venta;
                  $proc_folio_pedido=$num->proc_folio_pedido;
                  $fecha2=$num->fecha2;
                  $forma_pago=$num->forma_pago;
                  $cod_vendedor=$num->cod_vendedor;
                  $ptotal=$num->ptotal;
                  $impuesto=$num->impuesto;
                  $adicional=$num->adicional;
                  $total=$num->total;
                  $rut_cliente=$num->rut_cliente;
                  $comision=$num->comision;
                  $fecha_pago=$num->fecha_pago;
                  $monto=$num->monto;
                  $tipo_documento=$num->tipo_documento;
                  $n_deposito=$num->n_deposito;
                  $iva=$num->iva;
                  $cartola=$num->id_cartola_bancos;
            
                  if($proc_folio_pedido==null){
            
                    $proc_folio_pedido='NULL';
                  }
                    
                    DB::insert("INSERT INTO MODULO_COMISION_VENTA_HIST
                    (folio,id_venta,proc_folio_pedido,fecha2,forma_pago,cod_vendedor,ptotal,impuesto,adicional,total,rut_cliente,
                    comision,fecha_pago,monto,tipo_documento,n_deposito,año,mes,sucursal,vendedor,iva,cartola)
                    VALUES
            
                    (convert(varchar,'$num->folio'),	$num->id_venta,$proc_folio_pedido,	convert(date,'$num->fecha2'),	$num->forma_pago,	$num->cod_vendedor,	$num->ptotal,	$num->impuesto,	
                    $num->adicional,	$num->total,	convert(varchar,'$num->rut_cliente'),	$num->comision,	convert(date,'$num->fecha_pago'),	$num->monto,	$num->tipo_documento	,$num->n_deposito,
                    '$año','$mes','$sucursal','$vendedor',$iva,$cartola)");
            
                }
                foreach($comision1 as $num)
                {
                        $folio=$num->folio;
                        $id_venta=$num->id_venta;
                        $proc_folio_pedido=$num->proc_folio_pedido;
                        $fecha2=$num->fecha2;
                        $forma_pago=$num->forma_pago;
                        $cod_vendedor=$num->cod_vendedor;
                        $ptotal=$num->ptotal;
                        $impuesto=$num->impuesto;
                        $adicional=$num->adicional;
                        $total=$num->total;
                        $rut_cliente=$num->rut_cliente;
                        $comision=$num->comision;
                        $fecha_pago=$num->fecha_pago;
                        $monto=$num->monto;
                        $tipo_documento=$num->tipo_documento;
                        $n_deposito=$num->n_deposito;
                        $iva=$num->iva;
                        $cartola=$num->id_cartola_bancos;
            
                        if($proc_folio_pedido==null){
            
                          $proc_folio_pedido='NULL';
                        }
                          
                          DB::insert("INSERT INTO MODULO_COMISION_VENTA_HIST
                          (folio,id_venta,proc_folio_pedido,fecha2,forma_pago,cod_vendedor,ptotal,impuesto,adicional,total,rut_cliente,
                          comision,fecha_pago,monto,tipo_documento,n_deposito,año,mes,sucursal,vendedor,iva,cartola)
                          VALUES
            
                          (convert(varchar,'$num->folio'),	$num->id_venta,$proc_folio_pedido,	convert(date,'$num->fecha2'),	$num->forma_pago,	$num->cod_vendedor,	$num->ptotal,	$num->impuesto,	
                          $num->adicional,	$num->total,	convert(varchar,'$num->rut_cliente'),	$num->comision,	convert(date,'$num->fecha_pago'),	$num->monto,	$num->tipo_documento	,$num->n_deposito,
                          '$año','$mes','$sucursal','$vendedor',$iva,$cartola)");
            
                }   
            }
            else{
                $estado_final=2;
            }
            
          
        }

      /*
        /*$asunto = 'Almacenes Con Stock Limitado';
        $destinatario = 'jhonwilbermendozachino@gmail.com';
        

        $mail = new PHPMailer(true);  
        $mail->SMTPDebug = 2;
        $mail->isSMTP();                    
        $mail->Host       = 'smtp.gmail.com';             
        $mail->SMTPAuth   = true;                               
        $mail->Username   = 'jhonwilbermendozachino@gmail.com';
        $mail->Password   = 'Contraseña';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
        $mail->Port       = 587;          
        $mail->setFrom('jhonwilbermendozachino@gmail.com', 'Frigorifico Las Brasas');
        $mail->addAddress($destinatario);
        $mail->isHTML(true);                                 
        $mail->Subject = $asunto;
        $mail->Body    = view('reports/comision-venta/email')->with(compact('asunto'));
        if($mail->send()){
            return json_encode(array("status" => 200, "response" => array("message" => "Correo Enviado")));
        }
        else{
            return response()->json(array("status" => 100, "message" => "Error al enviar correo"));
        }//
       
      }
      */
      /*return response()->json([

        //'comision'    =>$comision,
        //'comision1'   =>$comision1,
        //'comision2'   =>$comision2,
        'estado'      =>$estado,
        'datosFinal'  =>$datosFinal,
        //'result'      =>$result,
        'datosOriginal'=>$datosOriginal,
        'estadoFinal'  =>$estado_final
      ]);*/
    }
  }
  public function comisiones(Request $request){

    if (request() -> ajax()){

      $comisiones= DB::select("SELECT id_vendedor, nombre_vendedor, ISNULL(nivel1,'') as nivel1,ISNULL(comision1,'') as comision1,ISNULL(nivel2,'') as nivel2,ISNULL(comision2,'') as comision2,ISNULL(nivel3,'') as nivel3,ISNULL(comision3,'') as comision3 FROM ADM_VENDEDOR_PARAMETROS_COMISION");
      return response()->json([

        'comisiones'              =>$comisiones

      ]);
    }
  }
  public function comisiones1(Request $request){
    
    $data= Comision::select("*")->paginate(10);
      return response()->json([
        'pagination' => [
          'total'         => $data->total(),
          'current_page'  => $data->currentPage(),
          'per_page'      => $data->perPage(),
          'last_page'     => $data->lastPage(),
          'from'          => $data->firstItem(),
          'to'            => $data->lastItem(),
        ],
        'pagos'              =>$data

      ]);

  }

  public function updateVendedor(Request $request){
    if(request() -> ajax()){

      DB::update("UPDATE [dbo].[ADM_VENDEDOR_PARAMETROS_COMISION]
                  SET [nivel1] = $request->nivel1
                      ,[comision1] = $request->comision1
                      ,[nivel2] = $request->nivel2
                      ,[comision2] = $request->comision2
                      ,[nivel3] = $request->nivel3
                      ,[comision3] = $request->comision3
                  WHERE id_vendedor=$request->id");
    }

  }
  public function getDetalles1(Request $request){

    if($request -> ajax()){

      $año = $request->gestion;
      $mes = $request->mes;

      //$fechaInicio = DB::select("SELECT fecha=DATEFROMPARTS($año,$mes,1)");
      //$fechaFinal = DB::select("SELECT fecha=EOMONTH(DATEFROMPARTS($año,$mes,1))");

     

      $validado = DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
      FROM MODULO_COMISION_VENTA_HIST m2
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal' and m2.año='$año' and m2.mes='$mes'
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m2.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $validado1=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m2.ptotal-(m2.impuesto+m2.adicional+m2.iva))) as total
      FROM MODULO_COMISION_VENTA_HIST m2
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m2.vendedor='$request->vendedor' and m2.sucursal='$request->sucursal'  and m2.año='$año' and m2.mes='$mes'
      and m2.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m2.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $detalle2=DB::select("SELECT m2.tipo_documento, m3.TPDC_DESCRIPCION,count(m2.tipo_documento) as documento,sum((m1.ptotal-(m1.impuesto+m1.adicional+m1.iva))) as total
      FROM MODULO_VENTA_HIST m1 INNER JOIN CREDITO_HISTORIAL_CLIENTES m2 ON m1.folio = m2.folio
      INNER JOIN ADM_TP_DOCUMENTO m3 ON m2.tipo_documento=m3.TPDC_CODIGO
      WHERE m1.cod_vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.estado=1
      and m2.fecha_pago IS NULL
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      GROUP BY m3.TPDC_DESCRIPCION,m2.tipo_documento");

      $fecha_actual=DB::select("SELECT DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      $fecha_anterior=DB::select("SELECT DATENAME(month,EOMONTH(DATEFROMPARTS($año,$mes,1),-1)) as mesAnt, DATENAME(year,EOMONTH (DATEFROMPARTS($año,$mes,1),-1)) as añoAnt, DATENAME(month,DATEFROMPARTS($año,$mes,1)) as mes, DATENAME(year,DATEFROMPARTS($año,$mes,1)) as año");

      //$fecha_siguiente=DB::select("");


      return response()->json([

        
        'detalle2'   =>$detalle2,
        'fecha_actual' =>$fecha_actual,
        'fecha_anterior'=>$fecha_anterior,
        'validado'    =>$validado,
        'validado1'   =>$validado1

      ]);
    }
  }
  public function getComision1(Request $request){
    if($request -> ajax()){

      $año = $request->gestion;
      $mes = $request->mes;

      //$fechaInicio = DB::select("SELECT fecha=DATEFROMPARTS($año,$mes,1)");
      //$fechaFinal = DB::select("SELECT fecha=EOMONTH(DATEFROMPARTS($año,$mes,1))");

    
      $comisionvalidado = DB::select("SELECT *
      FROM MODULO_COMISION_VENTA_HIST m1
      WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$año'
      and m1.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      ORDER BY m1.fecha2");

      $comisionvalidado1 =   DB::select("SELECT *
      FROM MODULO_COMISION_VENTA_HIST m1
      WHERE m1.vendedor='$request->vendedor' and m1.sucursal='$request->sucursal' and m1.mes='$mes' and m1.año='$año'
      and m1.fecha_pago BETWEEN DATEFROMPARTS($año,$mes,1) AND EOMONTH(DATEFROMPARTS($año,$mes,1))
      and m1.fecha2 BETWEEN DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,DATEFROMPARTS($año,$mes,1)),0)) AND EOMONTH (DATEFROMPARTS($año,$mes,1),-1)
      ORDER BY m1.fecha_pago");

      $comision2=DB::select("SELECT m1.folio, m1.id_venta, m1.proc_folio_pedido, m1.fecha2, m1.forma_pago,
      m1.cod_vendedor, m1.ptotal, m1.impuesto, m1.adicional,
      m1.total, m1.rut_cliente, (m1.ptotal-(m1.impuesto+m1.adicional+m1.iva)) as comision,
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

       
        'comision2'   =>$comision2,
        'fecha_actual' =>$fecha_actual,
        'fecha_anterior'=>$fecha_anterior,
        'comisionvalidado' =>$comisionvalidado,
        'comisionvalidado1' =>$comisionvalidado1


      ]);
    }
  }
  
}
