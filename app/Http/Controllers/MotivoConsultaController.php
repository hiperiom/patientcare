<?php

namespace App\Http\Controllers;

use App\Models\MotivoConsulta;
use Illuminate\Http\Request;

class MotivoConsultaController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return MotivoConsulta::store($request);
    }
    public function store2(Request $request)
    {
        return MotivoConsulta::store2($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MotivoConsulta  $motivoConsulta
     * @return \Illuminate\Http\Response
     */
    public function show(MotivoConsulta $motivoConsulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MotivoConsulta  $motivoConsulta
     * @return \Illuminate\Http\Response
     */
    public function edit(MotivoConsulta $motivoConsulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MotivoConsulta  $motivoConsulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MotivoConsulta $motivoConsulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotivoConsulta  $motivoConsulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoConsulta $motivoConsulta)
    {
        //
    }
}
