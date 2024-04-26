<?php

namespace App\Http\Controllers;

use App\Models\Minerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $datosMinerales = request()->except('_token');
        Minerales::create($datosMinerales);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('mineral');
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
    public function update(Request $request, $id)
    {
        $datosMinerales = request()->except('_token','_method');
        Minerales::where('id','=',$id)->update($datosMinerales);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('mineral');
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
        // $bitacora = new BitacoraController;
        // $bitacora->update();
        return redirect('mineral')->with('eliminar', 'ok');
    }
}