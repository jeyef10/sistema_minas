<?php

namespace App\Http\Controllers;
use App\Models\Licencias;
use App\Models\Inspecciones;
use App\Models\Plazos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class LicenciaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-licencia|crear-licencia|editar-licencia|borrar-licencia', ['only' => ['index']]);
         $this->middleware('permission:crear-licencia', ['only' => ['create','store']]);
         $this->middleware('permission:editar-licencia', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-licencia', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspecciones = Inspecciones::all();

        return view('licencia.index', compact('inspecciones'));
    }

    public function getInspeccionDetalles($id)
    {
        // Recupera la inspección por su ID
        $inspeccion = Inspecciones::find($id);

        if (!$inspeccion) {
            // Maneja el caso en que no se encuentre la inspección
            return response()->json(['error' => 'Inspección no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_planificacion' => $inspeccion->planificacion->recepcion->categoria,
            'observaciones' => $inspeccion->observaciones,
            'conclusiones' => $inspeccion->conclusiones,
            'latitud' => $inspeccion->latitud,
            'longitud' => $inspeccion->longitud,
            'longitud_terreno' => $inspeccion->longitud_terreno,
            'ancho' => $inspeccion->ancho,
            'profundidad' => $inspeccion->profundidad,
            'volumen' => $inspeccion->volumen,
            'utm_norte' => $inspeccion->utm_norte,
            'utm_este' => $inspeccion->utm_este,
            'lindero_norte' => $inspeccion->lindero_norte,
            'lindero_sur' => $inspeccion->lindero_sur,
            'lindero_este' => $inspeccion->lindero_este,
            'lindero_oeste' => $inspeccion->lindero_oeste,
            'superficie' => $inspeccion->superficie,
            'res_fotos' => $inspeccion->res_fotos,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $inspeccion = Inspecciones::findOrFail($id);
        $plazos = Plazos::all();

        return view('licencia.create', compact('inspeccion', 'plazos'));
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
