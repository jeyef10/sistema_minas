<?php

namespace App\Http\Controllers;

use App\Models\Minerales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MineralController extends Controller
{
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
