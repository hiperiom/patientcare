<?php

namespace App\Http\Controllers;
use App\Models\CentroSalud;
use App\Models\UserMedicoAgenda;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CentroSaludController extends Controller
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
    public function getAll()
    {
        return CentroSalud::where("centro_salud.active",1)
            //->join("centro_salud_especialidades","centro_salud.id","centro_salud_especialidades.centro_salud_id")
            ->select(
                "centro_salud.*",
                "centro_salud.id AS centro_salud_id",
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( cat_user_especialidad.id )
                            FROM centro_salud_especialidades
                            INNER JOIN cat_user_especialidad ON centro_salud_especialidades.cat_especialidad_id = cat_user_especialidad.id
                            WHERE centro_salud_especialidades.centro_salud_id = centro_salud.id
                            AND centro_salud_especialidades.active = 1
                        ) AS centro_salud_especialidades_id
                    "),
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( cat_user_especialidad.id )
                            FROM user_medico_agenda
                            INNER JOIN cat_user_especialidad ON user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            WHERE user_medico_agenda.centro_salud_id = centro_salud.id
                            AND user_medico_agenda.active = 1
                        ) AS especialidades_id
                    "),
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( cat_user_especialidad.description )
                            FROM user_medico_agenda
                            INNER JOIN cat_user_especialidad ON user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            WHERE user_medico_agenda.centro_salud_id = centro_salud.id
                            AND user_medico_agenda.active = 1
                        ) AS especialidades_description
                    "),
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( DISTINCT user_medico_agenda.user_id_medico )
                                FROM user_medico_agenda
                            WHERE user_medico_agenda.centro_salud_id = centro_salud.id
                            AND user_medico_agenda.active = 1
                        ) AS medicos_id
                    "),
                DB::raw("
                        (
                            SELECT
                                CONCAT( user_profile.nombres,' ',user_profile.apellidos )
                                FROM user_profile
                            WHERE user_profile.user_id = centro_salud.user_id_gerente
                        ) AS gerente_nombre
                    "),
                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT(
                                CONCAT(
                                    (
                                        CASE
                                            WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN CONCAT(user_profile.prefijo,' ')
                                        ELSE ''
                                        END
                                    ),
                                    user_profile.nombres,
                                    ' ',
                                    user_profile.apellidos
                                )
                            )
                        FROM user_medico_agenda
                        INNER JOIN user_profile ON user_medico_agenda.user_id_medico = user_profile.user_id
                        WHERE user_medico_agenda.centro_salud_id = centro_salud.id
                        AND user_medico_agenda.active = 1
                    ) AS medicos_description
                ")
            )
            ->get();
    }
    public function especialidadByCentroSalud($cat_especialidad_id)
    {
     
        $model = new UserMedicoAgenda();
        $model = $model->join("centro_salud","user_medico_agenda.centro_salud_id","centro_salud.id");
        $model = $model->where("user_medico_agenda.cat_especialidad_id", $cat_especialidad_id);
        $model = $model->where("user_medico_agenda.active",1);

        $model =    $model->select(
                        "centro_salud.id",
                        "centro_salud.description"
                    );
        //$model = $model->groupBy("centro_salud.description");
        //$model = $model->orderBy("centro_salud.description", "ASC");
        $model = $model->get()->toArray();

        $id = [];
        $response = [];
        foreach($model as $value){
           
            if ( !in_array($value['id'],$id)) {
                array_push($response,$value);
                array_push($id, $value['id']);
            }
        }
        return Response()->json( $response );
    }
    public function medicosByCentroSalud($cat_especialidad_id,$centro_salud_id)
    {
     
        $model = new UserMedicoAgenda();
        $model = $model->join("user_profile","user_medico_agenda.user_id_medico","user_profile.user_id");
        $model = $model->where("user_medico_agenda.cat_especialidad_id", $cat_especialidad_id);
        $model = $model->where("user_medico_agenda.centro_salud_id", $centro_salud_id);
        $model = $model->where("user_medico_agenda.active",1);

        $model =    $model->select(
                        DB::raw("
                            CONCAT(
                                user_profile.nombres,
                                ' ',
                                user_profile.apellidos
                            ) AS description
                        "),
                        "user_profile.user_id AS id"
                    );
        //$model = $model->groupBy("centro_salud.description");
        //$model = $model->orderBy("centro_salud.description", "ASC");
        $model = $model->get()->toArray();

       /*  $id = [];
        $response = [];
        foreach($model as $value){
           
            if ( !in_array($value['id'],$id)) {
                array_push($response,$value);
                array_push($id, $value['id']);
            }
        } */
        return Response()->json( $model );
    }
    public function getAll2()
    {
     
        $centro_salud = CentroSalud::where("active",1 )->get()->toArray();
        /* foreach ($centro_salud as $key => $value) {
            $centro_salud[$key]['especialidades'] =  CentroSaludEspecialidades::where("centro_salud_especialidades.active",1 )
            ->where("centro_salud_id",$value['id'])
            ->select(
                "centro_salud_especialidades.id",
                "centro_salud_id",
                "cat_especialidad_id",
                "description",
                "image"
            )
            ->join("cat_user_especialidad","centro_salud_especialidades.cat_especialidad_id","cat_user_especialidad.id")
            ->orderBy("cat_user_especialidad.description", "ASC")
            ->get()
            ->toArray();
        } */
        return $centro_salud;
    }
    public function actualizaruserCentrossalud()
    {
        //FUNCION TEMPORAL PARA ACTUALIZAR TABLA USER CENTRO SALUD 07-08-2022
        $model = User::where("user.active",1)
                ->join("user_type","user.id","user_type.user_id")
                ->where("user_type.cat_user_type_id",2)
                //->join("user_profile","user.id","user_profile.user_id")
                ->select(
                    //"DISTINCT user_profile.cedula",
                    "user.*",
                    "user_type.cat_user_type_id"
                )
                ->get();
        dd( $model );
        foreach ($model as $key => $value) {
            # code...
        }
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
    public function show($id)
    {
        //
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
    public function default()
    {
        return config("app.APP_CENTRO_SALUD_ID");
    }
}
