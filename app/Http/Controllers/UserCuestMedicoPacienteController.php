<?php

namespace App\Http\Controllers;

use App\Models\UserCuestMedicoPaciente;
use Illuminate\Http\Request;

class UserCuestMedicoPacienteController extends Controller
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
        return Response()->json(UserCuestMedicoPaciente::store($request));
    }

    public function fixed_medico_paciente(Request $request)
    {
        return Response()->json(UserCuestMedicoPaciente::fixed_medico_paciente($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestMedicoPaciente  $userCuestMedicoPaciente
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$tipo_medico)
    {
        return Response()->json(UserCuestMedicoPaciente::show($user_id,$tipo_medico));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestMedicoPaciente  $userCuestMedicoPaciente
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestMedicoPaciente $userCuestMedicoPaciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestMedicoPaciente  $userCuestMedicoPaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestMedicoPaciente $userCuestMedicoPaciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestMedicoPaciente  $userCuestMedicoPaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestMedicoPaciente::eliminar($request);
    }
    public function eliminarById(Request $request)
    {
        return UserCuestMedicoPaciente::eliminarById($request);
    }
}
