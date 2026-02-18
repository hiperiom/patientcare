<?php

namespace App\Http\Controllers;

use App\Models\UserCuestMedicamento;
use Illuminate\Http\Request;

class UserCuestMedicamentoController extends Controller
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
        return UserCuestMedicamento::where("user_id_paciente",$user_id_paciente )->get()->toArray();
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
        return UserCuestMedicamento::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestMedicamento  $userCuestMedicamento
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestMedicamento $userCuestMedicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestMedicamento  $userCuestMedicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestMedicamento $userCuestMedicamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestMedicamento  $userCuestMedicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestMedicamento $userCuestMedicamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestMedicamento  $userCuestMedicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestMedicamento $userCuestMedicamento)
    {
        //
    }
}
