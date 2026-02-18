<?php

namespace App\Http\Controllers;

use App\Models\PersonalAsistencial;
use Illuminate\Http\Request;
use App\Models\CatQuirofano;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PersonalAsistencialController extends Controller
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
    public function gelAll()
    {
        $model = CatQuirofano::where("active",1)->get()->toArray();
       /*  foreach ($model as $key => $value) {
            $pa = new PersonalAsistencial();
            $pa = $pa->where("personal_asistencial.active",1)->where("personal_asistencial.cat_quirofano_id",$value['id']);
            $pa = $pa->join("user_profile","personal_asistencial.user_id","user_profile.user_id");
            $pa = $pa->select(
                "personal_asistencial.*",
                DB::raw("user_profile.prefijo"),
                DB::raw("
                    CONCAT(
                        SUBSTRING_INDEX( user_profile.apellidos, ' ', 1),
                        ', ',
                        SUBSTRING_INDEX( user_profile.nombres, ' ', 1)
                    ) AS personal
                ")
            );
            $pa = $pa->get()->toArray();

            $model[$key]['personal_asistencial']= $pa; //PersonalAsistencial::where("active",1)->where("cat_quirofano_id",$value['id'])->get()->toArray();
        } */

        return Response()->json($model);
    }
    public function gelAllOtroPersonal()
    {
        $model = new PersonalAsistencial();
        $model = $model->where("personal_asistencial.active",1)->whereIn("personal_asistencial.tipo_personal",['preanestesia','recuperacion','obstetrico']);
        $model = $model->join("user_profile","personal_asistencial.user_id","user_profile.user_id");
        $model = $model->select(
            "personal_asistencial.*",
            DB::raw("user_profile.prefijo"),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1),
                    ', ',
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1)
                ) AS personal
            ")
        );
        $model = $model->get()->toArray();


        return Response()->json($model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $model = PersonalAsistencial::where("active",1)
        ->where("solicitud_quirofano_id",$request->solicitud_quirofano_id)
        ->where("tipo_personal",$request->tipo_personal)
        ->update([
            'active' => 0
        ]);


        $model = new PersonalAsistencial();
        $model->cat_quirofano_id = $request->cat_quirofano_id === "null"?NULL: $request->cat_quirofano_id;
        $model->user_id = $request->user_id;
        $model->solicitud_quirofano_id = $request->solicitud_quirofano_id;
        $model->tipo_personal = $request->tipo_personal;
        $model->user_id_medico = Auth::id();
        $model->save();

        $model = PersonalAsistencial::where('personal_asistencial.id',$model->id);
        $model = $model->join("user_profile AS up","personal_asistencial.user_id","up.user_id");
        $model = $model->join("user_profile AS up2","personal_asistencial.user_id_medico","up2.user_id");
        $model = $model->where("active",1);
        $model = $model->select(
            "personal_asistencial.*",
            DB::raw("CONCAT( SUBSTRING_INDEX(up.nombres , ' ', 1),' ',SUBSTRING_INDEX(up.apellidos , ' ', 1) ) AS personal"),
            DB::raw("CONCAT( SUBSTRING_INDEX(up2.nombres , ' ', 1),' ',SUBSTRING_INDEX(up2.apellidos , ' ', 1) ) AS registrado_por"),
        );
        $model = $model->first()->toArray();
        return $model;
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
     * @param  \App\Models\PersonalAsistencial  $personalAsistencial
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalAsistencial $personalAsistencial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalAsistencial  $personalAsistencial
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalAsistencial $personalAsistencial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalAsistencial  $personalAsistencial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $model = PersonalAsistencial::find($request->id);
        $model->update([$request->field => $request->value]);

        /* if ($request->field =="fecha_reservacion") {
            $model->update(["h_inicio" => $request->value]);
        } */
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalAsistencial  $personalAsistencial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //dd($request->all());
        if ($request->field =="active") {
            $user_id = PersonalAsistencial::where("id",$request->id)->value('user_id');
            $model = PersonalAsistencial::where("user_id",$user_id)
            ->update([
                'active' => 0
            ]);
        }



        $model = PersonalAsistencial::where("id",$request->id)
        ->update([
            $request->field => $request->value
        ]);

        /* if ($request->field =="fecha_reservacion") {
            $model->update(["h_inicio" => $request->value]);
        } */
        return Response()->json($model);
    }
}
