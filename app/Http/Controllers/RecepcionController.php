<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Recepcion;
use App\Models\Solicitante;
use App\Models\Municipio;
use App\Models\Minerales;
use App\Models\PersonaJuridica;
use App\Models\PersonaNatural;
use App\Models\Recaudos;
use App\Models\RecepcionRecaudos;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
       // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
        $recaudos = Recaudos::orderBy('nombre', 'asc')->get();
        $recepcionrecaudos = RecepcionRecaudos::all();
        $municipios = Municipio::all();
        $minerales = Minerales::all();

        return view('recepcion.create', compact('solicitantes', 'recepcionrecaudos', 'recaudos','municipios','minerales'));
    }

    public function fetchSolicitantesByTipo(Request $request, $tipoSolicitante)
    {
        $solicitantes = Solicitante::where('tipo', $tipoSolicitante)->get();

        $solicitantes = Solicitante::with('solicitanteEspecifico')
        ->where('tipo', $tipoSolicitante)
        ->get();

        return response()->json($solicitantes);
    }

    public function fetchMinerales(Request $request)
    {

        $categoria = $request->input('categoria'); // Obtener la categoría del request
        $minerales = Minerales::where('categoria', $categoria)->get(); // Consulta filtrada por categoría

        return response()->json($minerales);

    }

    public function fetchRecaudos(Request $request)
    {
        
        $categoria = $request->input('categoria_recaudos');
        $recaudos = Recaudos::all();

        return response()->json($recaudos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'recaudos' => 'required|array|min:13',
        ]);

        // Crear una nueva recepcion de recaudos
        $recepcion = new Recepcion ();
        $recepcion->id_solicitante = $request->input('solicitante_especifico_id');
        $recepcion->id_municipio = $request->input('id_municipio');
        $recepcion->direccion = $request->input('direccion');
        $recepcion->id_mineral = $request->input('nom_mineral');
        $recepcion->fecha = $request->input('simpleDataInput');
        
        $recepcion->save();// Guardar la instancia de la tabla Recepcion

        $recaudosSeleccionados = [];

        if (count($recaudosSeleccionados) !== 13) {
            
            $errorMessage = 'Se requieren 13 Recaudos para registrar la recepción. Por favor, seleccione 13 Recaudos.';// Mostrar el mensaje cuando no cumples con los 13 recaudos.

        }
        
        // Obtener los IDs de recaudos seleccionados (debe ser un array)
        $recaudosSeleccionados = $request->input('recaudos');

        // Crear registros en la tabla puente para cada recaudo seleccionado
        foreach ($recaudosSeleccionados as $recaudo) {
            $puente = new RecepcionRecaudos();
            $puente->id_recaudo = $recaudo;
            $puente->id_recepcion = $recepcion->id;
            $puente->save();// Guardar la instancia de la tabla puente (Recepcion_recaudos)
        }

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('planificacion');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recepcion  $Recepcion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recepcion  $Recepcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recepcion = Recepcion::findOrFail($id);
        $municipios = Municipio::all();
        $minerales = Minerales::all();
        $cat_mineral = $recepcion->mineral;
        $tipoSolicitante = $recepcion->solicitante;
        $datosSolicitante = $recepcion->solicitante->solicitanteEspecifico;
        $direccion = $recepcion->direccion;
        $fecha = $recepcion->fecha;

        // Obtener todos los recaudos
        $recaudos = Recaudos::all();

        // Obtener los IDs de los recaudos seleccionados de la tabla puente recepcion_recaudos
        $recaudosSeleccionados = RecepcionRecaudos::where('id_recepcion', $id)->pluck('id_recaudo');

        return view('recepcion.edit' , compact('recepcion', 'tipoSolicitante', 'datosSolicitante', 'municipios',
        'minerales', 'direccion', 'recaudos', 'fecha', 'cat_mineral', 'recaudosSeleccionados'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recepcion  $Recepcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Obtener la recepcion por ID
        $recepcion = Recepcion::findOrFail($id);
        $municipios = Municipio::all();
        $minerales = Minerales::all();

        // Actualizar los campos según los datos del formulario
        $recepcion->id_solicitante = $request->input('solicitante_especifico_id');
        $recepcion->id_municipio = $request->input('id_municipio');
        $recepcion->direccion = $request->input('direccion');
        $recepcion->id_mineral = $request->input('nom_mineral');
        $recepcion->fecha = $request->input('simpleDataInput');
        $recepcion->save();

        // Actualizar los registros en la tabla puente (recepciones_recaudos)
        $recaudosSeleccionados = $request->input('recaudos');
        RecepcionRecaudos::where('id_recepcion', $id)->delete(); // Eliminar registros anteriores
        foreach ($recaudosSeleccionados as $recaudo) {
            $puente = new RecepcionRecaudos();
            $puente->id_recaudo = $recaudo;
            $puente->id_recepcion = $recepcion->id;
            $puente->save();
        }

        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect('planificacion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recepcion  $Recepcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recepcion $recepcion)
    {
        //
    }
}