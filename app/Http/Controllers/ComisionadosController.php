<?php

namespace App\Http\Controllers;

use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\SolicitudesInspecciones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

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
        $municipios = Municipio::all();
        $solicitudesinspecciones = SolicitudesInspecciones::get();
        return view('comisionado.create', compact('solicitudesinspecciones','municipios'));
    }

    // public function getParroquias($municipioId)
    // {
    //     $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
    //     return response()->json($parroquias);
    // }

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
        $datosComisionados['id_municipio'] = $request->input('municipio');
        // $datosComisionados['id_parroquia'] = $request->input('parroquia');
        Comisionados::create($datosComisionados);

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect()->route('comisionado.index');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
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
    public function edit(comisionados $comisionados, $id)
    {
        $comisionado = Comisionados::find($id);
        $municipios = Municipio::all();
        return view('comisionado.edit',compact('comisionado', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comisionados $comisionados, $id)
    {
        $request->validate([
            'cedula' => 'unique:comisionados,cedula,' . $id 
        ], [
            'cedula.unique' => 'Está cédula ya existe en la base de datos.'
        ]);
        
       $comisionado = Comisionados::find($id);

       $comisionado->cedula = $request->input('cedula');
       $comisionado->nombres = $request->input('nombres');
       $comisionado->apellidos = $request->input('apellidos');
       $comisionado->id_municipio = $request->input('id_municipio');
       
        $comisionado->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('comisionado');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
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
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('comisionado')->with('eliminar', 'ok');
    }
}



        