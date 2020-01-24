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
      $year=DB::select('SELECT DISTINCT fecha_llegada=YEAR(fecha_llegada) FROM dbsys.camiones UNION
      SELECT DISTINCT fecha_llegada=YEAR(fecha_viza) FROM dbo.ADM_TRASLADO_SALIDA_EXT order by fecha_llegada desc ');

      // $clasificaciones=DB::select('SELECT  * FROM dbo.ADM_CLASIFICACIONCODIGO');
      $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

      // $year->distinct();
      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();

      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();
      // $y=date('Y', strtotime($request->Mes_cambiar));

      // return view('gestion-camion')->with(compact('datos'))->with(compact('year'));
      $datos=GestionCamion::where('camion', '0')->get();


      return view('gestion-camion')->with(compact('year'))->with(compact('datos'))->with(compact('clasificaciones'));
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

      $year=DB::select('SELECT DISTINCT fecha_llegada=YEAR(fecha_llegada) FROM dbsys.camiones UNION
      SELECT DISTINCT fecha_llegada=YEAR(fecha_viza) FROM dbo.ADM_TRASLADO_SALIDA_EXT order by fecha_llegada desc ');
      $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');
      $datos=GestionCamion::where('camion', '0')->get();

      return view('gestion-camion-r')->with(compact('year'))->with(compact('datos'))->with(compact('clasificaciones'));
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
        // dd($request);
        $request->validate([
          'codigo' => 'required',
        ]);
        // $year=DB::select('SELECT DISTINCT fecha_llegada=YEAR(fecha_llegada) FROM dbsys.camiones UNION
        // SELECT DISTINCT fecha_llegada=YEAR(fecha_viza) FROM dbo.ADM_TRASLADO_SALIDA_EXT order by fecha_llegada desc ');

        // $datos=DB::select("SELECT * FROM dbsys.camiones c
        //                       inner join dbsys.camiones_detalle cd
        //                       on c.id_camion = cd.id_camion
        //                       where c.codigo ='$request->codigo' and estado = '1'");
        //
        //
      $datos=DB::select("SELECT nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
        ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
          , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                              inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
							  inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
							  left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
								WHERE  c.codigo ='$request->codigo' and c.estado = '1'");

        $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');

        // $datos=DbsysCamiones::where('codigo', $request->codigo)->get();

            return view('gestion-camion')->with(compact('datos'))->with(compact('clasificaciones'));

    }

    public function showr(Request $request)
    {
        $request->validate([
          'codigo' => 'required',
        ]);

      $datos=DB::select("SELECT nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
        ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
          , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
							  inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
							  left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
								WHERE  c.codigo ='$request->codigo' and c.estado = '1'");

        $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');
        return view('gestion-camion-r')->with(compact('datos'))->with(compact('clasificaciones'));

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


    }

    public function getCamion(Request $request)
    {

          if ($request -> ajax()) {
            // try{
        // $camiones=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE YEAR(fecha_llegada) = $request->anio_id and descripcion LIKE '%'+'$request->clasificacion_id'+'%' ");
        $camiones=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE  descripcion LIKE '%'+'$request->clasificacion_id'+'%' and estado = '1' ");

        // $camiones=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE YEAR(fecha_llegada) = $request->anio_id and descripcion = '$request->clasificacion_id'
        //     	UNION
        //     	SELECT  camion=CAST(nro_traslado AS NVARCHAR(20)) FROM dbo.ADM_TRASLADO_SALIDA_EXT WHERE YEAR(fecha_viza) = $request->anio_id LIKE 'ACEITE%'
        //       order by camion desc");

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
              $camiones=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE  descripcion LIKE '%'+'$request->clasificacion_id'+'%' and estado = '2' ");
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

  // public function getclasificacion(Request $request)
  // {
  //   if ($request -> ajax()) {
  //
  //     $clasificaciones=DB::select('SELECT  * FROM dbsys.camiones_clasificacion');
  //
  //
  //         foreach ($clasificaciones as $clasificacion) {
  //           $clasificacionArray[$clasificacion->cod_int] = $clasificacion->desc01 ;
  //         }
  //         return response()->json($clasificacionArray);
  //         // return $camionArray;
  //     }
  // }
    public function gettablecamion(Request $request)
    {
      if ($request -> ajax()) {

          // $DATO= '13H01';
          // $documento=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE codigo = $DATO ");
          // $documento=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE YEAR(fecha_llegada) = '2018'");
           // UNION
  			   //   $documento=DB::select("SELECT   documento = zeta FROM dbo.ADM_TRASLADO_SALIDA_EXT WHERE nro_traslado  = $request->camion_id");


          // $documento=DbsysCamiones::where('codigo',$request->camion_id)->get();
          //
          // $documentos=DB::select("SELECT * FROM dbsys.camiones c
          //                       inner join dbsys.camiones_detalle cd
          //                       on c.id_camion = cd.id_camion
          //                       where c.codigo ='$request->camion_id'");

                                $documentos=DB::select("SELECT nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
                                  ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
                                    , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
                                          inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
                          							  inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
                          							  left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
                          								WHERE  c.codigo ='$request->camion_id' ");

          // SELECT MERC_RZETA, CODI_RCODIGO, MERC_RENTRADA FROM dbo.ADM_MERCANCIA WHERE MERC_RZETA LIKE '101-15-015954'+'%' ");
          // return $camiones;
          // $sql = "SELECT ad.doc_ingreso, a.nro_traslado AS zeta, ad.codigo_mercancia, ad.cantidad
			    //    FROM   ADM_TRASLADO_SALIDA_EXT a INNER JOIN ADM_TRASLADO_SALIDA_DET_EXT ad ON a.folio = ad.folio
			    //    WHERE  (a.zeta = $documento->ingreso_zeta)";
          //
          //    $documento=DB::select($sql);
          // $documento1=DB::table('dbo.ADM_TRASLADO_SALIDA_EXT')

            // $documento=AdmTrasladoSalidaExt::where('nro_traslado',$request->camion_id)->get();

          // if ($documento1->fecha_llegada != '') {
          //   $documento=$documento1;
          //   $documento->get();
          // }else {
          //   $documento=$documento2;
          //   // $documento->get();
          // }
          // foreach ($documento as $documento) {
          //   $camionArray['descripcion'] = $camion->descripcion ;
          // }
          return response()->json($documentos);


      }
    }

    public function gettablecamionr(Request $request)
    {
      if ($request -> ajax()) {
              $documentos=DB::select("SELECT nro_item,c.codigo,producto=(ac.CODI_RNOMBRE+'-'+atu.tume_sigla),cantidad_cierre,cd.bultos_ingreso,cd.cantidad_ingreso,bultos_ingresos=cantidad_cierre,cantidad_ingresos=cantidad_cierre
              ,cantidad_diferencia,cif_moneda_ext,viu_moneda_nal, cif_moneda_nal, precio_compra,total_compra
              , cif_adicional_nal,cif_final_nal,total_costo FROM dbsys.camiones c
              inner join dbsys.camiones_detalle cd on c.id_camion = cd.id_camion
              inner join  ADM_CODIGOS ac on  cd.codigo = ac.CODI_RCODIGO
              left outer join ADM_TP_UNIDMEDIDA atu on ac.TUME_CODIGO=atu.TUME_CODIGO
              WHERE  c.codigo ='$request->camion_id' ");

          return response()->json($documentos);

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
        //
    }
}
