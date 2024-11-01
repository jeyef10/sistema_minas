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

        $desde = $request->input('desde'); 
        $hasta = $request->input('hasta');


        $licencia = licencias::join('inspecciones', 'inspecciones.id', '=', 'licencias.id_inspeccion')
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
            ->select([
                'personas_naturales.cedula as solicitante_cedula',
                'personas_naturales.nombre as solicitante_nombre_natural',
                'personas_naturales.apellido as solicitante_apellido',
                'personas_juridicas.nombre as solicitante_nombre_juridico',
                'personas_juridicas.rif as solicitante_rif',
                'recepcion.direccion',
                'recepcion.categoria',
                'solicitantes.tipo as solicitante_tipo',
                'licencias.resolucion_hpc',
                'licencias.resolucion_apro',
                'licencias.catastro_la',
                'licencias.catastro_lp',
                'licencias.id_plazo'
            ]);

        $resultados = $licencia->get();

        return view('reporte.index', ['resultados' => $resultados]);
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


