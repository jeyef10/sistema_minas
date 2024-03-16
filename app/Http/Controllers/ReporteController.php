<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;
use App\Models\Perifericos;
use App\Models\TipoPeriferico;
use App\Models\Persona;
use App\Models\Division;
use App\Models\Sede;
use App\Models\Asignar;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function bitacora()
    { 
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }

    public function index(Request $request)
    {
            $persona = Persona::join('persona_division_sede', 'persona_division_sede.id_persona', '=', 'personas.id')
                ->join('division_sede', 'division_sede.id', '=', 'persona_division_sede.id_division_sede')
                ->join('sedes', 'sedes.id', '=', 'division_sede.id_sede')
                ->join('divisions', 'divisions.id', '=', 'division_sede.id_division')
                ->join('asignar', 'asignar.id_persona', '=', 'personas.id')
                ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id')
                ->select([
                    'personas.cedula',
                    'personas.nombre',
                    'personas.apellido',
                    'personas.id_usuario',
                    'divisions.nombre_division',
                    'sedes.nombre_sede',
                    'equipos.serial',
                    'equipos.serialA',
                    'asignar.estatus',
                ]);
    
            $resultados = $persona->get();

        return view('reporte.index', ['resultados' => $resultados]);
    }

    public function reportesPdf(Request $request)
    {
        $resultados = Persona::join('persona_division_sede', 'persona_division_sede.id_persona', '=', 'personas.id')
        ->join('division_sede', 'division_sede.id', '=', 'persona_division_sede.id_division_sede')
        ->join('sedes', 'sedes.id', '=', 'division_sede.id_sede')
        ->join('divisions', 'divisions.id', '=', 'division_sede.id_division')
        ->join('asignar', 'asignar.id_persona', '=', 'personas.id')
        ->join('equipos', 'asignar.id_equipo', '=', 'equipos.id')
        ->get();

        $pdf = Pdf::loadView('reporte.equipo.pdf', compact('resultados'))->setPaper('a4', 'portrait'); //portrait,landscape

        return $pdf->stream();

    }
    
    public function indexperif(Request $request)
    {
        $personas = Persona::join('persona_division_sede', 'personas.id', '=', 'persona_division_sede.id_persona')
        ->join('division_sede', 'persona_division_sede.id_division_sede', '=', 'division_sede.id')
        ->join('sedes', 'division_sede.id_sede', '=', 'sedes.id')
        ->join('divisions', 'division_sede.id_division', '=', 'divisions.id')
        ->join('asignar', 'personas.id', '=', 'asignar.id_persona')
        ->join('perifericos', 'asignar.id_periferico', '=', 'perifericos.id')
        ->join('tipo_perifericos', 'perifericos.id_tipo', '=', 'tipo_perifericos.id')
        ->join('marcas', 'perifericos.id_marca', '=', 'marcas.id')
        ->join('modelos', 'perifericos.id_modelo', '=', 'modelos.id')
        ->select([
            'personas.cedula',
            'personas.nombre',
            'personas.apellido',
            'divisions.nombre_division',
            'sedes.nombre_sede',
            'tipo_perifericos.tipo',
            'marcas.nombre_marca',
            'modelos.nombre_modelo',
            'perifericos.id_tipo',
            'perifericos.id_marca',
            'perifericos.id_modelo',
            'perifericos.serial',
            'perifericos.serialA',
            'asignar.estatus',
        ]);
        
        $perifs = $personas->get();

        return view('reporte.indexperif', ['perifs' => $perifs]); 
    }

    
    public function reportesperifPdf(Request $request)
    {
        $perifs = Persona::join('persona_division_sede', 'persona_division_sede.id_persona', '=', 'personas.id')
        ->join('division_sede', 'division_sede.id', '=', 'persona_division_sede.id_division_sede')
        ->join('sedes', 'sedes.id', '=', 'division_sede.id_sede')
        ->join('divisions', 'divisions.id', '=', 'division_sede.id_division')
        ->join('asignar', 'personas.id', '=', 'asignar.id_persona')
        ->join('perifericos', 'asignar.id_periferico', '=', 'perifericos.id')
        ->join('tipo_perifericos', 'perifericos.id_tipo', '=', 'tipo_perifericos.id')
        ->join('marcas', 'perifericos.id_marca', '=', 'marcas.id')
        ->join('modelos', 'perifericos.id_modelo', '=', 'modelos.id')
        ->get();

        $pdf = Pdf::loadView('reporte.equipo.perifpdf', compact('perifs'))->setPaper('a4', 'portrait'); //portrait,landscape

        return $pdf->stream();

    }

}

/*actua como experto en bases de datos y laravel orm.

tengo las tablas equipos, personas, sedes, divisions, asignar, persona_division_sede,division_sede.

La realcion de equipos a asignar es de uno a muchos con clave foranea id_equipo.
La realcion de personas a asignar es de uno a muchos con clave foranea id_persona.
La realcion de personas a persona_division_sede es de uno a muchos con clave foranea id_persona.
La realcion de division_sede a persona_division_sede es de uno a muchos con clave foranea id_division_sede.
La realcion de sedes a division_sede es de uno a muchos con clave foranea id_sede.
La realcion de divisions a division_sede es de uno a muchos con clave foranea id_division.

necesitp una consulta que me filtre a los equipos de una persona

necesito una consulta que me filtre a los equipos de una sede

*/

