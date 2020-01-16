<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;

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

      // $year->distinct();
      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();

      // $year= DbsysCamiones::select(date('Y', strtotime('fecha_llegada')))->get();
      // $y=date('Y', strtotime($request->Mes_cambiar));

      // return view('gestion-camion')->with(compact('datos'))->with(compact('year'));
      return view('gestion-camion')->with(compact('year'));
      // dd($year1);

        // return view('gestion-camion',compact('datos'));
        // return view('gestion-camion');

        // $y=date('Y', strtotime($request->Mes_cambiar));
        // $m=date('m', strtotime($request->Mes_cambiar));
        // \App\TipoCambio::whereYear('CAMB_FECHA', $y)->whereMonth('CAMB_FECHA', $m)->update($form_data);
        // return redirect('tipo-cambio')->with('success','Mes actualizado correctamente. ');

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
    public function show(Request $request)
    {
        // dd($request);
        $request->validate([
          'codigo' => 'required',
        ]);

        $datos=GestionCamion::where('camion', $request->codigo)->get();

            // return view('gestion-camion', $datos);
            //
            return view('gestion-camion',compact('datos'));
// return $datos;
          // return $requestñ
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
            try{
        $camiones=DB::select("SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE YEAR(fecha_llegada) = $request->anio_id
			  UNION
			  SELECT  camion=CAST(nro_traslado AS NVARCHAR(20)) FROM dbo.ADM_TRASLADO_SALIDA_EXT WHERE YEAR(fecha_viza) = $request->anio_id
			  order by camion desc");
        }
        catch(\Exception $e){
          return $e->getMessage();
        }
        // $camiones1=DB::select('SELECT  camion=CAST(codigo AS NVARCHAR(20)) FROM dbsys.camiones WHERE YEAR(fecha_llegada) = ?', [$request->anio_id]);
      // -- UNION
      // $camiones=DB::select('SELECT  camion=CAST(nro_traslado AS NVARCHAR(20)) FROM dbo.ADM_TRASLADO_SALIDA_EXT WHERE YEAR(fecha_viza) = ?', [$request->anio_id],
      //  'order by camion desc');

 // $year=DbsysCamiones::select(('fecha_llegada'))->distinct()->get();
            // $camiones1 = Test::where('gestion',$request->anio_id)->get();
            foreach ($camiones as $camion) {
              $camionArray[$camion->camion] = $camion->camion ;
            }
            return response()->json($camionArray);
            // return $camionArray;
        }
    }
  // $datos=GestionCamion::where('camion', $request->codigo)->get();
    public function gettablecamion(Request $request)
    {
      if ($request -> ajax()) {
          $camioninfo = Test::where('camion',$request->camion_id)->get();
          return response()->json(
              $camioninfo->toArray()
          );

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
