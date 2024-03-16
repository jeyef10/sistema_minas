<?php

namespace App\Imports;

use App\Models\Nomina;
use Maatwebsite\Excel\Concerns\ToModel;

class NominasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nomina([
            'cedula' => $row[0],
            'nombre' => $row[1],
            'apellido' => $row[2],
            'id_usuario' => $row[3],
            'telefono' => $row[4],
            'cargo' => $row[5],
            'division' => $row[6],
        ]);
    }
}
