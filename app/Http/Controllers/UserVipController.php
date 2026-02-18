<?php

namespace App\Http\Controllers;

use App\Models\UserVip;
use Illuminate\Http\Request;

class UserVipController extends Controller
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
        return UserVip::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserVip  $userVip
     * @return \Illuminate\Http\Response
     */
    public function show(UserVip $userVip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserVip  $userVip
     * @return \Illuminate\Http\Response
     */
    public function edit(UserVip $userVip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserVip  $userVip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserVip $userVip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserVip  $userVip
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserVip $userVip)
    {
        //
    }
}
