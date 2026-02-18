<?php

namespace App\Http\Controllers;

use App\Models\UserEnfermeria;
use Illuminate\Http\Request;

class UserEnfermeriaController extends Controller
{
    public function app()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view('medico.indexNUEVODEPRECATED');
        //return view('enfermeria.app');
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEnfermeria  $userEnfermeria
     * @return \Illuminate\Http\Response
     */
    public function show(UserEnfermeria $userEnfermeria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEnfermeria  $userEnfermeria
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEnfermeria $userEnfermeria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEnfermeria  $userEnfermeria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEnfermeria $userEnfermeria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEnfermeria  $userEnfermeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEnfermeria $userEnfermeria)
    {
        //
    }
}
