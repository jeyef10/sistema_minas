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
    public function bitacora()
    { 
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }

    public function index(Request $request)
    {
        $licencia = licencias::join('inspecciones', 'inspecciones.id', '=', 'licencias.id_inspeccion')
            ->join('planificacion', 'planificacion.id', '=', 'inspecciones.id_planificacion')
            ->join('recepcion', 'recepcion.id', '=', 'planificacion.id_recepcion')
            ->join('solicitantes', 'solicitantes.id', '=', 'recepcion.id_solicitante' )
            ->leftJoin('personas_naturales', function ($join) {
                $join->on('recepcion.id_solicitante', '=', 'personas_naturales.solicitante_id')
                    ->where('solicitantes.solicitante_especifico_type', '=', ' App\\Models\\PersonaNatural');
            })
            ->leftJoin('personas_juridicas', function ($join) {
                $join->on('recepcion.id_solicitante', '=', 'personas_juridicas.solicitante_id')
                    ->where('solicitantes.solicitante_especifico_type', '=', ' App\\Models\\PersonaJuridica');
            })
            ->select([
                'personas_naturales.nombre as solicitante_nombre_natural',
                'personas_naturales.apellido as solicitante_apellido_natural',
                'personas_naturales.cedula as solicitante_cedula',
                'personas_juridicas.nombre as solicitante_nombre_juridico',
                'personas_juridicas.rif as solicitante_rif',
                'personas_juridicas.correo as solicitante_correo',
                'recepcion.direccion',
                'recepcion.id_solicitante as solicitante_tipo'
            ]);

        $resultados = $licencia->get();

        return view('reporte.index', ['resultados' => $resultados]);
    }

}


