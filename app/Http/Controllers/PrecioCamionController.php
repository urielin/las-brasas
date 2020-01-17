<?php

namespace App\Http\Controllers;

use App\PrecioCamion;
use App\CamionesClasificacion;
use App\BodegaIdOfertas;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DateTimeZone;

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
    public function update(Request $request, BodegaIdOfertas $BodegaIdOfertas)
    {
        //obtener dato
        $user='DEV';
        $fecha_actual = new \DateTime();
        $fecha_actual->setTimezone(new \DateTimeZone('America/Lima'));
        $fecha_actual= $fecha_actual->format('d-m-Y H:i:s');
        $id_camion=$request->get('id_camion');
        $id_corte=$request->get('id_corte');
        $precio=$request->get('publico');
        $mayorista=$request->get('mayor');
        $clasificacion=$request->get('clasificacion');
        // $app = BodegaIdOfertas::find(1);
        // $app->name = $request->name;
        // $app->email = $request->email;
        // $app->save();
        
        // return $request;
        // buscar si existe y actualizar estado a 0
        try{
            $BodegaIdOfertas = BodegaIdOfertas::firstOrNew(
                ['id_camion' => $id_camion, 'id_corte'=> $id_corte, 'estado'=> 1]
            );

            if($BodegaIdOfertas->exists){
                
                // $BodegaIdOfertas->estado = 2;
                // ACTUALIZA EL ESTADO A 2 PARA DESABILITARLO
                
                $BodegaIdOfertas___ = BodegaIdOfertas::where('id_camion', $id_camion)
                ->where('id_corte', $id_corte)->where('estado', 1)
                ->update(['estado' => 0,'usuario' => $user,'fecha_baja' => $fecha_actual]);
                
            }else{
       
                

            }
            // CREA UN NUEVO ITEM CON ESTADO A 1
            $BodegaIdOfertas = new BodegaIdOfertas;
            $BodegaIdOfertas->id_camion = $id_camion;
            $BodegaIdOfertas->id_corte = $id_corte;
            $BodegaIdOfertas->precio = $precio;
            $BodegaIdOfertas->mayorista = $mayorista;
            $BodegaIdOfertas->estado = 1;
            $BodegaIdOfertas->usuario = $user;
            $BodegaIdOfertas->fecha = $fecha_actual;
            $BodegaIdOfertas->save();

            // $BodegaIdOfertas->save();
         }
         catch(\Exception $e){
            // do task when error
            return $e->getMessage();   // insert query
         }
        
         $datos['PrecioCamion']=DB::select("SELECT * FROM dbo.Precios_Camiones($clasificacion, '', '') ORDER BY descripcion");
          return view('table-precio-camion', $datos);
 
        //actualizar estado a 0 
        // $BodegaIdOfertas = BodegaIdOfertas::updateOrCreate(
        //     ['id_camion' => $id_camion, 'id_corte' => $id_corte],
        //     ['price' => 99, 'discounted' => 1]
        // );
        //insertar dato nuevo actualizado  id_camion', '=', $id_camion

        //actualizar  datos de la vista
        // return $request;
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
