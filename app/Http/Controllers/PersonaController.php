<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Division;
use App\Models\DivisionSede;
use App\Models\Sede;
use App\Models\PersonaDivisionSede;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;


class PersonaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-persona|crear-persona|editar-persona|borrar-persona', ['only' => ['index']]);
         $this->middleware('permission:crear-persona', ['only' => ['create','store']]);
         $this->middleware('permission:editar-persona', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-persona', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::with(['cargo', 'divisionesSedes.sede', 'divisionesSedes.division'])->get();
        return view('persona.index', compact('personas'));
    }

    public function pdf()
    {
          $personas=Persona::all();
          $pdf=Pdf::loadView('persona.pdf', compact('personas'));
          return $pdf->stream();

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $cargos = Cargo::all(); // Obtener todos los registros de la tabla "cargo"
        $sedes = Sede::all(); // Obtener todos los registros de la tabla "sede"
        $divisiones = Division::join('division_sede', 'divisions.id', '=', 'division_sede.id_division')
        ->join('sedes', 'division_sede.id_sede', '=', 'sedes.id')
        ->pluck('divisions.nombre_division', 'divisions.id')
        ->toArray(); // Obtener los nombres de las divisiones relacionadas con las sedes
                              
        return view('persona.create', compact('cargos', 'sedes', 'divisiones')); // Pasar los cargos, sedes y divisiones a la vista "create.blade.php"
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
=======
        $request->validate(
            [
            'cedula' => 'unique:personas,cedula',
            'id_usuario' => 'unique:personas,id_usuario',
            ],
            [
            'cedula.unique' => 'El valor del campo Cedula ya existe en la base de datos.',
            'id_usuario.unique' => 'El valor del campo Id Usuario ya existe en la base de datos.',
            ]
        );
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
        $datosPersona = $request->except('_token');
        $persona = Persona::create($datosPersona);
        $bitacora = new BitacoraController;
        $bitacora->update();
        $idDivision = $request->input('id_division');

        $personaDivisionSede = new PersonaDivisionSede();
        $personaDivisionSede->id_persona = $persona->id;
        $personaDivisionSede->id_division_sede = $idDivision;
        $personaDivisionSede->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        return redirect('persona');
    }

    public function getBySede(Sede $sede)
    {
        $divisiones = Division::join('division_sede', 'divisions.id', '=', 'division_sede.id_division')
            ->join('sedes', 'division_sede.id_sede', '=', 'sedes.id')
            ->where('division_sede.id_sede', $sede->id)
            ->pluck('divisions.nombre_division', 'division_sede.id')
            ->toArray();

        return response()->json($divisiones);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
=======
        
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
        $persona = Persona::findOrFail($id);
        $cargos = Cargo::all();
        $sedes = Sede::all();
    
        // Obtener el registro de persona_division_sede para la persona seleccionada
        $personaDivisionSede = PersonaDivisionSede::where('id_persona', $id)->first();
    
        // Obtener los IDs de la sede y la división asociados a la persona
        $id_sede = null;
        $id_division_sede = null;
        
        if ($personaDivisionSede) {
            $id_sede = $personaDivisionSede->divisionSede->sede->id;
            $id_division_sede = $personaDivisionSede->id_division_sede;
        }

        
        // Obtener las divisiones asociadas a la sede de la persona
        $divisiones = Division::join('division_sede', 'divisions.id', '=', 'division_sede.id_division')
            ->where('division_sede.id_sede', $id_sede) // Obtener el ID de la sede asociada a la persona
            ->pluck('divisions.nombre_division', 'divisions.id')
            ->toArray();
    
        return view('persona.edit', compact('persona', 'cargos', 'sedes', 'divisiones', 'id_sede', 'id_division_sede'));
<<<<<<< HEAD
=======
        
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // Luego puedes continuar con el código de actualización de la persona
       $persona = Persona::find($id);
       $persona->nombre = $request->input('nombre');
       $persona->apellido = $request->input('apellido');
       $persona->cedula = $request->input('cedula');
       $persona->id_usuario = $request->input('id_usuario');
       $persona->id_cargo = $request->input('id_cargo');
       $persona->telefono = $request->input('telefono');
<<<<<<< HEAD
    
=======
       $bitacora = new BitacoraController;
       $bitacora->update();

>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
       // Obtener el ID de la relación persona_division_sede correspondiente a la persona
       $id_division_sede = $request->input('id_division_sede');

    // Buscar y actualizar la relación persona_division_sede
    $relacion = PersonaDivisionSede::where('id_persona', $id)->first();
    if ($relacion) {
        $relacion->id_division_sede = $id_division_sede;
        $relacion->save();
    } else {
        // Si no existe ninguna relación previa, debes crear una nueva
        $relacion = new PersonaDivisionSede;
        $relacion->id_persona = $id;
        $relacion->id_division_sede = $id_division_sede;
        $relacion->save();
<<<<<<< HEAD
    }
       
    $persona->save();

    return redirect('persona');
=======
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
    }
    $bitacora = new BitacoraController;
    $bitacora->update(); 
    $persona->save();
     

    return redirect('persona');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        // persona::destroy($id);
        // return redirect('persona');

        /* //////////////////////////////////////////////////////////////////// */

        // Obtener la persona a eliminar
        $persona = persona::findOrFail($id);
    
        // Eliminar los registros relacionados en la tabla puente
        $persona->PersonaDivisionSede()->detach();
    
        // Eliminar la persona
        $persona->delete();
    
        return redirect('persona')->with('eliminar', 'ok');
=======
        try {
            // Obtener la persona a eliminar
            $persona = persona::findOrFail($id);
        
            // Eliminar los registros relacionados en la tabla puente
            $persona->PersonaDivisionSede()->detach();
        
            // Eliminar la persona
            $persona->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
        
            return redirect('persona')->with('eliminar', 'ok');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la persona debido a que tiene un equipo y perifericos asignados.';
            return redirect()->back()->withErrors($errorMessage);
        }
        
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
    }
    
}
