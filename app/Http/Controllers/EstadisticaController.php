<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estadistica;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{

    public function index()
    {
        $recepciones = DB::table('recepcion')
            ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM created_at) as mes'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->get();

        $data_recepcion = $this->prepareChartData($recepciones);

        $inspecciones = DB::table('inspecciones')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM fecha_inspeccion) as mes'), 'estatus')
        ->whereYear('fecha_inspeccion', date('Y'))
        ->groupBy('estatus', DB::raw('EXTRACT(MONTH FROM fecha_inspeccion)'))
        ->get();

        $data_inspecciones = $this->preparePieChartData($inspecciones);

        // Obteniendo todos los municipios 
        $municipios = DB::table('municipios')->get();

        // Obteniendo el conteo de licencias por municipio
        $licencias = DB::table('municipios')
        ->leftJoin('recepcion', 'municipios.id', '=', 'recepcion.id_municipio')
        ->leftJoin('planificacion', 'recepcion.id', '=', 'planificacion.id_recepcion')
        ->leftJoin('inspecciones', 'planificacion.id', '=', 'inspecciones.id_planificacion')
        ->leftJoin('comprobante_pagos', 'inspecciones.id', '=', 'comprobante_pagos.id_inspeccion')
        ->leftJoin('licencias', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
        ->select('municipios.nom_municipio as municipio', DB::raw('count(licencias.id) as total_licencias'))
        ->groupBy('municipios.nom_municipio')
        ->get();

        // Asegurarse de que todos los municipios aparezcan.
        $data = $municipios->map(function($municipio) use ($licencias) {
            $licencia = $licencias->firstWhere('municipio', $municipio->nom_municipio);
            return [
                'municipio' => $municipio->nom_municipio,
                'total_licencias' => $licencia ? $licencia->total_licencias : 0,
            ];
        });
        
        $municipios = DB::table('municipios')->get();

        // Obteniendo los nombres de los minerales y sus categorías de aprovechamiento y procesamiento por municipio
        $recepciones = DB::table('recepcion')
            ->join('minerales', 'recepcion.id_mineral', '=', 'minerales.id')
            ->select('recepcion.id_municipio', 'recepcion.categoria', 'minerales.nombre as mineral')
            ->whereIn('recepcion.categoria', ['Aprovechamiento', 'Procesamiento'])
            ->get();
    
        // Asegurarse de que todos los municipios aparezcan
        $data_mineral = $municipios->map(function($municipio) use ($recepciones) {
            $recepcionesMunicipio = $recepciones->filter(function($recepcion) use ($municipio) {
                return $recepcion->id_municipio == $municipio->id;
            });
    
            $aprovechamiento = $recepcionesMunicipio->filter(function($recepcion) {
                return $recepcion->categoria === 'Aprovechamiento';
            })->pluck('mineral')->unique()->values()->all();
    
            $procesamiento = $recepcionesMunicipio->filter(function($recepcion) {
                return $recepcion->categoria === 'Procesamiento';
            })->pluck('mineral')->unique()->values()->all();
    
            return [
                'municipio' => $municipio->nom_municipio,
                'aprovechamiento' => $aprovechamiento,
                'procesamiento' => $procesamiento
            ];
        });

        $pagos = DB::table('pago_regalias')
        ->join('licencias', 'pago_regalias.id_licencia', '=', 'licencias.id')
        ->join('comprobante_pagos', 'licencias.id_comprobante_pago', '=', 'comprobante_pagos.id')
        ->join('inspecciones', 'comprobante_pagos.id_inspeccion', '=', 'inspecciones.id')
        ->join('planificacion', 'inspecciones.id_planificacion', '=', 'planificacion.id')
        ->join('recepcion', 'planificacion.id_recepcion', '=', 'recepcion.id')
        ->select(
            DB::raw('count(pago_regalias.id) as total'), 
            DB::raw('EXTRACT(MONTH FROM pago_regalias.created_at) as mes'),
            'recepcion.categoria'
        )
        ->whereYear('pago_regalias.created_at', date('Y'))
        ->groupBy(
            DB::raw('EXTRACT(MONTH FROM pago_regalias.created_at)'),
            'recepcion.categoria'
        )
        ->get();

        $data_pagos = $this->prepareChart($pagos);

        return view('estadistica.index', compact('data_recepcion', 'data_inspecciones', 'data', 'data_mineral','data_pagos'));
    }

    private function prepareChartData($recepciones)
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset = array_fill(0, 12, 0); // Inicializar un array con 12 ceros

        foreach ($recepciones as $recepcion) {
            $dataset[$recepcion->mes - 1] = $recepcion->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Número de Recepciones',
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];
    }

    private function preparePieChartData($inspecciones)
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        $aprobadas = array_fill(0, 12, 0); // Inicializar un array con 12 ceros para aprobadas
        $negados = array_fill(0, 12, 0); // Inicializar un array con 12 ceros para negados

        foreach ($inspecciones as $inspeccion) {
            if ($inspeccion->estatus === 'Aprobado') {
                $aprobadas[$inspeccion->mes - 1] = $inspeccion->total;
            } elseif ($inspeccion->estatus === 'Negado') {
                $negados[$inspeccion->mes - 1] = $inspeccion->total;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Aprobadas',
                    'data' => $aprobadas,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ],
                [
                    'label' => 'Negados',
                    'data' => $negados,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];
    }

    private function prepareChart($pagos) {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset_aprovechamiento = array_fill(0, 12, 0); // Inicializar array con 12 ceros para Aprovechamiento
        $dataset_procesamiento = array_fill(0, 12, 0); // Inicializar array con 12 ceros para Procesamiento
    
        foreach ($pagos as $pago) {
            if ($pago->categoria == 'Aprovechamiento') {
                $dataset_aprovechamiento[$pago->mes - 1] = $pago->total;
            } elseif ($pago->categoria == 'Procesamiento') {
                $dataset_procesamiento[$pago->mes - 1] = $pago->total;
            }
        }
    
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Aprovechamiento',
                    'data' => $dataset_aprovechamiento,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ],
                [
                    'label' => 'Procesamiento',
                    'data' => $dataset_procesamiento,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
