<?php

namespace App\Http\Controllers;

use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\SolicitudesComisionados;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ComisionadosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-comisionado|crear-comisionado|editar-comisionado|borrar-comisionado', ['only' => ['index']]);
         $this->middleware('permission:crear-comisionado', ['only' => ['create','store']]);
         $this->middleware('permission:editar-comisionado', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-comisionado', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $comisionados = Comisionados::all();
        // $municipios = Municipio::all();
        $comisionados = Comisionados::with('municipio')->get();
        return view('comisionado.index',compact('comisionados'));
    }

    public function pdf()
    {
        $comisionados = Comisionados::all();
        $pdf=Pdf::loadView('comisionado.pdf', compact('comisionados'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitudescomisionados = SolicitudesComisionados::get();
        $municipios = Municipio::all(); 
        return view('comisionado.create', compact('solicitudescomisionados','municipios'));
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
            'cedula' => 'unique:comisionados,cedula'
            ],
            [
            'cedula.unique' => 'Está cedula ya existe en la base de datos.'
            ]
        );

        $datosComisionados = $request->except('_token');
        Comisionados::create($datosComisionados);

        return redirect()->route('comisionado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function show(Comisionados $comisionados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comisionados = Comisionados::find($id);
        return view('comisionado.edit',compact('comisionados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comisionados $comisionados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Comisionados::destroy($id);
        // $bitacora = new BitacoraController;
        // $bitacora->update();
        return redirect('comisionado')->with('eliminar', 'ok');
    }
}
