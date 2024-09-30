<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitante;
use App\Models\PersonaNatural;
use App\Models\PersonaJuridica;
use App\Models\Recaudos;
use App\Models\Comisionados;
use App\Models\Minerales;
use App\Models\Regalia;
use App\Models\Plazos;
use App\Models\Recepcion;
use App\Models\Inspecciones;


class homeController extends Controller
{
    //
    public function index(){

        $solicitantes = Solicitante::all();
        $count_solicitante = DB::table('solicitantes')
        ->count();

        $personas_naturales = PersonaNatural::all();
        $count_natural = DB::table('personas_naturales')
        ->count();

        $personas_juridicas = PersonaJuridica::all();
        $count_juridico = DB::table('personas_juridicas')
        ->count();

        $recaudos = Recaudos::all();
        $count_recaudo= DB::table('recaudos')
        ->count();

        $comisionados = Comisionados::all();
        $count_comisionado= DB::table('comisionados')
        ->count();

        $minerales= Minerales::all();
        $count_mineral= DB::table('minerales')
        ->count();

        $regalias = Regalia::all();
        $count_regalia= DB::table('regalias')
        ->count();
        
        $plazos = Plazos::all();
        $count_plazo= DB::table('plazos')
        ->count();

        $mapa_recepcion = Recepcion::all();
        $count_recepcion = DB::table('recepcion')
        ->count();

        $mapa_inspecciones = Inspecciones::all();
        $count_inspecciones = DB::table('inspecciones')
        ->count();

        $mapa_recepciones = Recepcion::select('latitud', 'longitud')->get();
        $mapa_inspecciones = Inspecciones::select('latitud', 'longitud')->get();

        return view('home.inicio' , compact('count_solicitante', 'count_natural', 'count_juridico', 'count_recaudo','count_comisionado', 'count_mineral','count_regalia', 'count_plazo',
        'count_recepcion','count_inspecciones', 'mapa_recepciones', 'mapa_inspecciones' ) , [
        'count' => $count_solicitante, $count_natural, $count_juridico, $count_recaudo,  $count_comisionado,  $count_mineral,   
        $count_regalia, $count_plazo ,$count_recepcion, $count_inspecciones

    ]); ;

    }

}