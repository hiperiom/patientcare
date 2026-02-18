<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestUbicacion extends Model
{
    protected $table = "user_cuest_ubicacion";

    static function index_episodio($episodio_id)
    {
        return UserCuestUbicacion::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'CAT_USER_CUESTIONARIO_ID', 'VALUE', 'fecha_tac', 'coments', 'file', 'file_type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }
    protected $fillable = [
        "id",
        "cat_user_ubicacion_id",
        "user_id_paciente",
        "user_id_medico",
        "user_cuest_episodio_id",
        "value",
        "coments",
        "created_at",
        "user_cuest_episodio_id",
    ];

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        //PARA EL REGISTRO DE PACIENTES INTERNO
        //dump($request->all());
        if(isset($request->cat_user_ubicacion_id) && !is_null($request->cat_user_ubicacion_id)){
            try {
                $ubicacion = $request->cat_user_ubicacion_id;
                if (!is_null($request->subUbicacion1)) {
                    $ubicacion = $request->subUbicacion1;
                }
                if (!is_null($request->subUbicacion2)) {
                    $ubicacion = $request->subUbicacion2;
                }

                $ultReg= UserCuestUbicacion::where("user_id_paciente",$request->user_id_paciente)->first();

                if (is_null($ultReg)) {
                    UserCuestUbicacion::where("user_id_paciente",$request->user_id_paciente)
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
                    $model = new UserCuestUbicacion();
                    $model->user_cuest_episodio_id = $episode_id;
                    $model->cat_user_ubicacion_id = $ubicacion;
                    $model->user_cuest_episodio_id= UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
                    $model->user_id_paciente = $request->user_id_paciente;
                    $model->user_id_medico = !is_null(Auth::id())?Auth::id():null;
                    $model->value = null;
                    $model->coments = (isset($request->coments))?$request->coments:NULL;
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                }
                //return true;
            } catch (\Throwable $th) {
                dd($th->errorInfo[2]);
            }
        }
    }
    static function store2(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //PARA EL REGISTRO DE PACIENTES EXTERNO

        if ($request->value== "Ingreso" || $request->value== "Reingreso") {
            UserCuestEpisodio::store($request);
            UserCuestImpresionDiagnostica::where("user_id",$request->user_id)
            ->where("active",1)
            ->update(["active"=>0]);
        }


        $ubicacion = $request['cat_user_ubicacion_id'];

        if (isset($request->subUbicacion1) && $request->subUbicacion1!="null") {
            $ubicacion = $request->subUbicacion1;
        }
        if (isset($request->subUbicacion2) && $request->subUbicacion2!="null") {
            $ubicacion = $request->subUbicacion2;
        }

        UserCuestUbicacion::where("user_id_paciente",$request->user_id_paciente)
        ->where("active",1)
        ->update([
            "active"=>0,
            "deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
        ]);
        //dump($request->all());

        $model = new UserCuestUbicacion();
        $model->user_cuest_episodio_id = $episode_id;
        $model->cat_user_ubicacion_id = $ubicacion;
        $model->user_id_paciente = $request->user_id_paciente;
        $model->user_id_medico = Auth::id();
        $model->active = 1;
        if ($request->value== "Egreso") {
            $penultimo_episode_id = UserCuestEpisodio::ultimoEpisodioNoActivo_id($request->user_id_paciente);
            $model->user_cuest_episodio_id= $penultimo_episode_id;
        }else{
            $model->user_cuest_episodio_id= UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        }
        $model->value = isset($request->value)?$request->value:NULL;
        $model->prioridad = isset($request->prioridad_lista)?$request->prioridad_lista:0;
        if(isset($request->coment)){
            $model->coments = $request->coment;
        }

        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();





        //dd(UserCuestUbicacion::show($request->user_id_paciente));
        return UserCuestUbicacion::show($request->user_id_paciente);
    }
    static function getAllPad()
    {
        return UserCuestUbicacion::where("active",1)->whereBetween('cat_user_ubicacion_id', [225, 244])->count();
    }
    static function getPad($id)
    {
        return UserCuestUbicacion::where("active",1)->where('cat_user_ubicacion_id',$id)->count();
    }
    static function getAllHospitalizados()
    {
        return UserCuestUbicacion::where("active",1)
        ->whereNotBetween('cat_user_ubicacion_id', [225, 251])
        ->count();
    }
    static function show($user_id)
    {

        return UserCuestUbicacion::where("user_id_paciente",$user_id)
        ->join("user_cuest_episodio","user_cuest_ubicacion.user_cuest_episodio_id","user_cuest_episodio.id")
        ->join("cat_user_ubicacion","user_cuest_ubicacion.cat_user_ubicacion_id","cat_user_ubicacion.id")
        ->where("user_cuest_ubicacion.active",1)
        ->select(
            DB::raw("
                CASE
                    WHEN
                        user_cuest_episodio.cat_user_ubicacion_id IN (
                            224,225,226,227,228,229,357, #COVID
                            372,373,374,375,376,377,378, #QUIRURGICO
                            379,380,381,382,383,384,385 #MEDICO
                        )
                    THEN 'pad'
                    WHEN
                        user_cuest_episodio.cat_user_ubicacion_id IN (
                            2,3,4,5, 270,271,272,273,274,275,276, #EA
                            6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27, #ECVD
                            28,29,30,31,32,33,34,35,36,37,38,39,40, #EP
                            182,183,184,185,186,187,188,189,190,191,192,193, #UTIA
                            194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209, #UTICVD
                            211,212,213,214,215,216,217,218,219,220,221,222 #UTIP
                        )
                    THEN 'emergencia'
                    WHEN
                        user_cuest_episodio.cat_user_ubicacion_id IN (
                            42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69, #HP2
                            70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97, #HP3
                            98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125, 358,359,360,361,362,363, #HP4
                            126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153, 252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269, #HP5
                            154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181 #HP6
                        )
                    THEN 'hospitalizacion'
                    ELSE NULL
                END AS egreso_de
            "),
            //"user_cuest_episodio.cat_user_ubicacion_id AS egreso_de",
            "user_cuest_ubicacion.user_id_paciente AS user_id",
            "user_cuest_ubicacion.cat_user_ubicacion_id",
            "cat_user_ubicacion.name",
            "cat_user_ubicacion.description",
            "cat_user_ubicacion.coments",
            "user_cuest_ubicacion.coments AS observacion"
        )
        ->first();
    }
    static function historialUbiEpisodio($user_id)
    {
         return  DB::select("


         SELECT
             CONCAT(
                 cuu.description,
                 ' | ',
                 cuu.coments
             ) AS 'area',
             CONCAT(
                 up.prefijo,
                 ' ',
                 up.nombres,
                 ' ',
                 up.apellidos
             ) AS 'creado_por',
             DATE_FORMAT(ucu.created_at, '%d/%m/%Y %h:%i:%S %p') AS fecha_ingreso,
            CASE
                WHEN
                    (
                        SELECT ucu3.created_at
                        FROM user_cuest_ubicacion as ucu3
                        WHERE ucu3.user_id_paciente = ".$user_id."
                        AND ucu3.created_at > ucu.created_at
                        ORDER BY ucu3.created_at ASC
                        LIMIT 1
                    ) IS NOT NULL
                THEN
                    DATE_FORMAT(
                        (
                            SELECT ucu3.created_at
                            FROM user_cuest_ubicacion as ucu3
                            WHERE ucu3.user_id_paciente = ".$user_id."
                            AND ucu3.created_at > ucu.created_at
                            ORDER BY ucu3.created_at ASC
                            LIMIT 1
                        ) ,
                        '%d/%m/%Y %h:%i:%S %p'
                    )
                ELSE ''
            END AS fecha_traslado,

             CASE
                 WHEN
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_id_paciente = ".$user_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     ) IS NULL
                 THEN
                     TO_DAYS(NOW()) -
                     TO_DAYS(
                         ucu.created_at
                     )
                 ELSE
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_id_paciente = ".$user_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     )
         END AS dias_en_area

         FROM user_cuest_ubicacion AS ucu
         INNER JOIN  cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
         INNER JOIN  user_profile AS up ON ucu.user_id_medico = up.user_id
         WHERE ucu.user_id_paciente = ".$user_id."
         #AND ucu.created_at >= (
             #SELECT ucu2.created_at
             #FROM user_cuest_ubicacion AS ucu2
             #WHERE ucu2.user_id_paciente = ".$user_id."
             #AND ucu2.cat_user_ubicacion_id IN(245,246)
             #ORDER BY ucu2.created_at DESC
             #LIMIT 1
         #)
         ORDER BY ucu.id DESC;
        ", [1]);
    }
    static function trasladosEnEpisodio($episode_id)
    {
         return  DB::select("
         SELECT
             CONCAT(
                 cuu.description,
                 ' | ',
                 cuu.coments
             ) AS 'area',
             ucu.user_id_medico,
             ucu.created_at,
             DATE_FORMAT(ucu.created_at, '%d/%m/%Y %h:%i:%S %p') AS fecha_ingreso,
            CASE
                WHEN
                    (
                        SELECT ucu3.created_at
                        FROM user_cuest_ubicacion as ucu3
                        WHERE ucu3.user_cuest_episodio_id = ".$episode_id."
                        AND ucu3.created_at > ucu.created_at
                        ORDER BY ucu3.created_at ASC
                        LIMIT 1
                    ) IS NOT NULL
                THEN
                    DATE_FORMAT(
                        (
                            SELECT ucu3.created_at
                            FROM user_cuest_ubicacion as ucu3
                            WHERE ucu3.user_cuest_episodio_id = ".$episode_id."
                            AND ucu3.created_at > ucu.created_at
                            ORDER BY ucu3.created_at ASC
                            LIMIT 1
                        ) ,
                        '%d/%m/%Y %h:%i:%S %p'
                    )
                ELSE ''
            END AS fecha_traslado,

             CASE
                 WHEN
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_cuest_episodio_id = ".$episode_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     ) IS NULL
                 THEN
                     TO_DAYS(NOW()) -
                     TO_DAYS(
                         ucu.created_at
                     )
                 ELSE
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_cuest_episodio_id = ".$episode_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     )
         END AS dias_en_area

         FROM user_cuest_ubicacion AS ucu
         INNER JOIN  cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
         WHERE ucu.user_cuest_episodio_id = ".$episode_id."
         ORDER BY ucu.id DESC;
        ", [1]);
    }
    static function ultimoIngreso($user_id)
    {
         return  DB::select("
            SELECT
                (
                    SELECT ucu.created_at
                    FROM user_cuest_ubicacion AS ucu
                    WHERE ucu.value IN ('Ingreso','Reingreso')
                    AND ucu.user_id_paciente = ".$user_id."
                    ORDER BY ucu.created_at DESC
                    LIMIT 1
                ) AS ingreso,
                (
                DATEDIFF(CURDATE(), (
                    SELECT ucu.created_at
                    FROM user_cuest_ubicacion AS ucu
                    WHERE ucu.value IN ('Ingreso','Reingreso')
                    AND ucu.user_id_paciente = ".$user_id."
                    ORDER BY ucu.created_at DESC
                    LIMIT 1
                ))
                ) AS dias
            ", [1]);
    }
    static function historialAltas($user_id)
    {
         return  DB::select("


         SELECT
             CONCAT(
                 cuu.description,
                 ' | ',
                 cuu.coments
             ) AS 'area',
             DATE_FORMAT(ucu.created_at, '%d/%m/%Y %h:%i:%S %p') AS fecha_ingreso,
            CASE
                WHEN
                    (
                        SELECT ucu3.created_at
                        FROM user_cuest_ubicacion as ucu3
                        WHERE ucu3.user_id_paciente = ".$user_id."
                        AND ucu3.created_at > ucu.created_at
                        ORDER BY ucu3.created_at ASC
                        LIMIT 1
                    ) IS NOT NULL
                THEN
                    DATE_FORMAT(
                        (
                            SELECT ucu3.created_at
                            FROM user_cuest_ubicacion as ucu3
                            WHERE ucu3.user_id_paciente = ".$user_id."
                            AND ucu3.created_at > ucu.created_at
                            ORDER BY ucu3.created_at ASC
                            LIMIT 1
                        ) ,
                        '%d/%m/%Y %h:%i:%S %p'
                    )
                ELSE ''
            END AS fecha_traslado,

             CASE
                 WHEN
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_id_paciente = ".$user_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     ) IS NULL
                 THEN
                     TO_DAYS(NOW()) -
                     TO_DAYS(
                         ucu.created_at
                     )
                 ELSE
                     TO_DAYS(
                         (
                             SELECT ucu3.created_at
                             FROM user_cuest_ubicacion as ucu3
                             WHERE ucu3.user_id_paciente = ".$user_id."
                             AND ucu3.created_at > ucu.created_at
                             ORDER BY ucu3.created_at ASC
                             LIMIT 1
                         )
                     ) -
                     TO_DAYS(
                         ucu.created_at
                     )
         END AS dias_en_area

         FROM user_cuest_ubicacion AS ucu
         INNER JOIN  cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
         WHERE ucu.user_id_paciente = ".$user_id."
         AND ucu.cat_user_ubicacion_id IN(246,247,248,249)
         ORDER BY ucu.id DESC;
        ", [1]);
    }
    //relationships
    public function ubicacion()
    {
        /*
            Obtener descrición de la ubicacion del usuario
        */
        return $this->hasOne('App\Models\CatUserUbicacion', 'id', 'cat_user_ubicacion_id');
    }
    public function profilePaciente()
    {
        /*
            Obtener profile del usuario paciente
        */
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'user_id_paciente');
    }
    public function episodio()
    {
        /*
            Obtener episodio por su ubicacion actual
        */
        return $this->hasOne('App\Models\UserCuestEpisodio', 'id', 'user_cuest_episodio_id');
    }
}
