<?php

namespace App\Http\Controllers;

use App\Models\Inspecciones;
use App\Models\Solicitudes;
use App\Models\SolicitudesRecaudos;
use App\Models\Solicitante;
use App\Models\PersonaNatural;
use App\Models\PersonaJuridica;
use App\Models\Recaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitudes::with('solicitante','solicitanteEspecifico', 'recaudo')->get(); 
       
        $soliAgrupadas = $solicitudes->groupBy(function($solicitud) {
            // Agrupa por la identificación de solicitante y solicitud.
            return $solicitud->solicitante_especifico_id . '-' . $solicitud->id;
        });
    
        
        return view('inspeccion.index', compact('solicitudes'));
    }

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
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function show(Inspecciones $inspecciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspecciones $inspecciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspecciones $inspecciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspecciones $inspecciones)
    {
        //
    }
}
