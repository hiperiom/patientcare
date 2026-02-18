<?php

namespace App\Http\Controllers;

use App\Models\SolicitudQuirofanoMedicos;
use Illuminate\Http\Request;

class SolicitudQuirofanoMedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("area_quirurgica.cupo.index");
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
     * @param  \App\Models\IntQuirurgicaMedicos  $intQuirurgicaMedicos
     * @return \Illuminate\Http\Response
     */
    public function show(SolicitudQuirofano $intQuirurgicaMedicos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntQuirurgicaMedicos  $intQuirurgicaMedicos
     * @return \Illuminate\Http\Response
     */
    public function edit(SolicitudQuirofano $intQuirurgicaMedicos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IntQuirurgicaMedicos  $intQuirurgicaMedicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IntQuirurgicaMedicos $intQuirurgicaMedicos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntQuirurgicaMedicos  $intQuirurgicaMedicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(SolicitudQuirofano $intQuirurgicaMedicos)
    {
        //
    }
}
