<?php

namespace App\Http\Controllers;
use App\Models\ComprobantePago;
use App\Models\Inspecciones;
use App\Models\TipoPago;
use App\Models\Banco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class ComprobantePagoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-comprobante_pago|crear-comprobante_pago|editar-comprobante_pago|borrar-comprobante_pago', ['only' => ['index']]);
        $this->middleware('permission:crear-comprobante_pago', ['only' => ['create','store']]);
        $this->middleware('permission:editar-comprobante_pago', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-comprobante_pago', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspecciones = Inspecciones::all();
         // Iterar sobre cada planificación para verificar si fue inspeccionada
         $inspecciones ->each(function ($inspeccion) {
            // Buscar en la tabla Inspecciones si existe una inspeccion para esta inspeccione
            $inspeccion->yaComprobado = ComprobantePago::where('id_inspeccion', $inspeccion->id)->exists();
        });

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
            'id_planificacion' => $inspeccion->planificacion->recepcion->categoria,
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
        $bancos = Banco::all();

        return view('comprobantepago.create' , compact('inspeccion', 'tipo_pagos', 'bancos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, 
                [
                'nro_oficio' => 'unique:comprobante_pagos,nro_oficio',
                'n_referencia' => 'unique:comprobante_pagos,n_referencia',
                ],
                [
                'nro_oficio.unique' => 'Este Número Oficio ya existe',
                'n_referencia.unique' => 'Este Número de Referencia ya existe',
                ]
            );

        $comprabantepagos = new ComprobantePago ();
        $comprabantepagos->id_inspeccion = $request->input('id_inspeccion');
        $comprabantepagos->nro_oficio = $request->input('nro_oficio');
        $comprabantepagos->fecha_oficio = $request->input('fecha_oficio');
        $comprabantepagos->estatus_oficio = $request->input('estatus_oficio');
        $comprabantepagos->nombre_firma = $request->input('nombre_firma');
        $comprabantepagos->id_tipo_pago = $request->input('id_tipo_pago');
        $comprabantepagos->id_banco = $request->input('id_banco');
        $comprabantepagos->n_referencia = $request->input('n_referencia');
        
        
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
        $comprabantepagos->timbre_fiscal = $request->input('timbre_fiscal');
        $comprabantepagos->observaciones_fiscal = $request->input('observaciones_fiscal');
        $comprabantepagos->fecha_pago = $request->input('fecha_pago');
        // $comprabantepagos->estatus_pago = $request->input('estatus_pago');

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
        $nro_oficio = $comprobante_pago->nro_oficio;
        $fecha_oficio = $comprobante_pago->fecha_oficio;
        $estatus_oficio = $comprobante_pago->estatus_oficio;
        $nombre_firma = $comprobante_pago->nombre_firma;
        $tipo_pagos = TipoPago::all();
        $bancos = Banco::all();
        $n_referencia = $comprobante_pago->n_referencia;
        $comprobante_pdf = $comprobante_pago->comprobante_pdf;
        $observaciones_com = $comprobante_pago->observaciones_com;
        $timbre_fiscal = $comprobante_pago->timbre_fiscal;
        $observaciones_fiscal = $comprobante_pago->observaciones_fiscal;
        $fecha_pago = date('d/m/Y', strtotime($comprobante_pago->fecha_pago));
        // $estatus_pago = $comprobante_pago->estatus_pago;

        return view('comprobantepago.edit' , compact('comprobante_pago', 'inspeccion', 'nro_oficio', 'fecha_oficio', 
        'estatus_oficio', 'nombre_firma', 'tipo_pagos', 'bancos', 'n_referencia','comprobante_pdf', 'observaciones_com',
        'timbre_fiscal', 'observaciones_fiscal', 'fecha_pago'));
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

        $this->validate($request, 
                [
                'nro_oficio' => 'unique:comprobante_pagos,nro_oficio,' . $id,
                'n_referencia' => 'unique:comprobante_pagos,n_referencia,' . $id,
                ],
                [
                'nro_oficio.unique' => 'Este Número Oficio ya existe',
                'n_referencia.unique' => 'Este Número de Referencia ya existe',
                ]
            );

        // Buscar El comprobante existente        
        $comprobante_pago = ComprobantePago::findOrFail($id);
        $comprobante_pago->id_inspeccion = $request->input('id_inspeccion');
        $comprobante_pago->nro_oficio = $request->input('nro_oficio');
        $comprobante_pago->fecha_oficio = $request->input('fecha_oficio');
        $comprobante_pago->estatus_oficio = $request->input('estatus_oficio');
        $comprobante_pago->nombre_firma = $request->input('nombre_firma');
        $comprobante_pago->id_tipo_pago = $request->input('id_tipo_pago');
        $comprobante_pago->id_banco = $request->input('id_banco');
        // dd($comprobante_pago->id_banco);
        $comprobante_pago->n_referencia = $request->input('n_referencia');

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
            $archivosExistentes = json_decode($comprobante_pago->comprobante_pdf, true) ?? [];
            $todosLosArchivos = array_merge($archivosExistentes, $nuevosNombresPdf);

            $comprobante_pago->comprobante_pdf = json_encode($todosLosArchivos);
        }

        // $comprabante_pago->observaciones_com = $request->input('observaciones_com');
        $comprobante_pago->observaciones_com = $comprobante_pago->observaciones_com ?? $request->input('observaciones_com');
        $comprobante_pago->timbre_fiscal = $request->input('timbre_fiscal');
        $comprobante_pago->observaciones_fiscal = $request->input('observaciones_fiscal');
        $comprobante_pago->fecha_pago = $request->input('fecha_pago');
        // $comprobante_pago->estatus_pago = $request->input('estatus_pago');

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
