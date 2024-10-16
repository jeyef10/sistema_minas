<?php

namespace App\Http\Controllers;
use App\Models\ComprobantePago;
use App\Models\Inspecciones;
use App\Models\TipoPago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class ComprobantePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspecciones = Inspecciones::all();

        return view ('comprobantepago.index', compact('inspecciones'));
    }

    public function getInspeccionDetalles($id)
    {
        // Recupera la inspección por su ID
        $inspeccion = Inspecciones::find($id);

        if (!$inspeccion) {
            // Maneja el caso en que no se encuentre la inspección
            return response()->json(['error' => 'Inspección no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'funcionario_acomp' => $inspeccion->funcionario_acomp,
            'observaciones' => $inspeccion->observaciones,
            'conclusiones' => $inspeccion->conclusiones,
            'latitud' => $inspeccion->latitud,
            'longitud' => $inspeccion->longitud,
            'longitud_terreno' => $inspeccion->longitud_terreno,
            'ancho' => $inspeccion->ancho,
            'profundidad' => $inspeccion->profundidad,
            'volumen' => $inspeccion->volumen,
            'utm_norte' => $inspeccion->utm_norte,
            'utm_este' => $inspeccion->utm_este,
            'lindero_norte' => $inspeccion->lindero_norte,
            'lindero_sur' => $inspeccion->lindero_sur,
            'lindero_este' => $inspeccion->lindero_este,
            'lindero_oeste' => $inspeccion->lindero_oeste,
            'superficie' => $inspeccion->superficie,
            'res_fotos' => $inspeccion->res_fotos,
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
        $tipo_pagos = TipoPago::all();

        return view('comprobantepago.create' , compact('inspeccion', 'tipo_pagos'));

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
            'fecha_pago' => 'required|date|date_format:d/m/Y|after_or_equal:'.date('d/m/Y'),
            // 'comprobante' => 'required|array|min:1',
            // 'comprobante.*' => 'mimes:pdf',
        ], [
            'fecha_pago.required' => 'La fecha de pago es obligatoria.',
            'fecha_pago.date' => 'La fecha de pago debe ser una fecha válida.',
            'fecha_pago.date_format' => 'La fecha de pago debe tener el formato AAAA-MM-DD.',
            'fecha_pago.after_or_equal' => 'La fecha de pago debe ser la fecha actual.',
            // 'comprobante.required' => 'Debe registrar uno o más comprobantes en formato PDF.',
            // 'comprobante.min' => 'Debe registrar al menos un comprobante.',
            // 'comprobante.*.mimes' => 'Cada archivo debe ser un PDF.',
            
        ]);

        $comprabantepagos = new ComprobantePago ();
        $comprabantepagos->id_inspeccion = $request->input('id_inspeccion');
        $comprabantepagos->id_tipo_pago = $request->input('id_tipo_pago');
        $comprabantepagos->fecha_pago = $request->input('fecha_pago');
        
        // Verificar si se han cargado archivos
        if ($request->hasFile('comprobante_pdf')) {
            $rutaGuardarPdf = 'pdf/';
            $nombresPdf = [];

            foreach ($request->file('comprobante_pdf') as $pdf) {
                $pdfComprobante = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path($rutaGuardarPdf), $pdfComprobante);
                $nombresPdf[] = $pdfComprobante;
            }

            $comprabantepagos->comprobante_pdf = json_encode($nombresPdf);
        } else {
            $comprabantepagos->comprobante_pdf = '[]'; // null
        }

        $comprabantepagos->observaciones_com = $request->input('observaciones_com');
        $comprabantepagos->estatus_pago = $request->input('estatus_pago');

        $comprabantepagos->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('licencia');
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comprobante_pago = ComprobantePago::findOrFail($id);
        $inspeccion = Inspecciones::find($id);
        $tipo_pagos = TipoPago::all();
        $fecha_pago = date('d/m/Y', strtotime($comprobante_pago->fecha_pago));
        $comprobante_pdf = $comprobante_pago->comprobante_pdf;
        $observaciones_com = $comprobante_pago->observaciones_com;
        $estatus_pago = $comprobante_pago->estatus_pago;
        return view('comprobantepago.edit' , compact('comprobante_pago', 'inspeccion', 'tipo_pagos', 'fecha_pago', 'comprobante_pdf', 'observaciones_com', 'estatus_pago'));
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
        // Buscar El comprobante existente        
        $comprobante_pago = ComprobantePago::findOrFail($id);
        $comprobante_pago->id_inspeccion = $request->input('id_inspeccion');
        $comprobante_pago->id_tipo_pago = $request->input('id_tipo_pago');
        $comprobante_pago->fecha_pago = $request->input('fecha_pago');

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('comprobante_pdf')) {
            $rutaGuardarPdf = 'pdf/';
            $nuevosNombresPdf = [];

            foreach ($request->file('comprobante_pdf') as $pdf) {
                $pdfComprobante = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path($rutaGuardarPdf), $pdfComprobante);
                $nuevosNombresPdf[] = $pdfComprobante;
            }

            // Combinar los nuevos archivos con los existentes
            $archivosExistentes = json_decode($comprobantePago->comprobante_pdf, true) ?? [];
            $todosLosArchivos = array_merge($archivosExistentes, $nuevosNombresPdf);

            $comprobantePago->comprobante_pdf = json_encode($todosLosArchivos);
        }

        $comprabante_pago->observaciones_com = $request->input('observaciones_com');
        $comprobante_pago->estatus_pago = $request->input('estatus_pago');

        $comprobante_pago->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('licencia');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
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
