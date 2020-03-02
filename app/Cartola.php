<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Cartola extends Model
{
    public $timestamps = false;
    protected $table = "dbo.CARTOLA_BANCOS";
    protected $fillable = [
                          'cartola', 'tp_cuenta',
                          "saldo", 'descripcion','fecha',
                          'documento', 'sucursal', 'cargo'];
    public function list(){
       return DB::table($this->table)->get();
    }
 }
