<?php

namespace App\Http\Controllers;

use App\Models\UserTrasladoAmbulancia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserTrasladoAmbulanciaController extends Controller
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
        $model = new UserTrasladoAmbulancia();
        $model->fecha_traslado = $request->fecha_traslado ." ".$request->hora_traslado;
        $model->origen_traslado = $request->origen_traslado;
        $model->destino_traslado = $request->destino_traslado;
        $model->observacion = $request->observacion;
        $model->user_cuest_episodio_id = $request->user_cuest_episodio_id;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_registro = Auth::id();
        $model->save();
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTrasladoAmbulancia  $userTrasladoAmbulancia
     * @return \Illuminate\Http\Response
     */
    public function show($user_id_paciente)
    {
        return UserTrasladoAmbulancia::where("user_id_paciente",$user_id_paciente)->orderBy("created_at","DESC")->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTrasladoAmbulancia  $userTrasladoAmbulancia
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTrasladoAmbulancia $userTrasladoAmbulancia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTrasladoAmbulancia  $userTrasladoAmbulancia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTrasladoAmbulancia $userTrasladoAmbulancia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTrasladoAmbulancia  $userTrasladoAmbulancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTrasladoAmbulancia $userTrasladoAmbulancia)
    {
        //
    }
}
