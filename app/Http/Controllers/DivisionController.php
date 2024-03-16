<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Bitacora;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class DivisionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-division|crear-division|editar-division|borrar-division', ['only' => ['index']]);
         $this->middleware('permission:crear-division', ['only' => ['create','store']]);
         $this->middleware('permission:crear-division', ['only' => ['create','store']]);
         $this->middleware('permission:editar-division', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-division', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           //Cambiar numero 5 para aumentar los registros que muestra el catalogo
           $datos['divisions']=division::all();
           return view('division.index',$datos);
    }

    public function archivo()
    {
          $divisions=Division::all();
          $pdf=Pdf::loadView('division.archivo', compact('divisions'));
          return $pdf->stream();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('division.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosDivision = request()->except('_token');
        division::create($datosDivision);
        // dd($datosDivision);
        // return response()->json($datosDivision);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect ('division');
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
        $division=division::findOrFail($id);

        return view('division.edit',compact('division'));
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
        $datosDivision = request()->except('_token','_method');
        division::where('id','=',$id)->update($datosDivision);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('division');
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
            $division = Division::findOrFail($id);
        
            // Elimina las relaciones en la tabla puente
            $division->sedes()->detach();
        
            // Elimina el registro de la tabla division
            $division->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();

            return redirect('division')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la división debido a que tiene personas asignadas a esta división en una o varias sedes.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}