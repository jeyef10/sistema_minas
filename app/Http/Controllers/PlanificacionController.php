<?php

namespace App\Http\Controllers;

use App\Models\Planificacion;
use App\Models\PlanificacionComisionados;
use App\Models\Recepcion;
use App\Models\Recaudos;
use App\Models\Comisionados;
use App\Models\Municipio;
// use App\Models\MunicipioComisionado;
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
    function __construct()
    {
         $this->middleware('permission:ver-planificacion|crear-planificacion|editar-planificacion|borrar-planificacion', ['only' => ['index']]);
         $this->middleware('permission:crear-planificacion', ['only' => ['create','store']]);
         $this->middleware('permission:editar-planificacion', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-planificacion', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todas las recepciones y cargar relaciones
        $recepciones = Recepcion::with('solicitante', 'recepcionrecaudos')->get();

        // Iterar sobre cada recepción para verificar si está planificada
            $recepciones->each(function ($recepcion) {
                // Buscar en la tabla Planificacion si existe una planificación para esta recepción
                $recepcion->yaPlanificada = Planificacion::where('id_recepcion', $recepcion->id)->exists();
            });

        $recaudos = Recaudos::all();

        return view('planificacion.index', compact('recepciones', 'recaudos'));
    }

    public function getRecepcionDetalles($id)
    {
        $recepcion = Recepcion::with('mineral', 'municipio')->find($id);
        $recaudos = RecepcionRecaudos::with('recepcion', 'recaudo')->where('id_recepcion', $id)->get();

        return ['recepcion' => $recepcion, 'recaudos' => $recaudos];
    }

     public function pdf()
    {
        $recepciones=Recepcion::all();
          $pdf=Pdf::loadView('planificacion.pdf', compact('recepciones'));
          return $pdf->stream();

    }

    
    /**
     * 
     * 
     * 
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $planificacioncomisionados = PlanificacionComisionados::all();
        $comisionados = Comisionados::all();
        $municipios = Municipio::all();
        // $municipiocomisionados = MunicipioComisionado::all();
        $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
        $recepcion = Recepcion::findOrFail($id);
        
        return view('planificacion.create', compact('planificacioncomisionados', 'comisionados', 'municipios', 'solicitantes','recepcion'));
    }


    public function fetchComisionados(Request $request, $municipioId)
    {
        $comisionados = Comisionados::join('municipio_comisionados', 'comisionados.id', '=', 'municipio_comisionados.id_comisionado')
                                ->where('municipio_comisionados.id_municipio', $municipioId)
                                ->select('comisionados.id', 'comisionados.*')
                                ->get();

        return response()->json($comisionados);
    }


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
            'fecha_final' => [
                'required',
                'date_format:d/m/Y',
                'after_or_equal:fecha_inicial', // Permitir que sea igual a la fecha inicial
                function ($attribute, $value, $fail) use ($request) {
                    $fechaInicial = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_inicial'));
                    $fechaFinal = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
                    $diasHabiles = 0;
        
                    // Contar 7 días hábiles (excluyendo sábados y domingos)
                    for ($date = $fechaInicial->copy(); $diasHabiles < 7; $date->addDay()) {
                        if (!$date->isWeekend()) {
                            $diasHabiles++;
                        }
                    }
        
                    // Verificar si 'fecha_final' está dentro del rango de 7 días hábiles
                    if ($fechaFinal->lt($fechaInicial) || $fechaFinal->gt($date->subDay())) {
                        $fail('La fecha final debe estar dentro de los 7 días hábiles después de la fecha inicial.');
                    }
                },
            ],
        ]);

        // Obtener al comisionado por ID de comisionado
        $comisionado = Comisionados::findOrFail($request->input('comisionado'));

        // Verificar si el comisionado tiene un id_usuario asociado
        if (is_null($comisionado->id_usuario)) {
            return redirect()->back()->withErrors('No posees ningún Usuario con este Comisionado.');
        }
        
        // Crear una nueva Planificación
        $planificacion = new Planificacion ();
        $planificacion->id_recepcion = $request->input('id_recepcion');
        $planificacion->id_municipio = $request->input('id_municipio');
        $planificacion->id_comisionado = $request->input('comisionado');
        // $planificacion->fecha_inicial = $request->input('fecha_inicial');
        // $planificacion->fecha_final = $request->input('fecha_final');

        $planificacion->fecha_inicial = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_inicial'))->format('Y-m-d'); 
        $planificacion->fecha_final = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_final'))->format('Y-m-d');
        
        $planificacion->save();

        // Registrar la relación en planificacion_comisionados
        $planificacionComisionado = new PlanificacionComisionados();
        $planificacionComisionado->id_planificacion = $planificacion->id; // Usamos el ID de la planificación creada
        $planificacionComisionado->id_comisionado = $request->input('comisionado');
        $planificacionComisionado->save();

        // Obtener al comisionado por ID de comisionado y luego el usuario correspondiente
        // $comisionado = Comisionados::findOrFail($request->input('comisionado'));
        
        // Obtener al usuario comisionado correspondiente
        $usuarioComisionado = User::findOrFail($comisionado->id_usuario);

        $datosNotificacion = [
            'mensaje' => 'Se le ha asignado una nueva inspección.',
            'id_planificacion' => $planificacion->id,
        ];

        $usuarioComisionado->notify(new NombreNotificacion($datosNotificacion, $planificacion));

        $administradores = User::role('Administrador')->get();
        Notification::send($administradores, new NombreNotificacion($datosNotificacion, $planificacion));

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
        $fecha_inicial = date('d/m/Y', strtotime($planificacion->fecha_inicial));
        $fecha_final = date('d/m/Y', strtotime($planificacion->fecha_final));
        $estatus = $planificacion->estatus;

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
        // $planificacion->fecha_inicial = $request->input('fecha_inicial');
        // $planificacion->fecha_final = $request->input('fecha_final');
        $planificacion->fecha_inicial = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_inicial'))->format('Y-m-d'); 
        $planificacion->fecha_final = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_final'))->format('Y-m-d');

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
