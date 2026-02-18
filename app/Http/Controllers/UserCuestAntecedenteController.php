<?php

namespace App\Http\Controllers;

use App\Models\UserCuestAntecedente;
use Illuminate\Http\Request;

class UserCuestAntecedenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        return UserCuestAntecedente::index($user_id);
    }
    public function getByPaciente($user_id_paciente)
    {
        return UserCuestAntecedente::where("user_id_paciente",$user_id_paciente )->get()->toArray();
    }
    public function index_episodio($user_id)
    {
        return UserCuestAntecedente::index_episodio($user_id);
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
        return UserCuestAntecedente::store3($request);
    }
    public function store2(Request $request)
    {
        return UserCuestAntecedente::store2($request);
    }
    public function store_ce(Request $request)
    {
        return UserCuestAntecedente::store_ce($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestAntecedente  $userCuestAntecedente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestAntecedente::show($request->user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestAntecedente  $userCuestAntecedente
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestAntecedente $userCuestAntecedente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestAntecedente  $userCuestAntecedente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestAntecedente $userCuestAntecedente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestAntecedente  $userCuestAntecedente
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestAntecedente $userCuestAntecedente)
    {
        //
    }
}
