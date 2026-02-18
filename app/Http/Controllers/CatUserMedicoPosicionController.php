<?php

namespace App\Http\Controllers;

use App\Models\CatUserMedicoPosicion;
use Illuminate\Http\Request;

class CatUserMedicoPosicionController extends Controller
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
    public function getAll()
    {
        return CatUserMedicoPosicion::getAll();
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
     * @param  \App\Models\CatMedicoCargo  $catMedicoCargo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return UserMedicoCargo::show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CatMedicoCargo  $catMedicoCargo
     * @return \Illuminate\Http\Response
     */
    public function edit(CatMedicoCargo $catMedicoCargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CatMedicoCargo  $catMedicoCargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CatMedicoCargo $catMedicoCargo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CatMedicoCargo  $catMedicoCargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CatMedicoCargo $catMedicoCargo)
    {
        //
    }
}
