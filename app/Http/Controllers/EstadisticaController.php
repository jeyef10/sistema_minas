<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estadistica;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{

    public function index()
    {
        $recepciones = DB::table('recepcion')
            ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM created_at) as mes'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->get();

        $data = $this->prepareChartData($recepciones);

        return view('estadistica.index', compact('data'));
    }

    private function prepareChartData($recepciones)
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset = array_fill(0, 12, 0); // Inicializar un array con 12 ceros

        foreach ($recepciones as $recepcion) {
            $dataset[$recepcion->mes - 1] = $recepcion->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Número de Recepciones',
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
