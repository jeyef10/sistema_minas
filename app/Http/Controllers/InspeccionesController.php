<?php

namespace App\Http\Controllers;
use App\Models\Inspecciones;
use App\Models\Planificacion;
use App\Models\PlanificacionComisionados;
use App\Models\Recepcion;
use App\Models\Comisionados;
use App\Models\Municipio;
use App\Models\User;
use App\Models\MunicipioComisionado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // $planificaciones = Planificacion::with('comisionados', 'planificacioncomisionados', 'municipio_comisionados')->get();
        $planificaciones = Planificacion::all();
        $unreadNotifications = Auth::user()->unreadNotifications;

            // Iterar sobre cada planificación para verificar si fue inspeccionada
            $planificaciones->each(function ($planificacion) {
                // Buscar en la tabla Inspecciones si existe una inspeccion para esta planificacion
                $planificacion->yaInspeccionada = Inspecciones::where('id_planificacion', $planificacion->id)->exists();
            });


        return view ('inspeccion.index', compact('planificaciones', 'unreadNotifications'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $notification_id)
    {
        $planificacion = Planificacion::findOrFail($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();
        return view('inspeccion.create', compact('planificacion', 'municipios', 'comisionados','notification_id'));
    }

    public function fetchComisionados(Request $request, $municipioId)
    {
        $municipiocomisionados = Comisionados::where('id_municipio', $municipioId)->get();
    
        return response()->json($municipiocomisionados);
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
                'res_fotos' => 'required|array|min:1',
                'res_fotos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'fecha_inspeccion' => 'required|date_format:d/m/Y|after_or_equal:today|before_or_equal:' . date('d/m/Y', strtotime('+7 days')),
            ], [
                'res_fotos.required' => 'Debe registrar una o más fotos.',
                'res_fotos.min' => 'Debe registrar al menos una foto.',
                'res_fotos.*.image' => 'Cada archivo debe ser una imagen.',
                'res_fotos.*.mimes' => 'Las imágenes deben ser de tipo jpeg, png, jpg, gif o svg.',
                'fecha_inspeccion.required' => 'La fecha de inspección es obligatoria.',
                'fecha_inspeccion.date_format' => 'El formato de la fecha de inspección no es válido.',
                'fecha_inspeccion.after_or_equal' => 'La fecha de inspección debe ser hoy o una fecha futura.',
                'fecha_inspeccion.before_or_equal' => 'La fecha de inspección no puede ser más de 7 días en el futuro.',
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
        $inspecciones->utm_norte = $request->input('utm_norte');
        $inspecciones->utm_este = $request->input('utm_este');
        

        // Verificar si se han cargado archivos
        if ($request->hasFile('res_fotos')) {
            $rutaGuardarImg = 'imagen/';
            $nombresImagenes = [];

            foreach ($request->file('res_fotos') as $foto) {
                $imagenInspeccion = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenInspeccion);
                $nombresImagenes[] = $imagenInspeccion;
            }

            
            $inspecciones->res_fotos = json_encode($nombresImagenes);
        } else {
            $inspecciones->res_fotos = '[]'; // null
            
        }
           
        $inspecciones->fecha_inspeccion = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_inspeccion'))->format('Y-m-d');
        $inspecciones->estatus = $request->input('estatus');
        // $inspecciones->estatus_resp = $request->input('estatus_resp');

            if ($inspecciones->estatus == "Aprobado") {

                /* //Notification how read
                $notification = Auth::user()->unreadNotifications
                                        ->where('id', $request->notification_id)
                                        ->first();
                if($notification){
                    $notification->markAsRead();
                } */

        // Marcar la notificación como leída para el usuario autenticado
        $notification = Auth::user()->unreadNotifications
                                    ->where('id', $request->notification_id)
                                    ->first();

        // Si se encuentra la notificación, marcarla como leída
        if ($notification) {
            $notification->markAsRead();
            
            // Obtener el id_planificacion de la notificación
            $id_planificacion = $notification->data['id_planificacion'];
            
            // Obtener todos los usuarios con el rol de "Administrador"
            $administradores = User::role('Administrador')->get();

            // Marcar las notificaciones relacionadas como leídas para cada administrador
            foreach ($administradores as $admin) {
                // Filtrar las notificaciones no leídas que tienen el mismo id_planificacion
                $adminNotifications = $admin->unreadNotifications
                                            ->filter(function ($adminNotification) use ($id_planificacion) {
                                                return $adminNotification->data['id_planificacion'] == $id_planificacion;
                                            });

                // Marcar cada notificación como leída
                foreach ($adminNotifications as $adminNotification) {
                    $adminNotification->markAsRead();
                }
            }
        }

                // $inspecciones->estatus_resp = $request->input('estatus_resp');

                if ($inspecciones->estatus_resp = '') {
                    $inspecciones->estatus_resp = 'Pendiente';
                }else{
                    $inspecciones->estatus_resp = $request->input('estatus_resp');
                }
            } else {
                $inspecciones->estatus_resp = 'Negado';
            }

        //     $inspeccion->estatus_resp = $request->input('estatus_resp');

        // if ($inspeccion->estatus == "Aprobado") {

        //     if ($inspeccion->estatus_resp = '') {
        //         $inspeccion->estatus_resp = 'Pendiente';
        //     }else{
        //         $inspeccion->estatus_resp = $request->input('estatus_resp');
        //     }
           
        // } else {
        //     $inspeccion->estatus_resp = 'Negado';
        // }
        $inspecciones->longitud_terreno = $request->input('longitud_terreno');
        $inspecciones->ancho = $request->input('ancho');
        $inspecciones->profundidad = $request->input('profundidad');
        $inspecciones->volumen = $request->input('volumen');
        $inspecciones->lindero_norte = $request->input('lindero_norte');
        $inspecciones->lindero_sur = $request->input('lindero_sur');
        $inspecciones->lindero_este = $request->input('lindero_este');
        $inspecciones->lindero_oeste = $request->input('lindero_oeste');
        $inspecciones->superficie = $request->input('superficie');

        $inspecciones->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
        
            return redirect('comprobantepago');
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    public function actualizarEstatusInspeccion(Request $request, $id)
    {
        $inspeccion = Inspecciones::find($id);

        if ($inspeccion) {
            $inspeccion->estatus_resp = $request->input('estatus_resp');
            $inspeccion->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Inspección no encontrada']);
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
        $inspeccion = Inspecciones::findOrFail($id);
        $planificacion = Planificacion::find($id);
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();
        $funcionario_acomp = $inspeccion->funcionario_acomp;
        $lugar_direccion = $inspeccion->lugar_direccion;
        $observaciones = $inspeccion->observaciones;
        $conclusiones = $inspeccion->conclusiones;
        $latitud = $inspeccion->latitud;
        $longitud = $inspeccion->longitud;
        $utm_norte = $inspeccion->utm_norte;
        $utm_este = $inspeccion->utm_este;
        $res_fotos = $inspeccion->res_fotos;
        $fecha_inspeccion = date('d/m/Y', strtotime($inspeccion->fecha_inspeccion));
        $estatus = $inspeccion->estatus;
        $estatus_resp = $inspeccion->estatus_resp;
        $longitud_terreno = $inspeccion->longitud_terreno;
        $ancho = $inspeccion->ancho;
        $profundidad = $inspeccion->profundidad;
        $volumen = $inspeccion->volumen;
        $lindero_norte = $inspeccion->lindero_norte;
        $lindero_sur = $inspeccion->lindero_sur;
        $lindero_este = $inspeccion->lindero_este;
        $lindero_oeste = $inspeccion->lindero_oeste;
        $superficie = $inspeccion->superficie;

        return view('inspeccion.edit' , compact('inspeccion', 'planificacion', 'municipios', 'comisionados', 'funcionario_acomp', 'lugar_direccion', 
        'observaciones','conclusiones', 'latitud', 'longitud', 'utm_norte', 'utm_este', 'res_fotos', 'fecha_inspeccion', 'estatus', 'estatus_resp',
        'longitud_terreno', 'ancho', 'profundidad', 'volumen', 'lindero_norte', 'lindero_sur', 'lindero_este', 'lindero_oeste', 'superficie'));
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

        // Buscar la inspección existente
        $inspeccion = Inspecciones::findOrFail($id);
        $inspeccion->id_planificacion = $request->input('id_planificacion');
        $inspeccion->funcionario_acomp = $request->input('funcionario_acomp');
        $inspeccion->lugar_direccion = $request->input('lugar_direccion');
        $inspeccion->observaciones = $request->input('observaciones');
        $inspeccion->conclusiones = $request->input('conclusiones');
        $inspeccion->latitud = $request->input('latitud');
        $inspeccion->longitud = $request->input('longitud');
        $inspeccion->utm_norte = $request->input('utm_norte');
        $inspeccion->utm_este = $request->input('utm_este');

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('res_fotos')) {
            $rutaGuardarImg = 'imagen/';
            $nombresImagenes = [];

            foreach ($request->file('res_fotos') as $foto) {
                $imagenInspeccion = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenInspeccion);
                $nombresImagenes[] = $imagenInspeccion;
            }

            // Actualizar las imágenes
            $inspeccion->res_fotos = json_encode($nombresImagenes);
        }

        $inspeccion->fecha_inspeccion = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('fecha_inspeccion'))->format('Y-m-d');
        $inspeccion->estatus = $request->input('estatus');
        $inspeccion->estatus_resp = $request->input('estatus_resp');

        if ($inspeccion->estatus == "Aprobado") {

            if ($inspeccion->estatus_resp = '') {
                $inspeccion->estatus_resp = 'Pendiente';
            }else{
                $inspeccion->estatus_resp = $request->input('estatus_resp');
            }
           
        } else {
            $inspeccion->estatus_resp = 'Negado';
        }


        $inspeccion->longitud_terreno = $request->input('longitud_terreno');
        $inspeccion->ancho = $request->input('ancho');
        $inspeccion->profundidad = $request->input('profundidad');
        $inspeccion->volumen = $request->input('volumen');
        $inspeccion->lindero_norte = $request->input('lindero_norte');
        $inspeccion->lindero_sur = $request->input('lindero_sur');
        $inspeccion->lindero_este = $request->input('lindero_este');
        $inspeccion->lindero_oeste = $request->input('lindero_oeste');
        $inspeccion->superficie = $request->input('superficie');

        $inspeccion->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect('comprobantepago');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
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
