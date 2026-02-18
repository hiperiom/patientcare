<?php

namespace App\Http\Controllers;

use App\Models\UserCuestTa;
use Illuminate\Http\Request;

class UserCuestTaController extends Controller
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
        return UserCuestTa::store($request);
    }
    public function store_cita(Request $request)
    {
        return UserCuestTa::store_cita($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestPA  $userCuestPA
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestTa::show($request->user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestPA  $userCuestPA
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $userCuestPA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestPA  $userCuestPA
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request $userCuestPA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestPA  $userCuestPA
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestTa::eliminar($request);
    }
}
