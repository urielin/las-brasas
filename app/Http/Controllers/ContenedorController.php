<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ContenedorController extends Controller
{
  public function pagos() {
    return view('gestion.pagos');
  }
  public function parametros() {
    return view('gestion.parametros');
  }
}
