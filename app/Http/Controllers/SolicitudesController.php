<?php

namespace App\Http\Controllers;

use App\Models\Solicitudes;
use App\Models\Minerales;
use App\Models\Plazos;
use App\Models\Regalia;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Solicitante;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // $solicitudes = Solicitudes::with('solicitanteEspecifico')->get();
        // return view('solicitudes.index', compact('solicitudes'));
        // $solicitudes = Solicitudes::all(); 

        // $solicitudesWithRequesters = Solicitudes::with('solicitanteEspecifico')->get();
        // return view('solicitudes.index', compact('solicitudes'));

        $solicitudes = Solicitudes::query();

        // Filtrar por tipo de solicitante (natural o jurídico) si se especifica
        if ($request->has('tipo_solicitante')) {
            $tipoSolicitante = $request->input('tipo_solicitante');
            $solicitudes->whereHas('solicitante', function ($query) use ($tipoSolicitante) {
                $query->where('tipo', $tipoSolicitante);
            });
        }
        return view('solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $solicitantes = Solicitante::all();
        $minerales = Minerales::all();
        $plazos = Plazos::all();
        $regalias = Regalia::all();
        $municipios = Municipio::all();
        $parroquias = Parroquia::all();

        return view('solicitudes.create', compact('plazos', 'minerales', 'regalias', 'solicitantes', 'municipios', 'parroquias'));
    }

    public function getParroquias($municipioId)
    {
        $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
        return response()->json($parroquias);
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
        // Validar los datos de entrada
        $validatedData = $request->validate([
        'id_solicitante' => 'required',
        'id_mineral' => 'required',
        'id_regalia' => 'required',
        'id_plazo' => 'required',
        'id_municipio' => 'required',
        'id_parroquia' => 'required',
        'tipo_mineral' => 'required',
        'nom_mineral' => 'required',
        'tasa_regalias' => 'required',
        'num_regalias' => 'required',
        'plazo' => 'required',
        'volumen' => 'required',
        'direccion' => 'required',
        'fecha' => 'required',
        'observaciones' => 'nullable',
        'estatus' => 'required',
        'tipo_solicitante' => 'required|in:natural,juridica', // Validar tipo de solicitante
        'datos_solicitante.cedula' => 'required|string|min:8|max:10', // Validar datos del solicitante (cedula para natural)
        'datos_solicitante.nombre' => 'required|string|max:255', // Validar datos del solicitante (nombre para natural)
        'datos_solicitante.apellido' => 'required|string|max:255', // Validar datos del solicitante (apellido para natural)
        'datos_solicitante.rif' => 'required|string|min:8|max:12', // Validar datos del solicitante (rif para juridica)
        'datos_solicitante.nombre_empresa' => 'required|string|max:255', // Validar datos del solicitante (nombre empresa para juridica)
        'datos_solicitante.correo' => 'required|email', // Validar datos del solicitante (correo para juridica)
    ]);

        // Crea un nuevo objeto Solicitudes
        $solicitud = new Solicitudes;

        $solicitud->fecha = $validatedData['fecha'];
        $solicitud->tipo = $validatedData['tipo'];
        $solicitud->num_minero = $validatedData['num_minero'];
        $solicitud->id_mineral = $validatedData['id_mineral'];
        $solicitud->tasa_regalias = $validatedData['tasa_regalias']; 
        $solicitud->volumen = $validatedData['volumen'];
        $solicitud->plazo = $validatedData['plazo'];
        $solicitud->estatus = $validatedData['estatus'];

        // Crea la instancia del solicitante (PersonaNatural o PersonaJuridica)
        $solicitanteData = $validatedData['datos_solicitante'];
        if ($validatedData['tipo_solicitante'] === 'natural') {
            $solicitante = new PersonaNatural;
            $solicitante->cedula = $solicitanteData['cedula'];
            $solicitante->nombre = $solicitanteData['nombre'];
            $solicitante->apellido = $solicitanteData['apellido'];
            $solicitante->save();
        } else {
            $solicitante = new PersonaJuridica;
            $solicitante->rif = $solicitanteData['rif'];
            $solicitante->nombre = $solicitanteData['nombre_empresa'];
            $solicitante->correo = $solicitanteData['correo'];
            $solicitante->save();
        }

        $solicitud->solicitanteEspecifico()->associate($solicitante);

        $solicitud->save();

        // Determinar el tipo de mensaje del solicitante
        $requesterTypeMessage = '';
        if ($validatedData['datos_solicitante']['tipo'] === 'natural') {
            $requesterTypeMessage = 'Solicitud registrada para Persona Natural';
        } else {
            $requesterTypeMessage = 'Solicitud registrada para Persona Jurídica';
        }

        // Obtenga la URL anterior de la solicitud (si se proporciona)
        $previousUrl = $request->input('previous_url');

        // Redirigir nuevamente con un mensaje de éxito (si existe la URL anterior)
        if ($previousUrl) {
            return redirect($previousUrl)->with('success', $requesterTypeMessage);
        }

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
