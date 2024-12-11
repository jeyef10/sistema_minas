<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\PagoRegalia;
use App\Models\Licencias;
use App\Models\Minerales;
use App\Models\Recepcion;
use App\Models\ControlRegalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class PagoRegaliaController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:ver-pago_regalia|crear-pago_regalia|editar-pago_regalia|borrar-pago_regalia', ['only' => ['index']]);
         $this->middleware('permission:crear-pago_regalia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-pago_regalia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-pago_regalia', ['only' => ['destroy']]);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $licencias = licencias::all();

        // Iterar sobre cada licencia para verificar los pagos realizados si es "Aprovechamiento"
        $licencias->each(function ($licencia) {
            // Obtener la categoría de la licencia desde la tabla recepcion
            // $categoria = $licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria;

            $nroCuotas = $licencia->nro_cuotas;
                
            // Buscar en la tabla control_regalias los pagos realizados para esta licencia
            $pagosRealizados = ControlRegalia::where('id_licencia', $licencia->id)->count();
                
            // Comparar el número de cuota aprobado con la cantidad de pagos realizados
            $licencia->cuotasPagadas = ($pagosRealizados < $nroCuotas);
        
        });


        return view('pago_regalia.index', compact('licencias'));
    }

    public function pdf(Request $request, $id)
    {

        // $licencia = Licencias::findOrFail($id);
       
        // $licencias = licencias::join('comprobante_pagos', 'comprobante_pagos.id', '=', 'licencias.id_comprobante_pago')
        //     ->join('inspecciones', 'inspecciones.id', '=', 'comprobante_pagos.id_inspeccion')
        //     ->join('planificacion', 'planificacion.id', '=', 'inspecciones.id_planificacion')
        //     ->join('recepcion', 'recepcion.id', '=', 'planificacion.id_recepcion')
        //     ->join('solicitantes', 'solicitantes.id', '=', 'recepcion.id_solicitante' )
        //     ->leftJoin('personas_naturales', function ($join) {
        //             $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_naturales.id')
        //                 ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaNatural');
        //         })
        //         ->leftJoin('personas_juridicas', function ($join) {
        //             $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_juridicas.id')
        //                 ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaJuridica');
        //         });
                
        // Generar el PDF, incluso si no se encuentran solicitantes
        // $pdf = Pdf::loadView('pago_regalia.pdf', compact('licencia'));
        // return $pdf->stream('Licencia.pdf');
    }

    public function getLicenciaDetalles($id)
    {
        // Recupera la inspección por su ID
        $licencia = Licencias::find($id);

        if (!$licencia) {
            // Maneja el caso en que no se encuentre la licencia
            return response()->json(['error' => 'Comprobante no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_comprobante_pago' => $licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria,
            'providencia' => $licencia->providencia,
            'num_territorio' => $licencia->num_territorio,
            'fecha_oficio' => $licencia->fecha_oficio,
            'talonario' => $licencia->talonario,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $licencia = Licencias::findOrFail($id);
        $minerales = Minerales::all();
        $recepciones = Recepcion::all();

        // Obtener la categoria de la Licencia
        $categoria = $licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria;

        // Contar el número de pagos realizados para esta licencia específica 
        $numeroPagos = ControlRegalia::where('id_licencia', $licencia->id)->count();

        // Obtener el primer pago realizado para esta licencia
        $primerPago = ControlRegalia::where('id_licencia', $licencia->id)->first();

        $tasaConvenio = '';

        if ($primerPago) { // Obtener la tasa_convenio del primer pago realizado desde la tabla pago_regalias 
            $tasaConvenio = PagoRegalia::where('id', $primerPago->id_pago_regalia)->value('tasa_convenio'); 
        }
        // Obtener el nro_cuotas registrado en la tabla licencias 
        $nroCuotas = $licencia->nro_cuotas;


        return view('pago_regalia.create', compact('licencia', 'minerales', 'recepciones', 'numeroPagos', 'primerPago', 'tasaConvenio', 'nroCuotas', 'categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener la licencia 
        $licencia = Licencias::find($request->input('id_licencia'));

        //Crear una nueva PagoRegalia 
        $pago_regalias = new PagoRegalia ();
        $pago_regalias->id_licencia = $request->input('id_licencia');
        $categoria = $request->input('categoria_licencia');

        // Obtener los valores de los inputs
        $id_mineral = $request->input('id_mineral');
        $id_mineral_pro = $request->input('id_mineral_pro');
        $mineral_oculto = $request->input('mineral_oculto');

        // Asignar el valor a id_mineral dependiendo de cuál no esté vacío
        if (!empty($id_mineral)) {

            if ($id_mineral == "convenio") {
                $pago_regalias->id_mineral =  $mineral_oculto;
            } else {
                $pago_regalias->id_mineral = $id_mineral;
            }
            
        } elseif (!empty($id_mineral_pro)) {
            $pago_regalias->id_mineral = $id_mineral_pro;
        }

        $pago_regalias->metodo_apro= $request->input('metodo_apro');
        $pago_regalias->monto_apro = $request->input('monto_apro');
        $pago_regalias->tasa_convenio = $request->input('tasa_convenio');
        
        // Obtener los valores de los inputs
        $pago_realizar_apro = $request->input('pago_realizar_apro');
        $pago_realizar_pro = $request->input('pago_realizar_pro');

         // Verificar la categoria de la licencia para almacenar el dato del input correspondiente
        if ($categoria == "Aprovechamiento") {
            $pago_regalias->pago_realizar = $pago_realizar_apro;
        } elseif ($categoria == "Procesamiento") {
            $pago_regalias->pago_realizar = $pago_realizar_pro;
        }
        
        // dd($pago_realizar_apro, $pago_regalias->pago_realizar);
        
        $pago_regalias->monto_decl = $request->input('monto_decl');
        $pago_regalias->metodo_pro = $request->input('metodo_pro');
        $pago_regalias->monto_pro = $request->input('monto_pro');
        $pago_regalias->resultado_apro = $request->input('resultado_apro');
        $pago_regalias->resultado_pro = $request->input('resultado_pro');

        // Verificar si se han cargado archivos
        if ($request->hasFile('comprobante')) {
            $rutaGuardarPdf = 'pdf/';
            $nombresPdf = [];

            foreach ($request->file('comprobante') as $pdf) {
                $pdfComprobante = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path($rutaGuardarPdf), $pdfComprobante);
                $nombresPdf[] = $pdfComprobante;
            }

            $pago_regalias->comprobante = json_encode($nombresPdf);
        } else {
            $pago_regalias->comprobante = '[]'; // null
        }
        
        $pago_regalias->fecha_pago = $request->input('fecha_pago');

        $fecha_venci_apro = $request->input('fecha_venci_apro'); 
        $fecha_venci_pro = $request->input('fecha_venci_pro');

        $numeroPagos = ControlRegalia::where('id_licencia', $licencia->id)->count();
        $nroCuotas = $pago_regalias->licencia->nro_cuotas;

        // Verificar la categoría de la licencia para almacenar el dato del input correspondiente
        if ($categoria == "Aprovechamiento") {
            // Verificar si es el último pago
            if (($pago_realizar_apro === '3era parte' && $numeroPagos == $nroCuotas - 1) || $pago_realizar_apro === 'Pago unico') {
                $pago_regalias->fecha_venci = null; // No guardar fecha de vencimiento para el último pago
            } elseif ($pago_realizar_apro === '2da parte' && $numeroPagos == $nroCuotas - 1) {
                $pago_regalias->fecha_venci = null; // No guardar fecha de vencimiento para el último pago de 2da parte
            } else {
                $pago_regalias->fecha_venci = $fecha_venci_apro; // Guardar fecha de vencimiento para otros casos
            }
        } elseif ($categoria == "Procesamiento") {
            // Verificar si es el último pago
            if ($numeroPagos == $nroCuotas - 1) {
                $pago_regalias->fecha_venci = null; // No guardar fecha de vencimiento para el último pago
            } else {
                $pago_regalias->fecha_venci = $fecha_venci_pro; // Guardar fecha de vencimiento para otros casos
            }
        }
        
        $pago_regalias->save();

        $puente = new ControlRegalia();
        $puente->id_pago_regalia = $pago_regalias->id; // Usamos el ID de lo pago_regalia creada
        $puente->id_licencia = $request->input('id_licencia');
        $puente->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('control_regalia');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PagoRegalia  $PagoRegalia
     * @return \Illuminate\Http\Response
     */
    public function show(PagoRegalia $PagoRegalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PagoRegalia  $PagoRegalia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pago_regalia = PagoRegalia::findOrFail($id);
        $licencia = licencias::find($pago_regalia->id_licencia);
        $mineral = Minerales::find($pago_regalia->id_mineral);
        // $minerales = Minerales::all();
        $id_licencia = $pago_regalia->id_licencia;
        $categoria = $pago_regalia->categoria_licencia;
        $id_mineral = $pago_regalia->id_mineral ;
        $metodo_apro = $pago_regalia->metodo_apro;
        $monto_apro = $pago_regalia->monto_apro;
        $tasa_convenio = $pago_regalia->tasa_convenio;
        $pago_realizar = $pago_regalia->pago_realizar;
        $monto_decl = $pago_regalia->monto_decl;
        $metodo_pro = $pago_regalia->metodo_pro;
        $monto_pro = $pago_regalia->monto_pro;
        $resultado_apro = $pago_regalia->resultado_apro;
        $resultado_pro = $pago_regalia->resultado_pro;
        $comprobante = $pago_regalia->comprobante;
        $fecha_pago = date('d/m/Y', strtotime($pago_regalia->fecha_pago));
        $fecha_venci = $pago_regalia->fecha_venci;
        $nroCuotas = $pago_regalia->licencia->nro_cuotas;

         // Contar el número de pagos realizados para esta licencia específica 
         $numeroPagos = ControlRegalia::where('id_licencia', $licencia->id)->count();

        return view('pago_regalia.edit' , compact('pago_regalia', 'licencia', 'mineral', 'id_licencia',
        'categoria', 'id_mineral', 'metodo_apro', 'monto_apro', 'tasa_convenio', 'pago_realizar', 'monto_decl', 
        'metodo_pro','monto_pro', 'resultado_apro', 'resultado_pro','comprobante', 'fecha_pago', 'fecha_venci', 
        'numeroPagos', 'nroCuotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PagoRegalia  $PagoRegalia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Obtener la PagoRegalia existente 
        $pago_regalia = PagoRegalia::find($id);
        $pago_regalia->id_licencia = $request->input('id_licencia');
        $categoria = $request->input('categoria_licencia');

        // Obtener los valores de los inputs
        $id_mineral = $request->input('id_mineral');
        $id_mineral_pro = $request->input('id_mineral_pro');
        $mineral_oculto = $request->input('mineral_oculto');

        // Asignar el valor a id_mineral dependiendo de cuál no esté vacío
        if (!empty($id_mineral)) {
            if ($id_mineral == "convenio") {
                $pago_regalia->id_mineral = $mineral_oculto;
            } else {
                $pago_regalia->id_mineral = $id_mineral;
            }
        } elseif (!empty($id_mineral_pro)) {
            $pago_regalia->id_mineral = $id_mineral_pro;
        }
        
        $pago_regalia->metodo_apro= $request->input('metodo_apro');
        $pago_regalia->monto_apro = $request->input('monto_apro');
        $pago_regalia->metodo_pro = $request->input('metodo_pro');
        $pago_regalia->monto_pro = $request->input('monto_pro');
        $pago_regalia->tasa_convenio = $request->input('tasa_convenio');

        // Obtener los valores de los inputs
        $pago_realizar_apro = $request->input('pago_realizar_apro');
        $pago_realizar_pro = $request->input('pago_realizar_pro');

         // Verificar la categoria de la licencia para almacenar el dato del input correspondiente
        if ($categoria == "Aprovechamiento") {
            $pago_regalia->pago_realizar = $pago_realizar_apro;
        } elseif ($categoria == "Procesamiento") {
            $pago_regalia->pago_realizar = $pago_realizar_pro;
        }

        $pago_regalia->monto_decl = $request->input('monto_decl');
        $pago_regalia->resultado_apro = $request->input('resultado_apro');
        $pago_regalia->resultado_pro = $request->input('resultado_pro');

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('comprobante')) {
            $rutaGuardarPdf = 'pdf/';
            $nuevosNombresPdf = [];

            foreach ($request->file('comprobante') as $pdf) {
                $pdfComprobante = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path($rutaGuardarPdf), $pdfComprobante);
                $nuevosNombresPdf[] = $pdfComprobante;
            }

            // Combinar los nuevos archivos con los existentes
            $archivosExistentes = json_decode( $pago_regalia->comprobante, true) ?? [];
            $todosLosArchivos = array_merge($archivosExistentes, $nuevosNombresPdf);

            $pago_regalia->comprobante = json_encode($todosLosArchivos);
        }
        
        $pago_regalia->fecha_pago = $request->input('fecha_pago');
        $pago_regalia->fecha_venci = $request->input('fecha_venci');

        $numeroPagos = ControlRegalia::where('id_licencia', $pago_regalia->licencia->id)->count();
        $nroCuotas = $pago_regalia->licencia->nro_cuotas;

        // Verificar la categoría de la licencia para almacenar el dato del input correspondiente
        if ($categoria == "Aprovechamiento") {
            // Verificar si es el último pago
            if (($pago_realizar_apro === '3era parte' && $numeroPagos == $nroCuotas - 1) || $pago_realizar_apro === 'Pago unico') {
                $pago_regalia->fecha_venci = null; // No guardar fecha de vencimiento para el último pago
            } elseif ($pago_realizar_apro === '2da parte' && $numeroPagos == $nroCuotas - 1) {
                $pago_regalia->fecha_venci = null; // No guardar fecha de vencimiento para el último pago de 2da parte
            } else {
                $pago_regalia->fecha_venci = $fecha_venci_apro; // Guardar fecha de vencimiento para otros casos
            }
        } elseif ($categoria == "Procesamiento") {
            // Verificar si es el último pago
            if ($numeroPagos == $nroCuotas - 1) {
                $pago_regalia->fecha_venci = null; // No guardar fecha de vencimiento para el último pago
            } else {
                $pago_regalia->fecha_venci = $fecha_venci_pro; // Guardar fecha de vencimiento para otros casos
            }
        }
        
        $pago_regalia->save();

        $puente = ControlRegalia::where('id_pago_regalia', $pago_regalia->id)->first();
        if (!$puente) {
            $puente = new ControlRegalia();
            $puente->id_pago_regalia = $pago_regalia->id;
        }
        $puente->id_licencia = $request->input('id_licencia');
        
        $puente->save();


        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('control_regalia');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PagoRegalia  $PagoRegalia
     * @return \Illuminate\Http\Response
     */
    public function destroy(PagoRegalia $PagoRegalia)
    {
        //
    }
}
