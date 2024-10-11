<?php

namespace App\Http\Controllers;
use App\Models\Licencias;
use App\Models\Inspecciones;
use App\Models\ComprobantePago;
use App\Models\Plazos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class LicenciaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-licencia|crear-licencia|editar-licencia|borrar-licencia', ['only' => ['index']]);
         $this->middleware('permission:crear-licencia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-licencia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-licencia', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comprobante_pagos = ComprobantePago::all();

        return view('licencia.index', compact('comprobante_pagos'));
    }

    public function getComprobanteDetalles($id)
    {
        // Recupera la inspección por su ID
        $comprobante_pago = ComprobantePago::find($id);

        if (!$comprobante_pago) {
            // Maneja el caso en que no se encuentre la inspección
            return response()->json(['error' => 'Comprobante no encontrada'], 404);
        }

        $comprobante_pdf = json_decode($comprobante_pago->comprobante_pdf, true);

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_inspeccion' => $comprobante_pago->inspeccion->planificacion->recepcion->categoria,
            'comprobante_pdf' => $comprobante_pago->comprobante_pdf,
            
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $inspeccion = Inspecciones::findOrFail($id);
        $plazos = Plazos::all();

        $year = date('Y');
        $contador = 1;
        $contadores = 1;
        $codigo_apro = '';
        $codigo_hpc = '';
        $codigo_la = '';
        $codigo_lp = '';

        // Obtener la categoría desde la tabla recepcion
        $categoria = DB::table('inspecciones')
            ->join('planificacion', 'inspecciones.id_planificacion', '=', 'planificacion.id')
            ->join('recepcion', 'planificacion.id_recepcion', '=', 'recepcion.id')
            ->where('inspecciones.id', $id)
            ->value('recepcion.categoria');

        // Obtener el último contador para la categoría y el año actual
        $lastRecord = DB::table('licencias')
            ->join('inspecciones', 'licencias.id_inspeccion', '=', 'inspecciones.id')
            ->join('planificacion', 'inspecciones.id_planificacion', '=', 'planificacion.id')
            ->join('recepcion', 'planificacion.id_recepcion', '=', 'recepcion.id')
            ->where('recepcion.categoria', $categoria)
            ->whereYear('licencias.created_at', $year)
            ->orderBy('licencias.id', 'desc')
            ->first();

        // Ajustar el contador para la categoría
        if ($lastRecord) {
            if ($categoria == 'Aprovechamiento') {
                $lastCode = explode('/', $lastRecord->resolucion_apro);
            } elseif ($categoria == 'Procesamiento') {
                $lastCode = explode('/', $lastRecord->resolucion_hpc);
            }
            $contador = 1; // Inicializar contador a 1 para cada nueva serie
        }

        // Formatear el contador con ceros a la izquierda
        $contadorFormatted = str_pad($contador, 3, '0', STR_PAD_LEFT);

        // Generar el código basado en la categoría
        if ($categoria == 'Aprovechamiento') {
            $codigo_apro = "$contadorFormatted/$year";
        } elseif ($categoria == 'Procesamiento') {
            $codigo_hpc = "HPC-$contadorFormatted/$year";
        }

        // Obtener el último contador para catastro_la y catastro_lp para el año actual
        $lastCatastroRecord = DB::table('licencias')
            ->join('inspecciones', 'licencias.id_inspeccion', '=', 'inspecciones.id')
            ->join('planificacion', 'inspecciones.id_planificacion', '=', 'planificacion.id')
            ->join('recepcion', 'planificacion.id_recepcion', '=', 'recepcion.id')
            ->where('recepcion.categoria', $categoria)
            ->whereYear('licencias.created_at', $year)
            ->orderBy('licencias.id', 'desc')
            ->first();

        // Ajustar el contador para catastro_la y catastro_lp
        if ($lastCatastroRecord) {
            if ($categoria == 'Aprovechamiento') {
                $lastCode = explode('-', $lastCatastroRecord->catastro_la);
                $contadores = 1; // Inicializar contador a 1 para cada nueva serie
            } elseif ($categoria == 'Procesamiento') {
                $lastCode = explode('-', $lastCatastroRecord->catastro_lp);
                $contadores = 1; // Inicializar contador a 1 para cada nueva serie
            }
        }

        // Formatear el contador con ceros a la izquierda
        $contadorFormatted = str_pad($contadores, 3, '0', STR_PAD_LEFT);

        // Generar el código basado en la categoría
        if ($categoria == 'Aprovechamiento') {
            $codigo_la = "YA-RMT/LA-$contadorFormatted";
        } elseif ($categoria == 'Procesamiento') {
            $codigo_lp = "YA-RMT/LP-$contadorFormatted";
        }

        return view('licencia.create', compact('inspeccion', 'plazos', 'codigo_apro', 'codigo_hpc', 'codigo_la', 'codigo_lp'));

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
            'fecha_oficio' => 'required|date|date_format:d/m/Y|after_or_equal:'.date('d/m/Y'),
        ], [
            'fecha_oficio.required' => 'La fecha de pago es obligatoria.',
            'fecha_oficio.date' => 'La fecha de pago debe ser una fecha válida.',
            'fecha_oficio.date_format' => 'La fecha de pago debe tener el formato AAAA-MM-DD.',
            'fecha_oficio.after_or_equal' => 'La fecha de pago debe ser la fecha actual.',
        ]);

        //Crear una nueva Licencia 
        $licencias = new Licencias();
        $licencias->id_inspeccion = $request->input('id_inspeccion');
        $licencias->resolucion_apro = $request->input('resolucion_apro');
        $licencias->resolucion_hpc = $request->input('resolucion_hpc');
        $licencias->catastro_la = $request->input('catastro_la');
        $licencias->catastro_lp = $request->input('catastro_lp');
        $licencias->providencia = $request->input('providencia');
        $licencias->num_territorio = $request->input('num_territorio');
        $licencias->fecha_oficio = $request->input('fecha_oficio');
        $licencias->id_plazo = $request->input('id_plazo');
        $licencias->talonario = $request->input('talonario');

        $licencias->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('control');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licencia = Licencias::find($id);
        return view('control.index', compact('licencia'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licencia = Licencias::findOrFail($id);
        $inspeccion = Inspecciones::find($id);
        $plazos = Plazos::all();
        $resolucion_apro = $licencia->resolucion_apro;
        $catastro_la = $licencia->catastro_la;
        $resolucion_hpc = $licencia->resolucion_hpc;
        $catastro_lp = $licencia->catastro_lp;
        $providencia = $licencia->providencia;
        $num_territorio = $licencia->num_territorio;
        $fecha_oficio = $licencia->fecha_oficio;
        $id_plazo = $licencia->plazo;
        $talonario = $licencia->talonario;

        return view('licencia.edit' , compact('licencia', 'inspeccion', 'plazos', 'resolucion_apro',
        'catastro_la', 'num_territorio', 'resolucion_hpc', 'catastro_lp', 'providencia', 'fecha_oficio', 'id_plazo', 'talonario'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Buscar la Licencia existente        
        $licencia = licencias::findOrFail($id);
        $licencia->id_inspeccion = $request->input('id_inspeccion');
        $licencia->resolucion_apro = $request->input('resolucion_apro');
        $licencia->resolucion_hpc = $request->input('resolucion_hpc');
        $licencia->catastro_la = $request->input('catastro_la');
        $licencia->catastro_lp = $request->input('catastro_lp');
        $licencia->providencia = $request->input('providencia');
        $licencia->num_territorio = $request->input('num_territorio');
        $licencia->fecha_oficio = $request->input('fecha_oficio');
        $licencia->id_plazo = $request->input('id_plazo');
        $licencia->talonario = $request->input('talonario');

        $licencia->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect('pago_regalia');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
