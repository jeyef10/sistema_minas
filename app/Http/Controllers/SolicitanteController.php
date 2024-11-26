<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use App\Models\PersonaNatural;
use App\Models\PersonaJuridica;
use App\Models\Recepcion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class SolicitanteController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-solicitante|crear-solicitante|editar-solicitante|borrar-solicitante', ['only' => ['index']]);
         $this->middleware('permission:crear-solicitante', ['only' => ['create','store']]);
         $this->middleware('permission:editar-solicitante', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-solicitante', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
        return view('solicitante.index', compact('solicitantes'));
    }

   
    
    public function pdf(Request $request)
    {
        $search = $request->input('search');
    
        $solicitantes = Solicitante::leftJoin('personas_naturales', function ($join) {
                    $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_naturales.id')
                        ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaNatural');
                })
                ->leftJoin('personas_juridicas', function ($join) {
                    $join->on('solicitantes.solicitante_especifico_id', '=', 'personas_juridicas.id')
                        ->where('solicitantes.solicitante_especifico_type', '=', 'App\\Models\\PersonaJuridica');
                })
                ->select('solicitantes.*', 'personas_naturales.cedula', 'personas_naturales.nombre as nombre_natural', 'personas_naturales.apellido', 'personas_juridicas.rif', 'personas_juridicas.nombre as nombre_juridico', 'personas_juridicas.correo');
    
        if ($search) {
            // Filtrar los solicitantes según la consulta de búsqueda
            $solicitantes = $solicitantes->where(function($query) use ($search) {
                $query->where('personas_naturales.nombre', 'LIKE', '%' . $search . '%')
                      ->orWhere('personas_naturales.apellido', 'LIKE', '%' . $search . '%')
                      ->orWhere('personas_naturales.cedula', 'LIKE', '%' . $search . '%')
                      ->orWhere('personas_juridicas.nombre', 'LIKE', '%' . $search . '%')
                      ->orWhere('personas_juridicas.rif', 'LIKE', '%' . $search . '%');
                      
            });
        }
    
        $solicitantes = $solicitantes->get();
    
        // Generar el PDF, incluso si no se encuentran solicitantes
        $pdf = Pdf::loadView('solicitante.pdf', compact('solicitantes'));
        return $pdf->stream('solicitante.pdf');
    }
    












// public function pdf(Request $request)
// {
//     $search = $request->input('search');

//     if ($search) {
//         // Filtrar los solicitantes según la consulta de búsqueda
//         $solicitantes = Solicitante::whereHas('solicitanteEspecifico', function($query) use ($search) {
//             $query->where('nombre', 'LIKE', '%' . $search . '%')
//                   ->orWhere('apellido', 'LIKE', '%' . $search . '%')
//                   ->orWhere('cedula', 'LIKE', '%' . $search . '%')
//                   ->orWhere('rif', 'LIKE', '%' . $search . '%')
//                   ->orWhere('correo', 'LIKE', '%' . $search . '%');
//         })->get();
//     } else {
//         // Obtener todos los solicitantes si no hay término de búsqueda
//         $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
//     }

