<?php

namespace App\Http\Controllers;

use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\MunicipioComisionado;
use App\Models\PlanificacionComisionados;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;
use App\Models\User;

class ComisionadosController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-comisionado|crear-comisionado|editar-comisionado|borrar-comisionado', ['only' => ['index']]);
         $this->middleware('permission:crear-comisionado', ['only' => ['create','store']]);
         $this->middleware('permission:editar-comisionado', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-comisionado', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comisionados = Comisionados::with('municipios')->get();
        return view('comisionado.index',compact('comisionados'));
    }

    public function pdf()
    {
        $comisionados = Comisionados::all();
        $pdf=Pdf::loadView('comisionado.pdf', compact('comisionados'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = Municipio::all();
        $municipiocomisionados = MunicipioComisionado::get();
        $planificacioncomisionados = PlanificacionComisionados::get();
        return view('comisionado.create', compact('planificacioncomisionados','municipios', 'municipiocomisionados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(Request $request)
    {
        $request->validate(
            [
            'cedula' => 'unique:comisionados,cedula'
            ],
            [
            'cedula.unique' => 'Está cedula ya existe en la base de datos.'
            ]
        );

        $comisionado = Comisionados::create($request->all());

        // Asociar los municipios al comisionado
        $comisionado->municipios()->sync($request->municipios);

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect()->route('comisionado.index');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
    } */

    public function store(Request $request)
    {
        $request->validate(
            [
            'cedula' => 'unique:comisionados,cedula'
            ],
            [
            'cedula.unique' => 'Está cedula ya existe en la base de datos.'
            ]
        );

        $comisionado = Comisionados::create($request->all());

        // Asociar los municipios al comisionado
        $comisionado->municipios()->sync($request->municipios);

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect()->route('comisionado.index')->with('success', 'Comisionado Registrado Exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function show(Comisionados $comisionados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comisionado = Comisionados::find($id);
        $municipios = Municipio::all();
        return view('comisionado.edit',compact('comisionado', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'cedula' => 'unique:comisionados,cedula,' . $id,
            ], 
            [
            'cedula.unique' => 'Está cédula ya existe en la base de datos.'
            ]
        );

        $comisionado = Comisionados::find($id);

        // Actualiza los campos del comisionado
        $comisionado->update([
            'cedula' => $request->cedula,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
        ]);

        // Sincroniza los municipios asociados
        $comisionado->municipios()->sync($request->municipios);

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect ('comisionado');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comisionados  $comisionados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

        $comisionado = Comisionados::findOrFail($id);
        
        // Eliminar los registros relacionados en la tabla puente
        $comisionado->municipios()->detach();
        
        // Elimina al comisionado
        $comisionado->delete();

        // Obtener el ID del usuario asociado
        $userId = $comisionado->id_usuario;

        // Eliminar el usuario asociado si existe
        if ($userId) {
            $user = User::find($userId);
            
            if ($user) {
                $user->delete();
            }
        }

        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('comisionado')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el comisionado debido a que tiene otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        } 
    }
}



        