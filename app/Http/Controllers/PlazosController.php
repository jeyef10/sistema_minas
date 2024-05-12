<?php

namespace App\Http\Controllers;

use App\Models\Plazos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
// use App\Http\Controllers\BitacoraController;

class PlazosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-plazo|crear-plazo|editar-plazo|borrar-plazo', ['only' => ['index']]);
         $this->middleware('permission:crear-plazo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-plazo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-plazo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plazos =Plazos::all();
        return view('plazo.index',compact('plazos'));
    }

    public function pdf()
    {
          $plazos=Plazos::all();
          $pdf=Pdf::loadView('plazo.pdf', compact('plazos'));
          return $pdf->stream();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plazo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosPlazos= request()->except('_token');
        plazos::create($datosPlazos);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('plazo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function show(Plazos $plazos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plazo = Plazos::find($id);       

        return view('plazo.edit',compact('plazo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosPlazos = request()->except('_token','_method');
        Plazos::where('id','=',$id)->update($datosPlazos);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('plazo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plazos::destroy($id);
        // $bitacora = new BitacoraController;
        // $bitacora->update();
        return redirect('plazo')->with('eliminar', 'ok');
    }
}
