<?php

namespace App\Http\Controllers;

use App\Models\UserCuestValoracion;
use Illuminate\Http\Request;

class UserCuestValoracionController extends Controller
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
        return UserCuestValoracion::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestValoracion  $userCuestValoracion
     * @return \Illuminate\Http\Response
     */
    public function show($user_id,$type)
    {
        return Response()->json(UserCuestValoracion::show($user_id,$type));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestValoracion  $userCuestValoracion
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestValoracion $userCuestValoracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestValoracion  $userCuestValoracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestValoracion $userCuestValoracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestValoracion  $userCuestValoracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestValoracion $userCuestValoracion)
    {
        //
    }
}
