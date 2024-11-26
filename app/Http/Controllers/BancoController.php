<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = Banco::all();

        return view('banco.index', compact('bancos')); 
    }
 
    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $bancos = Banco::where('codigo_banco', 'LIKE', '%' . $search . '%')
                           ->orWhere('nombre_banco', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $bancos = Banco::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('banco.pdf', compact('bancos'));
        return $pdf->stream('banco.pdf');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banco.create');
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
            'codigo_banco' => 'unique:bancos,codigo_banco',
            'nombre_banco' => 'unique:bancos,nombre_banco',            
            ],
            [
            
            'codigo_banco.unique' => 'Este Codigo ya existe en la base de datos.',
            'nombre_banco.unique' => 'Este Banco ya existe en la base de datos.'
            ],
        );


        $bancos = Banco::create($request->all());

        // $bitacora = new BitacoraController;
        // $bitacora->update();
        
        try {
        
            return redirect()->route('banco.index')->with('success', 'Banco Registrado Exitosamente.');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
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
        $banco = Banco::find($id);
        return view('banco.edit',compact('banco'));
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
        /* $request->validate(
            [
            'nombre_banco' => 'unique:bancos,nombre_banco',
            'codigo_banco' => 'unique:bancos,codigo_banco'
            ],
            [
            'nombre_banco.unique' => 'Este Banco ya existe en la base de datos.',
            'codigo_banco.unique' => 'Este Codigo ya existe en la base de datos.',
            ]
        ); */

        $banco = Banco::find($id);

        $banco->codigo_banco = $request->input('codigo_banco');
        $banco->nombre_banco = $request->input('nombre_banco');

        $banco->save();
        
        /* $bitacora = new BitacoraController;
        $bitacora->update(); */

        try {
        
            return redirect ('banco');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
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
            $banco = Banco::findOrFail($id);
        
            $banco->delete();
            /* $bitacora = new BitacoraController;
            $bitacora->update(); */
            return redirect('banco')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el banco debido a que tiene otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
