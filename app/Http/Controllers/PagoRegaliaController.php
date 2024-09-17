<?php

namespace App\Http\Controllers;

use App\Models\PagoRegalia;
use App\Models\Licencias;
use App\Models\Regalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class PagoRegaliaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licencias = licencias::all();

        return view('pago_regalia.index', compact('licencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $licencia = Licencias::findOrFail($id);
        $regalias = Regalia::all();

        return view('pago_regalia.create', compact('licencia', 'regalias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear una nueva PagoRegalia 
        $pago_regalias = new PagoRegalia ();
        $pago_regalias->id_licencia = $request->input('id_licencia');
        $pago_regalias->id_regalia = $request->input('id_regalia');
        $pago_regalias->metodo_apro= $request->input('metodo_apro');
        $pago_regalias->monto_apro = $request->input('monto_apro');
        $pago_regalias->metodo_pro = $request->input('metodo_pro');
        $pago_regalias->monto_pro = $request->input('monto_pro');
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
        $regalias = Regalia::all();
        $id_licencia = $pago_regalia->id_licencia;
        $id_regalia = $pago_regalia->id_regalia ;
        $metodo_apro = $pago_regalia->metodo_apro;
        $monto_apro = $pago_regalia->monto_apro;
        $metodo_pro = $pago_regalia->metodo_pro;
        $monto_pro = $pago_regalia->monto_pro;
        $fecha_pago = $pago_regalia->fecha_pago;
        $fecha_venci = $pago_regalia->fecha_venci;
        $estatus_regalia = $pago_regalia->estatus_regalia;


        return view('pago_regalia.edit' , compact('pago_regalia', 'licencia', 'regalias', 'id_licencia',
        'id_regalia', 'metodo_apro', 'monto_apro', 'metodo_pro', 'monto_pro', 'fecha_pago', 'fecha_venci', 'estatus_regalia'));
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
        $pago_regalia->id_regalia = $request->input('id_regalia');
        $pago_regalia->metodo_apro= $request->input('metodo_apro');
        $pago_regalia->monto_apro = $request->input('monto_apro');
        $pago_regalia->metodo_pro = $request->input('metodo_pro');
        $pago_regalia->monto_pro = $request->input('monto_pro');
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