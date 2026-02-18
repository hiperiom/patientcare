<?php

namespace App\Http\Controllers;

use App\Models\ExamenFisico;
use Illuminate\Http\Request;

class ExamenFisicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function getByCita($user_cita_id)
    {
        return ExamenFisico::where("user_cita_id",$user_cita_id)->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ExamenFisico::store($request);
    }
    public function store2(Request $request)
    {
        return ExamenFisico::store2($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamenFisico  $examenFisico
     * @return \Illuminate\Http\Response
     */
    public function show(ExamenFisico $examenFisico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamenFisico  $examenFisico
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamenFisico $examenFisico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExamenFisico  $examenFisico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamenFisico $examenFisico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamenFisico  $examenFisico
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamenFisico $examenFisico)
    {
        //
    }
}
