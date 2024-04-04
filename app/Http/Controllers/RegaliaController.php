<?php

namespace App\Http\Controllers;

use App\Models\Regalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RegaliaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-regalia|crear-regalia|editar-regalia|borrar-regalia', ['only' => ['index']]);
         $this->middleware('permission:crear-regalia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-regalia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-regalia', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regalias = Regalia::all();
        return view('regalia.index',compact('regalias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regalia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosRegalias= request()->except('_token');
        Regalia::create($datosRegalias);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('regalia');
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
        $regalia = Regalia::find($id);       

        return view('regalia.edit',compact('regalia'));
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
        $datosRegalias = request()->except('_token','_method');
        Regalia::where('id','=',$id)->update($datosRegalias);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        return redirect ('regalia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Regalia::destroy($id);
        // $bitacora = new BitacoraController;
        // $ bitacora->update();
        return redirect('regalia')->with('eliminar', 'ok');
    }
}
