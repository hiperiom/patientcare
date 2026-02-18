<?php

namespace App\Http\Controllers;

use App\Models\UserMedicoActivo;
use Illuminate\Http\Request;

class UserMedicoActivoController extends Controller
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
        //dd($request->all());
        UserMedicoActivo::where("user_id_medico",$request->user_id_paciente)
            ->update([
                "active"=>0,
                "updated_at"=>date('Y-m-d H:i:s', strtotime($request['created_at'])),
                "deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);
        $model = new UserMedicoActivo();
        $model->user_id_medico = $request->user_id_paciente;
        //$model->fecha_regreso = $request->fecha_regreso;
        $model->active = $request->active;
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMedicoActivo  $userMedicoActivo
     * @return \Illuminate\Http\Response
     */
    public function show(UserMedicoActivo $userMedicoActivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMedicoActivo  $userMedicoActivo
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMedicoActivo $userMedicoActivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMedicoActivo  $userMedicoActivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMedicoActivo $userMedicoActivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMedicoActivo  $userMedicoActivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMedicoActivo $userMedicoActivo)
    {
        //
    }
}
