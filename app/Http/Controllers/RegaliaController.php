<?php

namespace App\Http\Controllers;

use App\Models\Regalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class RegaliaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-regalia|crear-regalia|editar-regalia|borrar-regalia', ['only' => ['index']]);
         $this->middleware('permission:crear-regalia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-regalia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-regalia', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regalias = Regalia::all();
        return view('regalia.index',compact('regalias'));
    }
    
    public function pdf()
    {
          $regalias=Regalia::all();
          $pdf=Pdf::loadView('regalia.pdf', compact('regalias'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regalia.create');
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
            'monto' => 'unique:regalias,monto'
            ],
            [
            'monto.unique' => 'Este monto ya existe.'
            ]
        );

        $datosRegalias= request()->except('_token');
        Regalia::create($datosRegalias);
        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('regalia');
    
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
        $regalia = Regalia::find($id);       

        return view('regalia.edit',compact('regalia'));
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
            'monto' => 'unique:regalias,monto'
            ],
            [
            'monto.unique' => 'Este monto ya existe.'
            ]
        );

        $datosRegalias = request()->except('_token','_method');
        Regalia::where('id','=',$id)->update($datosRegalias);
        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('regalia');
    
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
       Regalia::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('regalia')->with('eliminar', 'ok');
    }
}
