<?php

namespace App\Http\Controllers;

use App\Models\UserCondicionMedica;
use Illuminate\Http\Request;

class UserCondicionMedicaController extends Controller
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
    public function getByPaciente($user_id_paciente)
    {
        return UserCondicionMedica::where("user_id_paciente",$user_id_paciente )->get()->toArray();
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
        return UserCondicionMedica::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCondicionMedica  $userCondicionMedica
     * @return \Illuminate\Http\Response
     */
    public function show(UserCondicionMedica $userCondicionMedica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCondicionMedica  $userCondicionMedica
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCondicionMedica $userCondicionMedica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCondicionMedica  $userCondicionMedica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCondicionMedica $userCondicionMedica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCondicionMedica  $userCondicionMedica
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCondicionMedica $userCondicionMedica)
    {
        //
    }
}
