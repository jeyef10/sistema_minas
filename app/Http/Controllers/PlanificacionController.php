<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\Recepcion;
use App\Models\Recaudos;
use App\Models\Municipio;
use App\Models\Comisionados;
use App\Models\RecepcionRecaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recepciones = Recepcion::with('solicitante', 'recepcionrecaudos')->get();
        $recaudos = Recaudos::all();
        return view('planificacion.index', compact('recepciones', 'recaudos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recepciones = Recepcion::all();
        $recepcionrecaudos = RecepcionRecaudos::all();
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();

        return view('planificacion.create', compact('recepciones', 'recepcionrecaudos', 'municipios', 'comisionados'));
    }

    /* public function getParroquias($municipioId)
    {
        $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
        return response()->json($parroquias);
    } */

    // public function fetchComisionados(Request $request, $municipioId)
    // {
    //     $municipiocomisionados = Comisionados::where('id_municipio', $municipioId)->get();
    
    //     return response()->json($municipiocomisionados);
    // }

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
     * @param  \App\Models\Planificacion  $Planificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Planificacion $planificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planificacion  $Planificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Planificacion $planificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planificacion  $Planificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planificacion $planificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planificacion  $Planificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planificacion $planificacion)
    {
        //
    }
}
