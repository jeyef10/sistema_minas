<?php

namespace App\Http\Controllers;

use App\Models\Nomina;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NominasImport;

class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nomina.index');
    }

    public function importar(Request $request)
    {
        $file = $request->file('documento');
        Excel::import(new NominasImport, $file);
        return redirect('usuarios')->with('success', 'Nómina Importada Correctamente.');
    }
}
