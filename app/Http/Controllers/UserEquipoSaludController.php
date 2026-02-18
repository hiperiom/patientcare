<?php

namespace App\Http\Controllers;

use App\Models\UserEquipoSalud;
use Illuminate\Http\Request;

class UserEquipoSaludController extends Controller
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
        return UserEquipoSalud::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEquipoSalud  $userEquipoSalud
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return Response()->json(UserEquipoSalud::show($user_id));
    }
    public function medicosByArea(Request $request)
    {
        return Response()->json(UserEquipoSalud::medicosByArea($request));
    }
    public function medicosByEspecialidad(Request $request)
    {
        return Response()->json(UserEquipoSalud::medicosByEspecialidad($request));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEquipoSalud  $userEquipoSalud
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEquipoSalud $userEquipoSalud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEquipoSalud  $userEquipoSalud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return UserEquipoSalud::actualizar($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEquipoSalud  $userEquipoSalud
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEquipoSalud $userEquipoSalud)
    {
        //
    }
}
