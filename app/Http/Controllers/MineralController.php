<?php

namespace App\Http\Controllers;

use App\Models\Minerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class MineralController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-mineral|crear-mineral|editar-mineral|borrar-mineral', ['only' => ['index']]);
         $this->middleware('permission:crear-mineral', ['only' => ['create','store']]);
         $this->middleware('permission:editar-mineral', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-mineral', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $minerales = Minerales::all();
        return view('mineral.index',compact('minerales'));
    }

    public function pdf()
    {
          $minerales=Minerales::all();
          $pdf=Pdf::loadView('mineral.pdf', compact('minerales'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mineral.create');
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
            'nombre' => 'unique:minerales,nombre'
            ],
            [
            'nombre.unique' => 'Este mineral ya existe.'
            ]
        );

        $datosMinerales = request()->except('_token');
        Minerales::create($datosMinerales);
        $bitacora = new BitacoraController;
        $bitacora->update();
         
        try {
        
            return redirect ('mineral');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Este mineral ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mineral  $mineral
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mineral  $mineral
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mineral = Minerales::find($id);       

        return view('mineral.edit',compact('mineral'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mineral  $mineral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, minerales $minerales,  $id)
    {
        $request->validate(
            [
            'nombre' => 'unique:minerales,nombre,' .$id,
            ],
            [
            'nombre.unique' => 'Este mineral ya existe.'
            ]
        );

        $datosMinerales = request()->except('_token','_method');
        Minerales::where('id','=',$id)->update($datosMinerales);
        $bitacora = new BitacoraController;
        $bitacora->update();


        try {
        
            return redirect ('mineral');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Este mineral ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mineral  $mineral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Minerales::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('mineral')->with('eliminar', 'ok');
    }
}
