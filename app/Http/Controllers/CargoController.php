<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade\Pdf;


class CargoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-cargo|crear-cargo|editar-cargo|borrar-cargo', ['only' => ['index']]);
         $this->middleware('permission:crear-cargo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cargo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-cargo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //Cambiar numero 5 para aumentar los registros que muestra el catalogo
         $datos['cargos']=Cargo::all();
         return view('cargo.index',$datos);
    }
    public function pdf()
    {
          $cargos=Cargo::all();
          $pdf=Pdf::loadView('cargo.pdf', compact('cargos'));
          return $pdf->stream();

    }

    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datosCargo = request()->except('_token');
        Cargo::create($datosCargo);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect ('cargo');

        // return response()->json($datosCargo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cargo=cargo::findOrFail($id);

        return view('cargo.edit',compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosCargo = request()->except('_token','_method');
        cargo::where('id','=',$id)->update($datosCargo);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect ('cargo');

        // $cargo=cargo::findOrFail($id);
        // return view('cargo.edit',compact('cargo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        cargo::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('cargo')->with('eliminar', 'ok');
    }
}
