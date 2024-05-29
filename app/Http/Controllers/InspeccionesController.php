<?php

namespace App\Http\Controllers;

use App\Models\Inspecciones;
use App\Models\Solicitudes;
use App\Models\Municipio;
use App\Models\Comisionados;
use App\Models\SolicitudesRecaudos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitudes::with('solicitante', 'solicitudesrecaudos')->get();
        return view('inspeccion.index', compact('solicitudes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $solicitudes = Solicitudes::all();
        $solicitudesrecaudos = SolicitudesRecaudos::all();
        $municipios = Municipio::all();
        $comisionados = Comisionados::all();

        return view('inspeccion.create', compact('solicitudes', 'solicitudesrecaudos', 'municipios', 'comisionados'));
    }

    /* public function getParroquias($municipioId)
    {
        $parroquias = Parroquia::where('id_municipio', $municipioId)->pluck('nom_parroquia', 'id');
        return response()->json($parroquias);
    } */

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
        // Obtén los datos del formulario
        $solicitud = $request->input('id_solicitud');
        $municipio = $request->input('municipio');
        $comisionado = $request->input('comisionado');
        $acompañante = $request->input('acompañante');
        $lugar = $request->input('lugar');
        $observaciones = $request->input('observaciones');
        $conclusiones = $request->input('conclusiones');
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $direccion = $request->input('direccion');

        // Subir la imagen
        if ($request->hasFile('reseña')) {
            $imagen = $request->file('reseña'); // Obtiene el archivo de imagen del formulario
            $nombreArchivo = time() . '.' . $imagen->getClientOriginalExtension(); // Genera un nombre único para el archivo basado en la hora actual y la extensión original
            $ruta = $imagen->storeAs('images', $nombreArchivo); // Guarda la imagen en el directorio público 'images'
            //$ruta = storage_path('app/public/images/' . $nombreArchivo); // Define la ruta completa donde se guardará la imagen (en caso de usar storage_path)
        } else {
            $ruta = null; // Si no se subió una imagen, guarda null
        }

        // Guarda los datos en la base de datos
        Inspecciones::create([
            'id_solicitud' => $solicitud,
            'id_municipio' => $municipio,
            'id_comisionado' => $comisionado,
            'funcionario_acomp' => $acompañante,
            'lugar_direccion' => $lugar,
            'fecha_inspeccion' => $request->input('fecha'),
            'observaciones' => $observaciones,
            'conclusiones' => $conclusiones,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'direccion' => $direccion,
            'res_fotos' => $ruta, // Guarda la ruta pública de la imagen
            'estatus' => $request->input('estatus'),
        ]);

        // Redirige a la página deseada (por ejemplo, la vista de confirmación)
        return redirect()->back()->with('success', 'Datos guardados correctamente.');
    }


    public function guardar(Request $request)
    {
         /* // Validación de campos (puedes agregar más reglas según tus necesidades)
         $request->validate([
            'resena' => 'required',
            'fecha' => 'required|date',
            'estatus' => 'required|in:1,2,3', // Valores permitidos: 1, 2 o 3
            // Agrega más reglas de validación según tus campos
        ]); */

        // Obtén los datos del formulario
        $municipio = $request->input('municipio');
        $comisionado = $request->input('comisionado');
        $acompañante = $request->input('acompañante');
        $lugar = $request->input('lugar');
        $observaciones = $request->input('observaciones');
        $conclusiones = $request->input('conclusiones');
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $direccion = $request->input('direccion');

        // Subir la imagen
        if ($request->hasFile('reseña')) {
            $imagen = $request->file('reseña'); // Obtiene el archivo de imagen del formulario
            $nombreArchivo = time() . '.' . $imagen->getClientOriginalExtension(); // Genera un nombre único para el archivo basado en la hora actual y la extensión original
            $ruta = public_path('images/' . $nombreArchivo); // Define la ruta completa donde se guardará la imagen
            $imagen->move(public_path('images'), $nombreArchivo); // Mueve la imagen al directorio público
        }

        // Obtén los datos del formulario
        $reseña = $ruta ?? null; // Si se subió una imagen, guarda la ruta; de lo contrario, guarda null

        $fecha = $request->input('fecha');
        $estatus = $request->input('estatus');

        // Guarda los datos en la base de datos
        Inspecciones::create([
            'id_municipio' => $municipio,
            'id_comisionado' => $comisionado,
            'funcionario_acomp' => $acompañante,
            'lugar_direccion' => $lugar,
            'fecha_inspeccion' => $fecha,
            'observaciones' => $observaciones,
            'conclusiones' => $conclusiones,
            'latitud' => $latitud,
            'longitud' => $longitud,
            'direccion' => $direccion,
            'res_fotos' => $ruta,
            'estatus' => $estatus,
        ]);

        // Redirige a la página deseada (por ejemplo, la vista de confirmación)
        return redirect()->route('nombre.de.la.ruta')->with('success', 'Datos guardados correctamente.');
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
    public function edit(Inspecciones $inspecciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inspecciones  $inspecciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inspecciones $inspecciones)
    {
        //
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
