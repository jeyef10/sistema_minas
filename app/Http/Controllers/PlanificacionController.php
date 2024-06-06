<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\PlanificacionComisionados;
use App\Models\Recepcion;
use App\Models\Recaudos;
use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\RecepcionRecaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

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

    public function getRecepcionDetalles($id)
    {
        $recepcion = Recepcion::with('mineral', 'municipio')->find($id);
        $recaudos = RecepcionRecaudos::with('recepcion', 'recaudo')->where('id_recepcion', $id)->get();

        return ['recepcion' => $recepcion, 'recaudos' => $recaudos];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $planificacioncomisionados = PlanificacionComisionados::all();
        $comisionados = Comisionados::all();
        $recepciones = Recepcion::all();
        $municipios = Municipio::all();
        
        return view('planificacion.create', compact('planificacioncomisionados', 'comisionados', 'recepciones', 'municipios' ));
    }

    public function fetchComisionados(Request $request, $municipioId)
    {
        $municipiocomisionados = Comisionados::where('id_municipio', $municipioId)->get();
    
        return response()->json($municipiocomisionados);
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
