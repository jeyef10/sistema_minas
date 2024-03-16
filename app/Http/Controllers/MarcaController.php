<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class MarcaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-marca|crear-marca|editar-marca|borrar-marca', ['only' => ['index']]);
         $this->middleware('permission:crear-marca', ['only' => ['create','store']]);
         $this->middleware('permission:editar-marca', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-marca', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cambiar numero 5 para aumentar los registros que muestra el catalogo
        $datos['marcas']=marca::all();
        return view('marca.index',$datos);
    }

    public function pdf()
    {
          $marcas=Marca::all();
          $pdf=Pdf::loadView('marca.pdf', compact('marcas'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosMarca = request()->except('_token');
        marca::create($datosMarca);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('marca');
    }

    public function saveModal(Request $request)
    {
        $request->validate([
            'nombre_marca' => 'required|unique:marcas|max:255',
        ]);
    
        $marca = Marca::create([
            'nombre_marca' => $request->nombre_marca
        ]);
    
        return response()->json(['marca' => $marca]);
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
        $marca=marca::findOrFail($id);

        return view('marca.edit',compact('marca'));
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
        $datosMarca = request()->except('_token','_method');
        marca::where('id','=',$id)->update($datosMarca);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('marca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        marca::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('marca')->with('eliminar', 'ok');
    }
}
