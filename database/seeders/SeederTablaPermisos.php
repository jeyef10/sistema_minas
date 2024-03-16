<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
                                                    /* DESCOMENTAR AL EJECUTAR EL SEEDER LA PRIMERA VEZ (SI NO HAY REGISTROS EN LA BASE DE DTAOS) */
            //Operaciones sobre tabla Usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre tabla Sedes
            /* 'ver-sede',
            'crear-sede',
            'editar-sede',
            'borrar-sede', */

            //Operaciones sobre tabla Divisiones
            /* 'ver-division',
            'crear-division',
            'editar-division',
            'borrar-division',
 */
            //Operaciones sobre tabla Cargos
            /* 'ver-cargo',
            'crear-cargo',
            'editar-cargo',
            'borrar-cargo', */

            //Operaciones sobre tabla Personas
            /* 'ver-persona',
            'crear-persona',
            'editar-persona',
            'borrar-persona', */

            //Operaciones sobre tabla Marcas
           /*  'ver-marca',
            'crear-marca',
            'editar-marca',
            'borrar-marca',
 */
            //Operaciones sobre tabla Modelos
           /*  'ver-modelo',
            'crear-modelo',
            'editar-modelo',
            'borrar-modelo', */

            /* //Operaciones sobre tabla Perifericos
            'ver-periferico',
            'crear-periferico',
            'editar-periferico',
            'borrar-periferico', */

            //Operaciones sobre tabla Equipos
            /* 'ver-equipo',
            'crear-equipo',
            'editar-equipo',
            'borrar-equipo', */

            //Operaciones sobre tabla Sistemas
           /*  'ver-sistema',
            'crear-sistema',
            'editar-sistema',
            'borrar-sistema', */

             //Operaciones sobre tabla Tipo de Sistemas Operativos
             /* 'ver-tipoperif',
             'crear-tipoperif',
             'editar-tipoperif',
             'borrar-tipoperif' */
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
