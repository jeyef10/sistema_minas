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
use App\Models\PagoRegalia;
use App\Models\Plazos;
use App\Models\TipoPago;
use App\Models\Banco;
use App\Models\Recepcion;
use App\Models\Inspecciones;
use App\Models\Licencias;


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

        // $regalias = Regalia::all();
        // $count_regalia= DB::table('regalias')
        // ->count();
        
        $plazos = Plazos::all();
        $count_plazo= DB::table('plazos')
        ->count();

        $tipo_pagos = TipoPago::all();
        $count_tipo_pagos= DB::table('tipo_pagos')
        ->count();

        $bancos = Banco::all();
        $count_bancos = DB::table('bancos')
        ->count();

        $mapa_recepcion = Recepcion::all();
        $count_recepcion = DB::table('recepcion')
        ->count();

        $mapa_inspecciones = Inspecciones::all();
        $count_inspecciones = DB::table('inspecciones')
        ->count();

        $licencia= Licencias::all();
        $count_licencia= DB::table('licencias')
        ->count();

        $mapa_recepciones = Recepcion::select('latitud', 'longitud')->get();
        $mapa_inspecciones = Inspecciones::select('latitud', 'longitud')->get();
        // $mapa_licencias = Licencias::with('inspeccion:latitud,longitud')
        //     ->get()
        //     ->map(function ($licencia) {
        //         return [
        //             'latitud' => $licencia->inspeccion->latitud,
        //             'longitud' => $licencia->inspeccion->longitud
        //         ];
        //     });

        $mapa_licencias = Licencias::with('inspeccion')
        ->get()
        ->filter(function ($licencia) {
            return !is_null($licencia->inspeccion);
        })
        ->map(function ($licencia) {
            return [
                'latitud' => $licencia->inspeccion->latitud,
                'longitud' => $licencia->inspeccion->longitud
            ];
        });

        $pagos = PagoRegalia::with('licencia')
            ->select('pago_regalias.*')
            ->join(DB::raw('(SELECT MAX(id) as latest_id FROM pago_regalias GROUP BY id_licencia) as latest_pagos'), 'pago_regalias.id', '=', 'latest_pagos.latest_id')
            ->whereNotNull('fecha_venci')
            ->get();


            // dd($pagos); 


        // Filtrar pagos vencidos y de vencimiento cercano
        $pagos = $pagos->filter(function ($pago) {
            $statusInfo = $this->determineStatus($pago);
            if ($statusInfo['status'] != 'Normal') {
                // Verificar si hay otros pagos para la misma licencia que están al día
                $licenciaPagos = PagoRegalia::where('id_licencia', $pago->id_licencia)->get();
                $allPaid = false;
                foreach ($licenciaPagos as $licenciaPago) {
                    if ($this->determineStatus($licenciaPago)['status'] == 'Normal') {
                        $allPaid = true;
                        break;
                    }
                }
                return !$allPaid;
            }
            return false;
        });

        foreach ($pagos as $pago) {
            $statusInfo = $this->determineStatus($pago);
            $pago->status = $statusInfo['status'];
            $pago->statusClass = $statusInfo['class'];
        }

        return view('home.inicio' , compact('count_solicitante', 'count_natural', 'count_juridico', 'count_recaudo','count_comisionado', 'count_mineral', 'count_plazo', 
        'count_tipo_pagos', 'count_bancos', 'count_recepcion','count_inspecciones', 'count_licencia', 'mapa_recepciones', 'mapa_inspecciones', 'mapa_licencias', 'pagos' ) , [
        'count' => $count_solicitante, $count_natural, $count_juridico, $count_recaudo,  $count_comisionado,  $count_mineral, $count_plazo ,
        $count_tipo_pagos,  $count_bancos, $count_recepcion, $count_inspecciones, $count_licencia

    ]); 


     }

     protected function determineStatus($pago)
    {
        $dueDate = $pago->fecha_venci;
        $now = now();
        $status = '';
        $statusClass = '';
    
        if ($now->greaterThan($dueDate)) {
            $status = 'Vencido';
            $statusClass = 'badge badge-danger';
        } elseif ($now->diffInDays($dueDate) <= 7) {
            $status = 'Vencimiento cercano';
            $statusClass = 'badge badge-warning';
        } 
        
        else {
            $status = 'Normal';
            $statusClass = 'badge badge-success';
        }
    
        return ['status' => $status, 'class' => $statusClass];
    }


}