<?php

namespace App\Http\Controllers;

use App\Models\Recaudos;
use App\Models\SolicitudesRecaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class RecaudosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-recaudo|crear-recaudo|editar-recaudo|borrar-recaudo', ['only' => ['index']]);
         $this->middleware('permission:crear-recaudo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-recaudo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-recaudo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recaudos = Recaudos::all();
        return view('recaudo.index',compact('recaudos'));
    }

    public function pdf()
    {
        $recaudos = Recaudos::all();
        $pdf=Pdf::loadView('recaudo.pdf', compact('recaudos'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitudesrecaudos = SolicitudesRecaudos::get();
        return view('recaudo.create');
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
            'nombre' => 'unique:recaudos,nombre'
            ],
            [
            'nombre.unique' => 'Este recaudo ya existe.'
            ]
        );

        $recaudos = Recaudos::create(['nombre' => $request->input('nombre')]);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect()->route('recaudo.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function show(Recaudos $recaudos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recaudo = Recaudos::find($id);
        return view('recaudo.edit',compact('recaudo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recaudos $recaudos, $id)
    {
        $request->validate(
            [
            'nombre' => 'unique:recaudos,nombre'
            ],
            [
            'nombre.unique' => 'Este recaudo ya existe.'
            ]
        );
        
        $datosRecaudos = request()->except('_token','_method');
        Recaudos::where('id','=',$id)->update($datosRecaudos);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('recaudo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recaudos::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('recaudo')->with('eliminar', 'ok');
    }
}
