<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPeso;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserCuestPesoController extends Controller
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
        return UserCuestPeso::store($request);
    }
    public function store2(Request $request)
    {
        UserCuestPeso::where("user_id_paciente",$request->user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        $model = new UserCuestPeso();
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_cuest_episodio_id = $request->episodio_id;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->value = $request->value;
        $model->user_id_medico = Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime( $request->created_at ) );
        $model->save();

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCuestPeso  $userCuestPeso
     * @return \Illuminate\Http\Response
     */
    public function show(UserCuestPeso $userCuestPeso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCuestPeso  $userCuestPeso
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestPeso $userCuestPeso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCuestPeso  $userCuestPeso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestPeso $userCuestPeso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCuestPeso  $userCuestPeso
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCuestPeso $userCuestPeso)
    {
        //
    }
}
