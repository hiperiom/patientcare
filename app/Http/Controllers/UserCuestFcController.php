<?php

namespace App\Http\Controllers;

use App\Models\UserCuestFc;
use Illuminate\Http\Request;

class UserCuestFcController extends Controller
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
        return UserCuestFc::store($request);
    }
    public function store_cita(Request $request)
    {
        return UserCuestFc::store_cita($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestFc  $userCuestFc
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestFc::show($request->user_id,$request->episodio_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestFc  $userCuestFc
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestFc $userCuestFc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestFc  $userCuestFc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestFc $userCuestFc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestFc  $userCuestFc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestFc::eliminar($request);
    }
}
