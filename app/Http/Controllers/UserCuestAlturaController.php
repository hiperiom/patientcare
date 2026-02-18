<?php

namespace App\Http\Controllers;

use App\Models\UserCuestAltura;
use Illuminate\Http\Request;

class UserCuestAlturaController extends Controller
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
        return UserCuestAltura::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestAltura  $userCuestAltura
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestAltura $userCuestAltura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestAltura  $userCuestAltura
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestAltura $userCuestAltura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestAltura  $userCuestAltura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestAltura $userCuestAltura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestAltura  $userCuestAltura
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestAltura $userCuestAltura)
    {
        //
    }
}
