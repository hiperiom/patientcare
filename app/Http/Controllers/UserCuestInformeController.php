<?php

namespace App\Http\Controllers;

use App\Models\UserCuestInforme;
use Illuminate\Http\Request;

use App\Models\UserCuestEpisodio;
use App\Models\UserCuestTemperatura;
use App\Models\UserCuestOximetria;
use App\Models\UserCuestFc;
use App\Models\UserCuestFr;
use App\Models\UserCuestTa;
use App\Models\UserCuestGlic;
use App\Models\UserCuestPeso;
use App\Models\UserTalla;
use App\Models\UserCuestTac;
use App\Models\UserCuestSintoma;
use App\Models\UserCuestMonitoreo;
use App\Models\CatUserCuestionario;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\MotivoConsulta;
use App\Models\EnfermedadActual;
use App\Models\UserCuestAntecedente;
use App\Models\UserCondicionMedica;
use App\Models\UserAlergia;
use App\Models\UserCuestMedicamento;
use App\Models\UserCuestPlan;
use App\Models\UserCuestRecipe;
use App\Models\ExamenFisico;
use App\Models\UserProfile;
use App\Models\CentroSalud;
use App\Models\UserCita;
use App\Models\UserTipoDocumento;
use App\Models\CatTipoDocumento;
use App\Models\UserCuestEvolucion;
use App\Models\UserCuestOrdenMedica;
use App\Models\UserCuestEstudio;
use Illuminate\Support\Facades\Auth;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Support\Facades\DB;



