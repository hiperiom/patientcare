<?php

namespace App\Http\Controllers;

use App\Models\GrupoCentroSalud;
use Illuminate\Http\Request;

class GrupoCentroSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GrupoCentroSalud::index();
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
     * @param  \App\Models\GrupoCentroSalud  $GrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function show(GrupoCentroSalud $GrupoCentroSalud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoCentroSalud  $GrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoCentroSalud $GrupoCentroSalud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupoCentroSalud  $GrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoCentroSalud $GrupoCentroSalud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoCentroSalud  $GrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoCentroSalud $GrupoCentroSalud)
    {
        //
    }
}
