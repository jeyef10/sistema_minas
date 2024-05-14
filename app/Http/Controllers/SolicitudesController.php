<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use App\Models\Solicitante;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
use App\Models\Recaudos;
use App\Models\SolicitudesRecaudos;
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
       // 
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

    public function fetchSolicitantesByTipo(Request $request, $tipoSolicitante)
    {
        $solicitantes = Solicitante::where('tipo', $tipoSolicitante)->get();

        $solicitantes = Solicitante::with('solicitanteEspecifico')
        ->where('tipo', $tipoSolicitante)
        ->get();

        return response()->json($solicitantes);
    }

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

        $solicitud->save();// Guardar la instancia de la tabla solicitudes
        
        // Obtener los IDs de recaudos seleccionados (debe ser un array)
        $recaudosSeleccionados = $request->input('recaudos');

        // Crear registros en la tabla puente para cada recaudo seleccionado
        foreach ($recaudosSeleccionados as $recaudo) {
            $puente = new SolicitudesRecaudos();
            $puente->id_recaudo = $recaudo;
            $puente->id_solicitud = $solicitud->id;
            $puente->save();// Guardar la instancia de la tabla puente (solicitudes_recaudos)
        }

        return redirect('inspeccion');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener la solicitud con el ID especificado
        $solicitud = Solicitudes::find($id);

        // Verificar si la solicitud existe
        if (!$solicitud) {
            return redirect('inspeccion')->with('error', 'Solicitud no encontrada');
        }

        // Obtener los IDs de recaudos asociados a la solicitud
        $recaudos = SolicitudesRecaudos::where('id_solicitud', $solicitud->id)->pluck('id_recaudo');

        // Obtener los recaudos completos con los id obtenidos
        $recaudos = Recaudos::whereIn('id', $recaudos)->get();

        // Devolver la vista con la solicitud y sus recaudos asociados
        return view('inspeccion.show', [
            'solicitud' => $solicitud,
            'recaudos' => $recaudos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitudes = Solicitudes::findOrFail($id);
        return view('solicitudes.edit' , compact('solicitudes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitudes  $solicitudes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Obtener la solicitud por ID
        $solicitud = Solicitudes::findOrFail($id);

        // Actualizar los campos según los datos del formulario
        $solicitud->id_solicitante = $request->input('solicitante_especifico_id');
        $solicitud->fecha = $request->input('simpleDataInput');
        $solicitud->save();

        // Actualizar los registros en la tabla puente (solicitudes_recaudos)
        $recaudosSeleccionados = $request->input('recaudos');
        SolicitudesRecaudos::where('id_solicitud', $id)->delete(); // Eliminar registros anteriores
        foreach ($recaudosSeleccionados as $recaudo) {
            $puente = new SolicitudesRecaudos();
            $puente->id_recaudo = $recaudo;
            $puente->id_solicitud = $solicitud->id;
            $puente->save();
        }

        return redirect('inspeccion', ['id' => $solicitud->id]);
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
