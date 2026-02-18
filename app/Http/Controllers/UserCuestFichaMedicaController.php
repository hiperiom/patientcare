<?php

namespace App\Http\Controllers;

use App\Models\UserCuestFichaMedica;
use Illuminate\Http\Request;

class UserCuestFichaMedicaController extends Controller
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
        return UserCuestFichaMedica::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestGSanguineo  $userCuestGSanguineo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestGSanguineo  $userCuestGSanguineo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestGSanguineo  $userCuestGSanguineo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestGSanguineo  $userCuestGSanguineo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
    public function getLastFichaMedica(Request $request)
    {
        return UserCuestFichaMedica::getLastFichaMedica($request);
    }
}
