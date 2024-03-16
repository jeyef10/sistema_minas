<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Division;
use App\Models\DivisionSede;
use App\Models\Bitacora;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Pagination\LengthAwarePaginator;

class SedeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-sede|crear-sede|editar-sede|borrar-sede', ['only' => ['index']]);
         $this->middleware('permission:crear-sede', ['only' => ['create','store']]);
         $this->middleware('permission:editar-sede', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-sede', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::with('division')->get(); // Cargar la relación con "division"
        return view('sede.index', compact('sedes'));
    }

    public function pdf()
    {
          $sedes=Sede::all();
          $pdf=Pdf::loadView('sede.pdf', compact('sedes'));
          return $pdf->stream();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all(); // Obtener todos los registros de la tabla "division"
        return view('sede.create', compact('divisions')); // Pasar los divisions a la vista "form.blade.php"
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosSede = request()->except('_token');
        $sede = Sede::create($datosSede);
        $bitacora = new BitacoraController;
        $bitacora->update();
        // Obtener las divisiones seleccionadas
        $divisiones = $request->input('divisiones', []);
                
        // Guardar las relaciones en la tabla puente
        $sede->division()->sync($divisiones);
        return redirect ('sede');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sede=Sede::find($id);
        $divisions = Division::all(); // Obtener todos los registros de la tabla "division"

        return view('sede.edit',compact('sede','divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Actualiza los datos de la sede con los datos del formulario
            $sede = Sede::findOrFail($id);
            $sede->nombre_sede = $request->nombre_sede;
            $sede->save();
        
            // Actualiza las divisiones de la sede en la tabla puente
            $sede->division()->sync($request->input('division', []));
            $bitacora = new BitacoraController;
            $bitacora->update();
        
            return redirect('sede');  

        } catch (QueryException $exception) {
            $errorMessageEdit = 'Error: No se puede quitar la division a la sede ya que hay personas asociadas a esta division .';
            return redirect()->back()->withErrors($errorMessageEdit);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Obtener la sede a eliminar
            $sede = Sede::findOrFail($id);
        
            // Eliminar los registros relacionados en la tabla puente
            $sede->division()->detach();
        
            // Eliminar la sede
            $sede->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();

            return redirect('sede')->with('eliminar', 'ok');   
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la sede debido a que tiene divisiones asignadas.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
