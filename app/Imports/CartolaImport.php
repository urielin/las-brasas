<?php
namespace App\Imports;
use App\Cartola;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class CartolaImport implements ToModel
{

    public function model(array $row)
    {
        return new Cartola([
            'descripcion'  => $row[0],
            'fecha'        => $row[1],
            'documento'    => $row[2],
            'sucursal'     => $row[3],
            'cargo'        => $row[4],
            'abono'        => $row[5],
            'saldo'        => $row[6],
        ]);
    }

}
