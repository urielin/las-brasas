<?php

namespace App\Http\Controllers;

use App\TipoCambio;
use App\Clasificacion;
use App\Product;
use App\UnidadMedida;
use App\ProductoTerminado;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $oClasificacion, $oProduct, $oUnidadMedida, $oProductoTerminado;

    public function __construct(){
      $this->oClasificacion = new Clasificacion();
      $this->oProduct = new Product();
      $this->oUnidadMedida = new UnidadMedida();
      $this->oProductoTerminado = new ProductoTerminado();
    }

    public function index()
    {
       $clasificacion = $this->oClasificacion->list();
       $unidades = $this->oUnidadMedida->list();
       $clasifications = $this->oProduct->clasifications();
       $clasifications2 = $this->oProduct->clasifications2();
       return view('master.productos', compact('clasificacion', 'unidades', 'clasifications', 'clasifications2'));
    }
    public function filter(Request $request) {
      $request = $request->all();
      $filter = $this->oProduct->filter($request);
      return response()->json([ 'data' => $filter ]);
    }
    public function listClasificacion() {
       return $this->oClasificacion->list();
    }
    public function listUnidades() {
      return $this->oUnidadMedida->list();
    }
    public function findOne(Request $request) {
      return $this->oProduct->findOne($request->all());
    }
    public function updateSon(Request $request){
      $request = $request->all();
      return $this->oProduct->updateSon($request);
    }
    public function create(Request $request) {
      $request = $request->all();
      return $this->oProduct->create($request);
    }
    public function catalogo(Request $request) {
      $request = $request->all();
      return $this->oProductoTerminado->findAllSon($request);
    }
    public function clasificacion(Request $request) {
      return $this->oProduct->clasifications();
    }
    public function clasificacion2(Request $request) {
      return $this->oProduct->clasifications2();
    }
    public function nutricionals(Request $request) {
      return $this->oProduct->nutricionals($request->all());
    }
    public function updateNutricional(Request $request) {
      return $this->oProduct->updateNutricional($request->all());
    }
    public function updateProduct(Request $request) {
      return $this->oProductoTerminado->updateProduct($request->all());
    }
    public function deleteProduct(Request $request) {
      return $this->oProductoTerminado->deleteProduct($request->all());
    }
}
