<?php

namespace App\Http\Controllers;

use App\Models\UserCuestAntg;
use Illuminate\Http\Request;

class UserCuestAntgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserCuestAntg::index($request);
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
        return UserCuestAntg::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestAntg  $UserCuestAntg
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestAntg::store($request->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestAntg  $UserCuestAntg
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestAntg $UserCuestAntg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestAntg  $UserCuestAntg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestAntg $UserCuestAntg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestAntg  $UserCuestAntg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestAntg::eliminar($request);
    }
}
