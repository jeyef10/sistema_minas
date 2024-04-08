<?php

namespace App\Http\Controllers;
use App\Models\Minerales;
use App\Models\Categoria;
use App\Models\MineralCategoria;
use App\Models\Bitacora;
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
        // $categoria = Categoria::find($id);
        /* $categoria = Categoria::with('mineral')->get()->find($id); // Cargar la relación con "Minerales"
        $minerales = Minerales::all(); // Obtener todos los registros de la tabla "mineral" */

        // $categoria = Categoria::with('mineral')->find($id);       
    
        // return view('categoria.edit', compact('categoria'));
        /* return view('categoria.edit', compact('categoria', 'minerales')); */

        $categoria = Categoria::with('mineral')->find($id); // Cargar la relación con "Minerales"
        $mineral = $categoria->mineral->first(); // Obtener el primer "Mineral" de la categoría
        $minerales = Minerales::all(); // Obtener todos los registros de la tabla "mineral" */

        return view('categoria.edit', compact('mineral', 'categoria', 'minerales'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
