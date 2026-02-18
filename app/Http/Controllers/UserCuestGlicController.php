<?php

namespace App\Http\Controllers;
use App\Models\UserCuestGlic;
use Illuminate\Http\Request;

class UserCuestGlicController extends Controller
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
        return UserCuestGlic::store($request);
    }
    public function store_cita(Request $request)
    {
        return UserCuestGlic::store_cita($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestGlic  $userCuestGlic
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestGlic::show($request->user_id,$request->episodio_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestGlic  $userCuestGlic
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestGlic $userCuestGlic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestGlic  $userCuestGlic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestGlic $userCuestGlic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestGlic  $userCuestGlic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestGlic::eliminar($request);
    }
}
