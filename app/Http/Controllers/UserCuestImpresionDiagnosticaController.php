<?php

namespace App\Http\Controllers;

use App\Models\UserCuestImpresionDiagnostica;
use Illuminate\Http\Request;

class UserCuestImpresionDiagnosticaController extends Controller
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
        return UserCuestImpresionDiagnostica::store($request);
    }
    public function getByCita($user_cita_id)
    {
        return UserCuestImpresionDiagnostica::where("user_cita_id",$user_cita_id)->first();
    }
    public function store2(Request $request)
    {
        return UserCuestImpresionDiagnostica::store2($request);
    }
    public function store3(Request $request)
    {
        return UserCuestImpresionDiagnostica::store3($request);
    }
    public function store4(Request $request)
    {
        return UserCuestImpresionDiagnostica::store4($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Response()->json(UserCuestImpresionDiagnostica::show($id));
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
        return UserCuestImpresionDiagnostica::actualizar($request);
    }
    public function update2(Request $request)
    {
        return UserCuestImpresionDiagnostica::actualizar2($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UserCuestImpresionDiagnostica::eliminar($id);
    }
}
