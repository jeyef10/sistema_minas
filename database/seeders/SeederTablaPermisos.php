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

            //Operaciones sobre tabla Solicitantes
            'ver-solicitante',
            'crear-solicitante',
            'editar-solicitante',
            'borrar-solicitante',
            
            //Operaciones sobre tabla Recaudos
            'ver-recaudo',
            'crear-recaudo',
            'editar-recaudo',
            'borrar-recaudo',

            //Operaciones sobre tabla Comisionados
            'ver-comisionado',
            'crear-comisionado',
            'editar-comisionado',
            'borrar-comisionado',

            //Operaciones sobre tabla Minerales
            'ver-mineral',
            'crear-mineral',
            'editar-mineral',
            'borrar-mineral',

            //Operaciones sobre tabla Plazos
            'ver-plazo',
            'crear-plazo',
            'editar-plazo',
            'borrar-plazo',

            //Operaciones sobre tabla Tipo_pagos
            'ver-tipopago',
            'crear-tipopago',
            'editar-tipopago',
            'borrar-tipopago',

            //Operaciones sobre tabla Bancos
            'ver-banco',
            'crear-banco',
            'editar-banco',
            'borrar-banco',

            //Operaciones sobre tabla Recepción
            'ver-recepcion',
            'crear-recepcion',
            'editar-recepcion',
            // 'borrar-recepcion',

            //Operaciones sobre tabla Planificación
            'ver-planificacion',
            'crear-planificacion',
            'editar-planificacion',
            // 'borrar-planificacion',

            //Operaciones sobre tabla Inspección
            'ver-inspeccion',
            'crear-inspeccion',
            'editar-inspeccion',
            // 'borrar-inspeccion',

            //Operaciones sobre tabla Comprobante Pago
            'ver-comprobante_pago',
            'crear-comprobante_pago',
            'editar-comprobante_pago',
            // 'borrar-inspeccion',

            //Operaciones sobre tabla licencia
            'ver-licencia',
            'crear-licencia',
            'editar-licencia',
            // 'borrar-licencia',

            //Operaciones sobre tabla la Pago Regalias
            'ver-pago_regalia',
            'crear-pago_regalia',
            'editar-pago_regalia',
            // 'borrar-pago_regalia',


              //Operaciones sobre tabla control
              'ver-control_regalia',
              'crear-control_regalia',
              'editar-control_regalia',
            //   'borrar-control_regalia',
 
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
