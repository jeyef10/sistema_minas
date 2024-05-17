<?php

namespace App\Http\Controllers;

use App\Models\Inspecciones;
use App\Models\Solicitudes;
use App\Models\Municipio;
use App\Models\Comisionados;
use App\Models\SolicitudesRecaudos;
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
        $solicitudes = Solicitudes::with('solicitante', 'solicitudesrecaudos')->get();
        return view('inspeccion.index', compact('solicitudes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitudes = Solicitudes::all();
        $solicitudesrecaudos = SolicitudesRecaudos::all();
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();

        return view('inspeccion.create', compact('solicitudes', 'solicitudesrecaudos', 'municipios', 'comisionados'));
    }

    /* public function getParroquias($municipioId)
    {
        $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
        return response()->json($parroquias);
    } */

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
