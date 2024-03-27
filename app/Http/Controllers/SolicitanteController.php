<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario', ['only' => ['index']]);
    //      $this->middleware('permission:crear-usuario', ['only' => ['create','store']]);
    //      $this->middleware('permission:editar-usuario', ['only' => ['edit','update']]);
    //      $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $solicitantes = DB::table('solicitante')->get();
        $solicitantes = Solicitante::all();
        return view('solicitante.index',compact('solicitantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosSolicitante = request()->except('_token');
        Solicitante::create($datosSolicitante);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('solicitante');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitante $solicitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitante=Solicitante::findOrFail($id);

        return view('solicitante.edit',compact('solicitante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosSolicitante = request()->except('_token','_method');
        Solicitante::where('id','=',$id)->update($datosSolicitante);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('solicitante');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Solicitante::destroy($id);
        // $bitacora = new BitacoraController;
        // $bitacora->update();
        return redirect('solicitante')->with('eliminar', 'ok');
    }
}
