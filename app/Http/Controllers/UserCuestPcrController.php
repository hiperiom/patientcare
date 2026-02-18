<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPcr;
use Illuminate\Http\Request;

class UserCuestPcrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserCuestPcr::index($request);
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
        return UserCuestPcr::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestPcr  $userCuestPcr
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestPcr::store($request->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestPcr  $userCuestPcr
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestPcr $userCuestPcr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestPcr  $userCuestPcr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestPcr $userCuestPcr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestPcr  $userCuestPcr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestPcr::eliminar($request);
    }
}
