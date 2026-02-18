<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserProfileController extends Controller
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
        return UserProfile::store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCedula(Request $request)
    {
        return UserProfile::getCedula($request->user_id);
    }
    public function cedulaExiste(Request $request)
    {
        // echo $request->cedula;
        return UserProfile::cedulaExiste($request);
    }
    public function show(Request $request)
    {
        return UserProfile::show($request->user_id);
    }
    public function getByCedula($cedula)
    {
        $model = new UserProfile();
        $model = $model->join("user","user_profile.user_id","user.id");
        $model = $model->leftJoin("user_cuest_direction","user_profile.user_id","user_cuest_direction.user_id");
        $model = $model->where("cedula",$cedula);
        $model = $model->select(
            "user_profile.*",
            "user.email",
            "user_cuest_direction.cat_estado_id",
            "user_cuest_direction.cat_municipio_id",
            "user_cuest_direction.description",
            "user_cuest_direction.domicilio",
            DB::raw("user_cuest_direction.id AS user_cuest_direction_id")
        );
        $model = $model->first();

        return  Response()->json($model);
    }
    public function show_by_cedula($cedula)
    {
        return UserProfile::where("user.active",1)
                            ->where("cedula",$cedula)
                            ->join("user","user_profile.user_id","user.id")
                            ->select(
                                "user_profile.*",
                                "user.email",
                                DB::raw("
                                    (SELECT value FROM user_profile_images AS upi WHERE upi.user_id_paciente = user.id AND coments = 'imgSoyChacao') AS imgSoyChacao
                                "),
                                DB::raw("
                                    (SELECT value FROM user_profile_images AS upi WHERE upi.user_id_paciente = user.id AND coments = 'imgDocIdentidad') AS imgDocIdentidad
                                "),
                                DB::raw("
                                    (SELECT value FROM user_profile_images AS upi WHERE upi.user_id_paciente = user.id AND coments = 'partidaNacimiento') AS partidaNacimiento
                                "),
                                DB::raw("
                                    CONCAT(
                                        nombres,
                                        ' ',
                                        apellidos
                                        ) as paciente
                                "),
                                DB::raw("
                                    cedula AS cedula_unformatted
                                "),
                                DB::raw("
                                    CASE
                                        WHEN cedula IS NULL THEN ''
                                        ELSE FORMAT(cedula, 0, 'de_DE')
                                    END AS cedula
                                "),
                                DB::raw("
                                    CASE
                                        WHEN fnacimientO IS NULL THEN ''
                                        ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                                    END AS nacimiento
                                "),
                                DB::raw("
                                YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                                "),
                                DB::raw("
                                    LOWER(
                                        CONCAT(
                                            user_profile.nombres,
                                            user_profile.apellidos,
                                            user_profile.nacionalidad,
                                            user_profile.cedula,
                                            user_profile.fnacimiento,
                                            user_profile.genero,
                                            user_profile.telefono_movil,
                                            user.email,
                                            YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ),
                                            FORMAT(cedula, 0, 'de_DE'),
                                            CONCAT(
                                                nombres,
                                                ' ',
                                                apellidos
                                            )
                                        )
                                    ) as filter
                                ")
                                )
                                ->get()->toArray();


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
        return UserProfile::actualizar($request);
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

    public function updateWhatsapp(Request $request){ //user_id, newEmail

        $profile = UserProfile::find($request->profile_id);
        $profile->telefono_movil = $request->newWhatsapp;
        $profile->save();

        return response('El número de whatsapp fue modificado con éxito.', 200);

    }

    public function searchUser($SEARCH_PARAMS)
    {
        $SEARCH_PARAMS = explode(" ",$SEARCH_PARAMS);
        $where = "";
        foreach ($SEARCH_PARAMS as $key => $value) {
            $where.= "(";
            $where.= "LOWER( user_profile.nombres ) LIKE LOWER( '%".$value."%' )  OR ";
            $where.= "LOWER( user_profile.apellidos ) LIKE LOWER( '%".$value."%' )  OR ";
            $where.= "LOWER( user_profile.cedula ) LIKE LOWER( '%".$value."%' )  OR ";
            $where.= "LOWER( user_profile.telefono_movil ) LIKE LOWER( '%".$value."%' )  OR ";
            $where.= "LOWER( tarjeta_soy_chacao.description ) LIKE LOWER( '%".$value."%' )";
            $where.= ")";

            if ( ($key + 1) < count($SEARCH_PARAMS) ) {
                $where.= " OR ";
            }

        }
            // dd($where);
        return DB::select("
            SELECT
                (
                    SELECT
                        GROUP_CONCAT( cat_user_type_id )
                        FROM user_type
                        WHERE
                            user_id = user_profile.user_id
                ) AS roles,
                user_profile.id,
                user_profile.exonerado,
                user_profile.user_id,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_profile.nacionalidad,
                user_profile.cedula,
                user_profile.genero,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad,
                CONCAT(
                    user_profile.nacionalidad,
                    user_profile.cedula
                ) AS cedulaF,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                tarjeta_soy_chacao.description AS tarjeta_soy_chacao,
                user.email AS email,
                ( SELECT COUNT(*) FROM user_cita WHERE user_id_paciente = user_profile.user_id AND cat_user_cita_status_id = 7 ) AS citas_completadas
            FROM user_profile
            INNER JOIN user ON user_profile.user_id = user.id
            LEFT JOIN tarjeta_soy_chacao ON user_profile.user_id  = tarjeta_soy_chacao.user_id_paciente
            WHERE
                ".$where."
            AND
            user.active = 1
        ",[]);
    }

    public function exonerado()
    {
        return UserProfile::where("active",1)->where("exonerado",">",0)
        ->join("user","user_profile.user_id","user.id")
        ->select(
            "user_profile.*",
            "user.email",
            DB::raw("
                CONCAT(
                    nombres,
                    ' ',
                    apellidos
                    ) as paciente
            "),
            DB::raw("
                CASE
                    WHEN cedula IS NULL THEN ''
                    ELSE FORMAT(cedula, 0, 'de_DE')
                END AS cedula
            "),
            DB::raw("
                CASE
                    WHEN fnacimientO IS NULL THEN ''
                    ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                END AS nacimiento
            "),
            DB::raw("
            YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            "),
            DB::raw("
                LOWER(
                    CONCAT(
                        user_profile.nombres,
                        user_profile.apellidos,
                        user_profile.nacionalidad,
                        user_profile.cedula,
                        user_profile.fnacimiento,
                        user_profile.genero,
                        user_profile.telefono_movil,
                        user.email,
                        YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ),
                        FORMAT(cedula, 0, 'de_DE'),
                        CONCAT(
                            nombres,
                            ' ',
                            apellidos
                        )
                    )
                ) as filter
            ")
        )
        ->orderBy("user.id","DESC")
        ->get()
        ->toArray();


    }

    public function getAll()
    {
        return UserProfile::where("active",1)
        ->join("user","user_profile.user_id","user.id")
        ->select(
            "user_profile.*",
            "user.email",
            DB::raw("
                CONCAT(
                    nombres,
                    ' ',
                    apellidos
                    ) as paciente
            "),
            DB::raw("
                CASE
                    WHEN cedula IS NULL THEN ''
                    ELSE FORMAT(cedula, 0, 'de_DE')
                END AS cedula
            "),
            DB::raw("
                CASE
                    WHEN fnacimientO IS NULL THEN ''
                    ELSE  DATE_FORMAT(fnacimiento, '%d/%m/%Y')
                END AS nacimiento
            "),
            DB::raw("
            YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            "),
            DB::raw("
                LOWER(
                    CONCAT(
                        user_profile.nombres,
                        user_profile.apellidos,
                        user_profile.nacionalidad,
                        user_profile.cedula,
                        user_profile.fnacimiento,
                        user_profile.genero,
                        user_profile.telefono_movil,
                        user.email,
                        YEAR(CURDATE())-YEAR(fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fnacimiento,'%m-%d'), 0 , -1 ),
                        FORMAT(cedula, 0, 'de_DE'),
                        CONCAT(
                            nombres,
                            ' ',
                            apellidos
                        )
                    )
                ) as filter
            ")
        )
        ->take(10000)
        ->orderBy("user.id","DESC")
        ->get()
        ->toArray();


    }

    public function update_field(Request $request, $id)
    {
        $model = UserProfile::where('id', $id)
        ->update([$request->field=>$request->value]);

        return Response()->json($model);
    }

    public function update_item(Request $request)
    {
        return UserProfile::update_item($request);
    }

    public function update_item_file(Request $request)
    {
        return UserProfile::update_item_file($request);
    }

}
