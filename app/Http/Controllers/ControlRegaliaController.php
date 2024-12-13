<?php

namespace App\Http\Controllers;

use App\Models\ControlRegalia;
use App\Models\PagoRegalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;


class ControlRegaliaController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:ver-control_regalia|crear-control_regalia|editar-control_regalia|borrar-control_regalia', ['only' => ['index']]);
         $this->middleware('permission:crear-control_regalia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-control_regalia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-control_regalia', ['only' => ['destroy']]);

    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago_regalias = PagoRegalia::all();

        return view('control_regalia.index', compact('pago_regalias'));
    }

    public function getPagoRegaliaDetalles($id)
    {
        // Recupera la inspección por su ID
        $pago_regalia = PagoRegalia::find($id);

        if (!$pago_regalia) {
            // Maneja el caso en que no se encuentre la pago_regalia
            return response()->json(['error' => 'Inspección no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_licencia'=> $pago_regalia->id_licencia,
            'tipo_licencia' => $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria,
            'id_mineral' => $pago_regalia->mineral->valor_tasa,
            'tasa_mineral' => $pago_regalia->mineral->tasa,
            'nombre_mineral' => $pago_regalia->mineral->nombre,
            'metodo_apro' => $pago_regalia->metodo_apro,
            'metodo_pro' => $pago_regalia->metodo_pro,
            'monto_apro' => $pago_regalia->monto_apro,
            'metodo_control_pro' => $pago_regalia->licencia->metodo_control_pro ?? 'N/A',
            'monto_pro' => $pago_regalia->monto_pro,
            'monto_decl'=> $pago_regalia->monto_decl ?? 'N/A',
            'resultado_apro' => $pago_regalia->resultado_apro,
            'resultado_pro' => $pago_regalia->resultado_pro,
            'comprobante' => $pago_regalia->comprobante,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function show(ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlRegalia $controlRegalia)
    {
        //
    }
}
