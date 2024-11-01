<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\PagoRegalia;
use App\Models\Licencias;
use App\Models\Minerales;
use App\Models\Recepcion;
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

        // Iterar sobre cada planificación para verificar si fue inspeccionada
        $licencias ->each(function ($licencia) {
            // Buscar en la tabla comprobante_pagoes si existe una comprobante_pago para esta comprobante_pagoe
            $licencia->yaPagado = PagoRegalia::where('id_licencia', $licencia->id)->exists();
        });


        return view('pago_regalia.index', compact('licencias'));
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

        return view('pago_regalia.create', compact('licencia', 'minerales', 'recepciones'));
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
        //     'comprobante' => 'required|array|min:1',
        //     'comprobante.*' => 'mimes:pdf',
        //     'fecha_pago' => 'required|date|date_format:d/m/Y|after_or_equal:'.date('d/m/Y'),
        // ], [
        //     'comprobante.required' => 'Debe registrar uno o más comprobantes en formato PDF.',
        //     'comprobante.min' => 'Debe registrar al menos un comprobante.',
        //     'comprobante.*.mimes' => 'Cada archivo debe ser un PDF.',
        // ]);

        //Crear una nueva PagoRegalia 
        $pago_regalias = new PagoRegalia ();
        $pago_regalias->id_licencia = $request->input('id_licencia');
        $pago_regalias->id_mineral = $request->input('id_mineral');
        $pago_regalias->metodo_apro= $request->input('metodo_apro');
        $pago_regalias->monto_apro = $request->input('monto_apro');
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
        $pago_regalias->fecha_venci = $request->input('fecha_venci');
        $pago_regalias->estatus_regalia = $request->input('estatus_regalia');
        
        $pago_regalias->save();

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
        $licencia = licencias::find($id);
        $minerales = Minerales::all();
        $id_licencia = $pago_regalia->id_licencia;
        $id_mineral = $pago_regalia->id_mineral ;
        $metodo_apro = $pago_regalia->metodo_apro;
        $monto_apro = $pago_regalia->monto_apro;
        $metodo_pro = $pago_regalia->metodo_pro;
        $monto_pro = $pago_regalia->monto_pro;
        $resultado_apro = $pago_regalia->resultado_apro;
        $resultado_pro = $pago_regalia->resultado_pro;
        $comprobante = $pago_regalia->comprobante;
        $fecha_pago = $pago_regalia->fecha_pago;
        $fecha_venci = $pago_regalia->fecha_venci;
        $estatus_regalia = $pago_regalia->estatus_regalia;

        return view('pago_regalia.edit' , compact('pago_regalia', 'licencia', 'minerales', 'id_licencia',
        'id_mineral', 'metodo_apro', 'monto_apro', 'metodo_pro', 'monto_pro', 'resultado_apro', 'resultado_pro',
        'comprobante', 'fecha_pago', 'fecha_venci', 'estatus_regalia'));
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
        // Buscar El PagoRegalia existente 
        $pago_regalia = PagoRegalia::findOrFail($id);
        $pago_regalia->id_licencia = $request->input('id_licencia');
        $pago_regalia->id_mineral = $request->input('id_mineral');
        $pago_regalia->metodo_apro= $request->input('metodo_apro');
        $pago_regalia->monto_apro = $request->input('monto_apro');
        $pago_regalia->metodo_pro = $request->input('metodo_pro');
        $pago_regalia->monto_pro = $request->input('monto_pro');
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
        $pago_regalia->estatus_regalia = $request->input('estatus_regalia');
        
        $pago_regalia->save();

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
