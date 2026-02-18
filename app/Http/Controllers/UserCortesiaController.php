<?php

namespace App\Http\Controllers;

use App\Models\UserCortesia;
use Illuminate\Http\Request;

class UserCortesiaController extends Controller
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
        //dd($request->all());
        if ( $request->value == "null") {
            $model = UserCortesia::find($request->user_cortesia_id);
            $model->delete();
            return  $model;    
        }
        $model = UserCortesia::updateOrCreate([
            "user_id_paciente"=>$request->user_id_paciente,
            "user_cita_id"=>$request->user_cita_id
        ],
        [
            "user_id_paciente"=>$request->user_id_paciente,
            "user_cita_id"=>$request->user_cita_id,
            "value"=>$request->value
        ]);
        //dd($model->id);
        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCortesia  $userCortesia
     * @return \Illuminate\Http\Response
     */
    public function show(UserCortesia $userCortesia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCortesia  $userCortesia
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCortesia $userCortesia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCortesia  $userCortesia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCortesia $userCortesia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCortesia  $userCortesia
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCortesia $userCortesia)
    {
        //
    }
}
