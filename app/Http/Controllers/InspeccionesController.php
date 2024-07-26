<?php

namespace App\Http\Controllers;
use App\Models\Inspecciones;
use App\Models\Planificacion;
use App\Models\PlanificacionComisionados;
use App\Models\Recepcion;
use App\Models\Comisionados;
use App\Models\Municipio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class InspeccionesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-inspeccion|crear-inspeccion|editar-inspeccion|borrar-inspeccion', ['only' => ['index']]);
         $this->middleware('permission:crear-inspeccion', ['only' => ['create','store']]);
         $this->middleware('permission:editar-inspeccion', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-inspeccion', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planificaciones = Planificacion::with('comisionados', 'planificacioncomisionados')->get();

        return view('inspeccion.index', compact('planificaciones'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $planificacion = Planificacion::findOrFail($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();

        return view('inspeccion.create', compact('planificacion', 'municipios', 'comisionados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha_inspeccion' => 'required|date_format:d/m/Y|after_or_equal:today|before_or_equal:'. date('d/m/Y', strtotime('+7 days')),
            ]);

        // Crear una nueva Inspección
        $inspecciones = new Inspecciones ();
        $inspecciones->id_planificacion = $request->input('id_planificacion');
        $inspecciones->funcionario_acomp = $request->input('funcionario_acomp');
        $inspecciones->lugar_direccion = $request->input('lugar_direccion');
        $inspecciones->observaciones = $request->input('observaciones');
        $inspecciones->conclusiones = $request->input('conclusiones');
        $inspecciones->latitud = $request->input('latitud');
        $inspecciones->longitud = $request->input('longitud');

       // Verificar si se han cargado archivos
        if ($request->hasFile('res_fotos')) {
            $rutaGuardarImg = 'imagen/';
            $nombresImagenes = [];
        
            foreach ($request->file('res_fotos') as $foto) {
            $imagenInspeccion = date('YmdHis') . '.' . $foto->getClientOriginalExtension();
            $foto->move($rutaGuardarImg, $imagenInspeccion);
            $nombresImagenes[] = $imagenInspeccion;
            }
        
            $inspecciones->res_fotos = json_encode($nombresImagenes);
        } else {
            $inspecciones->res_fotos = ''; // null
        }

        $inspecciones->fecha_inspeccion = $request->input('fecha_inspeccion');
        $inspecciones->estatus = $request->input('estatus');

        $inspecciones->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('licencia');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function show(Inspecciones $inspecciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inspeccion = Inspecciones::find($id);
        $planificacion = Planificacion::findOrFail($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();
        $funcionario_acomp = $inspeccion->funcionario_acomp;
        $lugar_direccion = $inspeccion->lugar_direccion;
        $observaciones = $inspeccion->observaciones;
        $conclusiones = $inspeccion->conclusiones;
        $latitud = $inspeccion->latitud;
        $longitud = $inspeccion->longitud;
        $res_fotos = $inspeccion->res_fotos;
        $fecha_inspeccion = $inspeccion->fecha_inspeccion;
        $estatus = $inspeccion->estatus;

        return view('inspeccion.edit' , compact('inspeccion', 'planificacion', 'municipios', 'comisionados', 'funcionario_acomp', 'lugar_direccion', 'observaciones', 'conclusiones',
        'latitud', 'longitud', 'res_fotos', 'fecha_inspeccion', 'estatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha_inspeccion' => 'required|date_format:d/m/Y|after_or_equal:today|before_or_equal:'. date('d/m/Y', strtotime('+7 days')),
            ]);

        // Encuentra la inspección por su ID
        $inspeccion = Inspecciones::find($id);

        // Actualiza los campos según los datos del formulario
        $inspeccion->id_planificacion = $request->input('id_planificacion');
        $inspeccion->funcionario_acomp = $request->input('funcionario_acomp');
        $inspeccion->lugar_direccion = $request->input('lugar_direccion');
        $inspeccion->observaciones = $request->input('observaciones');
        $inspeccion->conclusiones = $request->input('conclusiones');
        $inspeccion->latitud = $request->input('latitud');
        $inspeccion->longitud = $request->input('longitud');
        $inspeccion->fecha_inspeccion = $request->input('fecha_inspeccion');
        $inspeccion->estatus = $request->input('estatus');

        // Verificar si se han cargado archivos
        if ($request->hasFile('res_fotos')) {
            $rutaGuardarImg = 'imagen/';
            $nombresImagenes = [];

            foreach ($request->file('res_fotos') as $foto) {
                $imagenInspeccion = date('YmdHis') . '.' . $foto->getClientOriginalExtension();
                $foto->move($rutaGuardarImg, $imagenInspeccion);
                $nombresImagenes[] = $imagenInspeccion;
            }

            // Combinar imágenes anteriores con las nuevas
            $imagenesAnteriores = json_decode($inspeccion->res_fotos);
            $nombresImagenes = array_merge($imagenesAnteriores, $nombresImagenes);

            $inspeccion->res_fotos = json_encode($nombresImagenes);
        }

        // Actualizar la fecha de inspección y el estutus
        $inspeccion->fecha_inspeccion = $request->input('fecha_inspeccion');
        $inspeccion->estatus = $request->input('estatus');
        
        // Guarda los cambios
        $inspeccion->save();
        
        try {
            
            // Redirige a la página deseada
            return redirect('licencia');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspecciones $inspecciones)
    {
        //
    }
}
