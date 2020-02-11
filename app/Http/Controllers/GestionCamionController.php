<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;
use Validator;

class GestionCamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // $year=DbsysCamiones::select(('fecha_llegada'))->distinct()->get();
      // $year=DB::select('SELECT DISTINCT fecha_llegada=YEAR(fecha_llegada) FROM dbsys.camiones UNION
      // SELECT DISTINCT fecha_llegada=YEAR(fecha_viza) FROM dbo.ADM_TRASLADO_SALIDA_EXT order by fecha_llegada desc ');



      // $clasificaciones=DB::select('SELECT  * FROM dbo.ADM_CLASIFICACIONCODIGO');
      // $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

      // $year->distinct();
      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();

      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();
      // $y=date('Y', strtotime($request->Mes_cambiar));

      // return view('gestion-camion')->with(compact('datos'))->with(compact('year'));
      $year=DB::select('SELECT TP_GESTION FROM dbo.ADM_TP_GESTION order by TP_GESTION desc ');
      $datos=GestionCamion::where('camion', '0')->get();

      // return $datos;
      return view('gestion-camion')->with(compact('year'))->with(compact('datos'));
      // dd($year1);

        // return view('gestion-camion',compact('datos'));
        // return view('gestion-camion');

        // $y=date('Y', strtotime($request->Mes_cambiar));
        // $m=date('m', strtotime($request->Mes_cambiar));
        // \App\TipoCambio::whereYear('CAMB_FECHA', $y)->whereMonth('CAMB_FECHA', $m)->update($form_data);
        // return redirect('tipo-cambio')->with('success','Mes actualizado correctamente. ');

    }

    public function indexr()
    {

      // $year=DB::select('SELECT DISTINCT fecha_llegada=YEAR(fecha_llegada) FROM dbsys.camiones UNION
      // SELECT DISTINCT fecha_llegada=YEAR(fecha_viza) FROM dbo.ADM_TRASLADO_SALIDA_EXT order by fecha_llegada desc ');
      // $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');
      // $datos=GestionCamion::where('camion', '0')->get();
      //
      // return view('gestion-camion-r')->with(compact('year'))->with(compact('datos'))->with(compact('clasificaciones'));
      $year=DB::select('SELECT TP_GESTION FROM dbo.ADM_TP_GESTION order by TP_GESTION desc ');
      $datos=GestionCamion::where('camion', '0')->get();


      return view('gestion-camion-r')->with(compact('year'))->with(compact('datos'));

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
        $rules = array(
          'first_name' => 'required',
          'last_name'  => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails())
        {
          return response()->json(['errors'=>$error->errors()->all]);
        }

        $form_data = array(
          'first_name'    => $request->first_name,
          'last_name'     => $request->last_name
        );

        Sample_data::create($form_data);

        return response()->json([
          'success'  => 'Data Added successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if ($request -> ajax()) {

                $rules = array(
                  'codigo' => 'required',
                  // 'codigo' => 'required',
                  // 'cantidad_cierre' => 'required',
                  // 'bultos_ingreso' => 'required',
                  // 'cantidad_ingreso' => 'required',
                  // 'cif_moneda_ext' => 'required',
                  // 'viu_moneda_nal' => 'required',
                  // 'precio_compra' => 'required'
                );

                $error = Validator::make($request->all(),$rules);

                      if ($error->fails()) {
                        return response()->json([
                          'errors' => $error->errors()->all()
                        ]);
                      }
                      // return response()->json(['success'=>'Los datos fueron
                      //       actualizados exitosamente',
                      //       'aea'=>'Los datos fueron
                      //               actualizados exitosamente'
                      //
                      //     ]);

                                  $documentos=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                                    ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                                      , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                                          inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                            							  inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                            							  left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                            								WHERE  c.codigo ='$request->codigo' and c.estado = '1' ");

                                            $clasificaciones_camion=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

                                            $proveedor_camion=DB::select('SELECT  * from dbo.ADM_PROVEEDOR');

                                            $marca_origen=DB::select('SELECT  * from dbo.ADM_MARCA');

                                            $lugar_de_arribo=DB::select('SELECT  * from dbo.ADM_CIUDAD');

                                            $forma_pago=DB::select('SELECT  * from dbo.ADM_FORMAPAGO');

                                            $unidad=DB::select('SELECT * from dbo.ADM_TP_UNIDMEDIDA');

                                            $tipo_moneda=DB::select('SELECT * from dbo.ADM_TP_MONEDA');

                                            $dato_general=DB::select("SELECT codigo, doc_contenedor, clasif_mercancia,proveedor,
                                                      marca_origen ,    descripcion,        contenido,observaciones,
                                                      lugar_arribo ,     codigo_aux,      pais_origen, doc_bl,

                                                      fecha_cierre, fecha_embarque1, fecha_embarque2, fecha_llegada1,fecha_llegada2, observacion_fecha

                                                      forma_pago, despues_dias, despues_fecha,

                                                      fecha_embarque, fecha_llegada, resolucion_sanitaria, fecha_resolucion,
                                                      forward, forward_fecha, fecha_produccion, fecha_produccion2,
                                                      fecha_vencimiento, fecha_vencimiento2,

                                                      factura_nro, cantidad_unidades, tipo_unidades, valor_total, tipo_moneda, tratamiento_camion
                                                      FROM dbsys.camiones
                                                      WHERE  codigo ='$request->codigo'");


                                          // return response()->json($documentos);
                                          // return response()->json([
                                          //       'documentos' => $documentos,
                                          //       'datos_generales' => $dato_general
                                          //   ]);

                                          return response()->json([
                                            'documento'              =>$documentos,
                                            'dato_general'           =>$dato_general,
                                            'clasificaciones_camion' =>$clasificaciones_camion,
                                            'proveedor_camion'       =>$proveedor_camion,
                                            'marca_origen'           =>$marca_origen,
                                            'lugar_de_arribo'        =>$lugar_de_arribo,
                                            'forma_pago'             =>$forma_pago,
                                            'unidad'                 =>$unidad,
                                            'tipo_moneda'            =>$tipo_moneda
                                          ]);


        }



      // $year=DB::select('SELECT TP_GESTION FROM dbo.ADM_TP_GESTION order by TP_GESTION desc ');

        // $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

        // $datos=DbsysCamiones::where('codigo', $request->codigo)->get();

            // return view('gestion-camion')->with(compact('datos'))->with(compact('year'));

    }

    public function showr(Request $request)
    {

      if ($request -> ajax()) {

              $rules = array(
                'codigo' => 'required',
                // 'codigo' => 'required',
                // 'cantidad_cierre' => 'required',
                // 'bultos_ingreso' => 'required',
                // 'cantidad_ingreso' => 'required',
                // 'cif_moneda_ext' => 'required',
                // 'viu_moneda_nal' => 'required',
                // 'precio_compra' => 'required'
              );

              $error = Validator::make($request->all(),$rules);

                    if ($error->fails()) {
                      return response()->json([
                        'errors' => $error->errors()->all()
                      ]);
                    }
                    // return response()->json(['success'=>'Los datos fueron
                    //       actualizados exitosamente',
                    //       'aea'=>'Los datos fueron
                    //               actualizados exitosamente'
                    //
                    //     ]);

                    $documentos=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                      ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                        , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                            inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                              inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                              left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                              WHERE  c.codigo ='$request->codigo' and c.estado = '2' ");

                                          $clasificaciones_camion=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

                                          $proveedor_camion=DB::select('SELECT  * from dbo.ADM_PROVEEDOR');

                                          $marca_origen=DB::select('SELECT  * from dbo.ADM_MARCA');

                                          $lugar_de_arribo=DB::select('SELECT  * from dbo.ADM_CIUDAD');

                                          $forma_pago=DB::select('SELECT  * from dbo.ADM_FORMAPAGO');

                                          $unidad=DB::select('SELECT * from dbo.ADM_TP_UNIDMEDIDA');

                                          $tipo_moneda=DB::select('SELECT * from dbo.ADM_TP_MONEDA');

                                          $dato_general=DB::select("SELECT codigo, doc_contenedor, clasif_mercancia,proveedor,
                                                    marca_origen ,    descripcion,        contenido,observaciones,
                                                    lugar_arribo ,     codigo_aux,      pais_origen, doc_bl,

                                                    fecha_cierre, fecha_embarque1, fecha_embarque2, fecha_llegada1,fecha_llegada2, observacion_fecha

                                                    forma_pago, despues_dias, despues_fecha,

                                                    fecha_embarque, fecha_llegada, resolucion_sanitaria, fecha_resolucion,
                                                    forward, forward_fecha, fecha_produccion, fecha_produccion2,
                                                    fecha_vencimiento, fecha_vencimiento2,

                                                    factura_nro, cantidad_unidades, tipo_unidades, valor_total, tipo_moneda, tratamiento_camion
                                                    FROM dbsys.camiones
                                                    WHERE  codigo ='$request->codigo'");


                                        // return response()->json($documentos);
                                        // return response()->json([
                                        //       'documentos' => $documentos,
                                        //       'datos_generales' => $dato_general
                                        //   ]);

                                        return response()->json([
                                          'documento'              =>$documentos,
                                          'dato_general'           =>$dato_general,
                                          'clasificaciones_camion' =>$clasificaciones_camion,
                                          'proveedor_camion'       =>$proveedor_camion,
                                          'marca_origen'           =>$marca_origen,
                                          'lugar_de_arribo'        =>$lugar_de_arribo,
                                          'forma_pago'             =>$forma_pago,
                                          'unidad'                 =>$unidad,
                                          'tipo_moneda'            =>$tipo_moneda
                                        ]);


      }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
          $data = Sample_data::findOrFail($id);
          return response()->json(['result' => $data]);
        }
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


    }

    public function getCamion(Request $request)
    {

          if ($request -> ajax()) {

              if ($request->clasificacion_id != 'OTROS') {
                $camiones=DB::select("SELECT camion=CAST(codigo AS NVARCHAR(20)) 
                FROM dbsys.camiones c
                     inner join dbsys.camiones_clasificacion cc on c.clasif_mercancia = cc.cod_int
                WHERE  cc.desc01  LIKE '%'+'$request->clasificacion_id'+'%' and YEAR(fecha_llegada) = $request->anio_id and estado = '1'");

              }





          if ($camiones != null) {
            foreach ($camiones as $camion) {
              $camionArray[$camion->camion] = $camion->camion ;
            }
            return response()->json($camionArray);

          }else {
            $camionArray['1'] = 'Camiones no encontrados' ;
            return response()->json($camionArray);
          }
          // return $camionArray;
        }
    }

    public function getCamionr(Request $request)
    {

          if ($request -> ajax()) {

                if ($request->clasificacion_id != 'OTROS') {

                  $camiones=DB::select("SELECT camion=CAST(codigo AS NVARCHAR(20))
                  FROM dbsys.camiones c
                       inner join dbsys.camiones_clasificacion cc on c.clasif_mercancia = cc.cod_int
                  WHERE  cc.desc01  LIKE '%'+'$request->clasificacion_id'+'%' and YEAR(fecha_llegada) = $request->anio_id and estado = '2'");
                }


              if ($camiones != null) {
                foreach ($camiones as $camion) {
                  $camionArray[$camion->camion] = $camion->camion ;
                }
                return response()->json($camionArray);

              }else {
                $camionArray['1'] = 'Camiones no encontrados' ;
                return response()->json($camionArray);
              }
        }
    }
  // $datos=GestionCamion::where('camion', $request->codigo)->get();

  public function test(Request $request)
  {
  // ----------------------  Union de tablas inner join  ----------------------

  // $documento=DB::select("SELECT  ingreso_zeta FROM dbsys.camiones  WHERE codigo = '15PO15' ");
  // $doc=$documento
  // return $doc;

  // $camiones=DB::select("SELECT MERC_RZETA, CODI_RCODIGO, MERC_RENTRADA FROM dbo.ADM_MERCANCIA WHERE MERC_RZETA LIKE '101-15-015954'+'%' ");
  // return $camiones;

// ------------Declaracion de arreglos--------------
      // $ingenieros= [
      //         0=>  [
      //                 'nombre'      =>'Diego',
      //                 'especialidad'=>'Informatica'
      //              ],
      //         1=>  [
      //                 'nombre'      =>'Walter',
      //                 'especialidad'=>'Comercial'
      //              ],
      //
      //         2=>  [
      //                 'nombre'      =>'Marco',
      //                 'especialidad'=>'Minas'
      //              ]
      // ];
      //
      // // return $ingenieros;
      // // $ingenieros[3]['nombre']= 'Alberth';
      // // $ingenieros[3]['especialidad']='Mecanica'
      //
      // $ingenieros+= [
      // 3=>  [
      //         'nombre'      =>'Alberth',
      //         'especialidad'=>'Mecanica'
      //      ]
      //    ];
      // return view('test')->with(compact('ingenieros')) ;


  }

  public function getclasificacion(Request $request)
  {
    if ($request -> ajax()) {

      $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');
      // $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');


          foreach ($clasificaciones as $clasificacion) {
            $clasificacionArray[$clasificacion->cod_int] = $clasificacion->desc01 ;
          }
          return response()->json($clasificacionArray);
          // return $camionArray;
      }
  }


public function changeBloqueoCamion(Request $request)
{
  if ($request -> ajax()) {

    DB::update("UPDATE dbsys.camiones
                set bloqueo_camion='$request->bloqueo_2_id'
                where codigo= '$request->camion_id'");


        DB::update("UPDATE dbsys.camiones_detalle
                    set bloqueo_2='$request->bloqueo_2_id'
                    where camion_codigo= '$request->camion_id' ");

                            $documentos=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                              ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                                , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                      inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                                      inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                                      left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                                      WHERE  c.codigo ='$request->camion_id' ");

      return response()->json($documentos);


  }
}

    public function gettablecamion(Request $request)
    {
      if ($request -> ajax()) {

                                $documentos=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                                  ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                                    , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                          inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                          							  inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                          							  left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                          								WHERE  c.codigo ='$request->camion_id' ");

                                $clasificaciones_camion=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

                                $proveedor_camion=DB::select('SELECT  * from dbo.ADM_PROVEEDOR');

                                $marca_origen=DB::select('SELECT  * from dbo.ADM_MARCA');

                                $lugar_de_arribo=DB::select('SELECT  * from dbo.ADM_CIUDAD');

                                $forma_pago=DB::select('SELECT  * from dbo.ADM_FORMAPAGO');

                                $unidad=DB::select('SELECT * from dbo.ADM_TP_UNIDMEDIDA');

                                $tipo_moneda=DB::select('SELECT * from dbo.ADM_TP_MONEDA');

                                $dato_general=DB::select("SELECT codigo, doc_contenedor, clasif_mercancia,proveedor,
                                          marca_origen ,    descripcion,        contenido,observaciones,
                                          lugar_arribo ,     codigo_aux,      pais_origen, doc_bl,

                                          fecha_cierre, fecha_embarque1, fecha_embarque2, fecha_llegada1,fecha_llegada2, observacion_fecha,

                                          forma_pago, despues_dias, despues_fecha,

                                          fecha_embarque, fecha_llegada, resolucion_sanitaria, fecha_resolucion,
                                    	    forward, forward_fecha, fecha_produccion, fecha_produccion2,
                                    	    fecha_vencimiento, fecha_vencimiento2,

                                          factura_nro, cantidad_unidades, tipo_unidades, valor_total, tipo_moneda,

                                          id_camion, fecha_declaracion, fecha_transbordo, fecha_llegada_estimada, fecha_descarga, fecha_devolucion_contenedor, fecha_finalizacion

                                          FROM dbsys.camiones
                                          WHERE  codigo ='$request->camion_id'");

            return response()->json([
                'documento'              =>$documentos,
                'dato_general'           =>$dato_general,
                'clasificaciones_camion' =>$clasificaciones_camion,
                'proveedor_camion'       =>$proveedor_camion,
                'marca_origen'           =>$marca_origen,
                'lugar_de_arribo'        =>$lugar_de_arribo,
                'forma_pago'             =>$forma_pago,
                'unidad'                 =>$unidad,
                'tipo_moneda'            =>$tipo_moneda
                ]);


      }
    }


    public function generalCamion(Request $request)
    {
      if ($request -> ajax()) {
              $documentos=DB::select("SELECT codigo, doc_contenedor, clasif_mercancia,proveedor,
                                      marca_origen ,    descripcion,        contenido,observaciones,
                                      lugar_arribo ,     codigo_aux,      pais_origen, doc_bl
                                      FROM dbsys.camiones
                                      WHERE  c.codigo ='$request->camion_id'");
          return response()->json($documentos);
      }
    }

    public function gettablecamionr(Request $request)
    {
      if ($request -> ajax()) {
              $documentos=DB::select("SELECT cd.bloqueo_2,nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
              ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
              , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
              inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
              inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
              left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
              WHERE  c.codigo ='$request->camion_id'");

              $clasificaciones_camion=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

              $proveedor_camion=DB::select('SELECT  * from dbo.ADM_PROVEEDOR');

              $marca_origen=DB::select('SELECT  * from dbo.ADM_MARCA');

              $lugar_de_arribo=DB::select('SELECT  * from dbo.ADM_CIUDAD');

              $forma_pago=DB::select('SELECT  * from dbo.ADM_FORMAPAGO');

              $unidad=DB::select('SELECT * from dbo.ADM_TP_UNIDMEDIDA');

              $tipo_moneda=DB::select('SELECT * from dbo.ADM_TP_MONEDA');


              $dato_general=DB::select("SELECT codigo, doc_contenedor, clasif_mercancia,proveedor,
                        marca_origen ,    descripcion,        contenido,observaciones,
                        lugar_arribo ,     codigo_aux,      pais_origen, doc_bl,

                        fecha_cierre, fecha_embarque1, fecha_embarque2, fecha_llegada1,fecha_llegada2, observacion_fecha,

                        forma_pago, despues_dias, despues_fecha,

                        fecha_embarque, fecha_llegada, resolucion_sanitaria, fecha_resolucion,
                        forward, forward_fecha, fecha_produccion, fecha_produccion2,
                        fecha_vencimiento, fecha_vencimiento2,

                        factura_nro, cantidad_unidades, tipo_unidades, valor_total, tipo_moneda
                        FROM dbsys.camiones
                        WHERE  codigo ='$request->camion_id'");


// return response()->json($documentos);
// return response()->json([
//       'documentos' => $documentos,
//       'datos_generales' => $dato_general
//   ]);

                  return response()->json([
                  'documento'              =>$documentos,
                  'dato_general'           =>$dato_general,
                  'clasificaciones_camion' =>$clasificaciones_camion,
                  'proveedor_camion'       =>$proveedor_camion,
                  'marca_origen'           =>$marca_origen,
                  'lugar_de_arribo'        =>$lugar_de_arribo,
                  'forma_pago'             =>$forma_pago,
                  'unidad'                 =>$unidad,
                  'tipo_moneda'            =>$tipo_moneda
                  ]);


      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }

    public function switchitem(Request $request)
    {
          if ($request -> ajax()) {

            DB::update("UPDATE dbsys.camiones_detalle
                            set bloqueo_2='$request->bloqueo_2_id'
                            where camion_codigo= '$request->camion_id' and nro_item = '$request->item_id'");
              return response()->json();
          }
    }

    public function getembarque(Request $request)
    {
          if ($request -> ajax()) {

                $documentos=DB::select("SELECT *
                FROM dbsys.camiones
                WHERE  codigo ='$request->cod_camion_id'");


            // DB::update("UPDATE dbsys.camiones_detalle
            //                 set bloqueo_2='$request->bloqueo_2_id'
            //                 where camion_codigo= '$request->camion_id' and nro_item = '$request->item_id'");
              return response()->json($documentos);
          }
    }

    public function updategeneralValorTotal(Request $request)
    {
          DB::update("UPDATE dbsys.camiones
                          set
                          factura_nro='$request->factura_proveedor',
                          cantidad_unidades='$request->cantidad_recibida',
                          tipo_unidades='$request->unidad',
                          valor_total='$request->valor_total',
                          tipo_moneda='$request->tipo_de_moneda'


                          FROM dbsys.camiones where codigo = '$request->codigo_oficial_real5'
                    ");
        return response()->json(['success'=>'Los datos fueron
                actualizados exitosamente',
              ]);
    }


    public function updategeneralEmbarque(Request $request)
    {
        // fecha_embarque= CONVERT (Datetime, '$request->fecha_de_embarque_real', 120),
      $fecha_de_embarque_real = date('d-m-Y H:i:s', strtotime($request->fecha_de_embarque_real));
      $fecha_de_llegada = date('d-m-Y H:i:s', strtotime($request->fecha_de_llegada));
      $fecha_de_resol_sanitaria = date('d-m-Y H:i:s', strtotime($request->fecha_de_resol_sanitaria));
      $fecha_forward = date('d-m-Y H:i:s', strtotime($request->fecha_forward));
      $fecha_producción_desde = date('d-m-Y H:i:s', strtotime($request->fecha_producción_desde));
      $fecha_producción_desde_hasta = date('d-m-Y H:i:s', strtotime($request->fecha_producción_desde_hasta));
      $fecha_vencimiento_desde = date('d-m-Y H:i:s', strtotime($request->fecha_vencimiento_desde));
      $fecha_vencimiento_desde_hasta = date('d-m-Y H:i:s', strtotime($request->fecha_vencimiento_desde_hasta));


          DB::update("UPDATE dbsys.camiones
                          set
                          fecha_embarque= '$fecha_de_embarque_real',
                          fecha_llegada= '$fecha_de_llegada',
                          resolucion_sanitaria='$request->resol_sanitaria',
                          fecha_resolucion='$fecha_de_resol_sanitaria' ,
	                        forward='$request->forward',
                          forward_fecha='$fecha_forward',
                          fecha_produccion='$fecha_producción_desde' ,
                          fecha_produccion2='$fecha_producción_desde_hasta' ,
	                        fecha_vencimiento='$fecha_vencimiento_desde' ,
                          fecha_vencimiento2= '$fecha_vencimiento_desde_hasta'
                          FROM dbsys.camiones where codigo = '$request->codigo_oficial_real4'
                    ");
        return response()->json(['success'=>'Los datos fueron
                actualizados exitosamente',
              ]);
    }

    public function updategeneralFecha(Request $request)
    {
          $fecha_de_cierre = date('d-m-Y H:i:s', strtotime($request->fecha_de_cierre));
          $fecha_de_embarque_desde = date('d-m-Y H:i:s', strtotime($request->fecha_de_embarque_desde));
          $fecha_de_embarque_desde_hasta = date('d-m-Y H:i:s', strtotime($request->fecha_de_embarque_desde_hasta));
          $fecha_de_llegada_desde = date('d-m-Y H:i:s', strtotime($request->fecha_de_llegada_desde));
          $fecha_de_llegada_desde_hasta = date('d-m-Y H:i:s', strtotime($request->fecha_de_llegada_desde_hasta));

          DB::update("UPDATE dbsys.camiones
                          set
                          fecha_cierre='$fecha_de_cierre',
                          fecha_embarque1='$fecha_de_embarque_desde',
                          fecha_embarque2= '$fecha_de_embarque_desde_hasta',
                          fecha_llegada1='$fecha_de_llegada_desde',
                          fecha_llegada2= '$fecha_de_llegada_desde_hasta',
                          observacion_fecha ='$request->observacion'

                          FROM dbsys.camiones where codigo = '$request->codigo_oficial_real2'
                    ");
        return response()->json(['success'=>'Los datos fueron
                actualizados exitosamente',
              ]);
    }
    public function updategeneralCamion(Request $request)
    {
          DB::update("UPDATE dbsys.camiones
                          set
                          codigo='$request->codigo_oficial',
                          doc_contenedor='$request->nro_de_contenedor',
                          clasif_mercancia='$request->clasificacion_de_mercancia',
                          proveedor='$request->proveedor',
                          marca_origen='$request->marca_origen',
                          descripcion='$request->descripcion',
                          contenido='$request->contenido',
                          observaciones='$request->observaciones',
                          lugar_arribo='$request->lugar_de_arribo',
                          codigo_aux='$request->codigo_auxiliar',
                          pais_origen='$request->pais_origen',
                          doc_bl='$request->nro_bl'
                          FROM dbsys.camiones where codigo = '$request->codigo_oficial_real'
                    ");
        return response()->json(['success'=>'Los datos fueron
                actualizados exitosamente',
              ]);
    }

    public function updateitem(Request $request)
    {

      if ($request -> ajax()) {
        $rules = array(
          'nro_item' => 'required',
          'codigo' => 'required',
          'cantidad_cierre' => 'required',
          'bultos_ingreso' => 'required',
          'cantidad_ingreso' => 'required',
          // 'cif_moneda_ext' => 'required',
          // 'viu_moneda_nal' => 'required',
          // 'precio_compra' => 'required'
        );

        $error = Validator::make($request->all(),$rules);

        if ($error->fails()) {
          return response()->json([
            'errors' => $error->errors()->all()
          ]);
        }
        $form_data = array(

          'nro_item'     => $request->nro_item,
          'nro_itemreal' => $request->nro_item,

          'codigo'     => $request->codigo,
          'codigoreal' => $request->codigo,

          'cantidad_cierre'  => $request->cantidad_cierre,
          'bultos_ingreso'   => $request->bultos_ingreso,
          'cantidad_ingreso' => $request->cantidad_ingreso,
          // 'cif_moneda_ext' => $request->cif_moneda_ext,
          // 'viu_moneda_nal' => $request->viu_moneda_nal,
          // 'precio_compra' => $request->precio_compra,
        );
        // nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
        //                     ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
        //                     , cif_adicional_nal,cif_final_nal,total_costo
        //


          DB::update("UPDATE dbsys.camiones_detalle
                          set nro_item='$request->nro_item',
                        	cantidad_cierre='$request->cantidad_cierre',
                        	bultos_ingreso='$request->bultos_ingreso',
                        	cantidad_ingreso='$request->cantidad_ingreso'
                          FROM dbsys.camiones c
                          inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                          inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                          left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                          where c.codigo= '$request->codigo' and cd.nro_item = '$request->nro_itemreal' ");

          DB::update("UPDATE dbsys.camiones
                    set codigo='$request->codigo'
                    FROM dbsys.camiones c
                    inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                    inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                    left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                    where c.codigo= '$request->codigoreal'");



        return response()->json(['success'=>'Los datos fueron
                actualizados exitosamente',
                'aea'=>'Los datos fueron
                        actualizados exitosamente'

              ]);


      }
    }
}
