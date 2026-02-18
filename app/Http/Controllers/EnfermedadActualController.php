<?php

namespace App\Http\Controllers;

use App\Models\EnfermedadActual;
use Illuminate\Http\Request;

class EnfermedadActualController extends Controller
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
        return EnfermedadActual::store($request);
    }
    public function store2(Request $request)
    {
        return EnfermedadActual::store2($request);
    }
    public function getByCita($user_cita_id)
    {
        return EnfermedadActual::where("user_cita_id",$user_cita_id)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnfermedadActual  $enfermedadActual
     * @return \Illuminate\Http\Response
     */
    public function show(EnfermedadActual $enfermedadActual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnfermedadActual  $enfermedadActual
     * @return \Illuminate\Http\Response
     */
    public function edit(EnfermedadActual $enfermedadActual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnfermedadActual  $enfermedadActual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnfermedadActual $enfermedadActual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnfermedadActual  $enfermedadActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnfermedadActual $enfermedadActual)
    {
        //
    }
}
