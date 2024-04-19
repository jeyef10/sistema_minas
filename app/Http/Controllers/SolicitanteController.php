<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use App\Models\PersonaNatural;
use App\Models\PersonaJuridica;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        // Crea un nuevo objeto Solicitante
        $solicitante = new Solicitante;

        // Asigna los valores del formulario de solicitud a las propiedades del objeto Solicitante
        $solicitante->tipo = $request->tipo;
        $solicitante->num_minero = $request->num_minero;

        // Guarda el objeto Solicitante en la base de datos
        $solicitante->save(); 

        // Verifica si el tipo de solicitante es 'Natural'
        if ($request->tipo == 'Natural') {

            // Crea un nuevo objeto PersonaNatural
            $personaNatural = new PersonaNatural;

            // Asigna el ID del objeto Solicitante al solicitante_id del objeto PersonaNatural
            $personaNatural->solicitante_id = $solicitante->id; 

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
        }

        return redirect($request->input('previous_url')); // Aqui redirije a la pagina en la que estabamos anteriormente.

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
        $solicitante->num_minero = $request->num_minero;

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
        } 
        // Verifica si solicitanteEspecifico es una PersonaJuridica
        elseif ($solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica) {

            // Actualiza las propiedades de la PersonaJuridica con los valores del formulario de solicitud
            $solicitante->solicitanteEspecifico->rif = $request->rif;
            $solicitante->solicitanteEspecifico->nombre = $request->nombre;
            $solicitante->solicitanteEspecifico->correo = $request->correo;

            // Guarda la PersonaJuridica en la base de datos
            $solicitante->solicitanteEspecifico->save();
        }

        // Redirige al usuario a la página de solicitantes
        return redirect('solicitante');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Busca el Solicitante con el ID proporcionado en la base de datos
        $solicitante = Solicitante::with('solicitanteEspecifico')->find($id);

        // Si el Solicitante tiene un solicitanteEspecifico asociado (Persona Natural o Jurídica), lo elimina
        if ($solicitante->solicitanteEspecifico !== null) {
            $solicitante->solicitanteEspecifico->delete();
        }

        // Elimina el Solicitante de la base de datos
        $solicitante->delete();

        // Redirige al usuario a la página de solicitantes
        return redirect('solicitante')->with('eliminar', 'ok');

        // $bitacora = new BitacoraController;
        // $bitacora->update();

    }
}
