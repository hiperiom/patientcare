<?php

namespace App\Http\Controllers;

use App\Models\UserCuestCal;
use Illuminate\Http\Request;

class UserCuestCalController extends Controller
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
        UserCuestCal::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestCal  $userCuestCal
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestCal $userCuestCal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestCal  $userCuestCal
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestCal $userCuestCal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestCal  $userCuestCal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestCal $userCuestCal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestCal  $userCuestCal
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestCal $userCuestCal)
    {
        //
    }
}
