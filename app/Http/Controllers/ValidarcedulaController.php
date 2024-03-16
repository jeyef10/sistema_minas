<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Facades\DB;
use App\Models\Nomina;
use App\Models\User;
use Illuminate\Http\Request;

class ValidarcedulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.validacion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $datos = $request->input('cedula');

        if ($datos !="") {

            $nomina = DB::table('nominas')
            ->select('cedula', 'division')
            ->where('cedula', $datos)
            ->get();

            if ($nomina =="[]") {

            return redirect()->back()->with('message', "No Encontrado En la Base de Datos.");
                    
            }

                if ($nomina->first()->division != "Informatica") {

                    return redirect()->back()->with('message', "No Pertenece a La División de Informática.");

                } else {

                return redirect('/register')->with('validado', "Usted Ha Sido Validado Para Registrarse.");

                }

        } else {
            
            return redirect()->back()->with('message', "Ingrese Una Cedúla.");
            
        }
    }
}
