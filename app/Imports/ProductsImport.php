<?php
namespace App\Imports;
use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class ProductsImport implements ToModel
{
     public function model(array $row)
    {
        return new Producto([
            'idfamilia'     => $row[0],
            'codigo'        => $row[1],
            'nombre'        => $row[2],
            'precio_venta'  => $row[3],
            'descripcion'   => $row[4],
            'stock'         => $row[5],
            'condicion'     => $row[6],
            'idsucursal'    => $row[7]
        ]);
    }

}
