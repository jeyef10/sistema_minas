<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asignar;
use App\Http\Controllers\BitacoraController;
use App\Models\Equipos;
use App\Models\Perifericos;
use App\Models\Persona;
use App\Models\TipoPeriferico;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AsignarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    
        $asignacionesAgrupadas = $asignaciones->groupBy(function($asignacion) {
            // Agrupa por la identificación de la persona y del equipo.
            return $asignacion->id_persona . '-' . $asignacion->id_equipo;
        });
    
        return view('asignar.index', compact('asignacionesAgrupadas'));
    }

    public function pdf()
    {
        // Trae todos los registros de la tabla asignar
            $asignaciones = Asignar::all();

            // Crea un arreglo vacío para almacenar los datos del equipo con la persona
            $asignacionesAgrupadas = [];

            // Recorre todos los registros de la tabla asignar
            foreach ($asignaciones as $asignacion) {
            // Agrega los datos del equipo con la persona al arreglo
            $asignacionesAgrupadas[] = $asignacion;
            }

            // Carga la vista del PDF
            $pdf = PDF::loadView('asignar.pdf', compact('asignacionesAgrupadas'))->setPaper('a4', 'portrait');

            // Genera el PDF
            return $pdf->stream();
    }

    public function estatus()
    {
        $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    
        $asignacionesAgrupadas = $asignaciones->groupBy(function($asignacion) {
            // Agrupa por la identificación de la persona y del equipo.
            return $asignacion->id_persona . '-' . $asignacion->id_equipo;
        });
    
        return view('inventario.estatus', compact('asignacionesAgrupadas'));
    }

    public function desincorp()
    {
        $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    
        $asignacionesAgrupadas = $asignaciones->groupBy(function($asignacion) {
            // Agrupa por la identificación de la persona y del equipo.
            return $asignacion->id_persona . '-' . $asignacion->id_equipo;
        });
    
        return view('desincorporar.index', compact('asignacionesAgrupadas'));
    }
    
    public function reincorp()
    {
        $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    
        $asignacionesAgrupadas = $asignaciones->groupBy(function($asignacion) {
            // Agrupa por la identificación de la persona y del equipo.
            return $asignacion->id_persona . '-' . $asignacion->id_equipo;
        });
    
        return view('reincorporar.index', compact('asignacionesAgrupadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obteniendo los IDs de las personas, los equipos y los periféricos que ya están en uso.
        $idsPersonasUsadas = Asignar::pluck('id_persona')->toArray();
        $idsEquiposUsados = Asignar::pluck('id_equipo')->toArray();
        $idsPerifericosUsados = Asignar::pluck('id_periferico')->toArray();
    
        // Excluir personas, equipos y periféricos que ya están en uso.
        $personas = Persona::with('divisionesSedes.division', 'divisionesSedes.sede', 'cargo')
                    ->whereNotIn('id', $idsPersonasUsadas)
                    ->get();
    
        $equipos = Equipos::with('sistema')
                    ->whereNotIn('id', $idsEquiposUsados)
                    ->get();
    
        $perifericos = Perifericos::whereNotIn('id', $idsPerifericosUsados)
                    ->get();
    
        $tipo_perifericos = TipoPeriferico::all(); // Obtener todos los registros de la tabla "tipo_perifericos"
    
        return view('asignar.create', compact('personas','equipos', 'perifericos', 'tipo_perifericos'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_persona = $request->id_persona;
        $id_equipo = $request->id_equipo;
        $id_perifericos = $request->id_periferico;
        $id_perifericos = array_filter($id_perifericos);
    
        // Verificar si la persona ya tiene asignado un equipo
        $existingAssignment = Asignar::where('id_persona', $id_persona)
                                     ->exists();
    
        if ($existingAssignment) {
            // Mostrar mensaje de error o realizar la acción correspondiente
            return redirect()->back()->with('error', 'La persona ya tiene asignado un equipo.');
        }
    
        // Verificar si el equipo ya está asignado a otra persona
        $existingTeamAssignment = Asignar::where('id_equipo', $id_equipo)
                                         ->exists();
    
        if ($existingTeamAssignment) {
            // Mostrar mensaje de error o realizar la acción correspondiente
            return redirect()->back()->with('error', 'El equipo ya está asignado a otra persona.');
        }
    
        // Verificar si los periféricos ya están asignados a otra combinación de persona y equipo
        $existingPeripherals = Asignar::whereIn('id_periferico', $id_perifericos)
                                      ->exists();
    
        if ($existingPeripherals) {
            // Mostrar mensaje de error o realizar la acción correspondiente
            return redirect()->back()->with('error', 'Algunos periféricos ya están asignados a otra persona.');
        }
    
        $estatus = $request->estatus;
    
        foreach ($id_perifericos as $id_periferico) {
            Asignar::create([
                'id_persona' => $id_persona,
                'id_equipo' => $id_equipo,
                'id_periferico' => $id_periferico,
                'estatus' => $estatus
            ]);
        }

        $bitacora = new BitacoraController;
        $bitacora->update();
    
        return redirect('asignar');
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desincorporar($id)
    {
        $asignaciones = Asignar::where('id_persona', $id)->get();
        $personas = Persona::all();
        $equipos = Equipos::all();
        $tipo_perifericos = TipoPeriferico::all();
        $perifericos = Perifericos::all();
        $bitacora = new BitacoraController;
        $bitacora->update();
    
        // Si hay asignaciones para esta persona, usamos la primera para obtener los datos de la persona y el equipo
        if (!$asignaciones->isEmpty()) {
            $asignacion = $asignaciones->first();
        } else {
            // Si no hay asignaciones para esta persona, creamos un nuevo objeto Asignar con los valores predeterminados
            $asignacion = new Asignar;
            $asignacion->id_persona = 0;
            $asignacion->id_equipo = 0;
        }
    
        // Creamos una matriz con los ids de los tipos de periféricos de todas las asignaciones
        $ids_perifericos_por_tipo = [];
        foreach($asignaciones as $asignacion) {
            $periferico = $asignacion->periferico; // Asumiendo que tienes una relación "periferico" en el modelo Asignar
            $ids_perifericos_por_tipo[$periferico->id_tipo] = $periferico->id;
        }
        $bitacora = new BitacoraController;
        $bitacora->update();
    
    return view('asignar.desincorporar', compact('asignacion', 'personas', 'equipos', 'tipo_perifericos', 'perifericos', 'ids_perifericos_por_tipo'));
    }

    public function reincorporar($id)
    {
        $asignaciones = Asignar::where('id_persona', $id)->get();
        $personas = Persona::all();
        $equipos = Equipos::all();
        $tipo_perifericos = TipoPeriferico::all();
        $perifericos = Perifericos::all();
    
        // Si hay asignaciones para esta persona, usamos la primera para obtener los datos de la persona y el equipo
        if (!$asignaciones->isEmpty()) {
            $asignacion = $asignaciones->first();
        } else {
            // Si no hay asignaciones para esta persona, creamos un nuevo objeto Asignar con los valores predeterminados
            $asignacion = new Asignar;
            $asignacion->id_persona = 0;
            $asignacion->id_equipo = 0;
        }
    
        // Creamos una matriz con los ids de los tipos de periféricos de todas las asignaciones
        $ids_perifericos_por_tipo = [];
        foreach($asignaciones as $asignacion) {
            $periferico = $asignacion->periferico; // Asumiendo que tienes una relación "periferico" en el modelo Asignar
            $ids_perifericos_por_tipo[$periferico->id_tipo] = $periferico->id;
        }

    
    return view('asignar.reincorporar', compact('asignacion', 'personas', 'equipos', 'tipo_perifericos', 'perifericos', 'ids_perifericos_por_tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignaciones = Asignar::where('id_persona', $id)->get();
    
        // Obteniendo los IDs de las personas, los equipos y los periféricos que ya están en uso.
        $idsPersonasUsadas = Asignar::pluck('id_persona')->toArray();
        $idsEquiposUsados = Asignar::pluck('id_equipo')->toArray();
        $idsPerifericosUsados = Asignar::pluck('id_periferico')->toArray();
    
        // Excluir personas, equipos y periféricos que ya están en uso, pero incluir la persona, el equipo y el periférico que se está editando.
        $personas = Persona::with('divisionesSedes.division', 'divisionesSedes.sede', 'cargo')
                    ->whereNotIn('id', $idsPersonasUsadas)
                    ->get();
    
        $equipos = Equipos::whereNotIn('id', $idsEquiposUsados)
                    ->get();
    
        $perifericos = Perifericos::whereNotIn('id', $idsPerifericosUsados)
                    ->get();
    
        $tipo_perifericos = TipoPeriferico::all();
        
        // Si hay asignaciones para esta persona, usamos la primera para obtener los datos de la persona, el equipo y el periférico
        if (!$asignaciones->isEmpty()) {
            $asignacion = $asignaciones->first();
            // Agregamos la persona, el equipo y el periférico que se está editando a las listas
            $personas->push($asignacion->persona);
            $equipos->push($asignacion->equipo);
            
            // Agregamos todos los periféricos de las asignaciones a la lista de periféricos
            foreach($asignaciones as $asignacion) {
                $perifericos->push($asignacion->periferico);
            }
    
        } else {
            // Si no hay asignaciones para esta persona, creamos un nuevo objeto Asignar con los valores predeterminados
            $asignacion = new Asignar;
            $asignacion->id_persona = 0;
            $asignacion->id_equipo = 0;
            $asignacion->id_periferico = 0;
        }
    
        // Creamos una matriz con los ids de los tipos de periféricos de todas las asignaciones
        $ids_perifericos_por_tipo = [];
        foreach($asignaciones as $asignacion) {
            $periferico = $asignacion->periferico; // Asumiendo que tienes una relación "periferico" en el modelo Asignar
            $ids_perifericos_por_tipo[$periferico->id_tipo] = $periferico->id;
        }
    
        return view('asignar.edit', compact('asignacion', 'personas', 'equipos', 'tipo_perifericos', 'perifericos', 'ids_perifericos_por_tipo'));
    }
    
    
    
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $asignar)
    {
        // Obtén el estatus y la observación de la solicitud
        $estatus = $request->estatus;
        $observacion = $request->observacion;
    
        // Encuentra todas las asignaciones para la persona específica
        $asignaciones = Asignar::where('id_persona', $asignar)->get();
    
        // Actualiza el estatus y la observación de todas las asignaciones
        foreach ($asignaciones as $asignacion) {
            $asignacion->estatus = $estatus;
            $asignacion->observacion = $observacion;
            $asignacion->save();
        }
    
        // return redirect('asignar');

        return redirect('desincorporar');
    }

    public function updatereincorp(Request $request, $asignar)
    {
        // Obtén el estatus y la observación de la solicitud
        $estatus = $request->estatus;
        $observacion = $request->observacion;
        $nuevo_id_persona = $request->id_persona; // Asume que el nuevo ID de persona viene en la solicitud
    
        // Encuentra todas las asignaciones para la persona específica
        $asignaciones = Asignar::where('id_persona', $asignar)->get();
    
        // Actualiza el estatus y la observación de todas las asignaciones
        foreach ($asignaciones as $asignacion) {
            $asignacion->id_persona = $nuevo_id_persona; // Usa el nuevo ID de la persona
            $asignacion->estatus = $estatus;
            $asignacion->observacion = $observacion;
            $asignacion->save();
        }

        return redirect('reincorporar');
    }

    public function updateByPerson(Request $request, $id)
    {
        // Obtén los periféricos de la solicitud
        $perifericos_seleccionados = $request->id_periferico;
        $nuevo_id_persona = $request->id_persona; // Asume que el nuevo ID de persona viene en la solicitud
    
        // Encuentra todas las asignaciones para la persona específica
        $asignaciones = Asignar::where('id_persona', $id)->get();
    
        // Primero, manejemos las asignaciones existentes
        foreach ($asignaciones as $asignacion) {
            // Si este periférico no está en la solicitud, eliminamos la asignación
            if (!in_array($asignacion->id_periferico, $perifericos_seleccionados)) {
                $asignacion->delete();
            } else {
                // Si este periférico está en la solicitud, actualizamos la asignación
                $asignacion->id_persona = $nuevo_id_persona; // Actualiza el ID de la persona
                $asignacion->id_equipo = $request->id_equipo;// Actualiza el ID del equipo
    
                $key = array_search($asignacion->id_periferico, $perifericos_seleccionados);
                if ($key !== false) {
                    $asignacion->id_periferico = $request->id_periferico[$key];
                    $asignacion->estatus = $request->estatus;
                    $asignacion->observacion = $request->observacion;
                    $asignacion->save();
                }
                // Una vez manejado, lo eliminamos del array
                unset($perifericos_seleccionados[$key]);
            }
        }
    
        // Ahora, manejamos cualquier periférico nuevo seleccionado en la solicitud
        foreach ($perifericos_seleccionados as $key => $id_periferico) {
            if ($id_periferico != 0) {
                $asignacion = new Asignar;
                $asignacion->id_persona = $nuevo_id_persona; // Usa el nuevo ID de la persona
                $asignacion->id_equipo = $request->id_equipo;
                $asignacion->id_periferico = $id_periferico;
                $asignacion->estatus = 'Asignado'; // Agregamos un valor por defecto al estado
                $asignacion->observacion = null; // No se observa ninguna desincorporación aquí
                $asignacion->save();
            }
        }
    
        return redirect('asignar');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
