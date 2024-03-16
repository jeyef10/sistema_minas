<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estadistica;

class EstadisticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array('nombre' => 'Division', 'porcentaje' => 40.5),
            array('nombre' => 'Sede', 'porcentaje' => 40.5),
            array('nombre' => 'Persona', 'porcentaje' => 40.5),
            array('nombre' => 'Marca', 'porcentaje' => 40.5),
            array('nombre' => 'Modelo', 'porcentaje' => 40.5),
            array('nombre' => 'Tipo de Periferico', 'porcentaje' => 40.5),
            array('nombre' => 'Periferico', 'porcentaje' => 40.5),
            array('nombre' => 'Sistemas Operativos', 'porcentaje' => 40.5),
            array('nombre' => 'Equipios Informaticos', 'porcentaje' => 40.5),
        ];
        Estadistica::insert($data);
    }
}
