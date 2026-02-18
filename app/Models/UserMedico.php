<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
class UserMedico extends Model
{
    protected $table = "user_medico";
    static function store(Request $request)
    {

        try {
            $model = new UserMedico();
            $model->nombre = $request->nombre;
            $model->apellido = $request->apellido;
            $model->cedula = $request->cedula;
            $model->genero = $request->genero;
            $model->fnacimiento = $request->fnacimiento;
            $model->telefono_movil = $request->telefono_movil;
            $model->user_id = $request->user_id;
            $model->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    static function posicionAleatoriaMedico(){
        //FUNCION TEMPORAL 21-08-2021
        /*
        $model = UserType::where("user_type.cat_user_type_id",2)->pluck('user_id');

        foreach ($model as $key => $value) {
            $model = new UserMedicoPosicion();
                $model::updateOrCreate([
                    'cat_user_medico_posicion_id' =>1,
                    'user_id'=> $value,
                ],[

                    'cat_user_medico_posicion_id' =>1,
                    'user_id'=> $value,
                    'user_id_medico'=> Auth::id(),
                ]);


        }*/
    }
    static function getMedicosCitas()
    {
        $medicos_id = [];
        $medigo_agenda =    UserMedicoAgenda::where("user_medico_agenda.active",1)
                            //->where("user_medico_activo.active","!=",0)
                            //->leftJoin("user_medico_activo","user_medico_agenda.user_id_medico","user_medico_activo.user_id_medico")
                            ->select("user_medico_agenda.user_id_medico")
                            ->get()
                            ->toArray();
        foreach ($medigo_agenda as $key => $value) {
            array_push($medicos_id,$value['user_id_medico']);
        }

        $model =  User::whereIn("user.id",array_unique($medicos_id))
                //->where("user_type.cat_user_type_id",2)
                ->where("user.active",1)
                //->join("user_type","user.id","user_type.user_id")
                ->join("user_profile","user.id","user_profile.user_id")
                //->join("user_especialidad","user.id","user_especialidad.user_id")
                //->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                ->select(
                    DB::raw("
                        DISTINCT user_profile.user_id AS user_id
                    "),
                    "user_profile.imagen",
                    "user_profile.nacionalidad",
                    "user_profile.cedula AS cedula_unformatted",
                    DB::raw("
                        CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                    "),
                    "user.email",
                    "user_profile.nombres",
                    "user_profile.apellidos",
                    "user_profile.genero",
                    "user_profile.fnacimiento",
                    "user_profile.telefono_movil",
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.cat_especialidad_id )
                                FROM user_medico_agenda
                            WHERE user_medico_agenda.user_id_medico = user.id
                            AND user_medico_agenda.active = 1
                        ) AS user_especialidad_id_cita
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(cat_user_especialidad.description)
                            FROM user_medico_agenda
                            INNER JOIN cat_user_especialidad ON user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            WHERE user_medico_agenda.user_id_medico = user.id
                            AND user_medico_agenda.active = 1
                        ) AS especialidad_description
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.centro_salud_id )
                                FROM user_medico_agenda
                            WHERE user_id_medico = user.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_id
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_centro_salud.centro_salud_id )
                            FROM user_centro_salud
                            WHERE user_id_paciente = user.id
                            AND user_centro_salud.cat_user_type_id = 2
                            AND user_centro_salud.active = 1
                        ) AS centro_salud_id_asignado
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(centro_salud.description)
                            FROM user_medico_agenda
                            INNER JOIN centro_salud ON user_medico_agenda.centro_salud_id = centro_salud.id
                            WHERE user_medico_agenda.user_id_medico = user.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_description
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(user_medico_agenda.id)
                            FROM user_medico_agenda
                            WHERE user_medico_agenda.user_id_medico = user.id
                            AND user_medico_agenda.active = 1
                        ) AS user_medico_agenda_id
                    "),
                    "user_profile.firma",
                    "user_profile.sello",
                    DB::raw("
                        CASE
                            WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                        ELSE ''
                        END AS prefijo
                    "),

                    DB::raw("
                        CONCAT(user_profile.apellidos,', ',user_profile.nombres) AS medico
                    "),
                    "user_profile.mpps",
                    "user_profile.colegio_medico"

                   /*  "cat_user_especialidad.id AS cat_user_especialidad_id",
                    "cat_user_especialidad.description AS especialidad" */
                )

                //->orderBy("especialidad", "ASC")
                ->orderBy("medico", "ASC")
                ->get();
        foreach ($model as $key => $value) {

            $model[$key]['agenda']=UserMedicoAgenda::getOne($value->user_id);
        }
        return $model;
    }
    static function getMedicos()
    {
        return  UserType::where("user_type.cat_user_type_id",2)
                ->where("user_medico_posicion.active",1)
                ->join("user","user_type.user_id","user.id")
                ->join("user_profile","user_type.user_id","user_profile.user_id")
                ->join("user_especialidad","user_type.user_id","user_especialidad.user_id")
                ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                ->leftJoin("user_equipo_salud","user_type.user_id","user_equipo_salud.user_id")
                ->leftJoin("cat_user_equipo_salud","user_equipo_salud.cat_user_equipo_salud_id","cat_user_equipo_salud.id")
                ->leftJoin("user_medico_posicion","user_type.user_id","user_medico_posicion.user_id")
                ->leftJoin("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
                ->select(
                    DB::raw("
                        DISTINCT user_profile.user_id AS user_id
                    "),
                    DB::raw("
                       CASE
                        WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                        ELSE ''
                       END AS prefijo
                    "),
                    DB::raw("
                        CONCAT(user_profile.apellidos,', ',user_profile.nombres) AS medico
                    "),
                    DB::raw("
                        (SELECT GROUP_CONCAT(user_type.cat_user_type_id) FROM user_type WHERE user_id = user.id) AS user_roles_id
                    "),
                    "cat_user_medico_posicion.id AS posicion_id",
                    "cat_user_medico_posicion.description AS posicion",
                    "user_profile.imagen",
                    "user_profile.extension_telefonica",
                    "user_profile.firma",
                    "user_profile.sello",
                    "user_profile.telefono_movil AS telefono_movil",
                    "cat_user_especialidad.id AS cat_user_especialidad_id",
                    "cat_user_especialidad.description AS especialidad",
                    DB::raw("
                        UPPER(user_profile.genero) AS genero
                    "),
                    DB::raw("
                        CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                    "),
                    "user.email AS email",
                    "cat_user_equipo_salud.description AS equipo_salud",
                    "cat_user_equipo_salud.id AS equipo_salud_id"
                )

                ->orderBy("especialidad", "ASC")
                ->orderBy("medico", "ASC")
                ->get();
    }
    static function ce_getMedicos()
    {
        $model =  UserType::where("user_type.cat_user_type_id",2)
                ->where("cat_user_especialidad.active",1)
                ->where("user_medico_posicion.active",1)
                ->where("user_centro_salud.cat_user_type_id",2)
                ->where("user_medico_activo.active","!=",0)
                ->leftJoin("user_medico_activo","user_type.user_id","user_medico_activo.user_id_medico")
                ->join("user","user_type.user_id","user.id")
                ->join("user_centro_salud","user.id","user_centro_salud.user_id_paciente")
                ->join("user_profile","user_type.user_id","user_profile.user_id")
                ->join("user_especialidad","user_type.user_id","user_especialidad.user_id")
                ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                ->leftJoin("user_equipo_salud","user_type.user_id","user_equipo_salud.user_id")
                ->leftJoin("cat_user_equipo_salud","user_equipo_salud.cat_user_equipo_salud_id","cat_user_equipo_salud.id")
                ->leftJoin("user_cuest_direction","user_type.user_id","user_cuest_direction.user_id")
                ->leftJoin("user_medico_posicion","user_type.user_id","user_medico_posicion.user_id")
                ->leftJoin("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
                ->select(
                    DB::raw("
                        DISTINCT user_profile.user_id AS user_id
                    "),
                    "user_profile.imagen",
                    "user_profile.nacionalidad",
                    "user_profile.cedula AS cedula_unformatted",
                    DB::raw("
                        CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                    "),
                    DB::raw("
                        (
                            SELECT user_medico_agenda.agenda
                            FROM user_medico_agenda
                            WHERE
                                user_medico_agenda.cat_especialidad_id = user_especialidad.cat_user_especialidad_id
                                AND user_medico_agenda.centro_salud_id = user_centro_salud.centro_salud_id
                                AND user_medico_agenda.user_id_medico = user_type.user_id
                                AND active=1
                            LIMIT 1
                        ) AS agenda
                    "),
                    "user.email",
                    "user_profile.nombres",
                    "user_profile.apellidos",
                    "user_profile.genero",
                    "user_profile.fnacimiento",
                    "user_profile.telefono_movil",

                    "user_cuest_direction.cat_estado_id",
                    "user_cuest_direction.cat_municipio_id",
                    "user_cuest_direction.description",
                    "user_cuest_direction.domicilio",

                    DB::raw("
                        (
                            SELECT
                                description
                            FROM tarjeta_soy_chacao
                            WHERE user_id_paciente = user.id
                        ) AS tarjeta_soy_chacao
                    "),

                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( cat_user_especialidad_id )
                                FROM user_especialidad
                                WHERE
                                    user_id = user.id
                        ) AS user_especialidad_id
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.cat_especialidad_id )
                                FROM user_medico_agenda
                            WHERE user_medico_agenda.user_id_medico = user_type.user_id
                            AND user_medico_agenda.active = 1
                        ) AS user_especialidad_cita_id
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.centro_salud_id )
                                FROM user_medico_agenda
                            WHERE user_id_medico = user_type.user_id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_id
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_centro_salud.centro_salud_id )
                            FROM user_centro_salud
                            WHERE user_id_paciente = user.id
                            AND user_centro_salud.cat_user_type_id = 2
                            AND user_centro_salud.active = 1
                        ) AS centro_salud_id_asignado
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(centro_salud.description)
                            FROM user_centro_salud
                            INNER JOIN centro_salud ON user_centro_salud.centro_salud_id = centro_salud.id
                            WHERE user_id_paciente = user.id
                            AND user_centro_salud.cat_user_type_id = 2
                            AND user_centro_salud.active = 1
                        ) AS centro_salud_id_asignado_description
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(centro_salud.description)
                            FROM user_medico_agenda
                            INNER JOIN centro_salud ON user_medico_agenda.centro_salud_id = centro_salud.id
                            WHERE user_medico_agenda.user_id_medico = user_type.user_id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_description
                    "),
                    DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT(user_medico_agenda.id)
                            FROM user_medico_agenda
                            WHERE user_medico_agenda.user_id_medico = user_type.user_id
                            AND user_medico_agenda.active = 1
                        ) AS user_medico_agenda_id
                    "),
                    "user_profile.firma",
                    "user_profile.sello",
                    DB::raw("
                        CASE
                            WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                        ELSE ''
                        END AS prefijo
                    "),

                    DB::raw("
                        CONCAT(user_profile.apellidos,', ',user_profile.nombres) AS medico
                    "),
                    DB::raw("
                        (
                            SELECT user_profile_images.value
                            FROM user_profile_images
                            WHERE user_profile_images.user_id_paciente = user.id
                            AND user_profile_images.coments = 'imgSoyChacao'
                            AND user_profile_images.active = 1
                            LIMIT 1
                        ) AS imgSoyChacao
                    "),
                    DB::raw("
                        (
                            SELECT user_profile_images.value
                            FROM user_profile_images
                            WHERE user_profile_images.user_id_paciente = user.id
                            AND user_profile_images.coments = 'imgDocIdentidad'
                            AND user_profile_images.active = 1
                            LIMIT 1
                        ) AS imgDocIdentidad
                    "),
                    "cat_user_medico_posicion.id AS posicion_id",
                    "cat_user_medico_posicion.description AS posicion",

                    "user_profile.mpps",
                    "user_profile.colegio_medico",

                    "cat_user_especialidad.id AS cat_user_especialidad_id",
                    "cat_user_especialidad.description AS especialidad",

                    "cat_user_equipo_salud.description AS equipo_salud",
                    "cat_user_equipo_salud.id AS equipo_salud_id"
                )

                ->orderBy("especialidad", "ASC")
                ->orderBy("medico", "ASC")
                ->get();
        /* foreach ($model as $key => $value) {
            $model[$key]['agenda']=UserMedicoAgenda::getOne($value->user_id);
        } */
        return $model;
    }
    static function getMedico($user_id)
    {
        // SI NO TRAE AL MEDIVO VERIFICAR TABLA user_medico_activo 18-01-2023
        $model =  UserType::where("user_type.cat_user_type_id",2)
            ->where("user_type.user_id",$user_id)
            ->where("user_medico_posicion.active",1)
            ->where("user_medico_activo.active","!=",0)
            ->leftJoin("user_medico_activo","user_type.user_id","user_medico_activo.user_id_medico")
            ->join("user","user_type.user_id","user.id")
            ->join("user_centro_salud","user.id","user_centro_salud.user_id_paciente")
            ->join("user_profile","user_type.user_id","user_profile.user_id")
            ->join("user_especialidad","user_type.user_id","user_especialidad.user_id")
            ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
            ->leftJoin("user_equipo_salud","user_type.user_id","user_equipo_salud.user_id")
            ->leftJoin("cat_user_equipo_salud","user_equipo_salud.cat_user_equipo_salud_id","cat_user_equipo_salud.id")
            ->leftJoin("user_cuest_direction","user_type.user_id","user_cuest_direction.user_id")
            ->leftJoin("user_medico_posicion","user_type.user_id","user_medico_posicion.user_id")
            ->leftJoin("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
            ->select(
                DB::raw("
                    DISTINCT user_profile.user_id AS user_id
                "),
                "user_profile.imagen",
                "user_profile.nacionalidad",
                "user_profile.cedula AS cedula_unformatted",
                DB::raw("
                    CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                "),
                "user.email",
                "user_profile.nombres",
                "user_profile.apellidos",
                "user_profile.genero",
                "user_profile.fnacimiento",
                "user_profile.telefono_movil",

                "user_cuest_direction.cat_estado_id",
                "user_cuest_direction.cat_municipio_id",
                "user_cuest_direction.description",
                "user_cuest_direction.domicilio",

                DB::raw("
                    (
                        SELECT
                            description
                        FROM tarjeta_soy_chacao
                        WHERE user_id_paciente = user.id
                    ) AS tarjeta_soy_chacao
                "),

                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT( cat_user_especialidad_id )
                            FROM user_especialidad
                            WHERE
                                user_id = user.id
                    ) AS user_especialidad_id
                "),
                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT( user_medico_agenda.cat_especialidad_id )
                            FROM user_medico_agenda
                        WHERE user_medico_agenda.user_id_medico = user_type.user_id
                        AND user_medico_agenda.active = 1
                    ) AS user_especialidad_cita_id
                "),
                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT( user_medico_agenda.centro_salud_id )
                            FROM user_medico_agenda
                        WHERE user_id_medico = user_type.user_id
                        AND user_medico_agenda.active = 1
                    ) AS centro_salud_id
                "),
                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT(centro_salud.description)
                        FROM user_medico_agenda
                        INNER JOIN centro_salud ON user_medico_agenda.centro_salud_id = centro_salud.id
                        WHERE user_medico_agenda.user_id_medico = user_type.user_id
                        AND user_medico_agenda.active = 1
                    ) AS centro_salud_description
                "),
                DB::raw("
                    (
                        SELECT
                            GROUP_CONCAT(user_medico_agenda.id)
                        FROM user_medico_agenda
                        WHERE user_medico_agenda.user_id_medico = user_type.user_id
                        AND user_medico_agenda.active = 1
                    ) AS user_medico_agenda_id
                "),
                "user_profile.firma",
                "user_profile.sello",
                DB::raw("
                    CASE
                        WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                    ELSE ''
                    END AS prefijo
                "),

                DB::raw("
                    CONCAT(user_profile.apellidos,', ',user_profile.nombres) AS medico
                "),
                DB::raw("
                    (
                        SELECT user_profile_images.value
                        FROM user_profile_images
                        WHERE user_profile_images.user_id_paciente = user.id
                        AND user_profile_images.coments = 'imgSoyChacao'
                        AND user_profile_images.active = 1
                        LIMIT 1
                    ) AS imgSoyChacao
                "),
                DB::raw("
                    (
                        SELECT user_profile_images.value
                        FROM user_profile_images
                        WHERE user_profile_images.user_id_paciente = user.id
                        AND user_profile_images.coments = 'imgDocIdentidad'
                        AND user_profile_images.active = 1
                        LIMIT 1
                    ) AS imgDocIdentidad
                "),
                "cat_user_medico_posicion.id AS posicion_id",
                "cat_user_medico_posicion.description AS posicion",

                "user_profile.mpps",
                "user_profile.colegio_medico",

                "cat_user_especialidad.id AS cat_user_especialidad_id",
                "cat_user_especialidad.description AS especialidad",

                "cat_user_equipo_salud.description AS equipo_salud",
                "cat_user_equipo_salud.id AS equipo_salud_id"
            )
            ->orderBy("especialidad", "ASC")
            ->orderBy("medico", "ASC")
            ->first();
        $model['agenda'] = UserMedicoAgenda::where("user_id_medico",$user_id)->get();
        return $model;
    }
}



