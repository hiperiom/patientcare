<?php

namespace App\Http\Controllers;

use App\Models\UserProfileImages;
use Illuminate\Http\Request;

class UserProfileImageController extends Controller
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


    public function getAll(Request $request)
    {
        return Response()->json( UserProfileImages::where("user_id_paciente",$request->user_id)->where("active",1)->get() );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfileImage  $userProfileImage
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfileImage $userProfileImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfileImage  $userProfileImage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfileImage $userProfileImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfileImage  $userProfileImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfileImage $userProfileImage)
    {
        //
    }
    public function update_item_file(Request $request,$type)
    {
        return UserProfileImages::update_item_file($request,$type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfileImage  $userProfileImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfileImage $userProfileImage)
    {
        //
    }
}
