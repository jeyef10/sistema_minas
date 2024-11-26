<?php

namespace App\Http\Controllers;
use App\Models\Licencias;
use App\Models\ComprobantePago;
use App\Models\Plazos;
use App\Models\ControlRegalia;
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

        // Iterar sobre cada planificación para verificar si fue inspeccionada
        $comprobante_pagos ->each(function ($comprobante_pago) {
            // Buscar en la tabla comprobante_pagoes si existe una comprobante_pago para esta comprobante_pagoe
            $comprobante_pago->yaLicenciado = Licencias::where('id_comprobante_pago', $comprobante_pago->id)->exists();
        });

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

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_inspeccion' => $comprobante_pago->inspeccion->planificacion->recepcion->categoria,
            'banco' =>$comprobante_pago->banco,
            'n_referencia' =>$comprobante_pago->n_referencia,
            'comprobante_pdf' => $comprobante_pago->comprobante_pdf,
            'observaciones_com' => $comprobante_pago->observaciones_com,
            'timbre_fiscal' => $comprobante_pago->timbre_fiscal,
            'observaciones_fiscal' => $comprobante_pago->observaciones_fiscal,
            
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $comprobante_pago = ComprobantePago::findOrFail($id);
        $plazos = Plazos::all();

        $categoria = $comprobante_pago->inspeccion->planificacion->recepcion->categoria;

        $year = date('Y');
        $contador = 1;
        $contadores = 1;
        $codigo_apro = '';
        $codigo_hpc = '';
        $codigo_la = '';
        $codigo_lp = '';

        // Obtener la categoría desde la tabla recepcion
        $categoria = DB::table('comprobante_pagos')
            ->join('inspecciones', 'comprobante_pagos.id_inspeccion', '=', 'inspecciones.id')
            ->join('planificacion', 'inspecciones.id_planificacion', '=', 'planificacion.id')
            ->join('recepcion', 'planificacion.id_recepcion', '=', 'recepcion.id')
            ->where('comprobante_pagos.id', $id)
            ->value('recepcion.categoria');

        // Obtener el último contador para la categoría y el año actual
        $lastRecord = DB::table('licencias')
            ->join('comprobante_pagos', 'licencias.id_comprobante_pago', '=', 'comprobante_pagos.id')
            ->join('inspecciones', 'comprobante_pagos.id_inspeccion', '=', 'inspecciones.id')
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
                $contador = intval($lastCode[0]) + 1; // Incrementar el contador basado en el último registro
            } elseif ($categoria == 'Procesamiento') {
                $lastCode = explode('/', $lastRecord->resolucion_hpc); 
                $lastCounter = explode('-', $lastCode[0]); // Separar "HPC" del contador 
                $contador = intval($lastCounter[1]) + 1;
            }
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
            ->join('comprobante_pagos', 'licencias.id_comprobante_pago', '=', 'comprobante_pagos.id')
            ->join('inspecciones', 'comprobante_pagos.id_inspeccion', '=', 'inspecciones.id')
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
                $contadores = intval($lastCode[2]) + 1; // Incrementar el contador basado en el último registro
            } elseif ($categoria == 'Procesamiento') {
                $lastCode = explode('-', $lastCatastroRecord->catastro_lp);
                $contadores = intval($lastCode[2]) + 1; // Incrementar el contador basado en el último registro
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

        return view('licencia.create', compact('comprobante_pago', 'plazos', 'codigo_apro', 'codigo_hpc', 'codigo_la', 'codigo_lp', 'categoria'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'fecha_oficio' => 'required|date|date_format:d/m/Y|after_or_equal:'.date('d/m/Y'),
        // ], [
        //     'fecha_oficio.required' => 'La fecha de pago es obligatoria.',
        //     'fecha_oficio.date' => 'La fecha de pago debe ser una fecha válida.',
        //     'fecha_oficio.date_format' => 'La fecha de pago debe tener el formato AAAA-MM-DD.',
        //     'fecha_oficio.after_or_equal' => 'La fecha de pago debe ser la fecha actual.',
        // ]);

        //Crear una nueva Licencia 
        $licencias = new Licencias();
        $licencias->id_comprobante_pago = $request->input('id_comprobante_pago');
        $categoria_recepcion = $request->input('categoria');
        $nombre_mineral = $request->input('nombre_mineral');
        $licencias->resolucion_apro = $request->input('resolucion_apro');
        $licencias->resolucion_hpc = $request->input('resolucion_hpc');
        $licencias->catastro_la = $request->input('catastro_la');
        $licencias->catastro_lp = $request->input('catastro_lp');
        $licencias->providencia = $request->input('providencia');
        $licencias->num_territorio = $request->input('num_territorio');
        $licencias->metodo_licencia_apro = $request->input('metodo_licencia_apro');
        $licencias->metodo_licencia_pro = $request->input('metodo_licencia_pro');


        $nro_cuotas_apro = 0;

        if ($licencias->metodo_licencia_apro == 'Pago unico') {
            // $licencias->nro_cuotas = 1;
            $nro_cuotas_apro = 1;
        }elseif ($licencias->metodo_licencia_apro == 'Pago 2 parte') {
            // $licencias->nro_cuotas = 2;
            $nro_cuotas_apro = 2;
        }elseif ($licencias->metodo_licencia_apro == 'Pago 3 parte') {
            // $licencias->nro_cuotas = 3;
            $nro_cuotas_apro = 3;
        } 

        

        $licencias->fecha_oficio = $request->input('fecha_oficio');
        $licencias->id_plazo = $request->input('id_plazo');
        $licencias->fecha_inicial_ope = $request->input('fecha_inicial_ope');
        $licencias->fecha_final_ope = $request->input('fecha_final_ope');
        $licencias->talonario = $request->input('talonario');

          // Inicializar la variable nro_cuotas
        $nro_cuotas_pro = 0;

        // Verificar si el método de licencia es "Pago cuotas"
        if ($licencias->metodo_licencia_pro === 'Pago cuotas') {
            // Buscar el plazo por id
            $plazo = Plazos::findOrFail($licencias->id_plazo);

            // Verificar la medida_tiempo y calcular nro_cuotas
            if ($plazo->medida_tiempo === "mes(es)") {
                $nro_cuotas_pro = $plazo->cantidad;

                
            } elseif ($plazo->medida_tiempo === "año(s)") {
                $nro_cuotas_pro = $plazo->cantidad * 12;
            }
        }

        if ($nro_cuotas_apro == 0) {
           // Guardar la variable nro_cuotas en la licencia
            $licencias->nro_cuotas = $nro_cuotas_pro;
        } else {
            $licencias->nro_cuotas = $nro_cuotas_apro;
        }

        if ($categoria_recepcion == "Aprovechamiento") {
            $licencias->metodo_control_pro = null;
        } else {
            
            if ($nombre_mineral == "Roca caliza") {
                $licencias->metodo_control_pro = $request->input('metodo_control_pro');
            } else {
                $licencias->metodo_control_pro = null;
            }
            
        }
        

        $licencias->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('pago_regalia');
    
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
        $comprobante_pago = ComprobantePago::find($id);
        $plazos = Plazos::all();
        $categoria = $licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria;
        
        // Contar el número de pagos realizados para esta licencia específica 
        $numeroPagos = ControlRegalia::where('id_licencia', $licencia->id)->count();

        $resolucion_apro = $licencia->resolucion_apro;
        $catastro_la = $licencia->catastro_la;
        $resolucion_hpc = $licencia->resolucion_hpc;
        $catastro_lp = $licencia->catastro_lp;
        $providencia = $licencia->providencia;
        $num_territorio = $licencia->num_territorio;
        $metodo_licencia_apro = $licencia->metodo_licencia_apro;
        $metodo_licencia_pro = $licencia->metodo_licencia_pro;
        $fecha_oficio = $licencia->fecha_oficio;
        $fecha_inicial_ope = $licencia->fecha_inicial_ope;
        $fecha_final_ope = $licencia->fecha_final_ope;
        $id_plazo = $licencia->plazo;
        $talonario = $licencia->talonario;

        return view('licencia.edit' , compact('licencia', 'comprobante_pago', 'plazos', 'categoria', 'numeroPagos','resolucion_apro',
        'catastro_la', 'num_territorio', 'metodo_licencia_apro', 'metodo_licencia_pro', 'resolucion_hpc', 
        'catastro_lp', 'providencia', 'fecha_oficio', 'fecha_inicial_ope', 'fecha_final_ope', 'id_plazo',
        'talonario'));

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
        $licencia->id_comprobante_pago = $request->input('id_comprobante_pago');
        $categoria = $request->input('categoria');
        $nombre_mineral = $request->input('nombre_mineral');
        $licencia->resolucion_apro = $request->input('resolucion_apro');
        $licencia->resolucion_hpc = $request->input('resolucion_hpc');
        $licencia->catastro_la = $request->input('catastro_la');
        $licencia->catastro_lp = $request->input('catastro_lp');
        $licencia->providencia = $request->input('providencia');
        $licencia->num_territorio = $request->input('num_territorio');
        $licencia->metodo_licencia_apro = $request->input('metodo_licencia_apro');
        $licencia->metodo_licencia_pro = $request->input('metodo_licencia_pro');

        $nro_cuotas_apro = 0;

        if ($licencia->metodo_licencia_apro == 'Pago unico') {
            $nro_cuotas_apro = 1;
        }elseif ($licencia->metodo_licencia_apro == 'Pago 2 parte') {
            $nro_cuotas_apro = 2;
        }elseif ($licencia->metodo_licencia_apro == 'Pago 3 parte') {
            $nro_cuotas_apro = 3;
        } 

        $licencia->fecha_oficio = $request->input('fecha_oficio');
        $licencia->fecha_inicial_ope = $request->input('fecha_inicial_ope');
        $licencia->fecha_final_ope = $request->input('fecha_final_ope');
        $licencia->id_plazo = $request->input('id_plazo');
        $licencia->talonario = $request->input('talonario');

        // Inicializar la variable nro_cuotas
        $nro_cuotas_pro = 0;

        // Verificar si el método de licencia es "Pago cuotas"
        if ($licencia->metodo_licencia_pro === 'Pago cuotas') {
            // Buscar el plazo por id
            $plazo = Plazos::findOrFail($licencia->id_plazo);

            // Verificar la medida_tiempo y calcular nro_cuotas
            if ($plazo->medida_tiempo === "mes(es)") {
                $nro_cuotas_pro = $plazo->cantidad;

                
            } elseif ($plazo->medida_tiempo === "año(s)") {
                $nro_cuotas_pro = $plazo->cantidad * 12;
            }
        }

        if ($nro_cuotas_apro == 0) {
            // Guardar la variable nro_cuotas en la licencia
            $licencia->nro_cuotas = $nro_cuotas_pro;
        } else {
            $licencia->nro_cuotas = $nro_cuotas_apro;
        }

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



   

   

    

 
