<?php

namespace App\Http\Controllers;

use App\Models\CatGrupoCentroSalud;
use Illuminate\Http\Request;

class CatGrupoCentroSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatGrupoCentroSalud::index();
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
     * @param  \App\Models\CatGrupoCentroSalud  $CatGrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function show(CatGrupoCentroSalud $CatGrupoCentroSalud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatGrupoCentroSalud  $CatGrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function edit(CatGrupoCentroSalud $CatGrupoCentroSalud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatGrupoCentroSalud  $CatGrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatGrupoCentroSalud $CatGrupoCentroSalud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatGrupoCentroSalud  $CatGrupoCentroSalud
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatGrupoCentroSalud $CatGrupoCentroSalud)
    {
        //
    }
}
