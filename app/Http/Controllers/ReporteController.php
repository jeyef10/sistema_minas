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
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller

{
    
    public function index(Request $request)
    
    {

        $licencia = licencias::join('comprobante_pagos', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
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
                'licencias.id_plazo'
            ])
            ->get();
            
        return view('reporte.index', ['resultados' => $licencia]);
    }

    public function generarPDF(Request $request)
    {

        $search = $request->input('search');

        $licencia = licencias::join('comprobante_pagos', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
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
                'licencias.id_plazo'
            ])
            ->get();

        if ($search) {
            // Filtrar los solicitantes según la consulta de búsqueda
            $licencia = $licencia->where(function($query) use ($search) {
                $query->where('personas_naturales.cedula as solicitante_cedula', 'LIKE', '%' . $search . '%')
                        ->orWhere('personas_naturales.nombre as solicitante_nombre_natural', 'LIKE', '%' . $search . '%')
                        ->orWhere('personas_naturales.apellido as solicitante_apellido', 'LIKE', '%' . $search . '%')
                        ->orWhere('personas_juridicas.nombre as solicitante_nombre_juridico', 'LIKE', '%' . $search . '%')
                        ->orWhere('personas_juridicas.rif as solicitante_rif', 'LIKE', '%' . $search . '%')
                        ->orWhere('recepcion.direccion', 'LIKE', '%' . $search . '%')
                        ->orWhere('minerales.nombre as nombre_mineral', 'LIKE', '%' . $search . '%')
                        ->orWhere('recepcion.categoria', 'LIKE', '%' . $search . '%')
                        ->orWhere('solicitantes.tipo as solicitante_tipo', 'LIKE', '%' . $search . '%')
                        ->orWhere('licencias.resolucion_hpc', 'LIKE', '%' . $search . '%')
                        ->orWhere('licencias.resolucion_apro', 'LIKE', '%' . $search . '%')
                        ->orWhere('licencias.catastro_la', 'LIKE', '%' . $search . '%')
                        ->orWhere('licencias.catastro_lp', 'LIKE', '%' . $search . '%')
                        ->orWhere('licencias.id_plazo', 'LIKE', '%' . $search . '%');
                        
            });
        }

        $licencia = $licencia->get();

        $pdf = PDF::loadView('reporte.pdf', ['resultados' => $licencia]);

        return $pdf->download('reporte.pdf');
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


