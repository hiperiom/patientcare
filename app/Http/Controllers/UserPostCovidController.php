<?php

namespace App\Http\Controllers;

use App\Models\UserPostCovid;
use Illuminate\Http\Request;

class UserPostCovidController extends Controller
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
    public function getAll()
    {
        return UserPostCovid::getAll();
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
        return UserPostCovid::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPostCovid  $UserPostCovid
     * @return \Illuminate\Http\Response
     */
    public function show(UserPostCovid $userPostCovid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPostCovid  $UserPostCovid
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPostCovid $UserPostCovid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPostCovid  $UserPostCovid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPostCovid $UserPostCovid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPostCovid  $UserPostCovid
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPostCovid $UserPostCovid)
    {
        //
    }
}
