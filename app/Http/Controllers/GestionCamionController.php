<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GestionCamion;
use App\Test;

class GestionCamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datos='null';
      // $data['datos']='null'
      $year=Test::select('gestion')->distinct()->get();
      // $data['user']=User::all();
      // $data['employer']=employer::all();
      // return view('gestion-camion',['data'=>$datos]);

      return view('gestion-camion')->with(compact('datos'))->with(compact('year'));
      // return $year;

        // return view('gestion-camion',compact('datos'));
        // return view('gestion-camion');
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
        //
    }

    public function getCamion(Request $request)
    {
        if ($request -> ajax()) {
            $camiones = Test::where('gestion',$request->anio_id)->get();
            foreach ($camiones as $camion) {
              $camionArray[$camion->camion] = $camion->camion ;
            }

            return response()->json($camionArray);
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
