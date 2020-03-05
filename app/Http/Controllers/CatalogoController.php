<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\CartolaImport;
use App\Imports\ProductsImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Cartola;
use App\Producto;

class CatalogoController extends Controller
{
    protected $table = "dbo.CARTOLA_BANCOS";
    public function import(Request $request){
      $headboard = array();
      $cartola = $request->cartola;
      $cuenta = $request->cuenta;
      $body = collect();

      $collections = Excel::toArray(new ProductsImport, request()->file('file'));
      $headboard   = $collections[0][12];
      $monto       = $collections[0][12][0];
      $descripcion = $collections[0][12][1];
      $fecha       = $collections[0][12][3];
      $documento   = $collections[0][12][4];
      $sucursal    = $collections[0][12][5];
      $cargo       = $collections[0][12][7];
      $cartolas    = $collections[0];

      foreach ($cartolas as $key => $collection) {
        if ($key > 12 && $collection[0] != 'Saldos diarios' && $collection[0] != 'SALDO' && $collection[3] != null ) {
          $body->push([
            'cuenta' => $cuenta ?? '-',
            'cartola' => $cartola ?? '-',
            'monto' => $collection[0] ?? '-',
            'descripcion' => $collection[1],
            'fecha' => $collection[3] ?? '-',
            'documento' => $collection[4] ?? '-',
            'sucursal' => $collection[5] ?? '-',
            'cargo' => $collection[7] ?? '-',
          ]);
        }
      }
      return response()->json(['movimientos'=> $body]);
    }
    public function migracion(Request $request) {
      $cartolas = $request->cartolas;
      $params = json_decode($cartolas);

      $flat = Cartola::where('nombre_archivo', '='  ,$params[0]->nombre_archivo)->first();
      $flat1 = Cartola::where('cartola','=' , $params[0]->cartola)->first();

      if (isset($flat)  || isset($flat1)) {
        return response()->json(['status' => 500, 'message' => 'La cartola ya se ingreso Intente con otra']);
      } else {
        foreach ($params as $key => $value) {
            $documento = $value->documento == '000000' ? '' : $value->documento; 
            DB::table($this->table)
              ->insert([
                'tp_cuenta' => $value->cuenta,
                'cartola' => $value->cartola,
                'saldo' => $value->monto,
                'descripcion' => $value->descripcion,
                'fecha' => $value->fecha,
                'documento' => $documento,
                'nombre_archivo' => $value->nombre_archivo,
                'sucursal' => $value->sucursal,
                'deposito' => $value->deposito
              ]);
        }
        return response()->json(['status' => 200, 'message' => 'Cartola ingresada']);

      }
    }
    /*public function importPlane(Request $request) {
      $cartolas = $request->cartolas;
      $params = json_decode($cartolas);
      $body = collect();

      foreach ($params as $key => $value) {
        $body->push([
          'cuenta' => $value->cuenta ?? '-',
          'cartola' => $value->cartola ?? '-',
          'monto' => $value->monto ?? '-',
          'descripcion' => htmlentities($value->descripcion),
          'fecha' => $value->fecha ?? '-',
          'documento' => $value->documento ?? '-',
          'sucursal' => $value->sucursal ?? '-',
          'cargo' => $value->cargo ?? '-',
        ]);
      }
     }
    public function migracionPlane(Request $request) {

    }*/
}
