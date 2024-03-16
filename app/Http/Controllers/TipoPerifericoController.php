<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoPeriferico;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoPerifericoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-tipoperif|crear-tipoperif|editar-tipoperif|borrar-tipoperif', ['only' => ['index']]);
         $this->middleware('permission:crear-tipoperif', ['only' => ['create','store']]);
         $this->middleware('permission:editar-tipoperif', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-tipoperif', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Traigo todos los registros de la tabla de tipo SO.
        $datos['tipo_perifericos']=TipoPeriferico::all();
        return view('tipoperiferico.index',$datos);
    }

    public function pdf()
    {
          $tipo_perifericos=TipoPeriferico::all();
          $pdf=Pdf::loadView('tipoperiferico.pdf', compact('tipo_perifericos'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipoperiferico.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosTipoPeriferico = request()->except('_token');
        TipoPeriferico::create($datosTipoPeriferico);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('tipoperiferico');
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
        //
        $tipo_periferico=TipoPeriferico::findOrFail($id);

        return view('tipoperiferico.edit',compact('tipo_periferico'));
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
        //
        $datosTipoPeriferico = request()->except('_token','_method');
        TipoPeriferico::where('id','=',$id)->update($datosTipoPeriferico);
        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect ('tipoperiferico');
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
            TipoPeriferico::destroy($id);
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('tipoperiferico')->with('eliminar', 'ok');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el tipo de periferico debido a que tiene perifericos registrados en esta categoria.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
