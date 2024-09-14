<?php

namespace App\Http\Controllers;

use App\Models\ControlRegalia;
use App\Models\PagoRegalia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;


class ControlRegaliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pago_regalias = PagoRegalia::all();

        return view('control_regalia.index', compact('pago_regalias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function show(ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function edit(ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ControlRegalia $controlRegalia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ControlRegalia  $controlRegalia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ControlRegalia $controlRegalia)
    {
        //
    }
}
