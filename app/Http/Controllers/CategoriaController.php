<?php

namespace App\Http\Controllers;
use App\Models\Minerales;
use App\Models\Categoria;
use App\Models\MineralCategoria;
use App\Models\Bitacora;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::with('mineral')->get(); // Cargar la relación con "Minerales"
        // $categorias = Categoria::all();
        return view('categoria.index',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $minerales = Minerales::all(); // Obtener todos los registros de la tabla "mineral"
        return view('categoria.create', compact('minerales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosCategoria = request()->except('_token');
        $categoria = Categoria::create($datosCategoria);
        // $bitacora = new BitacoraController;
        // $bitacora->update();

        // Obtener los minerales seleccionadas
        // $minerales = $request->input('minerales', []);
        $minerales = $request->input('id_mineral');
                
        // Guardar las relaciones en la tabla puente
        $categoria->mineral()->sync($minerales);
        return redirect('categoria');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria, $id)
    {
        $categoria = Categoria::with('mineral')->find($id)->makeHidden(['created_at', 'updated_at']); // Cargar la relación con "Minerales"
        $mineral = $categoria->mineral->first()->makeHidden(['created_at', 'updated_at']); // Obtener el primer "Mineral" de la categoría
        $minerales = Minerales::all()->makeHidden(['created_at', 'updated_at']); // Obtener todos los registros de la tabla "mineral" */
        $id_mineral_seleccionado = $mineral->id; // Obtener el id del mineral seleccionado

        return view('categoria.edit', compact('mineral', 'categoria', 'minerales', 'id_mineral_seleccionado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Categoria $categoria, $id)
{
    // Validar los datos del formulario
    $request->validate([
        'tipo_categoria' => 'required',
        'id_mineral' => 'required',
    ]);

    // Buscar la categoría por ID
    $categoria = Categoria::find($id);

    // Actualizar los datos de la categoría
    $categoria->tipo_categoria = $request->tipo_categoria;

    // Guardar los cambios en la base de datos
    $categoria->save();

    // Actualizar la relación con el mineral
    $categoria->mineral()->sync([$request->id_mineral]);

    // Redirigir al usuario a la vista de edición con un mensaje de éxito
    return redirect('categoria')->with('success', 'Categoría Actualizada con Exito.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria, $id)
    {{
            // Buscar la categoría por ID
            $categoria = Categoria::find($id);
        
            // Verificar si la categoría existe
            if (!$categoria) {
                return redirect()->back()->with('error', 'Categoría no encontrada.');
            }
        
            // Eliminar la relación con el mineral
            $categoria->mineral()->detach();
        
            // Eliminar la categoría
            $categoria->delete();
        
            // Redirigir al usuario a la vista de lista con un mensaje de éxito
            return redirect('categoria')->with('eliminar', 'ok');
        }

        /* {
            try {
                Categoria::destroy($id);
                $bitacora = new BitacoraController;
                $bitacora->update();
                return redirect('categoria')->with('eliminar', 'ok');
            } catch (QueryException $exception) {
                $errorMessage = 'Error: No se puede eliminar la cetegoria debido a que este registro esta en una tabla puente.';
                return redirect()->back()->withErrors($errorMessage);
            } 
        } */
    }
}
