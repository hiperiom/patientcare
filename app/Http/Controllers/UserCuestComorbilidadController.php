<?php

namespace App\Http\Controllers;

use App\Models\UserCuestComorbilidad;
use Illuminate\Http\Request;

class UserCuestComorbilidadController extends Controller
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
        return view("medico.comorbilidad");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserCuestComorbilidad::store($request);
    }
    public function store2(Request $request)
    {
        return UserCuestComorbilidad::store2($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestComorbilidad  $userCuestComorbilidad
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return UserCuestComorbilidad::show($user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestComorbilidad  $userCuestComorbilidad
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestComorbilidad $userCuestComorbilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestComorbilidad  $userCuestComorbilidad
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, UserCuestComorbilidad $userCuestComorbilidad)
    {
        return UserCuestComorbilidad::actualizar2($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestComorbilidad  $userCuestComorbilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UserCuestComorbilidad::eliminar($id);
    }
}
