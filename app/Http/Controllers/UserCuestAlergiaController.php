<?php

namespace App\Http\Controllers;

use App\UserCuestAlergia;
use App\Models\UserAlergia;
use Illuminate\Http\Request;

class UserCuestAlergiaController extends Controller
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
        return UserAlergia::where("user_id_paciente",$user_id_paciente )->get()->toArray();
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
        return UserAlergia::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestAlergia  $userCuestAlergia
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestAlergia $userCuestAlergia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestAlergia  $userCuestAlergia
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestAlergia $userCuestAlergia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestAlergia  $userCuestAlergia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestAlergia $userCuestAlergia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestAlergia  $userCuestAlergia
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestAlergia $userCuestAlergia)
    {
        //
    }
}
