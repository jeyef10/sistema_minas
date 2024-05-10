<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use App\Models\Solicitante;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
// use App\Models\Minerales;
// use App\Models\Plazos;
// use App\Models\Regalia;
// use App\Models\Municipio;
// use App\Models\Parroquia;
use App\Models\Recaudos;
use App\Models\SolicitudesRecaudos;
// use App\Models\Comisionados;
// use App\Models\SolicitudesComisionados;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $solicitudes = Solicitudes::with('solicitante','solicitanteEspecifico','recaudo')->get(); 
        return view('solicitudes.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $solicitantes = Solicitante::all();
        $recaudos = Recaudos::orderBy('nombre', 'asc')->get();
        $solicitudesrecaudos = SolicitudesRecaudos::all();

        return view('solicitudes.create', compact('solicitantes', 'solicitudesrecaudos', 'recaudos',));
    }

    // public function getParroquias($municipioId)
    // {
    //     $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
    //     return response()->json($parroquias);
    // }

    public function fetchSolicitantesByTipo(Request $request, $tipoSolicitante)
    {
        $solicitantes = Solicitante::where('tipo', $tipoSolicitante)->get();

        $solicitantes = Solicitante::with('solicitanteEspecifico')
        ->where('tipo', $tipoSolicitante)
        ->get();

        return response()->json($solicitantes);
    }

    // public function fetchComisionados(Request $request, $comisionados)
    // {
    //     $comisionados = Comisionado::where('id_municipio', $municipioId)
    //         ->where('id_parroquia', $parroquiaId)
    //         ->get();

    //     return response()->json($comisionados);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // Crear una nueva solicitud
        $solicitud = new Solicitudes();
        $solicitud->id_solicitante = $request->input('solicitante_especifico_id');
        $solicitud->fecha = $request->input('simpleDataInput');
       
        $solicitud->save();

        // Guardar la relación con los recaudos (tabla puente)
        $puente = new SolicitudesRecaudos();
     
        $puente->id_recaudos = $request->input('recaudos');
        $puente->id_solicitud = 1;
    
      
        return response($puente);
        return redirect('solicitudes');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitudes $solicitudes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitudes $solicitudes)
    {
        //
    }
}
