<?php

namespace App\Http\Controllers;

use App\PrecioCamion;
use App\CamionesClasificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrecioCamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $datos['PrecioCamion2'] = DB::table("dbo.Precios_Camiones(1, '', '')")
        //         ->orderBy('name', 'desc')
        //         ->get();
        $clasificacion=$request->get('clasificacion') ? $request->get('clasificacion') : '1';
        $datos['clasificacion']=$clasificacion;
        // $datos['PrecioCamion']=PrecioCamion::paginate(10);
        $datos['PrecioCamion']=DB::select("SELECT * FROM dbo.Precios_Camiones($clasificacion, '', '') ORDER BY descripcion");
        // dd($preciosCamiones);
        $datos['CamionesClasificacion']=CamionesClasificacion::where('cod_int', '>', 0)
                                                                ->orderBy('cod_int')
                                                                ->get();
                                                                // dd($datos['CamionesClasificacion']);
        return view('precio-camion', $datos);
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
     * @param  \App\PrecioCamion  $precioCamion
     * @return \Illuminate\Http\Response
     */
    public function show(PrecioCamion $precioCamion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrecioCamion  $precioCamion
     * @return \Illuminate\Http\Response
     */
    public function edit(PrecioCamion $precioCamion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrecioCamion  $precioCamion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrecioCamion $precioCamion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrecioCamion  $precioCamion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrecioCamion $precioCamion)
    {
        //
    }
}
