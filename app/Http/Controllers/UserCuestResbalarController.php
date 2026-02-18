<?php

namespace App\Http\Controllers;

use App\Models\UserCuestResbalar;
use Illuminate\Http\Request;

class UserCuestResbalarController extends Controller
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
        return UserCuestResbalar::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestResbalar  $userCuestResbalar
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestResbalar $userCuestResbalar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestResbalar  $userCuestResbalar
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestResbalar $userCuestResbalar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestResbalar  $userCuestResbalar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestResbalar $userCuestResbalar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestResbalar  $userCuestResbalar
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestResbalar $userCuestResbalar)
    {
        //
    }
}