class UserCuestInformeController extends Controller
{
    public function index(Request $request)
    {
        return UserCuestInforme::index($request);
    }
    public function store(Request $request)
    {
        return UserCuestInforme::store($request);
    }
    public function show(Request $request)
    {
        return UserCuestInforme::show($request->user_cuest_informe_id);
    }
    public function destroy(Request $request)
    {
        return UserCuestInforme::eliminar($request);
    }
    public function hospitalizacion_egresados($fecha_inicio,$fecha_fin="CURDATE()")
    {
        $model = DB::select("
            SELECT
                DISTINCT user_profile.cedula AS 'CEDULA',
                CASE
                WHEN user.email LIKE '%@%'
                THEN user.email
                ELSE ''
                END AS 'CORREO',
                cat_user_ubicacion.description AS 'AREA',
                cat_user_ubicacion.coments AS 'HABITACION',
                user_profile.nombres AS 'NOMBRES',
                user_profile.apellidos AS 'APELLIDOS',
                user_profile.telefono_movil AS 'TELEFONO',
                user_cuest_episodio.egreso 'FECHA_EGRESO'
            FROM user_cuest_episodio
            INNER JOIN user_profile ON user_cuest_episodio.user_id = user_profile.user_id
            INNER JOIN cat_user_ubicacion ON user_cuest_episodio.cat_user_ubicacion_id = cat_user_ubicacion.id
            INNER JOIN user ON user_cuest_episodio.user_id = user.id
            WHERE user_cuest_episodio.egreso BETWEEN '".$fecha_inicio."' AND ".$fecha_fin."
            AND user_cuest_episodio.egreso NOT BETWEEN '2023-07-02 23:59:59' AND '2023-07-03 06:00:00'
            AND user_cuest_episodio.cat_user_ubicacion_id IN(42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,358,359,360,361,362,363)
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

            ORDER BY user_cuest_episodio.egreso DESC
        ",[]);

        //dd($model);
        return view("reportes.reporte_hospitalizacion_egresados",compact('model'));
    }
    public function evoluciones_ramh()
    {
        $model = DB::select("
            SELECT

                distinct user_medico_posicion.user_id AS 'USER_ID',
                user_profile.nombres AS 'NOMBRES',
                user_profile.apellidos AS 'APELLIDOS',
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 1
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `ENERO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 2
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `FEBRERO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 3
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `MARZO`,

                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 4
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `ABRIL`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 5
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `MAYO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 6
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `JUNIO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 7
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `JULIO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 8
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `AGOSTO`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 9
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `SEPTIEMBRE`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 10
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `OCTUBRE`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 11
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `NOVIEMBRE`,
                (
                    SELECT
                        count(*)
                    FROM user_cuest_evolucion
                    WHERE user_cuest_evolucion.user_id_medico = user_medico_posicion.user_id
                    AND MONTH( user_cuest_evolucion.created_at ) = 12
                    AND YEAR( user_cuest_evolucion.created_at ) = YEAR( CURDATE() )
                ) AS `DICIEMBRE`


                FROM user_medico_posicion
                INNER JOIN user_profile on user_medico_posicion.user_id = user_profile.user_id
                JOIN user on user_medico_posicion.user_id = user.id
                JOIN user_type on user_medico_posicion.user_id = user_type.user_id

                WHERE user_medico_posicion.cat_user_medico_posicion_id = 9
                AND user_medico_posicion.active = 1
                AND user.active = 1
                AND user_type.cat_user_type_id = 2
                ORDER BY `ENERO`  DESC
        ",[]);

        //dd($model);
        return view("reportes.reporte_egresos_ramh",compact('model'));
    }
    public function reporte_consulta(
        $objeto,
        $episodio_id,
        $model_id,
        $print,
        $nombre_reporte
    ){




        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $model = [
            "NOMBREREPORTE"=> $nombre_reporte,
            "LOGO"=>"logo-informe-bw.png",
            "EPISODIO"=>NULL,
            "FECHA_IMPRESION"=>NULL,
            "USER"=>NULL,
            "DATA"=>NULL,
            "CENTRO_SALUD"=>NULL,
        ];


        /* $model['EPISODIO'] = UserCuestEpisodio::where("id",$episodio_id)
            ->select(
                "user_cuest_episodio.*",
                DB::raw("DATE_FORMAT(user_cuest_episodio.ingreso, '%d/%m/%Y') AS ingreso")
            )
            ->first();

        if (is_null($model['EPISODIO'])) {
            return "El episodio no es valido";
        }

        $model['EPISODIO'] = $model['EPISODIO']->toArray();

        $model["FECHA_IMPRESION"] =date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y");

        $model['USER'] = User::where("user.id",$model['EPISODIO']['user_id'])
                ->join("user_profile","user.id","user_profile.user_id")
                ->leftJoin("user_cuest_direction","user.id","user_cuest_direction.user_id")
                ->leftJoin("cat_estado","user_cuest_direction.cat_estado_id","cat_estado.id")
                ->leftJoin("cat_municipio","user_cuest_direction.cat_municipio_id","cat_municipio.id")
                ->select(
                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'PACIENTE'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    DB::raw("
                        CASE
                            WHEN user_profile.fnacimiento IS NULL THEN ''
                            ELSE  DATE_FORMAT(user_profile.fnacimiento, '%d/%m/%Y')
                        END AS 'NACIMIENTO'
                    "),
                    DB::raw("
                        user_profile.telefono_movil AS 'TELEFONO'
                    "),
                    DB::raw("
                        YEAR(CURDATE())-YEAR(user_profile.fnacimiento) AS 'EDAD'
                    "),
                    DB::raw("

                        CONCAT(
                            cat_estado.description,
                            ', ',
                            cat_municipio.description,
                            CASE
                                WHEN
                                    user_cuest_direction.description IS NOT NULL THEN CONCAT( user_cuest_direction.description,', ' )
                                ELSE ''
                            END,
                            CASE
                                WHEN
                                    user_cuest_direction.domicilio IS NOT NULL THEN user_cuest_direction.domicilio
                                ELSE ''
                            END

                        ) AS 'DIRECTION'
                    ")

                )
                ->first();
                if (is_null($model['USER'])) {
                    return 'Datos de usuario imcompletos';
                }
        $model['USER'] = $model['USER']->toArray();

        $model['DATA'] = $objeto::where("user_medico_posicion.active",1)
            ->join("user_profile",$objeto->getTable().".user_id_medico","user_profile.user_id")
            ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
            ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
            ->leftJoin("user_medico_posicion","user_profile.user_id","user_medico_posicion.user_id")
            ->leftJoin("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
            ->select(
                DB::raw("
                    CONCAT(
                        CASE
                            WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                            ELSE ''
                        END,
                        ' ',
                        user_profile.nombres,
                        ' ',
                        user_profile.apellidos
                    ) AS 'MEDICO'
                "),
                DB::raw("
                    CASE
                        WHEN cat_user_medico_posicion.id IN(1) THEN 'TR'
                        WHEN cat_user_medico_posicion.id IN(2) THEN 'IN'
                        WHEN cat_user_medico_posicion.id IN(3,4) THEN 'FE'
                        WHEN cat_user_medico_posicion.id IN(5,6,7,8) THEN 'RE'
                        WHEN cat_user_medico_posicion.id IN(9) THEN 'RA'
                        WHEN cat_user_medico_posicion.id IN(10) THEN 'EN'
                        ELSE NULL END AS medico_posicion_siglas
                "),
                DB::raw("
                    CASE
                        WHEN cat_user_medico_posicion.id IN(1) THEN 'success'
                        WHEN cat_user_medico_posicion.id IN(2) THEN 'info'
                        WHEN cat_user_medico_posicion.id IN(3,4) THEN 'orange'
                        WHEN cat_user_medico_posicion.id IN(5,6,7,8) THEN 'secondary'
                        WHEN cat_user_medico_posicion.id IN(9) THEN 'purple'
                        WHEN cat_user_medico_posicion.id IN(10) THEN 'warning'
                        ELSE NULL END AS medico_posicion_color
                "),
                "cat_user_medico_posicion.id AS posicion_id",
                "cat_user_medico_posicion.description AS posicion",
                DB::raw("
                    CONCAT(
                        user_profile.nacionalidad,
                        '-',
                        FORMAT(user_profile.cedula, 0, 'de_DE')
                    ) AS 'CEDULA'
                "),

                "user_profile.firma",
                "user_profile.sello",
                $objeto->getTable().".*",

                "cat_user_especialidad.description AS especialidad"
            );

        if($model_id != "all"){
            $model['DATA'] =  $model['DATA']->where($objeto->getTable().".id", $model_id )->orderBy($objeto->getTable().".id","DESC")->get();
        }else{
            $model['DATA'] =  $model['DATA']->where($objeto->getTable().".user_cuest_episodio_id",$episodio_id)->orderBy($objeto->getTable().".user_cuest_episodio_id","DESC")->get();
        }

        $model['DATA'] = $model['DATA']->toArray();
        $model["CENTRO_SALUD"] = CentroSalud::where("id",1)->first()->toArray(); */

        return $model;
    }
    public function tipo_informe($nombre_documento)
    {
        $cat_informe = [];
        $cat_informe["signos_vitales"] = "Registro de Enfermeria - Signos vitales";
        $cat_informe["evolucion_medica"] = "Notas de Evolucion";
        $cat_informe["ingreso_emergencia"] = "Ingreso Emergencias";
        $cat_informe["ingreso_hospitalizacion"] = "Ingreso Hospitalización";
        $cat_informe["orden_medica"] = "Ordenes Medicas";
        $cat_informe["interconsulta"] = "Interconsulta";
        $cat_informe["nota_traslado"] = "Nota de Traslado";
        $cat_informe["estudio_cardiologico"] = "Estudio Cardiológico";
        $cat_informe["evaluacion_preoperatoria"] = "Evaluación preoperatoria";
        $cat_informe["procedimiento_medico"] = "Procedimiento Médico";
        $cat_informe["egreso_emergencia"] = "Informe de Egreso de Emergencia";
        $cat_informe["egreso_hospitalizacion"] = "Informe de Egreso de Hospitalización";
        $cat_informe["recipe_medico"] = "Recipe Medico";

        return $cat_informe[ $nombre_documento ];
    }
    public function datosEpisodio($episodio_id)
    {
        return UserCuestEpisodio::where("user_cuest_episodio.id",$episodio_id)
            ->where("ucu.active",1)
            ->join("user_cuest_ubicacion as ucu","user_cuest_episodio.id","ucu.user_cuest_episodio_id")
            ->join("cat_user_ubicacion as cuu","ucu.cat_user_ubicacion_id","cuu.id")
            ->join("user","user_cuest_episodio.user_id","user.id")
            ->join("user_profile AS up","user_cuest_episodio.user_id","up.user_id")

            ->select(
                DB::raw("user_cuest_episodio.id AS episodio_id"),
                DB::raw("user_cuest_episodio.user_id AS user_id_paciente"),
                DB::raw("LPAD(user_cuest_episodio.user_id ,7,'0') AS historia_id"),
                DB::raw("
                    CONCAT(
                        cuu.description,
                        ' | ',
                        cuu.coments
                    ) AS ubicacion
                "),
                DB::raw("
                    CONCAT(
                        LPAD(user_cuest_episodio.user_id ,7,'0'),
                        '-',
                        (SELECT count(*) FROM user_cuest_episodio AS uce WHERE uce.user_id = user_cuest_episodio.user_id)
                    )AS episodio_number"
                ),
                "user_cuest_episodio.ingreso",
                "user_cuest_episodio.egreso",
                DB::raw("DATE_FORMAT(user.created_at, '%d/%m/%Y') AS fecha_ingreso_historia"),
                DB::raw("DATE_FORMAT(user_cuest_episodio.ingreso, '%d/%m/%Y') AS fecha_ingreso_episodio"),
                DB::raw("CONCAT(up.apellidos,' ',up.nombres) AS paciente"),
                DB::raw("
                    CONCAT(
                        up.nacionalidad,
                        up.cedula
                    ) AS cedula
                "),
                "up.nombres",
                "up.apellidos",
                DB::raw("DATE_FORMAT(up.fnacimiento, '%d/%m/%Y') AS fecha_nacimiento"),
                DB::raw("(
                    TIMESTAMPDIFF(YEAR, up.fnacimiento, CURDATE())
                ) AS edad")


            )
            ->first()
            ->toArray();
    }
    public function limpiarCadena($cadena) {

        // Elimina etiquetas HTML y PHP de la cadena
        //$cadena = strip_tags($cadena);

        // Elimina caracteres especiales y formatos no deseados
        $cadena = htmlspecialchars($cadena);

        // Puedes agregar más procesamiento aquí según tus necesidades
        // Reemplaza <br> por saltos de línea
        $cadena = str_replace( "\r\n","<br>", $cadena);
        $cadena = str_replace( "<br><br>","<br>", $cadena);
        $cadena = str_replace( "&gt;",">", $cadena);
        $cadena = str_replace( "&lt;","<", $cadena);
        $cadena = str_replace( "&le;","≤", $cadena);
        $cadena = str_replace( "&ge;","≥", $cadena);

        return explode("<br>", $cadena);;
    }
    public function evolucion_medica(
        $nombre_documento,
        $episodio_id,
        $item_id
    ){
        //dd($episodio_id);
        $model = [];  //$this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Probabilidad Diagnóstica");
        $episodio = $this->datosEpisodio($episodio_id);
        $item_medico =  UserCuestEvolucion::where("user_cuest_evolucion.id",$item_id)
                        ->join("user","user_cuest_evolucion.user_id_medico","user.id")
                        ->join("user_profile AS up","user_cuest_evolucion.user_id_medico","up.user_id")
                        //->join("user_medico_posicion AS ump","user_cuest_evolucion.user_id_medico","ump.user_id")
                        //->join("cat_user_medico_posicion AS cmp","ump.cat_user_medico_posicion_id","cmp.id")
                        ->select(
                            DB::raw("up.user_id AS medico_id"),
                            DB::raw("
                                (
                                SELECT cmp.description
                                FROM user_medico_posicion  AS ump
                                LEFT JOIN cat_user_medico_posicion AS cmp ON ump.cat_user_medico_posicion_id = cmp.id
                                WHERE ump.user_id = user_cuest_evolucion.user_id_medico
                                ORDER BY ump.id DESC LIMIT 1
                                ) AS medico_cargo
                            "),

                            //DB::raw("cmp.description AS medico_cargo"),
                            DB::raw("user_cuest_evolucion.id AS item_id"),
                            DB::raw("DATE_FORMAT(user_cuest_evolucion.created_at, '%d/%m/%Y') AS fecha_creacion"),
                            DB::raw("DATE_FORMAT(user_cuest_evolucion.created_at, '%h:%i %p') AS hora_creacion"),

                            DB::raw("
                                CONCAT(
                                    (
                                        CASE
                                            WHEN up.prefijo IS NOT NULL THEN CONCAT(up.prefijo,' ')
                                        ELSE ''
                                        END
                                    ),
                                    up.nombres,
                                    ' ',
                                    up.apellidos
                                ) AS medico
                            "),
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.cedula IS NOT NULL THEN CONCAT( up.nacionalidad, FORMAT(up.cedula, 0, 'de_DE') )
                                    ELSE ''
                                    END
                                ) AS cedula
                            "),
                            "up.colegio_medico",
                            "up.mpps",
                            "up.firma",
                            "up.sello",
                            "up.nombres",
                            "up.apellidos",
                            "up.genero",
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.prefijo IS NOT NULL THEN up.prefijo
                                    ELSE ''
                                    END
                                ) AS prefijo
                            "),
                            //"user_cuest_evolucion.*",
                            "user_cuest_evolucion.value",
                            "user_cuest_evolucion.subjetivo",
                            "user_cuest_evolucion.objetivo",
                            "user_cuest_evolucion.analisis",
                            "user_cuest_evolucion.diagnostico",
                            "user_cuest_evolucion.plan",
                            DB::raw("user_cuest_evolucion.coments AS comentarios"),
                            DB::raw("DATE_FORMAT(up.fnacimiento, '%d/%m/%Y') AS fecha_nacimiento"),
                            DB::raw("YEAR(CURDATE())-YEAR(up.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(up.fnacimiento,'%m-%d'), 0 , -1 ) AS edad")
                        )
                        ->first()
                        ->toArray();



        $model = $episodio;
        $model['NOMBRE_DOCUMENTO'] = $nombre_documento;
        $model['TITULO_DOCUMENTO'] = $this->tipo_informe($nombre_documento) ;
        $item_medico['value'] = $this->limpiarCadena($item_medico['value']);
        //dd($item_medico);
        $model['ITEM_MEDICO']=$item_medico;

        $pdf = PDF::loadView('pdf.'.$model['NOMBRE_DOCUMENTO'],["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream($model['NOMBRE_DOCUMENTO'].".pdf");
    }
    function diasTranscurridos($ingreso,$egreso) {
        // Convertir la fecha dada a un objeto DateTime
        $fechaInicio = new DateTime($ingreso);

        // Obtener la fecha actual como un objeto DateTime
        $fechaActual = new DateTime();
        if (!is_null($egreso)) {
            $fechaActual = $egreso;
        }
        // Calcular la diferencia entre las dos fechas
        $intervalo = $fechaInicio->diff($fechaActual);

        // Obtener el número total de días transcurridos
        $totalDias = $intervalo->days;

        $dias = [];

        // Número total de días que deseas sumar
        $numDias = 30;

        // Obtener la fecha actual
        $fechaActual = date("Y-m-d");

        // Sumar el número de días a la fecha actual
        $fechaFutura = date("Y-m-d", strtotime($ingreso . " +$numDias days"));

        return [
            'total_dias'=>$totalDias,
            'dias'=>$dias,
        ] ;
    }
    public function getFechasRangoReportes($datos){

        /* Para extraer un nuevo array solo con fechas únicas a partir de la propiedad created_at del array dado en PHP,
        puedes utilizar un bucle para recorrer el array original y
        construir un nuevo array que contenga solo las fechas únicas. Aquí tienes cómo hacerlo: */


        // Array original


        // Array para almacenar las fechas únicas
        $fechasUnicas = [];

        // Recorremos el array original
        foreach ($datos as $dato) {
            // Obtenemos la fecha de cada elemento
            $fecha = substr($dato['created_at'], 0, 10); // Extraemos solo la fecha (YYYY-MM-DD)

            // Verificamos si la fecha ya existe en el array de fechas únicas
            if (!in_array($fecha, $fechasUnicas)) {
                // Si la fecha no existe, la agregamos al array de fechas únicas
                $fechasUnicas[] = $fecha;
            }
        }
    }

    public function signos_vitales($episodio_id){
        //
        $model = [];  //$this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Probabilidad Diagnóstica");
        $episodio = $this->datosEpisodio($episodio_id);
        $contador = 0;
        //OBTENEMOS TODOS LOS SIGNOS VITLES A MOSTRAR EN EL REPORTE
        $signos = [];
        $signos['peso'] =   UserCuestPeso::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->leftJoin("user_profile","user_cuest_peso.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_peso.user_id_paciente",
                                "user_cuest_peso.toma_nro",
                                "user_cuest_peso.value",
                                "user_cuest_peso.created_at",
                                "user_cuest_peso.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"
                            )
                            ->get();

        $signos['talla'] =  UserTalla::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->leftJoin("user_profile","user_cuest_talla.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_talla.user_id_paciente",
                                "user_cuest_talla.toma_nro",
                                "user_cuest_talla.value",
                                "user_cuest_talla.created_at",
                                "user_cuest_talla.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"

                            )
                            ->get();

        $signos['temp'] =   UserCuestTemperatura::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->where("cat_user_cuestionario_id",84)
                            ->leftJoin("user_profile","user_cuest_monitoreo.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_monitoreo.toma_nro",
                                "user_cuest_monitoreo.value",
                                "user_cuest_monitoreo.created_at",
                                "user_cuest_monitoreo.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos",
                                "user_cuest_monitoreo.user_id"
                            )
                            ->get();
        $signos['fr'] =     UserCuestFr::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->leftJoin("user_profile","user_cuest_fr.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_fr.user_id_paciente",
                                "user_cuest_fr.toma_nro",
                                "user_cuest_fr.value",
                                "user_cuest_fr.created_at",
                                "user_cuest_fr.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"

                            )
                            ->get();
        $signos['fc'] =     UserCuestFc::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->leftJoin("user_profile","user_cuest_fc.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_fc.user_id_paciente",
                                "user_cuest_fc.toma_nro",
                                "user_cuest_fc.value",
                                "user_cuest_fc.created_at",
                                "user_cuest_fc.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"

                            )
                            ->get();

        $signos['ta'] =     UserCuestTa::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->leftJoin("user_profile","user_cuest_ta.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_ta.user_id_paciente",
                                "user_cuest_ta.toma_nro",
                                "user_cuest_ta.value",
                                "user_cuest_ta.value2",
                                "user_cuest_ta.created_at",
                                "user_cuest_ta.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"

                            )
                            ->get();

        $signos['oxi'] =    UserCuestOximetria::where("user_cuest_episodio_id",$episodio['episodio_id'])
                            ->where("cat_user_cuestionario_id",73)
                            ->leftJoin("user_profile","user_cuest_monitoreo.user_id_medico","user_profile.user_id")
                            ->select(
                                "user_cuest_monitoreo.user_id",
                                "user_cuest_monitoreo.toma_nro",
                                "user_cuest_monitoreo.value",
                                "user_cuest_monitoreo.created_at",
                                "user_cuest_monitoreo.user_cuest_episodio_id",
                                "user_profile.prefijo",
                                "user_profile.nombres",
                                "user_profile.apellidos"

                            )
                            ->get();
                            //dd($signos);
        foreach ($signos as $key => $value) {
            if (count($value) > $contador) {
                $contador = count($value);

            }
        }
        foreach ($signos as $key => $value) {
            if (count($value) > 0) {
                $array_sin_nulos = array_filter(array_column($signos[ $key ]->toArray(),'toma_nro'), function($valor) {
                    return $valor !== null;
                });
                if(count($array_sin_nulos) < count($signos[ $key ]->toArray()) ){
                    for ($i=0; $i < count($signos[ $key ]->toArray()) ; $i++) {
                        //dd($signos[ 'temp' ][$i]);
                        $signos[ $key ][$i]->toma_nro = $i+1;
                        $signos[ $key ][$i]->save();
                    }

                    //dd( count($array_sin_nulos) ." ". count($signos[ $key ]) );
                }

            }
        }
        //dd($signos);
        //dd($contador);
        $grupos = [];
        //BUSCAMOS POR CADA FECHA TODOS LOS REGISTROS QUE COINCIDAN PARA CREAR UNA SOLA FILA

        for ($toma_nro=0; $toma_nro < $contador; $toma_nro++) {
            $fechaTaken = true;
            $propName = "talla";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;
            $grupos[$toma_nro]['created_at'] = NULL;
            $grupos[$toma_nro]['medico'] = NULL;

            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if(
                    $signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];

                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }

                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;

                }
            }

            $propName = "peso";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;


            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];

                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;
                }
            }

            $propName = "temp";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;


            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];

                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;

                }
            }

            $propName = "fr";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;


            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];
                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;
                    //$grupos[$toma_nro]['medico'] = NULL;
                }
            }

            $propName = "fc";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;

            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];

                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;
                    //$grupos[$toma_nro]['medico'] = NULL;
                }
            }

            $propName = "ta";
            $grupos[$toma_nro][ $propName ]['value1'] =NULL;
            $grupos[$toma_nro][ $propName ]['value2'] =NULL;


            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value1'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['value2'] = $signos[ $propName ][ $toma_nro ]['value2'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];

                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value1'] = NULL;
                    $grupos[$toma_nro][ $propName ]['value2'] = NULL;
                    //$grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;
                    //$grupos[$toma_nro]['medico'] = NULL;
                }
            }

            $propName = "oxi";
            $grupos[$toma_nro][ $propName ]['value'] =NULL;


            if (count($signos[ $propName ]) > 0 && isset($signos[ $propName ][ $toma_nro ]['toma_nro'])) {
                if($signos[ $propName ][ $toma_nro ]['toma_nro'] === ($toma_nro+1) ){
                    $grupos[$toma_nro][ $propName ]['value'] = $signos[ $propName ][ $toma_nro ]['value'];
                    $grupos[$toma_nro][ $propName ]['created_at'] = $signos[ $propName ][ $toma_nro ]['created_at'];
                    if (is_null($grupos[$toma_nro]['medico'])) {
                        $grupos[$toma_nro]['medico'] = ( is_null($signos[ $propName ][ $toma_nro ]['prefijo']) ? "":$signos[ $propName ][ $toma_nro ]['prefijo']." ").( is_null($signos[ $propName ][ $toma_nro ]['nombres']) ? "":$signos[ $propName ][ $toma_nro ]['nombres']." ").( is_null($signos[ $propName ][ $toma_nro ]['apellidos']) ? "":$signos[ $propName ][ $toma_nro ]['apellidos']." ");
                    }
                    $timestampBusqueda = strtotime($signos[ $propName ][ $toma_nro ]['created_at']);
                    if (is_null($grupos[$toma_nro]['created_at'])) {
                        $grupos[$toma_nro]['created_at'] =  date("d/m/Y g:i:s A", $timestampBusqueda );
                    }
                }else{
                    $grupos[$toma_nro][ $propName ]['value'] = NULL;
                    $grupos[$toma_nro][ $propName ]['created_at'] = NULL;
                    //$grupos[$toma_nro]['created_at'] = NULL;
                    //$grupos[$toma_nro]['medico'] = NULL;
                }
            }
        }

        //dd($grupos);






        $model = $episodio;


        $model['NOMBRE_DOCUMENTO'] = 'signos_vitales';
        $model['TITULO_DOCUMENTO'] = $this->tipo_informe('signos_vitales') ;

        $model['CONTADOR']=$contador;
        $model['DIAS_TRANSCURRIDOS']=$this->diasTranscurridos($episodio['ingreso'],$episodio['egreso']);

        $model['ITEM_MEDICO']=$grupos;
        //dd( $model['ITEM_MEDICO']);
        $pdf = PDF::loadView('pdf.'.$model['NOMBRE_DOCUMENTO'],["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream($model['NOMBRE_DOCUMENTO'].".pdf");
    }

    public function orden_medica(
        $nombre_documento,
        $episodio_id,
        $item_id
    ){
        //dd($episodio_id);
        $model = [];  //$this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Probabilidad Diagnóstica");
        $episodio = $this->datosEpisodio($episodio_id);
        $id = 0;
        $id2 = 1;



        //dd($item_medico);
        $item_medico =UserCuestOrdenMedica::where("user_cuest_orden_medica.id",$item_id)
                        ->join("user","user_cuest_orden_medica.user_id_medico","user.id")
                        ->join("user_profile AS up","user_cuest_orden_medica.user_id_medico","up.user_id")
                        ->join("user_medico_posicion AS ump","user_cuest_orden_medica.user_id_medico","ump.user_id")
                        ->join("cat_user_medico_posicion AS cmp","ump.cat_user_medico_posicion_id","cmp.id")
                        ->select(
                            DB::raw("cmp.description AS medico_cargo"),
                            DB::raw("user_cuest_orden_medica.id AS item_id"),
                            DB::raw("DATE_FORMAT(user_cuest_orden_medica.created_at, '%d/%m/%Y') AS fecha_creacion"),
                            DB::raw("DATE_FORMAT(user_cuest_orden_medica.created_at, '%h:%i %p') AS hora_creacion"),

                            DB::raw("
                                CONCAT(
                                    (
                                        CASE
                                            WHEN up.prefijo IS NOT NULL THEN CONCAT(up.prefijo,' ')
                                        ELSE ''
                                        END
                                    ),
                                    up.nombres,
                                    ' ',
                                    up.apellidos
                                ) AS medico
                            "),
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.cedula IS NOT NULL THEN CONCAT( up.nacionalidad, FORMAT(up.cedula, 0, 'de_DE') )
                                    ELSE ''
                                    END
                                ) AS cedula
                            "),
                            "up.colegio_medico",
                            "up.mpps",
                            "up.firma",
                            "up.sello",
                            "up.nombres",
                            "up.apellidos",
                            "up.genero",
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.prefijo IS NOT NULL THEN up.prefijo
                                    ELSE ''
                                    END
                                ) AS prefijo
                            "),
                            //"user_cuest_orden_medica.*",
                            "user_cuest_orden_medica.value",
                            DB::raw("user_cuest_orden_medica.coments AS comentarios"),
                            DB::raw("DATE_FORMAT(up.fnacimiento, '%d/%m/%Y') AS fecha_nacimiento"),
                            DB::raw("YEAR(CURDATE())-YEAR(up.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(up.fnacimiento,'%m-%d'), 0 , -1 ) AS edad")
                        )
                        ->first()
                        ->toArray();
        //dd($item_medico);
        //$item_medico =json_decode('[{"id":1,"description":"MANTENER EN HOSPITALIZACION A CARGO DE DRA.GOITIA *1586","active":1},{"id":2,"description":"CABECERA DE CAMA 45\u00b0","active":1},{"id":3,"description":"LACTANCIA MATERNA A LIBRE DEMANDA","active":1},{"id":4,"description":"CEFTRIAXONA (100MG\/KG\/DIA) 530 MG VIA INTRAMUSCULAR OD","active":1},{"id":5,"description":"ACETAMINOFEN (JBE120\/5C) (15MG\/KG\/DIA) 3.5CC VIA HORAL SOS FIEBRE TEMP MAYOR A 35.5\u00b0 Y\/O DOLOR CADA 6 HORAS","active":1},{"id":6,"description":"ENTEROGERMINA 1 VIAL VIA ORAL OD","active":1},{"id":7,"description":"CURVA TERMICA CADA 4 HORAS ESCTRICTO Y ANOTAR","active":1},{"id":8,"description":"VIGILAR CONTROL NEUROLOGICO","active":1},{"id":9,"description":"CONTROL DE SIGNOS VITALES","active":1},{"id":10,"description":"AVISAR EVENTUALIDAD","active":1}]');



        $model = $episodio;
        $model['NOMBRE_DOCUMENTO'] = $nombre_documento;
        $model['TITULO_DOCUMENTO'] = $this->tipo_informe($nombre_documento) ;
        $model['ITEM_MEDICO']=$item_medico;

        //dd($model);
        $pdf = PDF::loadView('pdf.'.$model['NOMBRE_DOCUMENTO'],["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream($model['NOMBRE_DOCUMENTO'].".pdf");
    }
    public function recipe_medico(
        $nombre_documento,
        $episodio_id,
        $item_id
    ){
        //dd($episodio_id);
        $model = [];  //$this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Probabilidad Diagnóstica");
        /* $episodio = [
            "episodio_id"=>"",
            "user_id_paciente"=>"",
            "historia_id"=>"",
            "episodio_number"=>"",
            "fecha_ingreso_historia"=>"",
            "fecha_ingreso_episodio"=>"",
            "paciente"=>"",
            "cedula"=>"",
            "nombres"=>"",
            "apellidos"=>"",
            "fecha_nacimiento"=>"",
            "edad"=>"",
            "comentarios"=>"",
        ]; */

        $episodio = $this->datosEpisodio($episodio_id);
        $id = 0;
        $id2 = 1;



        //dd($item_medico);
        //$item_medico =[];
        $item_medico =UserCuestRecipe::where("user_cuest_recipe.id",$item_id)
                        ->join("user","user_cuest_recipe.user_id_medico","user.id")
                        ->join("user_profile AS up","user_cuest_recipe.user_id_medico","up.user_id")
                        ->select(
                            DB::raw("user_cuest_recipe.id AS item_id"),
                            DB::raw("DATE_FORMAT(user_cuest_recipe.created_at, '%d/%m/%Y') AS fecha_creacion"),
                            DB::raw("DATE_FORMAT(user_cuest_recipe.created_at, '%h:%i %p') AS hora_creacion"),

                            DB::raw("
                                CONCAT(
                                    (
                                        CASE
                                            WHEN up.prefijo IS NOT NULL THEN CONCAT(up.prefijo,' ')
                                        ELSE ''
                                        END
                                    ),
                                    up.nombres,
                                    ' ',
                                    up.apellidos
                                ) AS medico
                            "),
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.cedula IS NOT NULL THEN CONCAT( up.nacionalidad, FORMAT(up.cedula, 0, 'de_DE') )
                                    ELSE ''
                                    END
                                ) AS cedula
                            "),
                            "up.colegio_medico",
                            "up.mpps",
                            "up.firma",
                            "up.sello",
                            "up.nombres",
                            "up.apellidos",
                            "up.genero",
                            DB::raw("
                                (
                                    CASE
                                        WHEN up.prefijo IS NOT NULL THEN up.prefijo
                                    ELSE ''
                                    END
                                ) AS prefijo
                            "),
                            //"user_cuest_recipe.*",
                            "user_cuest_recipe.value",
                            DB::raw("user_cuest_recipe.coments AS comentarios"),
                            DB::raw("DATE_FORMAT(up.fnacimiento, '%d/%m/%Y') AS fecha_nacimiento"),
                            DB::raw("YEAR(CURDATE())-YEAR(up.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(up.fnacimiento,'%m-%d'), 0 , -1 ) AS edad")
                        )
                        ->first()
                        ->toArray();




        $model = $episodio;
        $model['NOMBRE_DOCUMENTO'] = $nombre_documento;
        $model['TITULO_DOCUMENTO'] = $this->tipo_informe($nombre_documento) ;
        $model['ITEM_MEDICO']=$item_medico;


        //dd($model);
        $pdf = PDF::loadView('pdf.'.$model['NOMBRE_DOCUMENTO'],["model"=>$model]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream($model['NOMBRE_DOCUMENTO'].".pdf");
    }
}
