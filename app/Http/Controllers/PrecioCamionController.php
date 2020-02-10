<?php

namespace App\Http\Controllers;

use App\PrecioCamion;
use App\CamionesClasificacion;
use App\BodegaIdOfertas;
use App\AdmSucursal;
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
        // SI LA CLASIFICACION DEL REQUEST ES NULL ENTONCES CLASIFICACION = 1
        $clasificacion=$request->get('clasificacion') ? $request->get('clasificacion') : '1';
        $datos['clasificacion']=$clasificacion;
        // SI LA SUCURSAL DEL REQUEST ES NULL ENTONCES CLASIFICACION = 0
        $sucursal=$request->get('sucursal') ? $request->get('sucursal') : '0';
        $datos['sucursal']=$sucursal;
        // OBTENER DATOS PARA LA TABLA PRECIO CAMION
        // consulta antigua
        // $datos['PrecioCamion']=DB::select("SELECT *
        // FROM dbo.Precios_Camiones($clasificacion, '', '') left join dbo.bodega_id_ofertas
        // on dbo.bodega_id_ofertas.id_camion = dbo.Precios_Camiones.camion and 
        // dbo.bodega_id_ofertas.id_corte = dbo.Precios_Camiones.codigo 
        // WHERE estado = 1 or estado IS NULL
        // ORDER BY descripcion, camion");
        // OBTENER DATOS PARA LOS SELECT
         $datos['PrecioCamion']=DB::select("SELECT camion , codigo, ADM_CODIGOS.CODI_RNOMBRE AS descripcion, ADM_CODIGOS.CODI_P_VENTA AS lista_publico,
         ADM_CODIGOS.codi_p_venta_x_m1 AS lista_mayor, ISNULL(precio, 0) AS precio_publico, ISNULL(mayorista, 0) AS precio_mayor,
         bodega_id_ofertas.fecha_baja as fecha_baja, ISNULL(bodega_id_ofertas.sucursal, 0) as sucursal
         FROM    (bodega_id_ofertas_camion 
         INNER JOIN bodega_id_ofertas_catalogo 
         ON bodega_id_ofertas_camion.clasificacion = bodega_id_ofertas_catalogo.clasificacion 
         INNER JOIN ADM_CODIGOS ON bodega_id_ofertas_catalogo.codigo = ADM_CODIGOS.CODI_RCODIGO) 
         LEFT JOIN bodega_id_ofertas ON bodega_id_ofertas.id_camion = camion and  dbo.bodega_id_ofertas.id_corte = codigo 
         WHERE   (bodega_id_ofertas_camion.clasificacion = $clasificacion) AND (bodega_id_ofertas_camion.estado = 1) AND (bodega_id_ofertas_catalogo.estado = 1) AND (bodega_id_ofertas.estado = 1 or bodega_id_ofertas.estado IS NULL)
         ORDER BY DESCRIPCION, camion");

        $datos['CamionesClasificacion']=CamionesClasificacion::where('cod_int', '>', 0)->orderBy('cod_int')->get();
        $datos['AdmSucursal']=AdmSucursal::orderBy('SUCU_RESUMEN')->get();
        //
 
        if($request->ajax()){
            return view('table-precio-camion', $datos); 
        }
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
        $fecha_baja=$request->get('fecha_baja');
        $fecha_baja=date('d-m-Y H:i:s', strtotime($fecha_baja));
        // $fecha_baja=substr($fecha_baja, 0, -3);
        // $app = BodegaIdOfertas::find(1);
        // $app->name = $request->name;
        // $app->email = $request->email;
        // $app->save();
        
        // return $fecha_baja;
        // buscar si existe y actualizar estado a 0
        try{
            $BodegaIdOfertas = BodegaIdOfertas::firstOrNew(
                ['id_camion' => $id_camion, 'id_corte'=> $id_corte, 'estado'=> 1]
            );

            if($BodegaIdOfertas->exists){
                
                // $BodegaIdOfertas->estado = 0;
                // ACTUALIZA EL ESTADO A 0 PARA DESABILITARLO
                
                $BodegaIdOfertas___ = BodegaIdOfertas::where('id_camion', $id_camion)
                ->where('id_corte', $id_corte)->where('estado', 1)
                ->update([
                'precio' => $precio,
                'mayorista' => $mayorista,
                'fecha_baja' => $fecha_baja      
                            ]);
                
            }else{
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

            }
            // CREA UN NUEVO ITEM CON ESTADO A 1


            // $BodegaIdOfertas->save();
         }
         catch(\Exception $e){
            // do task when error
            return $e->getMessage();   // insert query
         }
         // DEVOLVER DATOS ACTUALIZADOS A LA TABLA PRECIO CAMION
         $datos['PrecioCamion']=DB::select("SELECT *
         FROM dbo.Precios_Camiones($clasificacion, '', '') left join dbo.bodega_id_ofertas
         on dbo.bodega_id_ofertas.id_camion = dbo.Precios_Camiones.camion and 
         dbo.bodega_id_ofertas.id_corte = dbo.Precios_Camiones.codigo 
         WHERE estado = 1 or estado IS NULL
         ORDER BY descripcion");
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
