<?php

namespace App\Http\Controllers;

use App\Models\UserGuardias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserGuardiasController extends Controller
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
        $guardias = json_decode($request->guardias);
        $group_guardias_id=[];
        foreach ($guardias as $key => $value) {
            $model = UserGuardias::firstOrCreate(
                [
                    'fecha_inicio' => $value->fecha_inicio,
                    'fecha_fin' => $value->fecha_fin,
                    'turno_inicio' => $value->turno_inicio,
                    'turno_fin' => $value->turno_fin,
                    'h_inicio' => $value->h_inicio,
                    'h_fin' => $value->h_fin,
                    'turno_id' => $value->turno_id,
                    'user_id' => $value->user_id,
                    'dayWeek' => $value->dayWeek,
                    'dayMonth' => $value->dayMonth,
                    'monthYear' => $value->monthYear,
                    'year' => $value->year,
                    'dayName' => $value->dayName,
                    'comentarios' => $value->comentarios,
                    'cargo' => $value->cargo,
                ],
                [
                    'fecha_inicio' => $value->fecha_inicio,
                    'fecha_fin' => $value->fecha_fin,
                    'turno_inicio' => $value->turno_inicio,
                    'turno_fin' => $value->turno_fin,
                    'h_inicio' => $value->h_inicio,
                    'h_fin' => $value->h_fin,
                    'turno_id' => $value->turno_id,
                    'user_id' => $value->user_id,
                    'dayWeek' => $value->dayWeek,
                    'dayMonth' => $value->dayMonth,
                    'monthYear' => $value->monthYear,
                    'year' => $value->year,
                    'dayName' => $value->dayName,
                    'active' => $value->active,
                    'comentarios' => $value->comentarios,
                    'cargo' => $value->cargo,
                    'cumplido' => $value->cumplido
                ]
            );

            array_push($group_guardias_id, $model->id);
        }
        $model = new UserGuardias();
        $model = $model->whereIn("user_guardias.id",$group_guardias_id);
        $model = $model->join("user_profile","user_guardias.user_id","user_profile.user_id");
        $model = $model->select(
            "user_guardias.id",
            "user_guardias.fecha_inicio",
            "user_guardias.fecha_fin",
            "user_guardias.turno_inicio",
            "user_guardias.turno_fin",
            "user_guardias.h_inicio",
            "user_guardias.h_fin",
            "user_guardias.cargo",
            "user_guardias.turno_id",
            "user_guardias.user_id",
            "user_guardias.dayWeek",
            "user_guardias.dayMonth",
            "user_guardias.monthYear",
            "user_guardias.year",
            "user_guardias.dayName",
            "user_guardias.active",
            "user_guardias.comentarios",
            "user_guardias.cumplido",
            "user_profile.imagen",
            DB::raw("CONCAT(user_profile.nombres,' ',user_profile.apellidos) as personal"),
            "user_profile.extension_telefonica as asterisco",
            "user_profile.telefono_movil"
        );





        $model = $model->get()->toArray();
        return Response()->json($model);

    }
    public function updatefield(Request $request)
    {
            $model = UserGuardias::find($request->guardia_id);
            $model = $model->update([
                $request->field=>$request->value
            ]);
        return Response()->json($model);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGuardias  $userGuardias
     * @return \Illuminate\Http\Response
     */
    public function today_list()
    {
        $model = UserGuardias::whereYear("turno_inicio",date("Y"));
        $model = $model->join("user_profile","user_guardias.user_id","user_profile.user_id");
        $model = $model->whereMonth("turno_inicio",date("m"));
        $model = $model->whereDay("turno_inicio",date("d"));
        $model = $model->where("user_guardias.active",1);
        $model = $model->select(
            "user_guardias.id",
            "user_guardias.fecha_inicio",
            "user_guardias.fecha_fin",
            "user_guardias.turno_inicio",
            "user_guardias.turno_fin",
            "user_guardias.h_inicio",
            "user_guardias.h_fin",
            "user_guardias.cargo",
            "user_guardias.turno_id",
            "user_guardias.user_id",
            "user_guardias.dayWeek",
            "user_guardias.dayMonth",
            "user_guardias.monthYear",
            "user_guardias.year",
            "user_guardias.dayName",
            "user_guardias.active",
            "user_guardias.comentarios",
            "user_guardias.cumplido",
            "user_profile.imagen",
            DB::raw("CONCAT(user_profile.nombres,' ',user_profile.apellidos) as personal"),
            "user_profile.extension_telefonica as asterisco",
            "user_profile.telefono_movil"
        );
        $model = $model->get();
        return Response()->json($model);
    }
    public function show(Request $request)
    {
        $model = UserGuardias::whereYear("turno_inicio",$request->currentYear);
        $model = $model->join("user_profile","user_guardias.user_id","user_profile.user_id");
        $model = $model->whereMonth("turno_inicio",$request->currentMonth);
        $model = $model->select(
            "user_guardias.id",
            "user_guardias.fecha_inicio",
            "user_guardias.fecha_fin",
            "user_guardias.turno_inicio",
            "user_guardias.turno_fin",
            "user_guardias.h_inicio",
            "user_guardias.h_fin",
            "user_guardias.cargo",
            "user_guardias.turno_id",
            "user_guardias.user_id",
            "user_guardias.dayWeek",
            "user_guardias.dayMonth",
            "user_guardias.monthYear",
            "user_guardias.year",
            "user_guardias.dayName",
            "user_guardias.active",
            "user_guardias.comentarios",
            "user_guardias.cumplido",
            "user_profile.imagen",
            DB::raw("CONCAT(user_profile.nombres,' ',user_profile.apellidos) as personal"),
            "user_profile.extension_telefonica as asterisco",
            "user_profile.telefono_movil"
        );
        $model = $model->get();
        return Response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGuardias  $userGuardias
     * @return \Illuminate\Http\Response
     */
    public function edit(UserGuardias $userGuardias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserGuardias  $userGuardias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserGuardias $userGuardias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGuardias  $userGuardias
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserGuardias $userGuardias)
    {
        //
    }
}
