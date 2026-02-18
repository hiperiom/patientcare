<?php

namespace App\Http\Controllers;

use App\Models\UserCuestEpisodio;
use App\Models\UserCuestHistoriaMedica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestHistoriaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserCuestHistoriaMedica::index($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return UserCuestHistoriaMedica::create($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserCuestHistoriaMedica::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestHistoriaMedica  $userCuestHistoriaMedica
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestHistoriaMedica::show($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestHistoriaMedica  $userCuestHistoriaMedica
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestHistoriaMedica $userCuestHistoriaMedica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestHistoriaMedica  $userCuestHistoriaMedica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestHistoriaMedica $userCuestHistoriaMedica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestHistoriaMedica  $userCuestHistoriaMedica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestHistoriaMedica::eliminar($request);
    }
    public function getHistorial(Request $request)
    {
        return UserCuestHistoriaMedica::getHistorial($request->user_id);
    }

}
