<?php

namespace App\Http\Controllers;

use App\Models\UserTalla;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserTallaController extends Controller
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
        UserTalla::where("user_id_paciente",$request->user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        $model = new UserTalla();
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_cuest_episodio_id = $request->episodio_id;
        $model->value = $request->value;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_medico = Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime( $request->created_at ) );
        $model->save();

        return $model;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTalla  $userTalla
     * @return \Illuminate\Http\Response
     */
    public function show(UserTalla $userTalla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTalla  $userTalla
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTalla $userTalla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTalla  $userTalla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTalla $userTalla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTalla  $userTalla
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTalla $userTalla)
    {
        //
    }
}
