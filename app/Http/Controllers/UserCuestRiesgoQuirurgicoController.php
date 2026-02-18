<?php

namespace App\Http\Controllers;

use App\Models\UserCuestRiesgoQuirurgico;
use Illuminate\Http\Request;

class UserCuestRiesgoQuirurgicoController extends Controller
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
        return UserCuestRiesgoQuirurgico::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestRiesgoQuirurgico  $userCuestRiesgoQuirurgico
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestRiesgoQuirurgico $userCuestRiesgoQuirurgico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestRiesgoQuirurgico  $userCuestRiesgoQuirurgico
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestRiesgoQuirurgico $userCuestRiesgoQuirurgico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestRiesgoQuirurgico  $userCuestRiesgoQuirurgico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestRiesgoQuirurgico $userCuestRiesgoQuirurgico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestRiesgoQuirurgico  $userCuestRiesgoQuirurgico
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestRiesgoQuirurgico $userCuestRiesgoQuirurgico)
    {
        //
    }
}