//     // Generar el PDF, incluso si no se encuentran solicitantes
//     $pdf = Pdf::loadView('solicitante.pdf', compact('solicitantes'));
//     return $pdf->stream('solicitante.pdf');
// }




    // public function pdf(Request $request)
    // {
    //     $search = $request->input('search');
    
    //     if ($search) {
    //         // Filtrar los solicitantes según la consulta de búsqueda
    //         $solicitantes = Solicitante::whereHas('solicitanteEspecifico', function($query) use ($search) {
    //             $query->where('nombre', 'LIKE', '%' . $search . '%')
    //                   ->orWhere('apellido', 'LIKE', '%' . $search . '%')
    //                   ->orWhere('cedula', 'LIKE', '%' . $search . '%')
    //                   ->orWhere('rif', 'LIKE', '%' . $search . '%');
    //         })->get();
    //     } else {
    //         // Obtener todos los solicitantes si no hay término de búsqueda
    //         $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
    //     }
    
    //     // Generar el PDF, incluso si no se encuentran solicitantes
    //     $pdf = Pdf::loadView('solicitante.pdf', compact('solicitantes'));
    //     return $pdf->stream('solicitante.pdf');
    // }
    

    // public function pdf(Request $request)
    // {

    //     $search = $request->input('search');

    //     if ($search) {
    //         // Filtrar los métodos de pago según la consulta de búsqueda
    //         $solicitantes = Solicitante::where('solicitante_especifico_id', 'LIKE', '%' . $search . '%')->get();
    //     } else {
    //         // Obtener todos los métodos de pago si no hay término de búsqueda
    //         $solicitantes = Solicitante::with('solicitanteEspecifico')->get();
    //     } 
    //     $pdf=Pdf::loadView('solicitante.pdf', compact('solicitantes'));
    //     return $pdf->stream();
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('solicitante.create');
        return view('solicitante.create', ['previous_url' => url()->previous()]); // Al cargar esta vista se le envia la url anterior a la vista solicitante/create.blade.php.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $request->validate(
            [
            'cedula' => 'unique:personas_naturales,cedula',
            'rif' => 'unique:personas_juridicas,rif',
            ],
            [
            'cedula.unique' => 'Está cedula ya existe en la base de datos.',
            'rif.unique' => 'Este rif ya existe en la base de datos.'
            ]
        );

        // Crea un nuevo objeto Solicitante
        $solicitante = new Solicitante;

        // Asigna los valores del formulario de solicitud a las propiedades del objeto Solicitante
        $solicitante->tipo = $request->tipo;

        // Guarda el objeto Solicitante en la base de datos
        $solicitante->save();
         

        // Verifica si el tipo de solicitante es 'Natural'
        if ($request->tipo == 'Natural') {

            // Crea un nuevo objeto PersonaNatural
            $personaNatural = new PersonaNatural;

            // Asigna el ID del objeto Solicitante al solicitante_id del objeto PersonaNatural
            $personaNatural->solicitante_id = $solicitante->id; 
            $personaNatural->id = $solicitante->id;
            // Asigna los valores del formulario de solicitud a las propiedades del objeto PersonaNatural
            $personaNatural->cedula = $request->cedula;
            $personaNatural->nombre = $request->nombre;
            $personaNatural->apellido = $request->apellido;

            // Guarda el objeto PersonaNatural en la base de datos
            $personaNatural->save();

            // Asocia el objeto PersonaNatural con el objeto Solicitante
            $solicitante->solicitanteEspecifico()->associate($personaNatural);

            // Guarda el objeto Solicitante en la base de datos
            $solicitante->save();

            $bitacora = new BitacoraController;
            $bitacora->update();

            
        } 
        // Verifica si el tipo de solicitante es 'Jurídico'
        else if ($request->tipo == 'Jurídico') {

            // Crea un nuevo objeto PersonaJuridica
            $personaJuridica = new PersonaJuridica;

            // Asigna el ID del objeto Solicitante al solicitante_id del objeto PersonaJuridica
            $personaJuridica->solicitante_id = $solicitante->id; 

            // Asigna los valores del formulario de solicitud a las propiedades del objeto PersonaJuridica
            $personaJuridica->rif = $request->rif;
            $personaJuridica->nombre = $request->nombre;
            $personaJuridica->correo = $request->correo;

            // Guarda el objeto PersonaJuridica en la base de datos
            $personaJuridica->save();

            // Asocia el objeto PersonaJuridica con el objeto Solicitante
            $solicitante->solicitanteEspecifico()->associate($personaJuridica);
            
            // Guarda el objeto Solicitante en la base de datos
            $solicitante->save();

            $bitacora = new BitacoraController;
            $bitacora->update();

        }
        
        try {
        
            return redirect($request->input('previous_url'));
    
            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }

         // Aqui redirije a la pagina en la que estabamos anteriormente.

        // Redirige al usuario a la página de solicitantes
        /* return redirect('solicitante'); */
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitante $solicitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitante = Solicitante::with('solicitanteEspecifico')->find($id);

        return view('solicitante.edit',compact('solicitante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Busca el Solicitante con el ID proporcionado en la base de datos
        $solicitante = Solicitante::with('solicitanteEspecifico')->find($id);

        // Actualiza las propiedades del Solicitante con los valores del formulario de solicitud
        $solicitante->tipo = $request->tipo;

        // Guarda el Solicitante en la base de datos
        $solicitante->save();
        

        // Verifica si solicitanteEspecifico es una PersonaNatural
        if ($solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural) {

            // Actualiza las propiedades de la PersonaNatural con los valores del formulario de solicitud
            $solicitante->solicitanteEspecifico->cedula = $request->cedula;
            $solicitante->solicitanteEspecifico->nombre = $request->nombre;
            $solicitante->solicitanteEspecifico->apellido = $request->apellido;

            // Guarda la PersonaNatural en la base de datos
            $solicitante->solicitanteEspecifico->save();
            $bitacora = new BitacoraController;
            $bitacora->update();
        } 
        // Verifica si solicitanteEspecifico es una PersonaJuridica
        elseif ($solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica) {

            // Actualiza las propiedades de la PersonaJuridica con los valores del formulario de solicitud
            $solicitante->solicitanteEspecifico->rif = $request->rif;
            $solicitante->solicitanteEspecifico->nombre = $request->nombre;
            $solicitante->solicitanteEspecifico->correo = $request->correo;

            // Guarda la PersonaJuridica en la base de datos
            $solicitante->solicitanteEspecifico->save();

            $bitacora = new BitacoraController;
            $bitacora->update();
        }

        try {
        
        return redirect('solicitante');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la persona debido a que tiene un equipo y perifericos asignados.';
            return redirect()->back()->withErrors($errorMessage);
        }

        
        // Redirige al usuario a la página de solicitantes
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Busca el Solicitante con el ID proporcionado en la base de datos
            $solicitante = Solicitante::find($id);

            if ($solicitante) {
                // Verifica si hay alguna recepción de recaudos asociada al Solicitante
                $recepciones = Recepcion::where('id_solicitante', $id)->count();

                if ($recepciones === 0) {
                    // Si no hay recepciones de recaudos, elimina el Solicitante
                    if ($solicitante->solicitanteEspecifico !== null) {
                        $solicitante->solicitanteEspecifico->delete();
                    }
                    $solicitante->delete();
                    $bitacora = new BitacoraController;
                    $bitacora->update();
                    return redirect('solicitante')->with('eliminar', 'ok');
                } else {
                    // Si hay recepciones de recaudos, muestra un mensaje de advertencia
                    $errorMessage = 'Advertencia: El solicitante está asociado a una recepción de recaudos. No se puede eliminar.';
                    return redirect()->back()->withErrors($errorMessage);
                }
            } else {
                // El Solicitante no existe, muestra un mensaje de error
                $errorMessage = 'Error: No se encontró el solicitante con el ID proporcionado.';
                return redirect()->back()->withErrors($errorMessage);
            }
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el solicitante debido a que tiene otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
