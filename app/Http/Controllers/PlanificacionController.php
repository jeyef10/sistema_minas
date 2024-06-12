<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\PlanificacionComisionados;
use App\Models\Recepcion;
use App\Models\Recaudos;
use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\RecepcionRecaudos;
use App\Models\Solicitante;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
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
        $municipios = Municipio::all();
        $solicitantes = Solicitante::with('solicitanteEspecifico')->get();

        // $id->repcecion->id_recepcion;

        $recepcion = Recepcion::all();
        
        return view('planificacion.create', compact('planificacioncomisionados', 'comisionados', 'municipios', 'solicitantes'));
    }

    public function fetchComisionados(Request $request, $municipioId)
    {
        $municipiocomisionados = Comisionados::where('id_municipio', $municipioId)->get();
    
        return response()->json($municipiocomisionados);
    }

    // public function getRecepcionDatos($recepcionId)
    // {
        
    //     $datos_recepcion = Recepcion::where('id_recepcion', $recepcionId)->get();
    //     dd($$datos_recepcion);
    //     return response()->json($datos_recepcion);
    
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'fecha_inicial' => 'required|date_format:d/m/Y|after_or_equal:today', // Garantiza que la fecha inicial sea hoy o en el futuro.
            'fecha_final' => 'required|date_format:d/m/Y|after:fecha_inicial|before_or_equal:'// Limita la fecha final a la próxima semana, incluido hoy y los próximos siete días.
        ]);

        // Crear una nueva Planificación
        $planificacion = new Planificacion ();
        $planificacion->id_recepcion = $request->input('id_recepcion');
        $planificacion->id_municipio = $request->input('id_municipio');
        $planificacion->id_comisionado = $request->input('comisionado');
        $planificacion->fecha_inicial = $request->input('fecha_inicial');
        $planificacion->fecha_final = $request->input('fecha_final');
        $planificacion->estatus = $request->input('estatus');
        
        $planificacion->save();

        // Obtener los IDs de recaudos seleccionados (debe ser un array)
        // $recaudosSeleccionados = $request->input('recaudos');

        // Crear registros en la tabla puente para cada comisionado
        // foreach ($recaudosSeleccionados as $recaudo) {
        //     $puente = new RecepcionRecaudos();
        //     $puente->id_recaudo = $recaudo;
        //     $puente->id_recepcion = $recepcion->id;
        //     $puente->save();// Guardar la instancia de la tabla puente (planificacion_comisionados)
        // }

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('planificacion');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

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
