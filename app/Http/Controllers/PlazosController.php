<?php

namespace App\Http\Controllers;

use App\Models\Plazos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;
use Illuminate\Validation\Rule;

class PlazosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-plazo|crear-plazo|editar-plazo|borrar-plazo', ['only' => ['index']]);
         $this->middleware('permission:crear-plazo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-plazo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-plazo', ['only' => ['destroy']]);
    }

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

    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
            $plazos =Plazos::where('cantidad', 'LIKE', '%' . $search . '%')
                           ->orWhere('medida_tiempo', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
            $plazos =Plazos::all();
        }
    
        // Generar el PDF, incluso si no se encuentran bancos
        $pdf = Pdf::loadView('plazo.pdf', compact('plazos'));
        return $pdf->stream('plazo.pdf');
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
      
        // $request->validate(
        //     [
        //     'cantidad' => 'unique:plazos,cantidad', 
        //     'medida_tiempo' => 'unique:plazos,medida_tiempo'
        //     ],
        //     [
        //     'cantidad.unique' => 'Este plazo ya existe.'
        //     ]
        // );

        $request->validate(
            [
                'cantidad' => [
                    'required',
                    'integer',
                ],
                'medida_tiempo' => [
                    'required',
                    'string',
                    Rule::unique('plazos')->where(function ($query) use ($request) {
                        return $query->where('cantidad', $request->cantidad);
                    }),
                ],
            ],
            [
                'medida_tiempo.unique' => 'Ya existe un plazo con esta cantidad y medida de tiempo.'
            ]
        );
        

        $datosPlazos= request()->except('_token');
        plazos::create($datosPlazos);
        $bitacora = new BitacoraController;
        $bitacora->update();

        
        try {
        
            return redirect ('plazo');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
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
    public function update(Request $request, plazos $plazos, $id)
    {
        // $request->validate(
        //     [
        //     'cantidad' => 'unique:plazos,cantidad'
        //     ],
        //     [
        //     'cantidad.unique' => 'Este plazo ya existe.'
        //     ]
        // );

        $request->validate(
            [
                'cantidad' => [
                    'required',
                    'integer',
                ],
                'medida_tiempo' => [
                    'required',
                    'string',
                    Rule::unique('plazos')->where(function ($query) use ($request, $id) {
                        return $query->where('cantidad', $request->cantidad)
                                     ->where('id', '!=', $id);
                    }),
                ],
            ],
            [
                'medida_tiempo.unique' => 'Ya existe un plazo con esta cantidad y medida de tiempo.'
            ]
        );

        $datosPlazos = request()->except('_token','_method');
        Plazos::where('id','=',$id)->update($datosPlazos);
        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('plazo');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plazos  $plazos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            // $recaudo = Recaudos::findOrFail($id);
        
            $plazo = Plazos::findOrFail($id);
            $plazo->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('plazo')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar este plazo debido a que está asignado a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
