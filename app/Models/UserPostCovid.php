<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPostCovid extends Model
{
    protected $table = "user_post_covid";
    protected $fillable = [
        "user_id",
        "hospitalizacion",
        "inicio_sintomas",
        "atencion_med",
        "oxigenoterapia",
        "sintomatologia",
        "prioridad",
        "user_id_medico",
        "created_at",
    ];
    static function store(Request $request)
    {
        $prioridad = "Leve";
        if(
            $request->hospitalizacion == "Si" ||
            $request->atencion_med == "Si" ||
            $request->oxigenoterapia == "Si" ||
            $request->sintomatologia == "Si"
        ){
            $prioridad = "Moderada";
        }
        $model = UserPostCovid::updateOrCreate(
            ['user_id' => $request->user_id],
            [
                'hospitalizacion' => $request->hospitalizacion,
                'atencion_med' => $request->atencion_med,
                'inicio_sintomas' => $request->inicio_sintomas,
                'oxigenoterapia' => $request->oxigenoterapia,
                'sintomatologia' => $request->sintomatologia,
                'prioridad' => $prioridad,
                'user_id' => $request->user_id,
                'user_id_medico' => !is_null(Auth::id()) ? Auth::id() : NULL,
                'created_at' => date('Y-m-d H:i:s', strtotime($request['created_at'])),
            ]
        );


        return UserPostCovid::show($request->user_id);

    }
    static function show($user_id)
    {
        return UserPostCovid::where("user_id",$user_id)->first();
    }
    static function getALL()
    {
        return  UserPostCovid::where("user_post_covid.active",1)
                ->where("user_cuest_ubicacion.cat_user_ubicacion_id",371)
                ->join("user","user_post_covid.user_id","user.id")
                ->join("user_profile","user_post_covid.user_id","user_profile.user_id")
                ->join("user_cuest_ubicacion","user_post_covid.user_id","user_cuest_ubicacion.user_id_paciente")
                ->select(
                    DB::raw("
                        DISTINCT user_post_covid.user_id AS user_id
                    "),
                    DB::raw("
                       CASE
                        WHEN user_post_covid.prioridad = 'Leve' THEN 'success'
                        WHEN user_post_covid.prioridad = 'Moderada' THEN 'warning'
                        ELSE ''
                       END AS prioridad_color
                    "),
                    DB::raw("
                       CASE
                        WHEN user_post_covid.prioridad = 'Leve' THEN 2
                        WHEN user_post_covid.prioridad = 'Moderada' THEN 1
                        ELSE ''
                       END AS prioridad_numero
                    "),
                    DB::raw("
                        CONCAT(user_profile.apellidos,', ',user_profile.nombres) AS paciente
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS cedula
                    "),
                    "user_profile.cedula AS cedula_default",
                    "user_profile.telefono_movil AS telefono_movil",
                    DB::raw("
                        UPPER(user_profile.genero) AS genero
                    "),
                    DB::raw("
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                    "),
                    DB::raw("
                        DATE_FORMAT(user.created_at, '%d/%m/%Y') AS registro
                    "),
                    "user.email AS email",
                    "user_post_covid.*",
                    "user_profile.*"
                )
                ->orderBy("prioridad_numero", "ASC")
                ->orderBy("user_post_covid.created_at", "DESC")
                ->get();
    }
}
