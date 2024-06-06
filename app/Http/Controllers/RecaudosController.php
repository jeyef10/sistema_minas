<?php

namespace App\Http\Controllers;

use App\Models\Recaudos;
use App\Models\RecepcionRecaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class RecaudosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-recaudo|crear-recaudo|editar-recaudo|borrar-recaudo', ['only' => ['index']]);
         $this->middleware('permission:crear-recaudo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-recaudo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-recaudo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recaudos = Recaudos::all();
        return view('recaudo.index',compact('recaudos'));
    }

    public function pdf()
    {
        $recaudos = Recaudos::all();
        $pdf=Pdf::loadView('recaudo.pdf', compact('recaudos'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recepcionrecaudos = RecepcionRecaudos::get();
        return view('recaudo.create');
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
            'nombre' => 'unique:recaudos,nombre',
            'categoria_recaudos' => 'required|array',
            ],
            [
            'nombre.unique' => 'Este recaudo ya existe.'
            ]
        );
    
        $recaudos = Recaudos::create([
            'nombre' => $request->input('nombre'),
            'categoria_recaudos' => json_encode($request->input('categoria_recaudos')) // Guardar opciones como JSON
        ]);

        $bitacora = new BitacoraController;
        $bitacora->update();
        
        try {
        
            return redirect()->route('recaudo.index');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function show(Recaudos $recaudos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recaudo = Recaudos::find($id);
        return view('recaudo.edit',compact('recaudo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'nombre' => 'unique:recaudos,nombre,' . $id,
            'categoria_recaudos' => 'required|array',
            ],
            [
            'nombre.unique' => 'Este recaudo ya existe.'
            ]
        );

        $recaudo = Recaudos::find($id);

        $recaudo->nombre = $request->input('nombre');
        $recaudo->categoria_recaudos = json_encode($request->input('categoria_recaudos'));

        $recaudo->save();
        
        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('recaudo');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recaudos  $recaudos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recaudos::destroy($id);
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('recaudo')->with('eliminar', 'ok');
    }
}
