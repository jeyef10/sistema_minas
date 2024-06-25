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
use App\Models\User;
use App\Notifications\NombreNotificacion;
use Illuminate\Support\Facades\Notification;

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
    public function create($id)
    {
        $planificacioncomisionados = PlanificacionComisionados::all();
        $comisionados = Comisionados::all();
        $municipios = Municipio::all();
        $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
        $recepcion = Recepcion::findOrFail($id);

        // $id = Recepcion::all()->random()->id;

        // $recepcion = Recepcion::find($id);
        
        return view('planificacion.create', compact('planificacioncomisionados', 'comisionados', 'municipios', 'solicitantes','recepcion'));
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
            'fecha_inicial' => 'required|date_format:d/m/Y|after_or_equal:today',
            'fecha_final' => 'required|date_format:d/m/Y|after:fecha_inicial|before_or_equal:' . date('d/m/Y', strtotime('+7 days')),
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

        // Registrar la relación en planificacion_comisionados
        $planificacionComisionado = new PlanificacionComisionados();
        $planificacionComisionado->id_planificacion = $planificacion->id; // Usamos el ID de la planificación creada
        $planificacionComisionado->id_comisionado = $request->input('comisionado');
        $planificacionComisionado->save();

        // Crear y enviar la notificación
        
        $usuariosNotificar = User::role(['Administrador', 'Comisionado'])->get();
        $datosNotificacion = [
            /* 'mensaje' => 'Se ha creado una nueva planificación.', */
            /* 'link' => route('create', ['id' => $planificacion->id]), */
            'id_planificacion' => $planificacion->id,
        ];

        // dd( $datosNotificacion);

        Notification::send($usuariosNotificar, new NombreNotificacion($datosNotificacion, $planificacion));

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('inspeccion');
    
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
    public function edit($id)
    {
        $planificacion = Planificacion::findOrFail($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();
        $fecha_inicial = $planificacion->fecha_inicial;
        $fecha_final = $planificacion->fecha_final;
        $estatus = $planificacion->estatus;

        // $id = Recepcion::all()->random()->id;

        $recepcion = Recepcion::find($id);

        return view('planificacion.edit' , compact('planificacion', 'municipios', 'comisionados', 'fecha_inicial',
        'fecha_final', 'estatus', 'recepcion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planificacion  $Planificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Obtener la recepcion por ID
        $planificacion = Planificacion::findOrFail($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();

        // Actualizar los campos según los datos del formulario
        $planificacion->id_recepcion = $request->input('id_recepcion');
        $planificacion->id_municipio = $request->input('id_municipio');
        $planificacion->id_comisionado = $request->input('comisionado');
        $planificacion->fecha_inicial = $request->input('fecha_inicial');
        $planificacion->fecha_final = $request->input('fecha_final');
        $planificacion->estatus = $request->input('estatus');

        $planificacion->save();

        // Actualizar la relación en planificacion_comisionados (si es necesario)
        // Por ejemplo, si deseas cambiar el comisionado asociado
        $planificacionComisionado = PlanificacionComisionados::where('id_planificacion', $id)->first();
        if ($planificacionComisionado) {
            $planificacionComisionado->id_comisionado = $request->input('comisionado');
            $planificacionComisionado->save();
        } else {
            // Crear una nueva entrada en la tabla puente
            $nuevoPlanificacionComisionado = new PlanificacionComisionados();
            $nuevoPlanificacionComisionado->id_planificacion = $id;
            $nuevoPlanificacionComisionado->id_comisionado = $request->input('comisionado');
            $nuevoPlanificacionComisionado->save();
        }

        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect('inspeccion');

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
