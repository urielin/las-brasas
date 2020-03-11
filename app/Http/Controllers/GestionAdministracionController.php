<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GestionAdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $clasificaciones = DB::SELECT("SELECT  cod_int, desc01
                            FROM    dbsys.camiones_clasificacion
                            WHERE cod_int > 0
                            ORDER BY cod_int");

          $estados        = DB::select("SELECT    CAM_ESTADO, CAM_DESCEST
                            FROM         dbsys.camiones_tp_estados");

          $unidades       = DB::select("SELECT     TUME_CODIGO, TUME_DESCR
                            FROM         ADM_TP_UNIDMEDIDA
                            WHERE     (mercancia = 1)
                            ORDER BY TUME_DESCR");

          $tipoMonedas    = DB::select("SELECT     TMDA_CODIGO, TMDA_DESCRIPCION
                            FROM         ADM_TP_MONEDA
                            WHERE     (estado = 1)");

          $formaPagos    = DB::select("SELECT     cod_int, desc01
                            FROM         dbsys.parametros
                            WHERE     (tabla = N'CAMIONES_FORMA_PAGO')
                            ORDER BY cod_int");
          $formaPagosDias    = DB::select("SELECT     cod_int, desc01
                                FROM         dbsys.parametros
                                WHERE     (tabla = N'CAMIONES_DIAS_PAGO')
                                ORDER BY cod_int");

          $formaPagosFechas    = DB::select("SELECT     cod_int, desc01
                                  FROM         dbsys.parametros
                                  WHERE     (tabla = N'CAMIONES_FECHA_POST_PAGO')
                                  ORDER BY cod_int");

          $lugarArribos        = DB::select("SELECT     ciudad_codigo, descripcion
                                  FROM         ADM_CIUDAD");

          $navieras            = DB::select("SELECT     NAV_CODIGO, NAV_DETALLE
                                  FROM         ADM_TP_NAVIERAS");

          $agencias            = DB::select("SELECT     AGE_CODIGO, AGE_DETALLE
                                  FROM         ADM_TP_AGENCIAS");

          $tramites            = DB::select("SELECT     cod_txt, desc01
                                  FROM         dbsys.parametros_aduana
                                  WHERE     (tabla = N'TRAMITE_TIPO')");


          $mercanciaOrigenes    = DB::select("SELECT     cod_txt, desc01
                                  FROM         dbsys.parametros_aduana
                                  WHERE     (tabla = 'PROCEDENCIAS')");


          $zonasFrancas    = DB::select("SELECT     cod_int, desc01
                                  FROM         dbsys.parametros_aduana
                                  WHERE     (tabla = 'ZONAS_FRANCAS_EXTENSION')");

          $zonasExportaciones    = DB::select("SELECT     cod_int, desc01
                                    FROM         dbsys.parametros_aduana
                                    WHERE     (tabla = 'ZONAS_EXPORTACION')");

          $zonaFrancas    = DB::select("SELECT     cod_int, desc01
                                      FROM         dbsys.parametros_aduana
                                      WHERE     (tabla = 'ZONAS_FRANCAS')");

          $regiones    = DB::select("SELECT     cod_txt, desc01
                                FROM         dbsys.parametros_aduana
                                WHERE     (tabla = 'REGIONES')");

          $transportes    = DB::select("SELECT     cod_int, desc01
                              FROM         dbsys.parametros_aduana
                              WHERE     (tabla = 'MEDIOS_TRANSPORTE')");

          $transExts    = DB::select("SELECT     cod_txt, desc01
                            FROM         dbsys.parametros_aduana
                            WHERE     (tabla = '_SINO_')");

          $transNal    = DB::select("SELECT     cod_txt, desc01
                          FROM         dbsys.parametros_aduana
                          WHERE     (tabla = '_SINO_')");

          $clausulas    = DB::select("SELECT     cod_txt, desc01
                          FROM         dbsys.parametros_aduana
                          WHERE     (tabla = N'CLAUSULA_TIPO')");

           $sucursales  = DB::select("SELECT      SUCU_CODIGO, SUCU_UBICACION,SUCU_NOMBRE
                           FROM         ADM_SUCURSAL
                           WHERE     (SUCU_ESTADO = 1)
                           ORDER BY SUCU_CODIGO");

          return view('gestion.gestionAdministracion')->with(compact('clasificaciones'))->with(compact('estados'))->with(compact('unidades'))->with(compact('tipoMonedas'))->with(compact('formaPagos'))
          ->with(compact('formaPagosDias'))->with(compact('formaPagosFechas'))->with(compact('lugarArribos'))->with(compact('navieras'))
          ->with(compact('agencias'))->with(compact('tramites'))->with(compact('mercanciaOrigenes'))->with(compact('zonasFrancas'))->with(compact('zonasExportaciones'))
          ->with(compact('zonaFrancas'))->with(compact('regiones'))->with(compact('transportes'))->with(compact('transExts'))
          ->with(compact('transNal'))->with(compact('clausulas'))->with(compact('sucursales'));
    }

    public function administrarTablaClasificacion(Request $request)
    {
        if ($request->ajax()) {
            $camiones = DB::SELECT("  SELECT * FROM dbsys.camiones c
                     inner join dbsys.camiones_clasificacion cc on c.clasif_mercancia = cc.cod_int
                WHERE  cc.cod_int ='$request->clasificacion' and  estado = '$request->estado'");


            return response()->json([
                'camiones'        =>$camiones
            ]);
        }

    }
    public function administrarTablaCodigo(Request $request)
    {
        if ($request->ajax()) {
            $camiones = DB::SELECT(" SELECT * FROM dbsys.camiones where codigo = '$request->codigo' ");


            return response()->json([
                'camiones'        =>$camiones
            ]);
        }

    }

    public function administrarDetalleCamion(Request $request)
    {
        if ($request->ajax()) {
            $camionesDetalle = DB::SELECT(" SELECT * FROM dbsys.camiones where id_camion = '$request->id_camion' ");

            $camionesAutorizacionDetalle = DB::SELECT(" SELECT * FROM dbsys.camiones_autorizaciones WHERE id_camion = '$request->id_camion' ");

            $camionesAdjuntoDetalle = DB::SELECT(" SELECT * FROM dbsys.camiones_adjuntos WHERE id_camion = '$request->id_camion' ");

            $camionesBultoDetalle = DB::SELECT(" SELECT * FROM  dbsys.camiones_bultos WHERE id_camion = '$request->id_camion' ");

            $camionesContenedorDetalle = DB::SELECT(" SELECT * FROM dbsys.camiones_contenedor WHERE id_camion = '$request->id_camion' ");

            $camionesItems=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                              ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                                , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                                    inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                                      inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                                      left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                                      WHERE  c.id_camion = '$request->id_camion' ORDER BY nro_item asc ");

            return response()->json([
                'camionesDetalle'               =>$camionesDetalle,
                'camionesAutorizacionDetalle'   =>$camionesAutorizacionDetalle,
                'camionesAdjuntoDetalle'        =>$camionesAdjuntoDetalle,
                'camionesBultoDetalle'          =>$camionesBultoDetalle,
                'camionesContenedorDetalle'     =>$camionesContenedorDetalle,
                'camionesItems'                 =>$camionesItems
            ]);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
