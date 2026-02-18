<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPdr;
use Illuminate\Http\Request;

class UserCuestPdrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserCuestPdr::index($request);
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
        return UserCuestPdr::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestPdr  $UserCuestPdr
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestPdr::store($request->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestPdr  $UserCuestPdr
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestPdr $UserCuestPdr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestPdr  $UserCuestPdr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestPdr $UserCuestPdr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestPdr  $UserCuestPdr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestPdr::eliminar($request);
    }
}
