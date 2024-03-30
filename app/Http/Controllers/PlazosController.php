<?php

namespace App\Http\Controllers;

use App\Models\Plazos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlazosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plazos =Plazos::all();
        return view('plazo.index',compact('plazos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plazo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosPlazos= request()->except('_token');
        plazos::create($datosPlazos);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('plazo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function show(Plazos $plazos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plazo = Plazos::find($id);       

        return view('plazo.edit',compact('plazo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosPlazos = request()->except('_token','_method');
        Plazos::where('id','=',$id)->update($datosPlazos);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('plazo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plazos::destroy($id);
        // $bitacora = new BitacoraController;
        // $ bitacora->update();
        return redirect('plazo')->with('eliminar', 'ok');
    }
}
