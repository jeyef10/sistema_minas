<?php

namespace App\Http\Controllers;

use App\Models\Equipos;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Sistema;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class EquiposController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-equipo|crear-equipo|editar-equipo|borrar-equipo', ['only' => ['index']]);
         $this->middleware('permission:crear-equipo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-equipo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-equipo', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipos::with('marca')->get(); // Cargar la relación con "marca"
        $equipos = Equipos::with('modelo')->get(); // Cargar la relación con "modelo"
        return view('equipo.index', compact('equipos'));

    }

    public function indexinvent()
    {
        $equipos = Equipos::with('marca')->get(); // Cargar la relación con "marca"
        $equipos = Equipos::with('modelo')->get(); // Cargar la relación con "modelo"
        return view('inventario.index', compact('equipos'));

    }

    public function pdf()
    {
          $equipos=Equipos::all();
          $pdf=Pdf::loadView('equipo.pdf', compact('equipos'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all(); // Obtener todos los registros de la tabla "marca"
        $modelos = Modelo::all(); // Obtener todos los registros de la tabla "modelo"
        $sistemas = Sistema::all(); // Obtener todos los registros de la tabla "sistema"
        return view('equipo.create', compact('marcas', 'modelos', 'sistemas')); // Pasar los cargos a la vista "form.blade.php"
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
            'serial' => 'unique:equipos,serial',
            'serialA' => 'unique:equipos,serialA',
            ],
            [
            'serial.unique' => 'El valor del campo Serial ya existe en la base de datos.',
            'serialA.unique' => 'El valor del campo Serial Activo ya existe en la base de datos.'
            ]
        );
        $datosEquipo = $request->except('_token', 'nuevamarca', 'nuevomodelo');
        Equipos::create($datosEquipo);
       
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('equipo');
       /* $datosEquipo = request()->except('_token', 'nuevamarca', 'nuevomodelo', 'tipo');
        $datosEquipo['id_so'] = $request->input('id_so');
        $datosEquipo['tipo'] = $request->input('tipo');
        
        Equipos::create($datosEquipo);
    
        return redirect ('equipo');*/
    }

    public function modal(Request $marca)
    {
        $equipos = Equipos::with('marca')->get(); // Cargar la relación con "marca"
        $marcas = request()->except('_token');
        marca::create($marcas);
        return redirect()->back();

        // $sqlBD = DB::table('marcas')->get();
        // $sqlBD->save($marcas);

        // $sqlBD = DB::table('marcas');
        // $sqlBD::insert($datosModal);

        // return view('equipo.create', compact('marcas','modelos')); // Pasar los cargos a la vista "form.blade.php"
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\equipos  $equipos
     * @return \Illuminate\Http\Response
     */
    public function show(equipos $equipos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\equipos  $equipos
     * @return \Illuminate\Http\Response
     */
    public function edit(equipos $equipos, $id)
    {
        $equipo = Equipos::find($id);
        $marcas = Marca::all(); // Obtener todos los registros de la tabla "marca"
        $modelos = Modelo::all(); // Obtener todos los registros de la tabla "modelo"
        $sistemas = Sistema::all(); // Obtener todos los registros de la tabla "sistema"
    
        return view('equipo.edit', compact('equipo', 'marcas', 'modelos', 'sistemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\equipos  $equipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipos $equipos, $id)
    {
        $request->validate(
            [
            'serial' => 'unique:equipos,serial',
            'serialA' => 'unique:equipos,serialA',
            ],
            [
            'serial.unique' => 'El valor del campo Serial ya existe en la base de datos.',
            'serialA.unique' => 'El valor del campo Serial Activo ya existe en la base de datos.'
            ]
        );
        // Excluir el campo "tipo" al actualizar los datos del equipo con los datos del formulario
        $data = $request->except(['_token', '_method', 'id', 'tipo']);

        $equipo = Equipos::findOrFail($id);
        $equipo->fill($data);
        $equipo->save();
        $bitacora = new BitacoraController;
        $bitacora->update();
        // Equipos::where('id', $id)->update($data);
    
        // Obtén el equipo actualizado
        // $equipo = Equipos::findOrFail($id);
    
        // Obtén la lista de las marcas, modelos y sistemas
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $sistemas = Sistema::all();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect('equipo');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\equipos  $equipos
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipos $equipos, $id)
    {
        try {
            Equipos::destroy($id);
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('equipo')->with('eliminar', 'ok');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el equipo debido a que esta asignado a una persona.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
