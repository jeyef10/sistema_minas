<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estadistica; 
use App\Models\Equipos;
use App\Models\Bitacora;
use App\Models\Asignar;

use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{

    // public function indeX()
    // {
    //     $estadisticas = Estadistica::all();

    //     $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    //     $count_asignar = DB::table('asignar')->count();
    //     $prueba='Asignar';

    //     $equipos_divisions = DB::table('equipos')
    //     ->select('divisions.*',DB::raw('count(*) as cantidad'))
    //     ->join('asignar', 'equipos.id', '=', 'asignar.id_equipo')
    //     ->join('persona_division_sede', 'asignar.id_persona', '=', 'persona_division_sede.id_persona')  
    //     ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
    //     ->join('divisions', 'divisions.id', '=', 'division_sede.id_division')
    //     ->groupBy('divisions.id')
    //     ->get();
        
    //     $equipos_sedes = DB::table('equipos')
    //     ->select('sedes.*',DB::raw('count(*) as cantidad'))
    //     ->join('asignar', 'equipos.id', '=', 'asignar.id_equipo')
    //     ->join('persona_division_sede', 'asignar.id_persona', '=', 'persona_division_sede.id_persona')  
    //     ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
    //     ->join('sedes', 'sedes.id', '=', 'division_sede.id_sede')
    //     ->groupBy('sedes.id')
    //     ->get();

    //     $equipos_so = DB::table('equipos')
    //     ->select('sistemas.tipo', DB::raw('count(*) as cantidad'))
    //     ->join('sistemas', 'equipos.id_so', '=', 'sistemas.id')
    //     ->groupBy('sistemas.tipo')
    //     ->orderBy('cantidad', 'desc')
    //     ->get(); //dd($equipos_sedes,$equipos_so);

    //     $equipos_divisions_so = DB::table('equipos')
    //     ->join('asignar', 'equipos.id', '=', 'asignar.id_equipo')
    //     ->join('persona_division_sede', 'asignar.id_persona', '=', 'persona_division_sede.id_persona')
    //     ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
    //     ->join('divisions', 'divisions.id', '=', 'division_sede.id_division')
    //     ->join('sistemas', 'equipos.id_so', '=', 'sistemas.id')
    //     ->select('divisions.*', 'sistemas.tipo', DB::raw('count(sistemas.tipo) as cantidad'))
    //     ->groupBy('divisions.id', 'sistemas.tipo')
    //     ->orderBy('divisions.id')
    //     ->get(); //dd($equipos_divisions_so);


    //     return view("estadistica.index", compact('prueba','count_asignar','equipos_divisions','equipos_sedes','equipos_so','equipos_divisions_so'),["data" =>json_encode($estadisticas)] , ['count' => $count_asignar]);

    //     // return view("estadistica.index", compact('count_asignar') ,["data" =>json_encode($estadisticas)] , ['count' => $count_asignar]);

      
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $estadisticas = Estadistica::all();

    //     $asignaciones = Asignar::with('persona', 'equipo', 'periferico')->get();
    //     $count_asignar = DB::table('asignar')->count();
    //     $prueba='Asignar';

    //     return view("estadistica.index", compact('prueba','count_asignar'));

      
    // }

    //     $equipos = Equipos::all();


    //     $assignedCount = DB::table('asignar')
    //       ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id')
    //       ->where('asignar.estatus', '=', 'Asignado') 
    //       ->count();

    //     $desincorporadoCount = DB::table('asignar')
    //       ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id') 
    //       ->where('asignar.estatus', '=', 'Desincorporado')
    //       ->count();

    //     $noAssignedCount = DB::table('equipos')
    //         ->whereNotIn('id', function ($query) {
    //             $query->select('id_equipo')
    //                 ->from('asignar')
    //                 // ->where('estatus', '=', 'Asignado')
    //                 ;
    //         })
    //         ->count();

    //     $division = DB::table('asignar')
    //         ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id')
    //         ->join('persona_division_sede', 'asignar.id_persona', '=', 'persona_division_sede.id_persona')
    //         ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
    //         ->join('sedes', 'division_sede.id_sede', '=', 'sedes.id')
    //         ->join('divisions', 'division_sede.id_division', '=', 'divisions.id')
    //         ->select('divisions.nombre_division', DB::raw('COUNT(asignar.id_equipo) as equipos_asignados'))
    //         // ->where('asignar.estatus', '=', 'Asignado')
    //         ->groupBy('divisions.id')
    //         ->orderByDesc('equipos_asignados')
    //         ->first();

    //     $sede = DB::table('asignar')
    //         ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id')
    //         ->join('persona_division_sede', 'asignar.id_persona', '=', 'persona_division_sede.id_persona')
    //         ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
    //         ->join('sedes', 'division_sede.id_sede', '=', 'sedes.id')
    //         ->select('sedes.nombre_sede', DB::raw('COUNT(asignar.id_equipo) as equipos_asignados'))
    //         // ->where('asignar.estatus', '=', 'Asignado')
    //         ->groupBy('sedes.id')
    //         ->orderByDesc('equipos_asignados')
    //         ->first();

    //     return view("estadistica.index", compact('equipos','assignedCount','noAssignedCount','desincorporadoCount','division','sede'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
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
