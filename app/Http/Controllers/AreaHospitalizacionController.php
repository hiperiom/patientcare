<?php

namespace App\Http\Controllers;

use App\AreaHospitalizacion;
use Illuminate\Http\Request;

class AreaHospitalizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_hospitalizacion.app");
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
     * @param  \App\AreaHospitalizacion  $areaHospitalizacion
     * @return \Illuminate\Http\Response
     */
    public function show(AreaHospitalizacion $areaHospitalizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AreaHospitalizacion  $areaHospitalizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaHospitalizacion $areaHospitalizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AreaHospitalizacion  $areaHospitalizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaHospitalizacion $areaHospitalizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AreaHospitalizacion  $areaHospitalizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaHospitalizacion $areaHospitalizacion)
    {
        //
    }
}
