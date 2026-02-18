<?php

namespace App\Http\Controllers;

use App\Models\UserCuestFr;
use Illuminate\Http\Request;

class UserCuestFrController extends Controller
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
       return  UserCuestFr::store($request);
    }
    public function store_cita(Request $request)
    {
       return  UserCuestFr::store_cita($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestFr  $userCuestFr
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestFr::show($request->user_id,$request->episodio_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestFr  $userCuestFr
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestFr $userCuestFr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestFr  $userCuestFr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestFr $userCuestFr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestFr  $userCuestFr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestFr::eliminar($request);
    }
}
