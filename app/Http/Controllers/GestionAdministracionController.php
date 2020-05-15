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

          $gestiones      = DB::select("SELECT TP_GESTION FROM dbo.ADM_TP_GESTION order by TP_GESTION desc ");

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

          return view('gestion.gestionAdministracion')->with(compact('clasificaciones'))->with(compact('estados'))->with(compact('gestiones'))->with(compact('unidades'))->with(compact('tipoMonedas'))->with(compact('formaPagos'))
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
                WHERE  cc.cod_int ='$request->clasificacion' and  estado = '$request->estado' and YEAR(fecha_llegada) = '$request->gestion' order by id_camion desc");


            return response()->json([
                'camiones'        =>$camiones
            ]);
        }

    }

    public function prueba(Request $request)
    {
      return view('gestion.prueba');
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


    public function administrarAgregarCamion(Request $request)
    {
        if ($request->ajax()) {

            $existe = DB::SELECT("SELECT * FROM dbsys.camiones Where codigo = '$request->codigo_agregar'");

            if ($existe != null) {

                $camionAgregar =  '1';
            }else {
                // $fecha_agregar  = date('d-m-Y H:i:s', strtotime($request->fecha_agregar));

                DB::insert("INSERT INTO dbsys.camiones (codigo, descripcion, contenido,codigo_aux, ingreso_zeta, ingreso_zeta_fecha,observaciones, estado,declara_tipo_transp )
                VALUES ('$request->codigo_agregar' ,'$request->descripcion_agregar','$request->contenido_agregar', '$request->auxiliar_agregar','$request->documento_agregar',GETDATE(),'$request->observaciones_agregar','1','$request->declara_tipo_transpN')");

                $camionAgregar = '0';
            }

            return response()->json([
                'camionAgregar'               =>$camionAgregar
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

            $camionesItems=DB::select("SELECT c.id_camion, nro_item, esp_nombre, cd.codigo, producto=(ac.CODI_RNOMBRE+'-'+ISNULL(atu.tume_sigla, ' ***** '))
                              FROM dbsys.camiones c
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

    public function upDatosGenerales(Request $request)
    {
        if ($request->ajax()) {

          $fecha_cierre       = date('d-m-Y H:i:s', strtotime($request->fecha_cierre));
          $fecha_embarque1    = date('d-m-Y H:i:s', strtotime($request->fecha_embarque1));
          $fecha_embarque2    = date('d-m-Y H:i:s', strtotime($request->fecha_embarque2));
          $fecha_llegada1     = date('d-m-Y H:i:s', strtotime($request->fecha_llegada1));
          $fecha_llegada2     = date('d-m-Y H:i:s', strtotime($request->fecha_llegada2));
          $fecha_produccion   = date('d-m-Y H:i:s', strtotime($request->fecha_produccion));
          $fecha_produccion2  = date('d-m-Y H:i:s', strtotime($request->fecha_produccion2));
          $fecha_vencimiento  = date('d-m-Y H:i:s', strtotime($request->fecha_vencimiento));
          $fecha_vencimiento2 = date('d-m-Y H:i:s', strtotime($request->fecha_vencimiento2));

          DB::update("UPDATE dbsys.camiones
                          set
                          codigo='$request->codigo_detalle',
                          codigo_aux='$request->codigo_aux',
                          estado='$request->estado_detalle',
                          descripcion='$request->descripcion',
                          contenido='$request->contenido',
                          observaciones='$request->observaciones',
                          proveedor='$request->proveedor',
                          marca_origen='$request->marca_origen',
                          clasif_mercancia='$request->clasif_mercancia',
                          fecha_cierre='$fecha_cierre',
                          cantidad_unidades='$request->cantidad_unidades',
                          tipo_unidades='$request->tipo_unidades',

                          monto_unitario='$request->monto_unitario',
                          monto_cierre='$request->monto_cierre',
                          tipo_moneda='$request->tipo_moneda',
                          forma_pago='$request->forma_pago',
                          despues_dias='$request->despues_dias',
                          despues_fecha='$request->despues_fecha',
                          lugar_arribo='$request->lugar_arribo',

                          fecha_embarque1='$fecha_embarque1',
                          fecha_embarque2='$fecha_embarque2',
                          fecha_llegada1='$fecha_llegada1',
                          fecha_llegada2='$fecha_llegada2',
                          fecha_produccion='$fecha_produccion',
                          fecha_produccion2='$fecha_produccion2',
                          fecha_vencimiento='$fecha_vencimiento',
                          fecha_vencimiento2='$fecha_vencimiento2',
                          observacion_fecha='$request->observacion_fecha'
                          FROM dbsys.camiones where id_camion = '$request->id_codigo_detalle'
                    ");

              return response()->json([
                'success'=>'Los datos fueron actualizados exitosamente'
                    ]);
        }

    }

    public function upDatosLogistica(Request $request)
    {
        if ($request->ajax()) {

          $fecha_embarque               = date('d-m-Y H:i:s', strtotime($request->fecha_embarque));
          $fecha_declaracion            = date('d-m-Y H:i:s', strtotime($request->fecha_declaracion));
          $fecha_transbordo             = date('d-m-Y H:i:s', strtotime($request->fecha_transbordo));
          $fecha_llegada_estimada       = date('d-m-Y H:i:s', strtotime($request->fecha_llegada_estimada));
          $fecha_llegada                = date('d-m-Y H:i:s', strtotime($request->fecha_llegada));
          $fecha_descarga               = date('d-m-Y H:i:s', strtotime($request->fecha_descarga));
          $fecha_devolucion_contenedor  = date('d-m-Y H:i:s', strtotime($request->fecha_devolucion_contenedor));
          $fecha_cumplimiento           = date('d-m-Y H:i:s', strtotime($request->fecha_cumplimiento));
          $fecha_finalizacion           = date('d-m-Y H:i:s', strtotime($request->fecha_finalizacion));

          DB::update("UPDATE dbsys.camiones

                          set
                          fecha_embarque='$fecha_embarque',
                          fecha_declaracion='$fecha_declaracion',
                          fecha_transbordo='$fecha_transbordo',
                          fecha_llegada_estimada='$fecha_llegada_estimada',
                          fecha_llegada='$fecha_llegada',
                          fecha_descarga='$fecha_descarga',
                          fecha_devolucion_contenedor='$fecha_devolucion_contenedor',
                          fecha_cumplimiento='$fecha_cumplimiento',
                          fecha_finalizacion='$fecha_finalizacion'
                          FROM dbsys.camiones where id_camion = '$request->id_codigo_logistica'
                    ");

              return response()->json([
                'success'=>'Los datos fueron actualizados exitosamente'
                    ]);
        }

    }

    public function upDatosTecnicos(Request $request)
    {
        if ($request->ajax()) {

          $ingreso_zeta_fecha               = date('d-m-Y H:i:s', strtotime($request->ingreso_zeta_fecha));

          DB::update("UPDATE dbsys.camiones
            set
                    naviera='$request->naviera',
                    agencia='$request->agencia',
                    transporte_nombre='$request->transporte_nombre',
                    ingreso_zeta='$request->ingreso_zeta',
                    ingreso_zeta_fecha='$ingreso_zeta_fecha',
            	      declara_tramite='$request->declara_tramite',
                    declara_origen='$request->declara_origen',
                    declara_zona_ext='$request->declara_zona_ext',
                    declara_zona_exp='$request->declara_zona_exp',
                    declara_zona_franca='$request->declara_zona_franca',
            	      declara_region='$request->declara_region',
                    declara_tipo_transp='$request->declara_tipo_transp',
                    declara_pais_origen='$request->declara_pais_origen',
                    declara_pais_procedencia='$request->declara_pais_procedencia',
            	      declara_puerto_embarque='$request->declara_puerto_embarque',
                    declara_trasb_ext='$request->declara_trasb_ext',
                    declara_trasb_nal='$request->declara_trasb_nal',
                    declara_almacen='$request->declara_almacen',
                    declara_almacen_ubic='$request->declara_almacen_ubic',
            	      declara_clausula='$request->declara_clausula',
                    valor_flete='$request->valor_flete',
                    valor_seguro='$request->valor_seguro',
                    valor_fob='$request->valor_fob',
                    valor_total='$request->valor_total',
                    valor_total_nal='$request->valor_total_nal',
                    sucursal='$request->sucursal'

                FROM dbsys.camiones where id_camion = '$request->id_codigo_tecnico'
                    ");

              return response()->json([
                'success'=>'Los datos fueron actualizados exitosamente'
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
