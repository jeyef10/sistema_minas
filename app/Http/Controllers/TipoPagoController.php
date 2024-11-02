<?php

namespace App\Http\Controllers;
use App\Models\TipoPago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_pagos = TipoPago::all();
        return view('tipopago.index',compact('tipo_pagos'));
    }


    public function pdf()
    {
          $tipo_pagos=TipoPago::all();
          $pdf=Pdf::loadView('tipopago.pdf', compact('tipo_pagos'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipopago.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate(
            [
            'forma_pago' => 'unique:tipo_pagos,forma_pago'
            ],
            [
            'forma_pago.unique' => 'Está método de pago ya existe en la base de datos.'
            ]
        );


        $tipo_pagos= TipoPago::create([
            'forma_pago' => $request->input('forma_pago') 
        ]);

        $bitacora = new BitacoraController;
        $bitacora->update();
        
        try {
        
            return redirect()->route('tipopago.index');
    
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
        $tipo_pago = TipoPago::find($id);
        return view('tipopago.edit',compact('tipo_pago'));
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
         $request->validate(
            [
            'forma_pago' => 'unique:tipo_pagos,forma_pago,' . $id, 
            ],
            [
            'forma_pago.unique' => 'Está método de pago ya existe en la base de datos.'
            ]
        );

        $tipo_pago = TipoPago::find($id);

        $tipo_pago->forma_pago =$request->input('forma_pago');

        $tipo_pago->save();
        
        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('tipopago');
    
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
        try {
            $tipo_pago = TipoPago::findOrFail($id);
        
            $tipo_pago->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('tipopago')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el tipo de pago  debido a que tiene otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
