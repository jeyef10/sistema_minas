<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ModeloController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-modelo|crear-modelo|editar-modelo|borrar-modelo', ['only' => ['index']]);
         $this->middleware('permission:crear-modelo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-modelo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-modelo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cambiar numero 5 para aumentar los registros que muestra el catalogo
        $datos['modelos']=modelo::all();
        return view('modelo.index',$datos);
    }

    public function pdf()
    {
          $modelos=Modelo::all();
          $pdf=Pdf::loadView('modelo.pdf', compact('modelos'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modelo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosModelo = request()->except('_token');
        modelo::create($datosModelo);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect ('modelo');
    }

    public function saveModal(Request $request)
    {
        $request->validate([
            'nombre_modelo' => 'required|unique:modelos|max:255',
        ]);
    
        $modelo = Modelo::create([
            'nombre_modelo' => $request->nombre_modelo
        ]);
    
        return response()->json(['modelo' => $modelo]);
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
        $modelo=modelo::findOrFail($id);

        return view('modelo.edit',compact('modelo'));
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
        $datosModelo = request()->except('_token','_method');
        modelo::where('id','=',$id)->update($datosModelo);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('modelo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         modelo::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('modelo')->with('eliminar', 'ok');
    }
}
