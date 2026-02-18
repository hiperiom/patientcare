<?php

namespace App\Http\Controllers;

use App\Models\UserCuestPendiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestPendienteController extends Controller
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
        return UserCuestPendiente::store($request);
    }
    public function store2(Request $request)
    {
        return UserCuestPendiente::store2($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCuestPendiente  $userCuestPendiente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return UserCuestPendiente::show($request->user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCuestPendiente  $userCuestPendiente
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCuestPendiente $userCuestPendiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCuestPendiente  $userCuestPendiente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCuestPendiente $userCuestPendiente)
    {
        return UserCuestPendiente::actualizar($request);
    }
    public function update2(Request $request)
    {
        return UserCuestPendiente::actualizar2($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCuestPendiente  $userCuestPendiente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return UserCuestPendiente::eliminar($request);
    }
    public function temporal()
    {
        # BORRAR DESPUES DE USAR 06-09-2021


        $model = DB::select("
            SELECT
                user.id as user_id,
                user_cuest_episodio.id as episodio_id,
                user_cuest_episodio.ingreso as ingreso
            FROM user
            JOIN user_profile ON user.id = user_profile.user_id
            JOIN user_cuest_episodio ON user.id = user_cuest_episodio.user_id
            JOIN user_type ON user_profile.user_id = user_type.user_id
            JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE user_profile.nombres IS NOT NULL
            AND user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)
            AND user_profile.apellidos IS NOT NULL
            AND user_profile.fnacimiento IS NOT NULL
            AND user_profile.genero IS NOT NULL
            AND user_cuest_ubicacion.active = 1
            AND user_cuest_episodio.active = 1
        ", [1]);

        foreach ($model as $key => $value) {
            DB::table('user_cuest_pendiente')
            ->where('user_id',$value->user_id)
            ->where('created_at','>=',$value->ingreso)
           ->update([
               'user_cuest_episodio_id'=>$value->episodio_id
           ]);
        }
    }
}
