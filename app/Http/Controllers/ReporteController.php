<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\licencias;
use App\Models\Inspecciones;
use App\Models\Planificacion;
use App\Models\Recepcion;
use App\Models\Solicitante;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
use App\Models\PagoRegalia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller

{
    
    public function index(Request $request)
    {

        $pago_regalia = PagoRegalia::join('licencias', 'licencias.id', '=', 'pago_regalias.id_licencia')
            ->join('comprobante_pagos', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
            ->join('inspecciones', 'inspecciones.id', '=', 'comprobante_pagos.id_inspeccion')
            ->join('planificacion', 'planificacion.id', '=', 'inspecciones.id_planificacion')
            ->join('recepcion', 'recepcion.id', '=', 'planificacion.id_recepcion')
            ->join('solicitantes', 'solicitantes.id', '=', 'recepcion.id_solicitante' )
            ->leftJoin('personas_naturales', function ($join) {
                $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_naturales.id')
                    ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaNatural');
            })
           
            ->leftJoin('personas_juridicas', function ($join) {
                $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_juridicas.id')
                    ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaJuridica');
            })
            ->join('minerales', 'minerales.id', '=', 'recepcion.id_mineral')
            ->select([
                'personas_naturales.cedula as solicitante_cedula',
                'personas_naturales.nombre as solicitante_nombre_natural',
                'personas_naturales.apellido as solicitante_apellido',
                'personas_juridicas.nombre as solicitante_nombre_juridico',
                'personas_juridicas.rif as solicitante_rif',
                'recepcion.direccion',
                'minerales.nombre as nombre_mineral',
                'recepcion.categoria',
                'solicitantes.tipo as solicitante_tipo',
                'licencias.resolucion_hpc',
                'licencias.resolucion_apro',
                'licencias.catastro_la',
                'licencias.catastro_lp',
                // 'licencias.id_plazo'
                'pago_regalias.metodo_apro',
                'pago_regalias.metodo_pro',
                'pago_regalias.pago_realizar',
                'pago_regalias.resultado_apro',
                'pago_regalias.resultado_pro'
            ])
            ->get();
            
        return view('reporte.index', ['resultados' => $pago_regalia]);

    }
    

    public function generarPDF(Request $request)
    {

        $search = $request->input('search');

        // Iniciar la consulta base
        $pago_regaliaQuery = PagoRegalia::join('licencias', 'licencias.id', '=', 'pago_regalias.id_licencia')
            ->join('comprobante_pagos', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
            ->join('inspecciones', 'inspecciones.id', '=', 'comprobante_pagos.id_inspeccion')
            ->join('planificacion', 'planificacion.id', '=', 'inspecciones.id_planificacion')
            ->join('recepcion', 'recepcion.id', '=', 'planificacion.id_recepcion')
            ->join('solicitantes', 'solicitantes.id', '=', 'recepcion.id_solicitante')
            ->leftJoin('personas_naturales', function ($join) {
                $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_naturales.id')
                    ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaNatural');
            })
            ->leftJoin('personas_juridicas', function ($join) {
                $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_juridicas.id')
                    ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaJuridica');
            })
            ->join('minerales', 'minerales.id', '=', 'recepcion.id_mineral')
            ->select([
                'personas_naturales.cedula as solicitante_cedula',
                'personas_naturales.nombre as solicitante_nombre_natural',
                'personas_naturales.apellido as solicitante_apellido',
                'personas_juridicas.nombre as solicitante_nombre_juridico',
                'personas_juridicas.rif as solicitante_rif',
                'recepcion.direccion',
                'minerales.nombre as nombre_mineral',
                'recepcion.categoria',
                'solicitantes.tipo as solicitante_tipo',
                'licencias.resolucion_hpc',
                'licencias.resolucion_apro',
                'licencias.catastro_la',
                'licencias.catastro_lp',
                // 'licencias.id_plazo'
                'pago_regalias.metodo_apro',
                'pago_regalias.metodo_pro',
                'pago_regalias.pago_realizar',
                'pago_regalias.resultado_apro',
                'pago_regalias.resultado_pro'
            ]);

        // Aplicar el filtro de búsqueda si existe
        if ($search) {
            $pago_regaliaQuery->where(function($query) use ($search) {
                $query->where('personas_naturales.cedula', 'LIKE', '%' . $search . '%')
                    ->orWhere('personas_naturales.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('personas_naturales.apellido', 'LIKE', '%' . $search . '%')
                    ->orWhere('personas_juridicas.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('personas_juridicas.rif', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion.direccion', 'LIKE', '%' . $search . '%')
                    ->orWhere('minerales.nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('recepcion.categoria', 'LIKE', '%' . $search . '%')
                    ->orWhere('solicitantes.tipo', 'LIKE', '%' . $search . '%')
                    ->orWhere('licencias.resolucion_hpc', 'LIKE', '%' . $search . '%')
                    ->orWhere('licencias.resolucion_apro', 'LIKE', '%' . $search . '%')
                    ->orWhere('licencias.catastro_la', 'LIKE', '%' . $search . '%')
                    ->orWhere('licencias.catastro_lp', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.metodo_apro', 'LIKE', '%' . $search . '%') // Nueva condición para método de aprobación
                    ->orWhere('licencias.id_plazo', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.metodo_apro', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.metodo_pro', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.pago_realizar', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.resultado_apro', 'LIKE', '%' . $search . '%')
                    ->orWhere('pago_regalias.resultado_pro', 'LIKE', '%' . $search . '%');
                    
            });
        }

        // Ejecutar la consulta
        $pago_regalia = $pago_regaliaQuery->get();

        // Generar el PDF incluso si no se encuentran registros
        $pdf = PDF::loadView('reporte.pdf', ['resultados' => $pago_regalia]);
        return $pdf->stream('reporte.pdf');

    }

    public function mensual (Request $request) {
         ///
        return view('reporte.mensual'); 
    
    }


    public function bitacora()
    { 
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }


}


