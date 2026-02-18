<?php

namespace App\Http\Controllers;

use App\Models\CatUserAntecedente;
use Illuminate\Http\Request;

class CatUserAntecedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatUserAntecedente::index();
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
     * @param  \App\CatUserAntecedente  $catUserAntecedente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return CatUserAntecedente::show($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CatUserAntecedente  $catUserAntecedente
     * @return \Illuminate\Http\Response
     */
    public function edit(CatUserAntecedente $catUserAntecedente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CatUserAntecedente  $catUserAntecedente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatUserAntecedente $catUserAntecedente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CatUserAntecedente  $catUserAntecedente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatUserAntecedente $catUserAntecedente)
    {
        //
    }
}
