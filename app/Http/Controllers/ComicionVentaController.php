<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class ComicionVentaController extends Controller
{
  public function index() {
    
    
    return view('contabilidad.comicion-por-venta');
  }
}
