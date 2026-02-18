<?php

namespace App\Http\Controllers;

use App\Models\InterconsultationRequest;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestHistoriaMedica;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestPlan;
use App\Models\UserCuestAlert;
use App\Models\UserCuestResbalar;
use App\Models\UserCuestRiesgoQuirurgico;
use App\Models\UserCuestUbicacion;
use App\Models\UserVip;
use App\Models\Vistas;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserTrasladoAmbulancia;
class VistasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function v_lts_oxit()
    {   $model = [];
        $vista = DB::select('SELECT * FROM v_lts_oxit', [1]);

        foreach ($vista as $key => $value) {
            foreach (explode(",",$value->rango1) as $key => $value1) {
                if (!empty($value1)) {
                    $model[] = array(
                        "user_id"=>$value->user_id,
                        "ubicacion"=>$value->ubicacion,
                        "paciente"=>$value->paciente,
                        "sexo"=>$value->sexo,
                        "edad"=>$value->edad,
                        "rango1"=>$value1,
                        "rango2"=>"",
                        "rango3"=>"",
                    );
                }
            }
            foreach (explode(",",$value->rango2) as $key => $value2) {
                if (!empty($value2)) {
                    $model[] = array(
                        "user_id"=>$value->user_id,
                        "ubicacion"=>$value->ubicacion,
                        "paciente"=>$value->paciente,
                        "sexo"=>$value->sexo,
                        "edad"=>$value->edad,
                        "rango1"=>"",
                        "rango2"=>$value2,
                        "rango3"=>"",
                    );
                }
            }
            foreach (explode(",",$value->rango3) as $key => $value3) {
                if (!empty($value3)) {
                    $model[] = array(
                        "user_id"=>$value->user_id,
                        "ubicacion"=>$value->ubicacion,
                        "paciente"=>$value->paciente,
                        "sexo"=>$value->sexo,
                        "edad"=>$value->edad,
                        "rango1"=>"",
                        "rango2"=>"",
                        "rango3"=>$value3,
                    );
                }
            }
        }
        return view("vistas.v_lts_oxit",compact('model'));

    }
    public function v_prioridad_spo2()
    {
        return DB::select('SELECT * FROM v_prioridad_spo2', [1]);
    }
    public function v_medicos()
    {
        return DB::select('SELECT * FROM v_medicos', [1]);
    }


    public function v_prioridad_1()
    {
        return DB::select('SELECT * FROM v_prioridad_1', [1]);
    }
    /*public function v_totales()
    {
        return DB::select('SELECT * FROM v_totales', [1]);
    }*/
    public function v_totales($pad)
    {
        $pad_id =[];
        switch ($pad) {
            case 'covid':
                $pad_id =[224,225,226,227,228,229,357];
                break;
            case 'quiru':
                $pad_id =[372,373,374,375,376,377,378];
                break;
            case 'medic':
                $pad_id =[379,380,381,382,383,384,385];
                break;
            case 'm_c_insuficiencia':
                $pad_id =[388,388,388,388,388,388,388];
                break;
            case 'm_c_hipertension':
                $pad_id =[389,389,389,389,389,389,389];
                break;


        }
        return DB::select("
            SELECT
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id NOT BETWEEN 225 AND 251
                    AND active=1
                ) AS t_hospitalizados,
                 (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id IN(".implode(", ",$pad_id).")
                    AND active=1
                ) AS t_pad,
               /*(
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[1]."
                    AND active=1
                ) AS t_pad1,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[2]."
                    AND active=1
                ) AS t_pad2,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[3]."
                    AND active=1
                ) AS t_pad3,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[4]."
                    AND active=1
                ) AS t_pad4,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[5]."
                    AND active=1
                ) AS t_pad5,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = ".$pad_id[6]."
                    AND active=1
                ) AS t_padEmp,*/
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
                    WHERE user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,358,359,360,361)
                    AND user_profile.nombres IS NOT NULL
                    AND user_profile.apellidos IS NOT NULL
                    AND user_profile.fnacimiento IS NOT NULL
                    AND user_profile.genero IS NOT NULL
                    AND user_cuest_ubicacion.active=1
                ) AS t_pacientes_activo
                LIMIT 1

        ", [1]);

    }
    public function v_prioridad_2()
    {
        return DB::select('SELECT * FROM v_prioridad_2', [1]);
    }
    public function v_pad_reporte_diario()
    {
        return DB::select("
            SELECT
                CONCAT(
                    user_profile.nacionalidad,
                    '-',
                    FORMAT(user_profile.cedula, 0, 'de_DE')
                ) AS cedula,
                (
                    TO_DAYS( NOW() ) - TO_DAYS( ( SELECT ingreso
                    FROM user_cuest_episodio
                    WHERE user_id = user_cuest_ubicacion.user_id_paciente
                    AND active=1
                    ORDER BY id DESC
                    LIMIT 1 ) )
                ) AS dias,
                (
                    SELECT
                    DATE_FORMAT(user_cuest_episodio.ingreso,'%d-%m-%Y')
                    FROM user_cuest_episodio
                    WHERE user_cuest_episodio.user_id = user_cuest_ubicacion.user_id_paciente
                    AND user_cuest_episodio.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS ingreso,
                (
                    SELECT
                    value
                    FROM user_cuest_alert
                    WHERE user_cuest_alert.user_cuest_episodio_id = user_cuest_ubicacion.user_cuest_episodio_id
                    AND user_cuest_alert.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS alert,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_cuest_ubicacion.*,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            FROM user_cuest_ubicacion
            JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (228,229, 373,374, 382)
            AND user_profile.nombres != 'null'
            AND user_profile.apellidos != 'null'
            AND user_cuest_ubicacion.active=1
        ", [1]);
    }
    public function v_ee_reporte_diario()
    {
        return DB::select("
            SELECT
                CONCAT(
                    user_profile.nacionalidad,
                    '-',
                    FORMAT(user_profile.cedula, 0, 'de_DE')
                ) AS cedula,
                (
                    TO_DAYS( NOW() ) - TO_DAYS( ( SELECT ingreso
                    FROM user_cuest_episodio
                    WHERE user_id = user_cuest_ubicacion.user_id_paciente
                    AND active=1
                    ORDER BY id DESC
                    LIMIT 1 ) )
                ) AS dias,
                (
                    SELECT
                    DATE_FORMAT(user_cuest_episodio.ingreso,'%d-%m-%Y')
                    FROM user_cuest_episodio
                    WHERE user_cuest_episodio.user_id = user_cuest_ubicacion.user_id_paciente
                    AND user_cuest_episodio.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS ingreso,
                (
                    SELECT
                    value
                    FROM user_cuest_alert
                    WHERE user_cuest_alert.user_cuest_episodio_id = user_cuest_ubicacion.user_cuest_episodio_id
                    AND user_cuest_alert.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS alert,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_cuest_ubicacion.*,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            FROM user_cuest_ubicacion
            JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (231,232,233)
            AND user_cuest_ubicacion.active=0
        ", [1]);
    }
    public function v_ee2_reporte_diario()
    {
        return DB::select("
            SELECT
                CONCAT(
                    user_profile.nacionalidad,
                    '-',
                    FORMAT(user_profile.cedula, 0, 'de_DE')
                ) AS cedula,
                (
                    TO_DAYS( NOW() ) - TO_DAYS( ( SELECT ingreso
                    FROM user_cuest_episodio
                    WHERE user_id = user_cuest_ubicacion.user_id_paciente
                    AND active=1
                    ORDER BY id DESC
                    LIMIT 1 ) )
                ) AS dias,
                (
                    SELECT
                    DATE_FORMAT(user_cuest_episodio.ingreso,'%d-%m-%Y')
                    FROM user_cuest_episodio
                    WHERE user_cuest_episodio.user_id = user_cuest_ubicacion.user_id_paciente
                    AND user_cuest_episodio.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS ingreso,
                (
                    SELECT
                    value
                    FROM user_cuest_alert
                    WHERE user_cuest_alert.user_cuest_episodio_id = user_cuest_ubicacion.user_cuest_episodio_id
                    AND user_cuest_alert.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS alert,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_cuest_ubicacion.*,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            FROM user_cuest_ubicacion
            JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (231,232,233)
            AND user_cuest_ubicacion.active=1
        ", [1]);
    }
    public function v_ee3_reporte_diario()
    {
        $model = DB::select("
            SELECT
                CONCAT(
                    cuu.description,
                    ' ',
                    cuu.coments
                ) AS ubicacion,
                CONCAT(
                    user_profile.nacionalidad,
                    user_profile.cedula
                ) AS cedula,
                user_cuest_episodio.dia_hos,
                user_cuest_episodio.ingreso,
                user_cuest_episodio.user_id,
                user_cuest_episodio.id as user_cuest_episodio_id,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad

            FROM user_cuest_episodio
            JOIN user_profile ON user_cuest_episodio.user_id = user_profile.user_id
            JOIN user_cuest_ubicacion as ucu ON user_cuest_episodio.id = ucu.user_cuest_episodio_id
            JOIN cat_user_ubicacion as cuu ON ucu.cat_user_ubicacion_id = cuu.id
            WHERE ucu.cat_user_ubicacion_id IN (429)
            #AND user_cuest_episodio.ingreso >= '2024-04-04 00:00:00'
            AND user_cuest_episodio.ingreso >= '2024-09-26 00:00:00'
            AND user_cuest_episodio.ingreso <= '2024-10-05 23:59:59'
            ORDER BY user_cuest_episodio.id DESC
        ", [1]);
        $newArray=[];
        foreach ($model as $key => $value) {

            $tempArray = (array) $value;
            $tempArray['evolucion'] = DB::select("
                SELECT
                    uce.*
                FROM user_cuest_evolucion as uce
                WHERE user_cuest_episodio_id = ".$value->user_cuest_episodio_id."
            ", [1]);

            $tempArray['imp_diagn'] = DB::select("
                SELECT
                    ucid.*
                FROM user_cuest_imp_diagn as ucid
                WHERE user_cuest_episodio_id = ".$value->user_cuest_episodio_id."
            ", [1]);
            $newArray[$key] = $tempArray;

        }

        return $newArray;
    }

    public function v_hospitalizacion_reporte_diario()
    {
        return DB::select("
            SELECT
                CONCAT(
                    user_profile.nacionalidad,
                    '-',
                    FORMAT(user_profile.cedula, 0, 'de_DE')
                ) AS cedula,
                (
                    TO_DAYS( NOW() ) - TO_DAYS( ( SELECT ingreso
                    FROM user_cuest_episodio
                    WHERE user_id = user_cuest_ubicacion.user_id_paciente
                    AND active=1
                    ORDER BY id DESC
                    LIMIT 1 ) )
                ) AS dias,
                (
                    SELECT
                    DATE_FORMAT(user_cuest_episodio.ingreso,'%d-%m-%Y')
                    FROM user_cuest_episodio
                    WHERE user_cuest_episodio.user_id = user_cuest_ubicacion.user_id_paciente
                    AND user_cuest_episodio.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS ingreso,
                (
                    SELECT
                    value
                    FROM user_cuest_alert
                    WHERE user_cuest_alert.user_cuest_episodio_id = user_cuest_ubicacion.user_cuest_episodio_id
                    AND user_cuest_alert.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS alert,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                CONCAT(
                    cat_user_ubicacion.description,
                    ' | ',
                    cat_user_ubicacion.coments
                ) AS ubicacion,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_cuest_ubicacion.*,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            FROM user_cuest_ubicacion
            JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (
                44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,
                72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,
                100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,358,359,360,361,362,363,
                128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,252,253,254,255,256,257,258,259,260,
                156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,261,262,263,264,265,266,267,268,269,
                390,
                213,214,215,216,217,218,219,220,221,222,
                184,185,186,187,188,189,190,191,192,193


            )
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%Ejemplo%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%ejemplo%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%Prueba%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%prueba%'
            AND user_cuest_ubicacion.active=1
        ", [1]);
    }
    public function v_emergencia_reporte_diario()
    {
        return DB::select("
            SELECT
                CONCAT(
                    user_profile.nacionalidad,
                    '-',
                    FORMAT(user_profile.cedula, 0, 'de_DE')
                ) AS cedula,
                (
                    TO_DAYS( NOW() ) - TO_DAYS( ( SELECT ingreso
                    FROM user_cuest_episodio
                    WHERE user_id = user_cuest_ubicacion.user_id_paciente
                    AND active=1
                    ORDER BY id DESC
                    LIMIT 1 ) )
                ) AS dias,
                (
                    SELECT
                    DATE_FORMAT(user_cuest_episodio.ingreso,'%d-%m-%Y')
                    FROM user_cuest_episodio
                    WHERE user_cuest_episodio.user_id = user_cuest_ubicacion.user_id_paciente
                    AND user_cuest_episodio.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS ingreso,
                (
                    SELECT
                    value
                    FROM user_cuest_alert
                    WHERE user_cuest_alert.user_cuest_episodio_id = user_cuest_ubicacion.user_cuest_episodio_id
                    AND user_cuest_alert.active=1
                    ORDER BY id DESC
                    LIMIT 1
                ) AS alert,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                user_profile.genero,
                user_profile.telefono_movil,
                user_profile.imagen,
                user_cuest_ubicacion.*,
                YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
            FROM user_cuest_ubicacion
            JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (
                2,3,4,5,270,271,272,273,274,275,276,
                28,29,30,31,32,33,34,35,36,37,38,39,40
            )
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%Ejemplo%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%ejemplo%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%Prueba%'
            AND CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) NOT like '%prueba%'
            AND user_cuest_ubicacion.active=1
        ", [1]);
    }

    public function list_altas_patients($caso){
        //$caso = "alta";
        $episodes = DB::select("
            SELECT
                uce.user_id,
                uce.id AS episodio_id,
                DATE_FORMAT(uce.ingreso, '%d/%m/%Y') AS ingreso_episodio,
                DATE_FORMAT(uce.ingreso, '%h:%i %p') AS hora_ingreso,
                DATE_FORMAT(uce.egreso, '%d/%m/%Y') AS egreso_episodio,
                DATE_FORMAT(uce.egreso, '%h:%i %p') AS hora_egreso,
                CASE
                    WHEN uce.cat_user_ubicacion_id != '' THEN
                        (
                            SELECT 
                                CONCAT(
                                    cuu.description,
                                    ' | ',
                                    cuu.coments
                                ) 
                            FROM cat_user_ubicacion AS cuu
                            WHERE id = uce.cat_user_ubicacion_id
                        )
                    ELSE uce.cat_user_ubicacion_id
                END AS ubicacion_alta,
                CONCAT(
                    up.nacionalidad,
                    '-',
                    FORMAT(up.cedula, 0, 'de_DE')
                ) AS cedula_formated,
                up.genero,
                up.imagen,
                CONCAT(
                    up.nombres,
                    ' ',
                    up.apellidos
                ) AS paciente,
                (
                    TIMESTAMPDIFF(YEAR, up.fnacimiento, CURDATE())
                ) AS edad,
                (
                    TO_DAYS( uce.egreso ) - TO_DAYS( uce.ingreso)
                ) AS dias



            FROM user_cuest_episodio AS uce
            INNER JOIN user ON uce.user_id = user.id
            INNER JOIN user_profile AS up ON uce.user_id = up.user_id
            INNER JOIN user_type AS ut ON up.user_id = ut.user_id
            WHERE
            
            CASE
                WHEN '".$caso."' = 'alta' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (246)
                WHEN '".$caso."' = 'traslado' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (251)
                WHEN '".$caso."' = 'contraopinion' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (247)
                WHEN '".$caso."' = 'fallecido' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (248)
                WHEN '".$caso."' = 'reingreso' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (250)
                WHEN '".$caso."' = 'alta_otro' THEN
                    (
                        SELECT user_cuest_ubicacion.cat_user_ubicacion_id
                        FROM user_cuest_ubicacion
                        WHERE user_cuest_ubicacion.user_cuest_episodio_id = uce.id
                        ORDER BY user_cuest_ubicacion.id DESC
                        LIMIT 1
                    ) IN (249)
            END
            AND ut.cat_user_type_id = 1
            AND uce.egreso IS NOT NULL
            ORDER BY uce.egreso DESC

            LIMIT 100
        ", [1]);
        return $episodes;
        //dd($episodes);
          

    }

    public function list_active_patients($caso)
    {
        if (in_array($caso,['alta','traslado','fallecido','otro'])) {
           return $this->list_altas_patients($caso);
        }


        $condition1 = " AND uce.egreso IS NULL AND uce.active = 1 AND uce.ingreso <= '".date("Y-m-d")." 23:23:59'";
        $limit = "";

        $orderBy = " ORDER BY ubicacion ASC";
        if (in_array($caso,["ea","ep"])) {
            $orderBy = " ORDER BY ucu.cat_user_ubicacion_id ASC";
        }
        if (in_array($caso,['alta','traslado','fallecido'])) {
            $orderBy = " ORDER BY episodio_id DESC ";
            $condition1 = " AND uce.egreso IS NOT NULL AND uce.active = 0";
            $limit = " LIMIT 100 ";
        }
        //VERIFICACÓN DE EPISODIOS NO ACTIVOS CREADOS EN EL AREA QUIRURGICA
        //A PARTIR DE LA FECHA ACTUAL.
        //SI HOY EL EPISODIO NO ESTÁ ACTIVO, AQUI SE AUTOMATIZA SU ACTIVACIÓN
        $episodios_no_activos = DB::select("
            SELECT
                uce.id AS episodio_id,
                sqx.id AS solicitud_iqx,
                sqx.user_id_paciente,
                sqx.area_intervencion AS area_intervencion_qx
            FROM user_cuest_episodio AS uce
            LEFT JOIN solicitud_quirofano AS sqx ON uce.id = sqx.episodio_id
            WHERE DATE(uce.ingreso) = CURDATE()
            AND uce.egreso IS NULL
            AND uce.active = 0
        ");
        //ACTIVACIÓN
        if (count($episodios_no_activos)  > 0) {
            foreach ($episodios_no_activos as $key => $value) {
                //ACTIVAMOS EL EPISODIO INACTIVO
                DB::select("
                    UPDATE user_cuest_episodio
                    SET active = 1
                    WHERE id = ".$value->episodio_id."
                ");
                //BUSCAR LA UBICACIÓN ACTUAL DEL EPISODIO.
                //SI LA UBICACIÓN ACTIVA DEL EPISODIO ACTUAL ES EA O EP NO TRASLADARLO
                //SINO MOVERLO A AQ TORRE HOSP o AQ MAPM

                $tiene_ubicacion_actual = DB::select("
                    SELECT COUNT(active) AS total
                    FROM user_cuest_ubicacion
                    #WHERE active = 1
                    WHERE user_cuest_episodio_id = ".$value->episodio_id."
                ");
                if ($tiene_ubicacion_actual[0]->total === 0) {
                    $fechaRegistro = date('Y-m-d H:i:s');
                    DB::select("
                        INSERT INTO
                        user_cuest_ubicacion
                        (
                            cat_user_ubicacion_id,
                            user_id_paciente,
                            user_id_medico,
                            value,
                            coments,
                            prioridad,
                            active,
                            user_cuest_episodio_id,
                            created_at,
                            updated_at,
                            deleted_at
                        )
                        VALUES (
                            ".$value->area_intervencion_qx.",
                            ".$value->user_id_paciente.",
                            ".Auth::id().",
                            'Ingreso automático AQ',
                            NULL,
                            '0',
                            '1',
                            ".$value->episodio_id.",
                            '".$fechaRegistro."',
                            '".$fechaRegistro."',
                            NULL
                        )
                    ");
                }

            }
        }
        //dd($episodios_no_activos);

        $model = DB::select("
            SELECT
                DISTINCT  uce.user_id,
                uce.id AS episodio_id,
                uce.id AS episodio,
                uce.pre_alta,
                uce.uti,
                uce.uti_causa,
                uce.codigo_azul,
                uce.atencion_emergencia,
                uce.hospitalizacion,
                uce.terapia_intensiva,
                uce.caso_tipo_medico,
                uce.cirugia,
                uce.nivel_triaje,
                uce.ingreso AS ingreso_episodio,

                CONCAT(
                    cuu.description,
                    ' | ',
                    cuu.coments
                ) AS ubicacion,

                CASE
                    WHEN cuu.parent_cat_user_ubicacion_id = 1 THEN cuu.id
                    ELSE cuu.parent_cat_user_ubicacion_id
                END AS parent_cat_user_ubicacion_id,

                ucu.cat_user_ubicacion_id,
                CASE 
                    #TRIAJE ADULTO  -  TRIAJE PEDIATRICO
                    WHEN ucu.cat_user_ubicacion_id IN(3,4,5,   29,30,31) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) < 30 
                    THEN 'success'
                    WHEN ucu.cat_user_ubicacion_id IN(3,4,5,   29,30,31) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) >= 30 AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) < 45
                    THEN 'warning'
                    WHEN ucu.cat_user_ubicacion_id IN(3,4,5,   29,30,31) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) >= 45
                    THEN 'danger'

                    #OBSERVACION ADULTO  -  OBSERVACION PEDIATRICO
                    WHEN ucu.cat_user_ubicacion_id IN(270,271,272,273,274,275,276,407,408,409,410,411,412,413,414,415,416,417,   33,34,35,36,37,38,39,40) AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) < 6 
                    THEN 'success'
                    WHEN ucu.cat_user_ubicacion_id IN(270,271,272,273,274,275,276,407,408,409,410,411,412,413,414,415,416,417,   33,34,35,36,37,38,39,40) AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) >= 6 AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) < 8
                    THEN 'warning'  
                    WHEN ucu.cat_user_ubicacion_id IN(270,271,272,273,274,275,276,407,408,409,410,411,412,413,414,415,416,417,   33,34,35,36,37,38,39,40) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) >= 8
                    THEN 'danger'

                    #TRAUMASHOCK
                    WHEN ucu.cat_user_ubicacion_id IN(405, 406) AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) < 6 
                    THEN 'success'
                    WHEN ucu.cat_user_ubicacion_id IN(405, 406) AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) >= 6 AND TIMESTAMPDIFF(HOUR, ucu.created_at, NOW()) < 8
                    THEN 'warning'  
                    WHEN ucu.cat_user_ubicacion_id IN(405, 406) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) >= 8
                    THEN 'danger'

                    #TRIAJE PEDIATRICO
                    WHEN ucu.cat_user_ubicacion_id IN(6,7,10) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) < 30 
                    THEN 'success'
                    WHEN ucu.cat_user_ubicacion_id IN(6,7,10) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) >= 30 AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) < 45
                    THEN 'warning'
                    WHEN ucu.cat_user_ubicacion_id IN(6,7,10) AND TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) > 45
                    THEN 'danger'


                END AS status_color_emergencia,
                JSON_OBJECT(
                    'h', TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) DIV 60,
                    'm', TIMESTAMPDIFF(MINUTE, ucu.created_at, NOW()) % 60
                ) AS tiempo_transcurrido,
                cuu.coments AS ubicacion_description,

                user.email AS email,

                CONCAT(
                    up.nacionalidad,
                    '-',
                    FORMAT(up.cedula, 0, 'de_DE')
                ) AS cedula_formated,

                up.id AS user_profile_id,

                up.nombres,
                up.apellidos,
                up.cedula,
                up.nacionalidad,
                up.fnacimiento,
                up.genero,
                up.telefono_movil,
                up.telefono_hogar,
                up.imagen,
                up.tipo_sangre,

                CONCAT(
                    up.nombres,
                    ' ',
                    up.apellidos
                ) AS paciente,

                up.genero AS sexo,
                (
                    TIMESTAMPDIFF(YEAR, up.fnacimiento, CURDATE())
                ) AS edad,


                (
                    TO_DAYS( NOW() ) - TO_DAYS( uce.ingreso)
                ) AS dias,

                (
                    SELECT value
                    FROM user_cuest_alert
                    WHERE user_cuest_episodio_id = uce.id
                    AND active=1
                    LIMIT 1
                ) AS alert,

                (
                    SELECT count(*)
                    FROM user_cuest_pendiente
                    WHERE user_id = user.id
                    AND user_cuest_pendiente.user_cuest_episodio_id = episodio
                    AND active=1
                ) AS t_pendiente,

                (
                    SELECT value
                    FROM user_vip
                    WHERE user_cuest_episodio_id = uce.id
                    AND active=1
                    LIMIT 1
                ) AS vip,

                (
                    SELECT ucm.value
                    FROM user_cuest_monitoreo AS ucm
                    WHERE ucm.user_id = user.id
                    AND ucm.cat_user_cuestionario_id = 84
                    AND ucm.active = 1
                    AND ucm.user_cuest_episodio_id = episodio
                    ORDER BY ucm.id DESC
                    LIMIT 1
                ) AS temp,
                (
                    SELECT ucm.value
                    FROM user_cuest_monitoreo AS ucm
                    WHERE ucm.user_id = user.id
                    AND ucm.cat_user_cuestionario_id = 73
                    AND ucm.active = 1
                    AND ucm.user_cuest_episodio_id = episodio
                    ORDER BY ucm.id DESC
                    LIMIT 1
                ) AS oxi,
                (
                    SELECT ucfc.value
                    FROM user_cuest_fc AS ucfc
                    WHERE ucfc.user_id_paciente = user.id
                    AND ucfc.active = 1
                    AND ucfc.user_cuest_episodio_id = episodio
                    ORDER BY ucfc.id DESC
                    LIMIT 1
                ) AS fc,
                (
                    SELECT ucgl.value
                    FROM user_cuest_glic AS ucgl
                    WHERE ucgl.user_id_paciente = user.id
                    AND ucgl.active = 1
                    AND ucgl.user_cuest_episodio_id = episodio
                    ORDER BY ucgl.id DESC
                    LIMIT 1
                ) AS gl,
                (
                    SELECT ucgl.unidades_insulina
                    FROM user_cuest_glic AS ucgl
                    WHERE ucgl.user_id_paciente = user.id
                    AND ucgl.active = 1
                    AND ucgl.user_cuest_episodio_id = episodio
                    ORDER BY ucgl.id DESC
                    LIMIT 1
                ) AS unidades_insulina,
                (
                    SELECT ucp.value
                    FROM user_cuest_peso AS ucp
                    WHERE ucp.user_id_paciente = user.id
                    AND ucp.active = 1
                    AND ucp.user_cuest_episodio_id = episodio
                    ORDER BY ucp.id DESC
                    LIMIT 1
                ) AS peso,
                (
                    SELECT ucp.value
                    FROM user_cuest_talla AS ucp
                    WHERE ucp.user_id_paciente = user.id
                    AND ucp.active = 1
                    AND ucp.user_cuest_episodio_id = episodio
                    ORDER BY ucp.id DESC
                    LIMIT 1
                ) AS talla,
                (
                    SELECT ucFr.value
                    FROM user_cuest_fr AS ucFr
                    WHERE ucFr.user_id_paciente = user.id
                    AND ucFr.active = 1
                    AND ucFr.user_cuest_episodio_id = episodio
                    ORDER BY ucFr.id DESC
                    LIMIT 1
                ) AS fr,
                (
                    SELECT
                        CONCAT(
                            ucta.value,
                            '/',
                            ucta.value2
                        )
                    FROM user_cuest_ta AS ucta
                    WHERE ucta.user_id_paciente = user.id
                    AND ucta.active = 1
                    AND ucta.user_cuest_episodio_id = episodio
                    ORDER BY ucta.id DESC
                    LIMIT 1
                ) AS ta,
                (
                    SELECT
                        ucta.media
                    FROM user_cuest_ta AS ucta
                    WHERE ucta.user_id_paciente = user.id
                    AND ucta.active = 1
                    AND ucta.user_cuest_episodio_id = episodio
                    ORDER BY ucta.id DESC
                    LIMIT 1
                ) AS ta_media,
                (
                    SELECT
                        GROUP_CONCAT(
                            DISTINCT cat_user_sintoma.description SEPARATOR ', '
                        ) AS `sintoma`
                    FROM user_cuest_sintoma
                    JOIN cat_user_sintoma ON user_cuest_sintoma.cat_user_cuestionario_id = cat_user_sintoma.id
                    WHERE user_cuest_sintoma.user_id = user.id
                    AND user_cuest_sintoma.user_cuest_episodio_id = episodio
                ) AS sintoma,
                (
                    SELECT
                        cat_user_cuestionario.description AS dispositivo
                    FROM user_cuest_monitoreo
                    JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                    WHERE user_cuest_monitoreo.user_id = user.id
                    AND cat_user_cuestionario.id IN
                        (
                            SELECT cat_user_cuestionario.id
                            FROM cat_user_cuestionario
                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                        )
                    AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
                    AND user_cuest_monitoreo.active=1
                    LIMIT 1
                ) AS oxit,
                CASE
                    WHEN uce.cat_user_ubicacion_id != '' THEN
                        CONCAT(
                            cuu2.description,
                            ' | ',
                            cuu2.coments
                        )
                    ELSE uce.cat_user_ubicacion_id
                END AS ubicacion_alta

            FROM user_cuest_episodio AS uce
            INNER JOIN user ON uce.user_id = user.id
            INNER JOIN user_profile AS up ON uce.user_id = up.user_id
            INNER JOIN user_type AS ut ON up.user_id = ut.user_id
            INNER JOIN user_cuest_ubicacion AS ucu ON up.user_id = ucu.user_id_paciente
            INNER JOIN cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
            LEFT JOIN cat_user_ubicacion AS cuu2 ON uce.cat_user_ubicacion_id = cuu2.id
            WHERE up.nombres IS NOT NULL
            AND CASE
                WHEN '".$caso."' = 'ea' THEN
                    cuu.parent_cat_user_ubicacion_id IN (2,3,270) OR ucu.cat_user_ubicacion_id IN (405)
                WHEN '".$caso."' = 'ecvd' THEN
                    cuu.parent_cat_user_ubicacion_id IN (6,7,10)
                WHEN '".$caso."' = 'ep' THEN
                    cuu.parent_cat_user_ubicacion_id IN (29,32,392) OR ucu.cat_user_ubicacion_id IN (406)
                WHEN '".$caso."' = 'aq' THEN
                    cuu.id IN (41,418,419,420,421,422,423,424,425)
                WHEN '".$caso."' = 'aq_torre_hosp' THEN
                    cuu.id IN (418,422)
                WHEN '".$caso."' = 'aq_mapm' THEN
                    cuu.id IN (424,425)
                WHEN '".$caso."' = 'hcep' THEN
                    cuu.id IN (390,399,400,401,402,403,404)
                WHEN '".$caso."' = 'hp2' THEN
                    cuu.parent_cat_user_ubicacion_id IN (42,43)
                WHEN '".$caso."' = 'hp3' THEN
                    cuu.parent_cat_user_ubicacion_id IN (71,235)
                WHEN '".$caso."' = 'hp4' THEN
                    cuu.parent_cat_user_ubicacion_id IN (236,99)
                WHEN '".$caso."' = 'hp5' THEN
                    cuu.parent_cat_user_ubicacion_id IN (127,234)
                WHEN '".$caso."' = 'hp6' THEN
                    cuu.parent_cat_user_ubicacion_id IN (154,155)
                WHEN '".$caso."' = 'utia' THEN
                    cuu.parent_cat_user_ubicacion_id IN (182)
                WHEN '".$caso."' = 'uticvd' THEN
                    cuu.parent_cat_user_ubicacion_id IN (194,195)
                WHEN '".$caso."' = 'utip' THEN
                    cuu.parent_cat_user_ubicacion_id IN (211)

                WHEN '".$caso."' = 'evento1_1' THEN
                    cuu.id IN (232)
                WHEN '".$caso."' = 'evento1_2' THEN
                    cuu.id IN (233)

                WHEN '".$caso."' = 'evento2_2' THEN
                    cuu.id IN (428,427,426)

                WHEN '".$caso."' = 'pfest' THEN
                    cuu.id IN (429)

                WHEN '".$caso."' = 'pad_m_c_insuficiencia' THEN
                    cuu.id IN (388)
                WHEN '".$caso."' = 'pad_m_c_hipertension' THEN
                    cuu.id IN (389)

                WHEN '".$caso."' = 'pad_quiru' THEN
                    cuu.id IN (372)
                WHEN '".$caso."' = 'pad_postquirurgico_amb' THEN
                    cuu.id IN (373)
                WHEN '".$caso."' = 'pad_postquirurgico_hosp' THEN
                    cuu.id IN (374)


                WHEN '".$caso."' = 'pad_medic' THEN
                    cuu.id IN (379)
                WHEN '".$caso."' = 'pad_medico' THEN
                    cuu.id IN (382)


                WHEN '".$caso."' = 'pad_emergencia' THEN
                    cuu.id IN (224)
                WHEN '".$caso."' = 'pad_emergencia_pediatrica' THEN
                    cuu.id IN (228)
                WHEN '".$caso."' = 'pad_emergencia_adulto' THEN
                    cuu.id IN (229)


                WHEN '".$caso."' = 'alta' THEN
                    cuu.id IN (246)
                WHEN '".$caso."' = 'traslado' THEN
                    cuu.id IN (251)
                WHEN '".$caso."' = 'contraopinion' THEN
                    cuu.id IN (247)
                WHEN '".$caso."' = 'fallecido' THEN
                    cuu.id IN (248)
                WHEN '".$caso."' = 'reingreso' THEN
                    cuu.id IN (250)
                WHEN '".$caso."' = 'traslado' THEN
                    cuu.id IN (251)
                WHEN '".$caso."' = 'alta_otro' THEN
                    cuu.id IN (249)
                WHEN '".$caso."' = 'te' THEN
                    cuu.id IN (388,389)
                WHEN '".$caso."' = 'utin' THEN
                    cuu.parent_cat_user_ubicacion_id IN (391)
                ELSE
                    ucu.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367,371,386,387)
            END
            AND up.apellidos IS NOT NULL
            AND up.fnacimiento IS NOT NULL
            AND up.genero IS NOT NULL
            AND up.cedula IS NOT NULL
            ".$condition1."
            AND ut.cat_user_type_id = 1
            AND ucu.active = 1
            ".$orderBy."
            ".$limit ."
            #LIMIT 3
        ");
        // dd($model);
        foreach ($model as $key => $value) {
            //TOTAL DE EPISODIOS ANTERIORES
            $model[$key]->total_episodios = UserCuestEpisodio::totalEpisodios($value->user_id);

            //ESTADO POR DEFECTO TRASLADO ACTUAL EN AMBULANCIA DURANTE EL EPISODIO
            $model[$key]->traslado_ambulancia = NULL;

            //ESPADO POR DEFECTO PACIENTE ESPECIAL? 0 = NO, 1 = SI
            $model[$key]->vip = 0;
            $model[$key]->vip_description = NULL;

            //NIVEL DE RIESGO DEL PACIENTE 3 = ESTABLE, 2 = INTERMEDIO, 1 = DE CUIDADO
            $model[$key]->alert = 3;
            $model[$key]->alert_description = NULL;

            //NIVEL DE RIESGO DE CAIDA DEL PACIENTE 3 = ESTABLE, 2 = INTERMEDIO, 1 = DE CUIDADO
            $model[$key]->resbalar = 3;
            $model[$key]->resbalar_description = NULL;

            //NIVEL DE RIESGO INFECCION DE HERIDA DEL PACIENTE 3 = ESTABLE, 2 = INTERMEDIO, 1 = DE CUIDADO
            $model[$key]->cirugia = 1;
            $model[$key]->cirugia_description = NULL;

            //ULTIMO VALOR DE SIGNOS VITALES
            if(is_null($value->temp)){
                $value->temp = ""; //TEMPERATURA
            }
            if(is_null($value->oxi)){
                $value->oxi = ""; //OXIMETRIA
            }
            if(is_null($value->fc)){
                $value->fc = ""; //FRECUENCIA CARDIACA
            }
            if(is_null($value->gl)){
                $value->gl = ""; // GLICEMIA
            }
            if(is_null($value->fr)){
                $value->fr = ""; // FRECUENCIA CARDIACA
            }
            if(is_null($value->ta)){
                $value->ta = ""; //TENSION ARTERIAL
            }
            if(is_null($value->sintoma)){
                $value->sintoma = ""; //SINTOMAS
            }
            if(is_null($value->oxit)){
                $value->oxit = ""; //OXIGENOTERAPIA
            }

            //ESTATUS POR DEFECTO PACIENTE EN EMERGENCIA (FICHA ADMINISTRATIVA)
            $model[$key]->servicio_emergencia = [
                "tipo_emergencia"=>NULL,
                "description"=>NULL,
                "value"=>NULL,
                "active"=>NULL,
                "user_id_medico"=>NULL,
                "user_cuest_episodio_id"=>NULL,
                "user_id_paciente"=>NULL,
                'id'=>NULL,
                'color'=>'secondary',
            ];

            //ESTADO POR DEFECTO TIPO DE PACIENTE EN EL EPISODIO  (FICHA ADMINISTRATIVA)
            $model[$key]->user_tipo_paciente =[];




            //LO SIGUIENTE SOLO APLICA PARA LOS PACIENTES CON EPISODIO ACTIVO
            if (
                $value->cat_user_ubicacion_id != 246 &&
                $value->cat_user_ubicacion_id != 247 &&
                $value->cat_user_ubicacion_id != 248 &&
                $value->cat_user_ubicacion_id != 249 &&
                $value->cat_user_ubicacion_id != 251

            ) {
                //HISTORIAL DEL PACIENTE
                $temp = []; //UserCuestHistoriaMedica::getHistorial($value->user_id); //ELIMINAR ESTO AL ACTUALIZAR MODULO DE IMPRESION DIAGNOSTICA
                $model[$key]->resultados = $temp;
                //EQUIPO MEDICO QUE ATIENDE AL PACIENTE
                $temp = UserCuestMedicoPaciente::show($value->user_id);
                $model[$key]->medico_paciente = $temp;

                //SOLICITUD DE INTERCONSULTA
                $interconsultation = new InterconsultationRequestController();
                $model[$key]->interconsultation_request = $interconsultation->index($value->episodio);

                   
                //PENDIENTES DEL PACIENTE
                if (!empty($value->episodio)) {
                    $temp = DB::select("
                        SELECT
                            id,
                            value,
                            privado,
                            active,
                            coments,
                            created_at AS created_at_default,
                            DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                            DATE_FORMAT(created_at, '%h:%i %p') AS hora
                            FROM user_cuest_pendiente AS tabla
                            WHERE tabla.user_id = ".$value->user_id."
                            AND tabla.user_cuest_episodio_id = ".$value->episodio."
                    ", [1]);
                    $model[$key]->pendiente = $temp;
                }else{
                    $model[$key]->pendiente = [];
                }

                //TRASLADO ACTUAL EN AMBULANCIA DURANTE EL EPISODIO
                $traslado_ambulancia = UserTrasladoAmbulancia::where("user_cuest_episodio_id",$value->episodio)->first();
                $model[$key]->traslado_ambulancia = $traslado_ambulancia;

                //EL PACIENTE ES ESPECIAL?
                $vip = UserVip::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->vip = isset($vip->value) ?$vip->value:NULL;
                $model[$key]->vip_description = isset($vip->description) ?$vip->description:NULL;

                //NIVEL DE RIESGO DEL PACIENTE
                $alert = UserCuestAlert::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->alert = isset($alert->value) ?$alert->value:NULL;
                $model[$key]->alert_description = isset($alert->description) ?$alert->description:NULL;

                //NIVEL DE RIESGO DE CAIDA DEL PACIENTE
                $resbalar = UserCuestResbalar::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->resbalar = isset($resbalar->value) ?$resbalar->value:NULL;
                $model[$key]->resbalar_description = isset($resbalar->description) ?$resbalar->description:NULL;

                //NIVEL DE INFECCION DE HERIDA DEL PACIENTE
                $cirugia = UserCuestRiesgoQuirurgico::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->cirugia = isset($cirugia->value) ?$cirugia->value:NULL;
                $model[$key]->cirugia_description = isset($cirugia->description) ?$cirugia->description:NULL;


                //PREALTA DEL PACIENTE
                try {
                    $prealta = UserCuestEpisodio::show($value->user_id)->pre_alta;
                } catch (\Throwable $th) {
                    dd($value->user_id);
                }
                $prealta =  !is_null($prealta) ? (new DateTime($prealta))->format('Y-m-d') : $prealta ;
                $model[$key]->prealta = $prealta;
                $model[$key]->prealta_color  = "info";
                if (!is_null($prealta)) {
                    date_default_timezone_set("America/Caracas");
                    $hoy = date("Y-m-d");
                    $fechaAnterior = (new DateTime($prealta))->format('Y-m-d');
                    $fecha1= new DateTime($hoy);
                    $fecha2= new DateTime($fechaAnterior);
                    $diff = $fecha1->diff($fecha2);


                    if ($diff->days < 0) {
                        $diff->days = 0;
                    }
                    if ($diff->days >= 2) {
                        $model[$key]->prealta_color = "success";
                    }
                    if ($diff->days == 1) {
                        $model[$key]->prealta_color = "warning";
                    }
                    if ($diff->days == 0) {
                        $model[$key]->prealta_color = "danger";
                    }
                }

                //ESTADO POR DEFECTO TIPO DE PACIENTE EN EL EPISODIO  (FICHA ADMINISTRATIVA)
                $user_tipo_paciente = DB::table("user_tipo_paciente")
                    ->where('user_cuest_episodio_id',$value->episodio)
                    ->first();
                if(is_null($user_tipo_paciente)){
                    $user_tipo_paciente = DB::table('user_tipo_paciente')->insert([
                        'tipo_paciente' => 'Particular',
                        'cat_empresa_id' => NULL,
                        'autorizado_por_id' => NULL,
                        'cat_aseguradora_id' => NULL,
                        'value1' =>  NULL,
                        'value2' =>  NULL,
                        'user_id' => $value->user_id,
                        'user_id_medico' => Auth::id(),
                        'user_cuest_episodio_id' => $value->episodio,
                        'created_at' => new DateTime()
                    ]);
                }else{
                    $model[$key]->user_tipo_paciente =$user_tipo_paciente;
                }

                //SERVICIO EMERGENCIA
                $temp = DB::select("
                    SELECT *
                    FROM servicio_emergencia
                    WHERE user_cuest_episodio_id = ".$value->episodio."
                    LIMIT 1
                ",[]);
                if(count($temp) > 0){
                    $model[$key]->servicio_emergencia = $temp[0];
                    if ($model[$key]->servicio_emergencia->value == 1) {
                        $model[$key]->servicio_emergencia->description = "Walk in A";
                        $model[$key]->servicio_emergencia->color = "info";
                    }
                    if ($model[$key]->servicio_emergencia->value == 2) {
                        $model[$key]->servicio_emergencia->description = "Walk in A +";
                        $model[$key]->servicio_emergencia->color = "info";
                    }
                    if ($model[$key]->servicio_emergencia->value == 3) {
                        $model[$key]->servicio_emergencia->description = "Walk in B";
                        $model[$key]->servicio_emergencia->color = "success";
                    }
                    if ($model[$key]->servicio_emergencia->value == 4) {
                        $model[$key]->servicio_emergencia->description = "Walk in B +";
                        $model[$key]->servicio_emergencia->color = "success";
                    }
                    if ($model[$key]->servicio_emergencia->value == 5) {
                        $model[$key]->servicio_emergencia->description = "No Walk in";
                        $model[$key]->servicio_emergencia->color = "secondary";
                    }
                    if ($model[$key]->servicio_emergencia->value == 6) {
                        $model[$key]->servicio_emergencia->description = "E. Conv.";
                        $model[$key]->servicio_emergencia->color = "gray";
                    }

                }

            }
            else{
                $model[$key]->ubicacion = $model[$key]->ubicacion_alta;
            }
        }
        //dd($model);
        return $model;
    }
    public function paciente_covid($area)
    {
        $model = DB::select("CALL paciente_covid_area('".$area."');", [1]);
       // dd($model);
        foreach ($model as $key => $value) {
            $model[$key]->total_episodios = UserCuestEpisodio::totalEpisodios($value->user_id);
            $model[$key]->traslado_ambulancia = NULL;
            $model[$key]->vip = 0;
            $model[$key]->vip_description = NULL;
            $model[$key]->alert = 3;
            $model[$key]->alert_description = NULL;
            $model[$key]->resbalar = 3;
            $model[$key]->resbalar_description = NULL;
            $model[$key]->cirugia = 1;
            $model[$key]->cirugia_description = NULL;
            if (
                $value->cat_user_ubicacion_id != 246 &&
                $value->cat_user_ubicacion_id != 247 &&
                $value->cat_user_ubicacion_id != 248 &&
                $value->cat_user_ubicacion_id != 249 &&
                $value->cat_user_ubicacion_id != 251

                ) {

                $temp = UserCuestMedicoPaciente::show($value->user_id);

                $model[$key]->medico_paciente = $temp;
                if (!empty($value->episodio)) {
                    $temp = DB::select("
                        SELECT
                            id,
                            value,
                            privado,
                            active,
                            coments,
                            created_at AS created_at_default,
                            DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                            DATE_FORMAT(created_at, '%h:%i %p') AS hora
                            FROM user_cuest_pendiente AS tabla
                            WHERE tabla.user_id = ".$value->user_id."
                            AND tabla.user_cuest_episodio_id = ".$value->episodio."
                    ", [1]);
                    $model[$key]->pendiente = $temp;
                }else{
                    $model[$key]->pendiente = [];
                }
                //$model[$key]->vip = UserVip::show($value->user_id);
                $traslado_ambulancia = UserTrasladoAmbulancia::where("user_cuest_episodio_id",$value->episodio)->first();
                $model[$key]->traslado_ambulancia = $traslado_ambulancia;

                $vip = UserVip::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();

                $model[$key]->vip = isset($vip->value) ?$vip->value:NULL;
                $model[$key]->vip_description = isset($vip->description) ?$vip->description:NULL;

                $alert = UserCuestAlert::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->alert = isset($alert->value) ?$alert->value:NULL;
                $model[$key]->alert_description = isset($alert->description) ?$alert->description:NULL;

                $resbalar = UserCuestResbalar::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->resbalar = isset($resbalar->value) ?$resbalar->value:NULL;
                $model[$key]->resbalar_description = isset($resbalar->description) ?$resbalar->description:NULL;

                $cirugia = UserCuestRiesgoQuirurgico::where("user_cuest_episodio_id",$value->episodio)->where("active",1)->orderBy("id","DESC")->select('description','value')->first();
                $model[$key]->cirugia = isset($cirugia->value) ?$cirugia->value:NULL;
                $model[$key]->cirugia_description = isset($cirugia->description) ?$cirugia->description:NULL;


                try {
                    $prealta = UserCuestEpisodio::show($value->user_id)->pre_alta;
                } catch (\Throwable $th) {
                    dd($value->user_id);
                }

                $prealta =  !is_null($prealta) ? (new DateTime($prealta))->format('Y-m-d') : $prealta ;
                $model[$key]->prealta = $prealta;
                $model[$key]->prealta_color  = "info";
                if (!is_null($prealta)) {
                    date_default_timezone_set("America/Caracas");
                    $hoy = date("Y-m-d");
                    $fechaAnterior = (new DateTime($prealta))->format('Y-m-d');
                    $fecha1= new DateTime($hoy);
                    $fecha2= new DateTime($fechaAnterior);
                    $diff = $fecha1->diff($fecha2);


                    if ($diff->days < 0) {
                        $diff->days = 0;
                    }
                    if ($diff->days >= 2) {
                        $model[$key]->prealta_color = "success";
                    }
                    if ($diff->days == 1) {
                        $model[$key]->prealta_color = "warning";
                    }
                    if ($diff->days == 0) {
                        $model[$key]->prealta_color = "danger";
                    }
                }


                $temp = UserCuestHistoriaMedica::getHistorial($value->user_id);
                $model[$key]->resultados = $temp;
            }
        }
        //dd($model);
        return $model;
    }
    public function paciente_especialidad($cat_user_especialidad_id)
    {
        return Response()->json(DB::select("CALL paciente_covid_especialidad(".$cat_user_especialidad_id.");", [1]));
    }
    public function medico_paciente($medico_id)
    {
        return Response()->json(DB::select("CALL paciente_covid_medico(".$medico_id.");", [1]));
    }


    public function pacientesConEpisodioActivo($area)
    {
        //$model = DB::select("CALL paciente_covid_area('".$area."');", [1]);
        $model = $this->list_active_patients($area);
        dd($model);
        foreach ($model as $key => $value) {
            $model[$key]->total_episodios = UserCuestEpisodio::totalEpisodios($value->user_id);

            if (
                $value->cat_user_ubicacion_id != 246 &&
                $value->cat_user_ubicacion_id != 247 &&
                $value->cat_user_ubicacion_id != 248 &&
                $value->cat_user_ubicacion_id != 249 &&
                $value->cat_user_ubicacion_id != 251

                ) {

                $temp = UserCuestMedicoPaciente::show($value->episodio_id);
                $model[$key]->medico_paciente = $temp;

                //PENDIENTES DEL PACIENTE
                $model[$key]->t_pendiente = 0;
                if (!empty($value->episodio_id)) {
                    $temp = DB::select("
                        SELECT
                            id,
                            value,
                            privado,
                            active,
                            coments,
                            created_at AS created_at_default,
                            DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at,
                            DATE_FORMAT(created_at, '%h:%i %p') AS hora
                            FROM user_cuest_pendiente AS tabla
                            WHERE tabla.user_id = ".$value->user_id."
                            AND tabla.user_cuest_episodio_id = ".$value->episodio_id."
                    ", [1]);
                    $model[$key]->pendiente = $temp;
                }else{
                    $model[$key]->pendiente = [];
                }
                $vip = UserVip::where("user_cuest_episodio_id",$value->user_id)->where("active",1)->select('description','value')->first();

                $model[$key]->vip = isset($vip->value) ?$vip->value:NULL;
                $model[$key]->vip_description = isset($vip->description) ?$vip->description:NULL;

                $alert = UserCuestAlert::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->alert = isset($alert->value) ?$alert->value:NULL;
                $model[$key]->alert_description = isset($alert->description) ?$alert->description:NULL;

                $resbalar = UserCuestResbalar::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->resbalar = isset($resbalar->value) ?$resbalar->value:NULL;
                $model[$key]->resbalar_description = isset($resbalar->description) ?$resbalar->description:NULL;

                $cirugia = UserCuestRiesgoQuirurgico::where("user_id_paciente",$value->user_id)->where("active",1)->select('description','value')->first();
                $model[$key]->cirugia = isset($cirugia->value) ?$cirugia->value:NULL;
                $model[$key]->cirugia_description = isset($cirugia->description) ?$cirugia->description:NULL;


                try {
                    $prealta = UserCuestEpisodio::show($value->user_id)->pre_alta;
                } catch (\Throwable $th) {
                    dd($value->user_id);
                }

                $prealta =  !is_null($prealta) ? (new DateTime($prealta))->format('Y-m-d') : $prealta ;
                $model[$key]->prealta = $prealta;
                $model[$key]->prealta_color  = "info";
                if (!is_null($prealta)) {
                    date_default_timezone_set("America/Caracas");
                    $hoy = date("Y-m-d");
                    $fechaAnterior = (new DateTime($prealta))->format('Y-m-d');
                    $fecha1= new DateTime($hoy);
                    $fecha2= new DateTime($fechaAnterior);
                    $diff = $fecha1->diff($fecha2);


                    if ($diff->days < 0) {
                        $diff->days = 0;
                    }
                    if ($diff->days >= 2) {
                        $model[$key]->prealta_color = "success";
                    }
                    if ($diff->days == 1) {
                        $model[$key]->prealta_color = "warning";
                    }
                    if ($diff->days == 0) {
                        $model[$key]->prealta_color = "danger";
                    }
                }


                $temp = UserCuestHistoriaMedica::getHistorial($value->user_id);
                $model[$key]->resultados = $temp;
            }
        }
        //dd($model);
        return $model;
    }

}
