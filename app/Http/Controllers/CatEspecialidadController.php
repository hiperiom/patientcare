<?php

namespace App\Http\Controllers;

use App\Models\CatEspecialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatEspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatEspecialidad::index();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($especialidad_id)
    {
        //return CatEspecialidad::show($especialidad_id);
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
    public function update(Request $request, $id)
    {
        //
    }
    public function index2()
    {
        return CatEspecialidad::index2();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function getAll(Request $request)
    // {
    //     return CatEspecialidad::where("deleted_at",null)->orderBy("description","ASC")->get();
    // }
    public function getAll()
    {
       /*  $model = [];
        $especialidades_activas = DB::select("
                    SELECT
                       user_medico_agenda.cat_especialidad_id
                    FROM user_medico_agenda
                    WHERE user_medico_agenda.active = 1
            ",[]);
        foreach ($especialidades_activas as $key => $value) {
            array_push($model,$value->cat_especialidad_id);
        }
        dd(array_unique($model)  ); */

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
}
