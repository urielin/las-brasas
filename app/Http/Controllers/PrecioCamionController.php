<?php

namespace App\Http\Controllers;

use App\PrecioCamion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrecioCamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datos['PrecioCamion2'] = DB::table("dbo.Precios_Camiones(1, '', '')")
        //         ->orderBy('name', 'desc')
        //         ->get();
        $datos['PrecioCamion']=PrecioCamion::paginate(10);
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
