<?php

namespace App\Http\Controllers;

use App\Models\UserEspecialidad;
use App\Models\UserMedicoAgenda;
use App\Models\CatEspecialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserEspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return UserEspecialidad::index($request);
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
    public function medicos($especialidad_id)
    {
        $model = new UserEspecialidad();

        $model = $model->join("user_type","user_especialidad.user_id","user_type.user_id");
        $model = $model->join("user_profile","user_especialidad.user_id","user_profile.user_id");
        $model = $model->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id");

        //$model = $model->whereIn("user_especialidad.cat_user_especialidad_id",[4,5,6,7,8,9,10,11,12,13,36,72,78]);
        $model = $model->where("user_type.cat_user_type_id",2);
        $model = $model->where("user_profile.prefijo","!=",'null');
        $model = $model->whereNotNull("user_profile.prefijo");
        $model = $model->whereNotNull("user_profile.nombres");
        $model = $model->whereNotNull("user_profile.apellidos");
        $model = $model->where("user_type.active",1);

        $model = $model->select(
            DB::raw("user_especialidad.cat_user_especialidad_id"),
            DB::raw("cat_user_especialidad.description AS especialidad"),
            DB::raw("user_profile.user_id"),
            DB::raw("user_profile.prefijo"),
            DB::raw("user_profile.imagen"),
            DB::raw("user_profile.nombres"),
            DB::raw("user_profile.apellidos"),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1),
                    ' ',
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1)
                ) AS description
            ")
        );
        $model = $model->orderBy("description");
        $model = $model->get()->toArray();

        return Response()->json($model);
    }
    public function anestesiologos($especialidad_id)
    {
        $model = new UserEspecialidad();
        $model = $model->whereIn("user_especialidad.cat_user_especialidad_id",[2]);
        $model = $model->where("user_type.cat_user_type_id",2);
        $model = $model->where("user_type.active",1);
        $model = $model->join("user_type","user_especialidad.user_id","user_type.user_id");
        $model = $model->join("user_profile","user_especialidad.user_id","user_profile.user_id");
        $model = $model->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id");
        $model = $model->select(
            DB::raw("user_especialidad.cat_user_especialidad_id"),
            DB::raw("cat_user_especialidad.description AS especialidad"),
            DB::raw("user_profile.user_id"),
            DB::raw("user_profile.prefijo"),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1),
                    ' ',
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1)
                ) AS description
            ")
        );
        $model = $model->orderBy("description");
        $model = $model->get()->toArray();

        return Response()->json($model);
    }
    public function personalAsistencial()
    {
        /*
            6 - Instrumentista
            7 - C Anestesia
            8 - C cirugia
        */
        $model = new UserEspecialidad();
        //$model = $model->whereIn("user_especialidad.cat_user_especialidad_id",[2]);
        $model = $model->where("user_type.cat_user_type_id",2);
        $model = $model->where("user_type.active",1);
        $model = $model->whereIn("user_equipo_salud.cat_user_equipo_salud_id",[6,7,8]);
        $model = $model->join("user_type","user_especialidad.user_id","user_type.user_id");
        $model = $model->join("user_profile","user_especialidad.user_id","user_profile.user_id");
        $model = $model->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id");
        $model = $model->join("user_equipo_salud","user_especialidad.user_id","user_equipo_salud.user_id");
        $model = $model->join("cat_user_equipo_salud","user_equipo_salud.cat_user_equipo_salud_id","cat_user_equipo_salud.id");

        $model = $model->select(
            DB::raw("user_especialidad.cat_user_especialidad_id"),
            DB::raw("cat_user_especialidad.description AS especialidad"),
            DB::raw("user_profile.user_id"),
            DB::raw("cat_user_equipo_salud.id AS equipo_salud_id"),
            DB::raw("cat_user_equipo_salud.description AS equipo_salud"),
            DB::raw("user_profile.prefijo"),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1),
                    ' ',
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1)
                ) AS description
            ")
        );
        $model = $model->orderBy("description");
        $model = $model->get()->toArray();

        return Response()->json($model);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UserEspecialidad::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Response()->json(UserEspecialidad::show($id));
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
        return Response()->json(UserEspecialidad::actualizar($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $model = UserEspecialidad::destroy($id);
        $model = UserEspecialidad::find($id);
        $user_id_medico = $model->user_id;
        $cat_especialidad_id = $model->cat_user_especialidad_id;
        $model->delete();
        $model =    UserMedicoAgenda::where("user_id_medico", $user_id_medico)
                    ->where("cat_especialidad_id", $cat_especialidad_id);
        $model->delete();
        return  Response()->json($model);
    }

    public function getAll()
    {

        return CatEspecialidad::where("cat_user_especialidad.active",1)
        ->where(
            DB::raw("
                (
                    SELECT
                        GROUP_CONCAT( centro_salud.description )
                    FROM centro_salud_especialidades
                    INNER JOIN centro_salud ON centro_salud_especialidades.centro_salud_id = centro_salud.id
                    WHERE centro_salud_especialidades.cat_especialidad_id = cat_user_especialidad.id
                    AND centro_salud_especialidades.active = 1
                )
            "),
            "!=",
            NULL
        )
        ->select(
                "cat_user_especialidad.*",
                "cat_user_especialidad.id AS cat_especialidad_id",
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.centro_salud_id )
                                FROM user_medico_agenda
                            WHERE user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_id
                    "),
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( centro_salud.description )
                            FROM user_medico_agenda
                            INNER JOIN centro_salud ON user_medico_agenda.centro_salud_id = centro_salud.id
                            WHERE user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_description
                    ")

            )
            ->get();
    }

    public function destroy2($cat_especialidad_id,$user_id)
    {
       // $model = UserEspecialidad::destroy($id);
        $model = UserEspecialidad::where("cat_user_especialidad_id",$cat_especialidad_id)->delete();

        $model = UserMedicoAgenda::where("user_id_medico", $user_id)->where("cat_especialidad_id", $cat_especialidad_id);
        $model->delete();
        return  Response()->json($model);
    }
}
