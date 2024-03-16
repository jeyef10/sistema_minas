<?php

namespace App\Http\Controllers;

use App\Models\Sistema;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class SistemaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-sistema|crear-sistema|editar-sistema|borrar-sistema', ['only' => ['index']]);
         $this->middleware('permission:crear-sistema', ['only' => ['create','store']]);
         $this->middleware('permission:editar-sistema', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-sistema', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cambiar numero 5 para aumentar los registros que muestra el catalogo
        $datos['sistemas']=sistema::all();
        return view('sistema.index',$datos);
    }

    public function pdf()
    {
          $sistemas=sistema::all();
          $pdf=Pdf::loadView('sistema.pdf', compact('sistemas'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosSistema = request()->except('_token');
        sistema::create($datosSistema);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect ('sistema');
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
        $sistema=sistema::findOrFail($id);

        return view('sistema.edit',compact('sistema'));
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
        $datosSistema = request()->except('_token','_method');
        sistema::where('id','=',$id)->update($datosSistema);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('sistema');
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
            sistema::destroy($id);
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('sistema')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el sistema operativo debido a que tiene equipos usando este sistema.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
