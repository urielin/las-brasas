<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\GestionCamion;
use App\Test;
use App\DbsysCamiones;
use App\AdmTrasladoSalidaExt;
use Validator;

class ContabilidadController extends Controller
{
  public function index() {
    return view('contabilidad.index');
  }
}
