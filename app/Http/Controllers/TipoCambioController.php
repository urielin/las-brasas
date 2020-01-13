<?php

namespace App\Http\Controllers;

use App\TipoCambio;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TipoCambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['TipoCambio']=TipoCambio::orderBy('CAMB_FECHA', 'desc')->paginate(10);

        return view('tipo-cambio', $datos);
        // return view('tipo-cambio');
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
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCambio $tipoCambio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCambio $tipoCambio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       $request->validate([
         'Tipo_de_cambio' => 'required',
         'Mes_cambiar' => 'required',
       ]);


     $form_data =array(
       'CAMB_CAMBIO'      => $request->Tipo_de_cambio ,

     );
     // $today = Carbon::today();
     // return $today;
     // $a=Carbon::createFromFormat('Y-m-d H', '2019-11-30 00:00:00.000')->toDateTimeString();
     // $q->whereMonth('CAMB_FECHA', '=', date('m'));
     // $q->whereYear('CAMB_FECHA', '=', date('Y'));
     // $fecha = $request->fecha;

      $y=date('Y', strtotime($request->Mes_cambiar));
      $m=date('m', strtotime($request->Mes_cambiar));

      // $afecha = $request->Mes_cambiar->format('Y');
      // return $m;

      // $product = \App\Product::find($id);
     // $mfecha = $request->Mes_cambiar->format('m');
     // $dfecha = $request->Mes_cambiar->format('d');
     // return $mfecha;
     \App\TipoCambio::whereYear('CAMB_FECHA', $y)->whereMonth('CAMB_FECHA', $m)->update($form_data);
     return redirect('tipo-cambio')->with('success','Mes actualizado correctamente. ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoCambio  $tipoCambio
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCambio $tipoCambio)
    {
        //
    }
}
