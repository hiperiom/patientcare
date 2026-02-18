<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPad;
use Illuminate\Http\Request;

class UserCuestPadController extends Controller
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
        return Response()->json(UserCuestPad::store($request));

    }
    public function updateDateIngreso(Request $request)
    {
        return UserCuestPad::updateDateIngreso($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        return UserCuestPad::show($user_id);
    }
    public function show2($pad_id)
    {
        return UserCuestPad::show2($pad_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return UserCuestPad::actualizar($request);
    }
    public function alta(Request $request)
    {
        return UserCuestPad::alta($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UserCuestPad::eliminar($id);
    }

}
