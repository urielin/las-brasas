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

          return view('gestion.gestionAdministracion')->with(compact('clasificaciones'))->with(compact('estados'));
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
