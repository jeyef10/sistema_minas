<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Sede;
// use App\Models\Division;
// use App\Models\Cargo;
// use App\Models\Marca;
// use App\Models\Modelo;
// use App\Models\Persona;
// use App\Models\TipoPeriferico;
// use App\Models\Perifericos;
// use App\Models\Sistema;
// use App\Models\Equipos;
// use App\Models\Asignar;

class homeController extends Controller
{
    //
    public function index(){

        return view('home.inicio');

    }

}