<?php

namespace App\Http\Controllers;
use App\Models\TipoPago;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;

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
       
        // $request->validate(
        //     [
        //     'nombre_pago' => 'unique:tipo_pagos,nombre_pago',
        //     'forma_pago' => 'required|tipo_pagos, forma_pago',
        //     ],
        //     [
        //     'nombre.unique' => ''
        //     ]
        // );
    
        $tipo_pagos= TipoPago::create([
            'nombre_pago' => $request->input('nombre_pago'),
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
        

        $tipo_pago = TipoPago::find($id);

        $tipo_pago->nombre_pago = $request->input('nombre_pago');
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
