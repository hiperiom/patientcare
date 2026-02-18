<?php

namespace App\Http\Controllers;

use App\Models\UserCuestInforme;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestTemperatura;
use App\Models\UserCuestOximetria;
use App\Models\UserCuestFc;
use App\Models\UserCuestFr;
use App\Models\UserCuestTa;
use App\Models\UserCuestGlic;
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
use App\Models\UserCuestObservacion;

use App\Models\UserCuestEstudio;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Mail\MessageReceived;
use App\Mail\MessageRecipe;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function reporte_consulta($objeto,$episodio_id,$model_id,$print,$nombre_reporte)
    {
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $model = [
            "NOMBREREPORTE"=>NULL,
            "version"=>NULL,
            "LOGO"=>NULL,
            "EPISODIO"=>NULL,
            "FECHA_IMPRESION"=>NULL,
            "USER"=>NULL,
            "DATA"=>NULL,
            "CENTRO_SALUD"=>NULL,
        ];

        $model["NOMBREREPORTE"] = $nombre_reporte;
        $model["version"] = $print == "color" ? true : false ;
        $model["LOGO"] = $print == "color" ? config('app.APP_LOGO_VERSION_REPORTS_MONO') : "logo-informe-bw.png" ;

        $model['EPISODIO'] = UserCuestEpisodio::where("id",$episodio_id)
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
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
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
                /* DB::raw("
                    REPLACE(user_cuest_evolucion.value,'\r\n','<br>') AS value
                "), */
                "cat_user_especialidad.description AS especialidad"
            );

        if($model_id != "all"){
            $model['DATA'] =  $model['DATA']->where($objeto->getTable().".id", $model_id )->orderBy($objeto->getTable().".id","DESC")->get();
        }else{
            $model['DATA'] =  $model['DATA']->where($objeto->getTable().".user_cuest_episodio_id",$episodio_id)->orderBy($objeto->getTable().".user_cuest_episodio_id","DESC")->get();
        }

        $model['DATA'] = $model['DATA']->toArray();
        $model["CENTRO_SALUD"] = CentroSalud::where("id",1)->first()->toArray();

        return $model;
    }
    public function reporte_probabilidad_diagnostica($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestImpresionDiagnostica();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Probabilidad Diagnóstica");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_probabilidad_diagnostica.pdf");
    }
    public function reporte_evolucion($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestEvolucion();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Evolución del paciente");


        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_evolución.pdf");
    }
    public function reporte_orden_medica($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestOrdenMedica();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Orden Médica");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_orden_médica.pdf");
    }
    public function reporte_plan($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestPlan();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Plan");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_plan.pdf");
    }
    public function reporte_recipe($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestRecipe();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Récipe");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_recipe.pdf");
    }
    public function reporte_estudio_diagnostico($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestEstudio();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Estudio Diagnóstico");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_estudio_diagnostico.pdf");
    }
    public function reporte_observacion($episodio_id,$model_id,$print)
    {
        $objeto = new UserCuestObservacion();
        $model = $this->reporte_consulta($objeto,$episodio_id,$model_id,$print,"Observación");

        $pdf = PDF::loadView('pdf.reporte_generico_1',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("reporte_observacion.pdf");
    }

    public function informeSeguro($user_id)
    {



        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        //$user_id = $_GET['user_id'];
        try {
            $user = User::where("user.id",$user_id)
                ->leftJoin("user_profile","user.id","user_profile.user_id")
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
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
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
                /* if (is_null($user)) {
                    return 'Datos de usuario imcompletos';
                } */
            $user->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
        $episodio = UserCuestEpisodio::where("user_id",$user_id)
        ->where("active",1)
        ->select(
            DB::raw("
                CASE
                    WHEN ingreso IS NULL THEN ''
                    ELSE  DATE_FORMAT(ingreso, '%d/%m/%Y')
                END AS 'INGRESO_FORMATED'
            "),
            "user_cuest_episodio.*"
        )
        ->orderBy("id","DESC")
        ->first();
        if (is_null($episodio)) {
            return NULL;
        }
        $episodio->toArray();

        $userTipoDocumento =    UserTipoDocumento::where("user_cuest_episodio_id",$episodio['id'])->first();

        if (is_null($userTipoDocumento)) {
            return "<script>alert('Este Informe Preliminar de Emergencia no posee una firma y Sello válido.');window.close()</script>";
        }
        $medico = UserProfile::where("user_profile.user_id",$userTipoDocumento['user_id_medico'])
                    ->leftJoin("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                    ->leftJoin("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                    ->select(

                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'MEDICO'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    "user_profile.*",
                    "cat_user_especialidad.description AS especialidad"
                )
                ->first()
                ->toArray();

        $length = 7;
        $cod_episodio = str_pad($episodio['id'],$length,"0", STR_PAD_LEFT);
        $model["FECHA_INFORME"] =date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y");  //esta fecha debe venir de user cuest informe

        $model["logo"] =config('app.APP_LOGO_VERSION_REPORTS_MONO');


        $model["user"] =$user;
        $model["medico"] =$medico;



        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];
        $model["episodio"]['SIGNOS']['TEMP'] = UserCuestTemperatura::where("user_cuest_episodio_id",$episodio['id'])->where("cat_user_cuestionario_id",84)
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                ' ',
                                                                '°C'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");
        $model["episodio"]['SIGNOS']['OXI'] =   UserCuestOximetria::where("user_cuest_episodio_id",$episodio['id'])->where("cat_user_cuestionario_id",73)
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                ' ',
                                                                '%'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");
        $model["episodio"]['SIGNOS']['FC'] =    UserCuestFc::where("user_cuest_episodio_id",$episodio['id'])
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                ' ',
                                                                'lat/min'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");
        $model["episodio"]['SIGNOS']['FR'] =    UserCuestFr::where("user_cuest_episodio_id",$episodio['id'])
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                ' ',
                                                                'resp/min'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");
        $model["episodio"]['SIGNOS']['GLIC'] =    UserCuestGlic::where("user_cuest_episodio_id",$episodio['id'])
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                ' ',
                                                                'mg/dL'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");

         $model["episodio"]['SIGNOS']['TA'] =    UserCuestTa::where("user_cuest_episodio_id",$episodio['id'])
                                                ->select(
                                                    DB::raw("
                                                        CASE
                                                            WHEN value IS NULL THEN ''
                                                            ELSE  CONCAT(
                                                                value,
                                                                '/',
                                                                value2,
                                                                ' ',
                                                                'mmHg'
                                                            )
                                                        END AS value
                                                    ")
                                                )
                                                ->value("value");
        $model["episodio"]["MOTIVO_CONSULTA"] =MotivoConsulta::where("user_cuest_episodio_id",$episodio['id'])->value('value');  ;
        $model["episodio"]["ENFERMEDAD_ACTUAL"] =EnfermedadActual::where("user_cuest_episodio_id",$episodio['id'])->value('value');
        $model["episodio"]["EXAMEN_FISICO"] = ExamenFisico::where("user_cuest_episodio_id",$episodio['id'])->value('value');
        $model["episodio"]['IMP_DIAG'] =    UserCuestImpresionDiagnostica::where("user_cuest_episodio_id",$episodio['id'])
                                                ->value("value");
        $model["episodio"]["ATENCION_EMERGENCIA"] =$episodio['atencion_emergencia'];
        $model["episodio"]["HOSPITALIZACION"] =$episodio['hospitalizacion'];
        $model["episodio"]["TERAPIA_INTENSIVA"] =$episodio['terapia_intensiva'];
        $model["episodio"]["CASO_TIPO_MEDICO"] =$episodio['caso_tipo_medico'];
        $model["episodio"]["CIRUGIA"] =$episodio['cirugia'];
        $model["episodio"]["NIVEL_TRIAJE"] =$episodio['nivel_triaje'];
        $model["episodio"]["REQUIERE_INTERSONSULTA"] =$episodio['requiere_intersonsulta'];
        $model["episodio"]["REALIZAR_PROCEDIMIENTO"] =$episodio['realizar_procedimiento'];
        $model["episodio"]["CANTIDAD_ESPECIALISTAS"] =$episodio['cantidad_especialistas'];
        $model["episodio"]["PROCEDIMIENTO_COMPLEJIDAD"] =$episodio['procedimiento_complejidad'];



        $model["medico"]['firma'] = file_exists( $userTipoDocumento['firma'] ) ? $userTipoDocumento['firma'] : NULL ;
        $model["medico"]['sello'] = file_exists( $userTipoDocumento['sello'] ) ? $userTipoDocumento['sello'] : NULL ;

        $model["centro_salud"] = CentroSalud::where("id",1)->first()->toArray();

        $pdf = PDF::loadView('pdf.informeSeguro',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("Informe_Preliminar_seguro.pdf");
    }
    public function enviarRecipeByCorreo(
        $centro_salud_id,
        $episodio_id,
        $user_id_medico,
        $user_id_paciente,
        $print
    )
    {
        try {
            if ( config("app.APP_SEND_EMAILS") ) {
                $model = $this->pdf_datos_basicos(
                    $centro_salud_id,
                    $episodio_id,
                    $user_id_medico,
                    $user_id_paciente,
                    $print
                );

                /************ */
                $medico = UserProfile::where("user_profile.user_id", $user_id_medico )
                    ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                    ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                    ->select(

                        DB::raw("
                            CONCAT(
                                user_profile.nombres,
                                ' ',
                                user_profile.apellidos
                            ) AS 'MEDICO'
                        "),
                        DB::raw("
                            CONCAT(
                                user_profile.nacionalidad,
                                '-',
                                FORMAT(user_profile.cedula, 0, 'de_DE')
                            ) AS 'CEDULA'
                        "),
                        "user_profile.*"
                    )
                    ->first()
                    ->toArray();

                    $userTipoDocumento =    UserTipoDocumento::firstOrCreate([
                        "user_cuest_episodio_id"=> $episodio_id,
                        "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Récipe Médico")->value("id"),
                        "active"=>1,
                    ],[
                        "user_cuest_episodio_id"=> $episodio_id,
                        "cat_tipo_documento_id"=> CatTipoDocumento::where("description","Récipe Médico")->value("id"),
                        "user_id_paciente"=>$user_id_paciente,
                        "user_id_medico"=>$user_id_medico,
                        "sello"=>$medico['sello'],
                        "firma"=>$medico['firma'],
                    ]);

                    $model["medico"]['firma'] = file_exists( $userTipoDocumento['firma'] ) ? $userTipoDocumento['firma'] : NULL ;
                    $model["medico"]['sello'] = file_exists( $userTipoDocumento['sello'] ) ? $userTipoDocumento['sello'] : NULL ;

                    $model["centro_salud"] = CentroSalud::where("id",10)->first()->toArray();
                /************ */




                $model["recipes"] =  UserCuestRecipe::where("user_cuest_episodio_id",$episodio_id)->get()->toArray();

                $pdf = PDF::loadView('pdf.recipe',["model"=>$model]);
                $pdf->setPaper('a4', 'landscape');


                $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                $model['subject']= "Récipe médico";

                // if (config("app.APP_TEST_MODE") ) {
                //     $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                //     $model['emails'] = $team_test;
                // }else{
                //     $model['emails'] = $request->email;
                // }
                $paciente = User::where('id',$user_id_paciente)->first();

            if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $model['emails'][0] = $paciente->email;
            }

                Mail::send('emails.recipe', ["model"=>$model], function ($message) use ($model,$pdf) {
                    foreach ($model['emails'] as $key => $correo) {
                        $message->to( $correo )
                        ->subject($model['subject'])
                        ->attachData($pdf->output(), $model['subject'].".pdf");
                    }
                });

            }else{
                //dump("El envio de correos está desabilitado.") ;
            }
        } catch (\Throwable $th) {
         dd($th);
        }

        return Response()->json(true);
    }
    public function enviarRecipeByCorreoCita(
        $user_centro_salud_id,
        $user_cita_id,
        $recipe_num,
        $user_id_paciente,
        $user_id_medico,
        $print
    )
    {
        try {

            $model = $this->pdf_datos_basicos_cita(
                $user_centro_salud_id,
                $user_cita_id,
                $recipe_num,
                $user_id_paciente,
                $user_id_medico,
                $print
            );



            $model["recipes"] =  UserCuestRecipe::where("user_cita_id",$user_cita_id)->where("recipe_num",$recipe_num)->get()->toArray();


            $pdf = PDF::loadView('pdf.recipe',["model"=>$model]);
            $pdf->setPaper('a4', 'landscape');

            $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
            $paciente = User::where('id',$user_id_paciente)->first();

            if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $model['emails'][0] = $paciente->email;
            }

            Mail::send('emails.recipe', ["model"=>$model], function ($message) use ($model, $pdf) {

                foreach ($model['emails'] as $key => $correo) {
                    $message->to( $correo )
                    ->subject("Récipe médico")
                    ->attachData($pdf->output(), "recipe_medico.pdf");
                }
            });

        } catch (\Throwable $th) {
         dd($th);
        }

        return Response()->json(true);
    }
    public function enviarinformeCita($user_centro_salud_id,$user_id_medico,$user_cita_id,$user_id_paciente,$print)
    {
        //dd("aa");
        try {

             $model = $this->pdf_datos_basicos_cita(
                $user_centro_salud_id,
                $user_cita_id,
                1,
                $user_id_paciente,
                $user_id_medico,
                $print
            );


        /*
            $model["recipes"] =  UserCuestRecipe::where("user_cita_id",$user_cita_id)->where("recipe_num",$recipe_num)->get()->toArray();
         */
            $model['app_url'] = config('app.url');
            $model['user_centro_salud'] = CentroSalud::where("id",$user_centro_salud_id)->first()->toArray();
            $model['logo'] = config('app.APP_URL')."image/system/".config('app.APP_LOGO_VERSION_REPORTS_MONO') ;
            // $model['motivo_consulta'] = MotivoConsulta::where("user_cita_id",$user_cita_id)->value("value");
            $model['motivo_consulta'] = UserCita::where("id",$user_cita_id)->value("reason_for_consultation");
            $model['enfermedad_actual'] = EnfermedadActual::where("user_cita_id",$user_cita_id)->value("value");
            $model['examen_fisico'] = ExamenFisico::where("user_cita_id",$user_cita_id)->value("value");
            $model['impresion_diagnostica'] = UserCuestImpresionDiagnostica::where("user_cita_id",$user_cita_id)->value("value");
            $model['plan'] = UserCuestPlan::where("user_cita_id",$user_cita_id)->value("value");
            $model['antecedentes'] = UserCuestAntecedente::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['alergias'] = UserAlergia::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['condicion_medica'] = UserCondicionMedica::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['medicamentos'] = UserCuestMedicamento::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            //dd($model);
            $pdf = PDF::loadView('pdf.informeCita',["model"=>$model]);
            $pdf->setPaper('a4', 'portrait');




             return $pdf->stream("informeCita.pdf");
          /*   if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $model['emails'] = $request->email;
            } */

           /*  Mail::send('emails.recipe', ["model"=>$model], function ($message) use ($model, $pdf) {

                foreach ($model['emails'] as $key => $correo) {
                    $message->to( $correo )
                    ->subject("Récipe médico")
                    ->attachData($pdf->output(), "recipe_medico.pdf");
                }
            }); */

        } catch (\Throwable $th) {
            dd($th);
        }

        return Response()->json(true);
    }
    public function enviarinformeCitaByCorreo($user_centro_salud_id,$user_id_medico,$user_cita_id,$user_id_paciente,$print)
    {
        //dd("aa");
        try {

             $model = $this->pdf_datos_basicos_cita(
                $user_centro_salud_id,
                $user_cita_id,
                1,
                $user_id_paciente,
                $user_id_medico,
                $print
            );


            /*
                $model["recipes"] =  UserCuestRecipe::where("user_cita_id",$user_cita_id)->where("recipe_num",$recipe_num)->get()->toArray();
            */
            $model['app_url'] = config('app.url');
            $model['user_centro_salud'] = CentroSalud::where("id",$user_centro_salud_id)->first()->toArray();
            $model['logo'] = config('app.APP_URL')."image/system/".config('app.APP_LOGO_VERSION_REPORTS_MONO') ;
            // $model['motivo_consulta'] = MotivoConsulta::where("user_cita_id",$user_cita_id)->value("value");
            $model['motivo_consulta'] = UserCita::where("id",$user_cita_id)->value("reason_for_consultation");
            $model['enfermedad_actual'] = EnfermedadActual::where("user_cita_id",$user_cita_id)->value("value");
            $model['examen_fisico'] = ExamenFisico::where("user_cita_id",$user_cita_id)->value("value");
            $model['impresion_diagnostica'] = UserCuestImpresionDiagnostica::where("user_cita_id",$user_cita_id)->value("value");
            $model['plan'] = UserCuestPlan::where("user_cita_id",$user_cita_id)->value("value");
            $model['antecedentes'] = UserCuestAntecedente::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['alergias'] = UserAlergia::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['condicion_medica'] = UserCondicionMedica::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            $model['medicamentos'] = UserCuestMedicamento::where("user_id_paciente",$user_id_paciente)->get()->toArray();
            // dd($model);
            $pdf = PDF::loadView('pdf.informeCita',["model"=>$model]);
            $pdf->setPaper('a4', 'portrait');

            $model['case']=7;
            $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
            $model['subject']= "Informe de Cita Médica";

                if (config("app.APP_TEST_MODE") ) {
                    $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                    $model['emails'] = $team_test;
                }else{
                    $user = User::find($user_id_paciente);
                    // dd($user);
                    // $model['emails'] = $request->email;
                    $model['emails'][0] = $user->email;
                }

                Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model,$pdf) {
                    foreach ($model['emails'] as $key => $correo) {
                        $message->to( $correo )
                        ->subject($model['subject'])
                        ->attachData($pdf->output(), $model['subject'].".pdf");
                    }
                });

             //return $pdf->stream("informeCita.pdf");
          /*   if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $model['emails'] = $request->email;
            } */

           /*  Mail::send('emails.recipe', ["model"=>$model], function ($message) use ($model, $pdf) {

                foreach ($model['emails'] as $key => $correo) {
                    $message->to( $correo )
                    ->subject("Récipe médico")
                    ->attachData($pdf->output(), "recipe_medico.pdf");
                }
            }); */

        } catch (\Throwable $th) {
            dd($th);
        }

        return Response()->json(true);
    }
    public function enviarEstudioByCorreo(
        $centro_salud_id,
        $episodio_id,
        $user_id_medico,
        $user_id_paciente,
        $print
    )
    {
        try {

            $model = $this->pdf_datos_basicos(
                $centro_salud_id,
                $episodio_id,
                $user_id_medico,
                $user_id_paciente,
                $print
            );


            $model["estudios"] =  UserCuestEstudio::where("user_cuest_episodio_id",$episodio_id)->get()->toArray();


            $pdf = PDF::loadView('pdf.estudiodiagnostico',["model"=>$model]);
            $pdf->setPaper('a4', 'portrait');

            $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;

            if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $paciente = User::where('id',$user_id_paciente)->first();
                // $model['emails'] = $request->email;
                $model['emails'][0] = $paciente->email;
            }

            Mail::send('emails.estudio', ["model"=>$model], function ($message) use ($model, $pdf) {

                foreach ($model['emails'] as $key => $correo) {
                    $message->to( $correo )
                    ->subject("Solicitud de Estudio Diagnóstico")
                    ->attachData($pdf->output(), "Solicitud de Estudio Diagnóstico.pdf");
                }
            });

        } catch (\Throwable $th) {
         dd($th);
        }

        return Response()->json(true);
    }
    public function enviarEstudioByCorreoCita(
        $user_centro_salud_id,
        $user_cita_id,
        $estudio_num,
        $user_id_paciente,
        $user_id_medico,
        $print
        )
    {
        try {

            $model = $this->pdf_datos_basicos_cita(
                $user_centro_salud_id,
                $user_cita_id,
                $estudio_num,
                $user_id_paciente,
                $user_id_medico,
                $print
            );



            $model["estudios"] =  UserCuestEstudio::where("user_cita_id",$user_cita_id)->where("estudio_num",$estudio_num)->get()->toArray();


            $pdf = PDF::loadView('pdf.estudiodiagnostico',["model"=>$model]);
            $pdf->setPaper('a4', 'portrait');

            $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;

            if (config("app.APP_TEST_MODE") ) {
                $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                $model['emails'] = $team_test;
            }else{
                $user = User::find($user_id_paciente);
                $model['emails'][0] = $user->email;
            }

            Mail::send('emails.estudio', ["model"=>$model], function ($message) use ($model, $pdf) {

                foreach ($model['emails'] as $key => $correo) {
                    $message->to( $correo )
                    ->subject("Solicitud de Estudio Diagnóstico")
                    ->attachData($pdf->output(), "Solicitud de Estudio Diagnóstico.pdf");
                }
            });

        } catch (\Throwable $th) {
         dd($th);
        }

        return Response()->json(true);
    }
    public function pdf_datos_basicos(
        $centro_salud_id,
        $episodio_id,
        $user_id_medico,
        $user_id_paciente,
        $print
    )
    {
        $user_id =$user_id_paciente;
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $model['version']= $print=="color"?true:false;
        $model['logoSystemVersion']= $model['version'] ? config('app.APP_LOGO_VERSION_REPORTS_COLOR') : config('app.APP_LOGO_VERSION_REPORTS_MONO');

        $user = User::where("user.id",$user_id)
                ->join("user_profile","user.id","user_profile.user_id")
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
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
                    "),
                    "user.email"
                )
                ->first()->toArray();
        if (is_null($user)) {
            return 'Datos de usuario imcompletos';
        }

        $medico = UserProfile::where("user_profile.user_id",$user_id_medico)

                    ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                    ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                    ->select(

                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'MEDICO'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    DB::raw("
                        cat_user_especialidad.description AS medico_especialidad
                    "),
                    "user_profile.*"
                )
                ->first()->toArray();
        if (is_null($medico)) {
            return 'Datos de médico imcompletos';
        }


        $centro_salud = CentroSalud::where("id",$centro_salud_id)->first();

        $medico['user_centro_salud_nombre'] = $centro_salud->description;
        $medico['user_centro_salud_direccion'] = $centro_salud->coments;

        $episodio = UserCuestEpisodio::where("id",$episodio_id)
                ->select(
                    DB::raw("
                        CASE
                            WHEN ingreso IS NULL THEN ''
                            ELSE  DATE_FORMAT(ingreso, '%d/%m/%Y')
                        END AS 'INGRESO_FORMATED'
                    "),
                    "user_cuest_episodio.*"
                )
                ->first()
                ->toArray();
                $length = 7;
        $cod_episodio = str_pad($episodio['id'],$length,"0", STR_PAD_LEFT);
        $model["FECHA_INFORME"] =  strtolower( date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y") );  //esta fecha debe venir de user cuest informe



        $model["user"] =$user;
        $model["medico"] =$medico;
        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];
        return $model;
    }
    public function pdf_datos_basicos_cita(
        $user_centro_salud_id,
        $user_cita_id,
        $recipe_num,
        $user_id_paciente,
        $user_id_medico,
        $print
    )
    {
        $user_id =$user_id_paciente;
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $model['version']= $print=="color"?true:false;
        $model['logoSystemVersion']= $model['version'] ? config('app.APP_LOGO_VERSION_REPORTS_COLOR') : config('app.APP_LOGO_VERSION_REPORTS_MONO');

        $user = User::where("user.id",$user_id_paciente)

                ->join("user_profile","user.id","user_profile.user_id")
                ->leftJoin("user_cuest_direction","user_profile.user_id","user_cuest_direction.user_id")
                ->leftJoin("cat_estado","user_cuest_direction.cat_estado_id","cat_estado.id")
                ->leftJoin("cat_municipio","user_cuest_direction.cat_municipio_id","cat_municipio.id")
                ->select(
                    DB::raw("
                        user_profile.imagen AS 'IMAGE_PACIENTE'
                    "),
                    DB::raw("
                        CONCAT(
                            cat_estado.description,
                            ', ',
                            cat_municipio.description,
                            ', ',
                            user_cuest_direction.description,
                            ', ',
                            user_cuest_direction.domicilio
                        ) AS 'DIRECTION'
                    "),
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
                        UPPER(user_profile.genero) AS 'GENERO'
                    "),
                    DB::raw("
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
                    "),
                    "user.email"
                )
                ->first()
                ->toArray();
        if (is_null($user)) {
            return 'Datos de usuario imcompletos';
        }

        $medico = UserProfile::where("user_profile.user_id",$user_id_medico)

                ->leftJoin("user_cuest_direction","user_profile.user_id","user_cuest_direction.user_id")
                ->leftJoin("cat_estado","user_cuest_direction.cat_estado_id","cat_estado.id")
                ->leftJoin("cat_municipio","user_cuest_direction.cat_municipio_id","cat_municipio.id")
                ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                ->select(

                    DB::raw("
                        CONCAT(
                            cat_estado.description,
                            ', ',
                            cat_municipio.description,
                            ', ',
                            user_cuest_direction.description,
                            ', ',
                            user_cuest_direction.domicilio
                        ) AS 'DIRECTION'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'MEDICO'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    DB::raw("
                        cat_user_especialidad.description AS medico_especialidad
                    "),
                    "user_profile.*"
                )
                ->first()
                ->toArray();
        if (is_null($medico)) {
            return 'Datos de médico imcompletos';
        }


        $centro_salud = CentroSalud::where("id", $user_centro_salud_id )->first();

        $medico['user_centro_salud_nombre'] = $centro_salud->description;
        $medico['user_centro_salud_direccion'] = $centro_salud->coments;

        $episodio = UserCita::where("id",$user_cita_id)
                    ->select(

                        DB::raw("
                            CONCAT(
                                day,
                                '/',
                                month,
                                '/',
                                year
                            ) AS 'INGRESO_FORMATED'
                        "),
                        "user_cita.*"
                    )
                ->first()
                ->toArray();
                $length = 7;
        $cod_episodio = str_pad($episodio['id'],$length,"0", STR_PAD_LEFT);
        $model["FECHA_INFORME"] =  strtolower( date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y") );  //esta fecha debe venir de user cuest informe



        $model["user"] =$user;
        $model["medico"] =$medico;
        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];
        $model["user_centro_salud_telefono"] = "+58 (212) 949.6411"; // temporal mientras busco donde se encuentra est ainformación en la base de datos
        // dd($model);

        return $model;
    }
    public function recipe_preview(
            $centro_salud_id,
            $episodio_id,
            $user_id_medico,
            $user_id_paciente,
            $print
        )
    {

        $model = $this->pdf_datos_basicos(
            $centro_salud_id,
            $episodio_id,
            $user_id_medico,
            $user_id_paciente,
            $print
        );



        $model["recipes"] =  UserCuestRecipe::where("user_cuest_episodio_id",$episodio_id)->get()->toArray();


        $pdf = PDF::loadView('pdf.recipe',["model"=>$model]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("recipe_medico.pdf");

        //return $model;
    }
    // '/cita/preview/{user_cita_id}/{recipe_num}/{user_id_paciente}/{user_id_medico}/{print}'
    public function recipe_cita_preview(
            $user_centro_salud_id,
            $user_cita_id,
            $recipe_num,
            $user_id_paciente,
            $user_id_medico,
            $print
        )
    {

        $model = $this->pdf_datos_basicos_cita(
            $user_centro_salud_id,
            $user_cita_id,
            $recipe_num,
            $user_id_paciente,
            $user_id_medico,
            $print
        );



        $model["recipes"] =  UserCuestRecipe::where("user_cita_id",$user_cita_id)->where("recipe_num",$recipe_num)->get()->toArray();


        $pdf = PDF::loadView('pdf.recipe',["model"=>$model]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("recipe_medico.pdf");

        //return $model;
    }
    public function estudio_preview(
            $centro_salud_id,
            $episodio_id,
            $user_id_medico,
            $user_id_paciente,
            $print
        )
    {

        $model = $this->pdf_datos_basicos(
            $centro_salud_id,
            $episodio_id,
            $user_id_medico,
            $user_id_paciente,
            $print
        );



        $model["estudios"] =  UserCuestEstudio::where("user_cuest_episodio_id",$episodio_id)->get()->toArray();


        $pdf = PDF::loadView('pdf.estudiodiagnostico',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("solicitud_estudio_diagnostico.pdf");

        //return $model;
    }
    public function pdf_ciguria_create($user_id_paciente)
    {
        return view("emails.plan_cirugia");
    }
    public function estudio_cita_preview(
            $user_centro_salud_id,
            $user_cita_id,
            $estudio_num,
            $user_id_paciente,
            $user_id_medico,
            $print
        )
    {

        $model = $this->pdf_datos_basicos_cita(
            $user_centro_salud_id,
            $user_cita_id,
            $estudio_num,
            $user_id_paciente,
            $user_id_medico,
            $print
        );



        $model["estudios"] =  UserCuestEstudio::where("user_cita_id",$user_cita_id)->where("estudio_num",$estudio_num)->get()->toArray();


        $pdf = PDF::loadView('pdf.estudiodiagnostico',["model"=>$model]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream("solicitud_estudio_diagnostico.pdf");

        //return $model;
    }
    public function recipe($user_id,$print)
    {

        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $model['version']= $print=="color"?true:false;
        $model['logoSystemVersion']= $model['version'] ? config('app.APP_LOGO_VERSION_REPORTS_COLOR') : config('app.APP_LOGO_VERSION_REPORTS_MONO');

        $user = User::where("user.id",$user_id)
                ->join("user_profile","user.id","user_profile.user_id")
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
                    YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
                    ")

                )
                ->first()->toArray();
        $medico = UserProfile::where("user_profile.user_id",Auth::id())

                    ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                    ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                    ->select(

                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'MEDICO'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    DB::raw("
                        cat_user_especialidad.description AS medico_especialidad
                    "),
                    "user_profile.*"



                )
                ->first()->toArray();

                $medico['user_centro_salud_nombre'] = session('user_centro_salud_nombre');
                $medico['user_centro_salud_direccion'] = session('user_centro_salud_direccion');
                //dd($medico);
        $episodio = UserCuestEpisodio::where("user_id",$user_id)
                ->where("active",1)
                ->select(
                    DB::raw("
                        CASE
                            WHEN ingreso IS NULL THEN ''
                            ELSE  DATE_FORMAT(ingreso, '%d/%m/%Y')
                        END AS 'INGRESO_FORMATED'
                    "),
                    "user_cuest_episodio.*"
                )
                ->orderBy("id","DESC")
                ->first()->toArray();

        $length = 7;
        $cod_episodio = str_pad($episodio['id'],$length,"0", STR_PAD_LEFT);
        $model["FECHA_INFORME"] =  strtolower( date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y") );  //esta fecha debe venir de user cuest informe



        $model["user"] =$user;
        $model["medico"] =$medico;
        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];
        $model["recipes"] = UserCuestRecipe::index($user_id);

         //dd($model);
        $pdf = PDF::loadView('pdf.recipe',["model"=>$model]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("recipe_medico.pdf");
    }
    public function estudiodiagnostico($user_id)
    {

        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $model['version']=false;
        $model['logoSystemVersion']= $model['version'] ? config('app.APP_LOGO_VERSION_REPORTS_COLOR') : config('app.APP_LOGO_VERSION_REPORTS_MONO');
        try {
                $user = User::where("user.id",$user_id)
                    ->join("user_profile","user.id","user_profile.user_id")
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
                        YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS 'EDAD'
                        ")

                    )
                    ->first()
                    ->toArray();
                    if (is_null($user)) {
                        return 'Datos de usuario imcompletos';
                    }
        } catch (\Throwable $th) {
            throw $th;
        }

                //dd($user);
        $medico = UserProfile::where("user_profile.user_id",Auth::id())

                    ->join("user_especialidad","user_profile.user_id","user_especialidad.user_id")
                    ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                    ->select(

                    DB::raw("
                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS 'MEDICO'
                    "),
                    DB::raw("
                        CONCAT(
                            user_profile.nacionalidad,
                            '-',
                            FORMAT(user_profile.cedula, 0, 'de_DE')
                        ) AS 'CEDULA'
                    "),
                    "user_profile.*"


                )
                ->first()->toArray();
        $episodio = UserCuestEpisodio::where("user_id",$user_id)
                ->where("active",1)
                ->select(
                    DB::raw("
                        CASE
                            WHEN ingreso IS NULL THEN ''
                            ELSE  DATE_FORMAT(ingreso, '%d/%m/%Y')
                        END AS 'INGRESO_FORMATED'
                    "),
                    "user_cuest_episodio.*"
                )
                ->orderBy("id","DESC")
                ->first()->toArray();

        $length = 7;
        $cod_episodio = str_pad($episodio['id'],$length,"0", STR_PAD_LEFT);
        $model["FECHA_INFORME"] =date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y");  //esta fecha debe venir de user cuest informe




        $model["user"] =$user;
        $model["medico"] =$medico;
        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];

         //dd($model);
        $pdf = PDF::loadView('pdf.estudiodiagnostico',["model"=>$model]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("estudio_diagnostico.pdf");
    }
    public function informeEgreso()
    {

        $informe = UserCuestInforme::show($_GET['user_cuest_informe_id']);
        $user_id = $informe['user_id'];
        $rango = [
            "finicio"=>date("Y-m-d",strtotime($informe['since'])),
            "ffin"=>date("Y-m-d",strtotime($informe['until']))
        ];
        $fechas = [
            "finicio"=>date("d-m-Y",strtotime($informe['since'])),
            "ffin"=>date("d-m-Y",strtotime($informe['until']))
        ];

        $rangos =  $this->getRangos($rango);
        $user = $this->user_profile($user_id);
        $temp = [];
        $oxi = [];
        $fc = [];
        $g1 = [];
        $g2 = [];
        $g3 = [];
        $dia=1;
        $colorBar =[
            ['#FFFF00','#FFFF55'],
            ['#FFAA00','#FFAA55'],
            ['#007FFF','#FFFF7F'],
        ];
        foreach ($rangos as $key => $value) {

            $temp[$key] = $this->dataset($this->model("t1",$user_id,$value),$rangos[$key],$dia);
            $oxi[$key] = $this->dataset($this->model("t2",$user_id,$value),$rangos[$key],$dia);
            $fc[$key] = $this->dataset($this->model("t3",$user_id,$value),$rangos[$key],$dia);
            $g1[$key] = $this->grafico($temp[$key],$colorBar[0]);
            $g2[$key] = $this->grafico($oxi[$key],$colorBar[1]);
            $g3[$key] = $this->grafico($fc[$key],$colorBar[2]);
            $dia= $dia+14;
        }

        //dd($model);
        $pdf = PDF::loadView('pdf.informeEgreso',
                [
                    "fecha"=>$fechas,
                    "user" =>$user,
                    "dias_pad"=> $this->getDiasPad($rango),
                    "temp"=> $temp,
                    "oxi"=> $oxi,
                    "fc"=> $fc,
                    "g1"=>$g1,
                    "g2"=>$g2,
                    "g3"=>$g3,
                    "observaciones"=>$informe['coments'],
                ]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream("Informe de Egreso.pdf");
    }
    public function getRangos($rango)
    {
        $fecha_inicio = date("Y-m-d",strtotime($rango['finicio']));
        $fecha_fin = date("Y-m-d",strtotime($rango['ffin']));
        $date1 = new DateTime($fecha_inicio);
        $date2 = new DateTime($fecha_fin);
        $diff = $date1->diff($date2);
        $rangos = [];
        $i=1;
        $ff =$fecha_inicio;
        $z = 0;

        while ($i <= $diff->days) {
            $fi = $ff;
            $ff = date("Y-m-d",strtotime($ff."+ 14 days"));
            $rangos[]=[
                "finicio"=>$fi,
                "ffin"=>$ff,
            ];
            $i = $i+14;
            $z = $diff->days-$i;

            if($diff->days > 14){
                //dd($diff->days);
                $rangos[]=[
                    "finicio"=> $ff,
                    "ffin"=>$fecha_fin,
                ];
                break;
            }
        }
        return $rangos;
    }
    public function getDiasPad($rango)
    {
        $date1 = new DateTime($rango['finicio']);
        $date2 = new DateTime($rango['ffin']);
        $diff = $date1->diff($date2);
        return $diff->days;
    }
    public function user_profile($user_id)
    {

        return DB::table('user_profile AS t')
            ->where("t.user_id",$user_id)
            ->select(
                "t.*",
                DB::raw("YEAR(CURDATE())-YEAR(t.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(t.fnacimiento,'%m-%d'), 0 , -1 ) AS edad")
            )
            ->first();
    }
    public function grafico($dataset,$color)
    {
        $grafico1 = json_encode([
            "type" => 'bar',
                "data" => [
                "labels" => $dataset['label'],
                "datasets" => [
                    [
                        "label" => "T1",
                        "data" => $dataset['datosInicio'],
                        "backgroundColor"=> $color[0]
                    ],
                    [
                        "label" => "T2",
                        "data" => $dataset['datosFin'],
                        "backgroundColor"=> $color[1]
                    ],
                ],
                ],

                "options"=> [
                    "legend"=> [
                        "display"=> false
                    ],
                    "scales"=> [
                        "yAxes"=> [[
                            "ticks"=> [
                                "fontSize"=> 10
                            ]
                        ]],
                        "xAxes"=> [[
                            "ticks"=> [
                                "fontSize"=> 8
                            ]
                        ]]
                            ],

                        "labels"=> [
                            "fontSize"=> "5"

                    /*
                    "plugins"=> [
                        "barlabel"=> [
                            "labels"=>[
                                [
                                    "text"=>'100',
                                    "font"=>[
                                        "size"=>10
                                    ]
                                ]

                            ]
                        ],

                        "datalabels"=> [
                            "anchor"=> 'center',
                            "align"=> 'center',
                            "color"=> 'black',
                            "font"=> [
                                "resizable"=> true,
                                "size"=> 10,
                            ],
                        ],*/
                    ],
                ],

            ]);

        $chartData = file_get_contents("https://quickchart.io/chart?width=485&height=150&c=".urlencode($grafico1));
        return 'data:image/png;base64, '.base64_encode($chartData);
    }

    public function dataSet($model,$rangos,$contador)
    {
        $dataset= [];
        $fecha_fin = date("Y-m-d",strtotime($rangos['ffin']."+ 1 days"));
        $fecha_inicio = $rangos['finicio'];
        $label = [];
        $datosInicio = [];
        $datosFin = [];
        $date1 = new DateTime($fecha_inicio);
        $date2 = new DateTime($fecha_fin );
        $diff = $date1->diff($date2);

        for ($i=0; $i <14 ; $i++) {
            $dia=date("d",strtotime($fecha_inicio));
            $temp=array();
            foreach ($model as $key => $value) {
                if($value->dia == $dia){
                    array_push($temp, $value->value);
                }
            }
            $dataset[$i]["label"]=$contador;
            $dataset[$i]["data"]=$temp;
            $fecha_inicio = date("Y-m-d",strtotime($fecha_inicio."+ 1 days"));
            array_push($label, "Día ".$contador);
            $contador++;
            $temp1=count($dataset[$i]["data"])>0? $dataset[$i]["data"][array_key_first($dataset[$i]["data"])]:0;
            if(count($dataset[$i]["data"])>1){
                $temp2 = $dataset[$i]["data"][array_key_last($dataset[$i]["data"])];
            }else{
                $temp2="";
            }

            array_push($datosInicio, $temp1);
            array_push($datosFin, $temp2);
            /*
            if(strtotime($fecha_inicio)==strtotime(date('Y-m-d'))){
                break;
            }*/
        }
        return [
            "label" => $label,
            "datosInicio" => $datosInicio,
            "datosFin" => $datosFin,
        ];
    }
    public function model($case,$user_id,$rangos)
    {

        switch ($case) {
            case 't1':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_monitoreo AS t
                    WHERE t.cat_user_cuestionario_id = 84
                    AND t.user_id = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
            case 't2':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_monitoreo AS t
                    WHERE t.cat_user_cuestionario_id = 73
                    AND t.user_id = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
            case 't3':
                return DB::select("
                    SELECT
                        t.value,
                        DATE_FORMAT(t.created_at,'%d') AS dia
                    FROM user_cuest_fc AS t
                    WHERE t.user_id_paciente = ".$user_id."
                    AND t.created_at BETWEEN '".$rangos['finicio']." 00:00:00' AND '".$rangos['ffin']." 23:59:59'
                ", [1]);
            break;
        }
    }
    public function readExcelTemp()
    {

echo "hola";
        $rutaArchivo = "archivo.xlsx";

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load( $rutaArchivo );
        $sheet = $spreadsheet->getActiveSheet();

        $worksheetInfo = $reader->listWorkSheetInfo( $rutaArchivo );

        $totalRow = $worksheetInfo[0]['totalRows'];
dd($totalRow);
        /* //-------------------------
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("E{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $total = count( array_unique( $cedulas_a_buscar ) );
        echo "Total cédulas pacientes únicas encontradas en Excel: $total<br>";
        $user_profiles_pacientes = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        $cedulas = array_column($user_profiles_pacientes,"cedula" );
        $user_id_pacientes = array_column($user_profiles_pacientes,"user_id" );
        $total = count( $cedulas );
        echo "Total cédulas pacientes únicas encontradas en BD: $total<br>";
        $cedulas_no_encontradas = array_diff( array_unique( $cedulas_a_buscar ) , $cedulas );
        for ($row=7; $row <= $totalRow; $row++) {

            $cedula_paciente =  $sheet->getCell("E{$row}")->getValue();
            $apellidos =  $sheet->getCell("C{$row}")->getValue();
            $nombres =  $sheet->getCell("D{$row}")->getValue();
            if ( in_array($cedula_paciente, $cedulas_no_encontradas ) ) {
                $reg_pac = new Request();
                $reg_pac->merge(["email"=>$cedula_paciente."@correotemporal.com"]);
                $reg_pac->merge(["nacionalidad"=>"V"]);
                $reg_pac->merge(["cedula"=>$cedula_paciente]);
                $reg_pac->merge(["nombres"=>$nombres]);
                $reg_pac->merge(["genero"=>"m"]);
                $reg_pac->merge(["apellidos"=>$apellidos]);
                $reg_pac->merge(["fnacimiento"=>date('Y-m-d H:i:s')]);
                $reg_pac->merge(["telefono_movil"=>NULL]);
                $reg_pac->merge(["cat_estado_id"=>NULL]);
                $reg_pac->merge(["cat_municipio_id"=>NULL]);
                $reg_pac->merge(["description"=>NULL]);
                $reg_pac->merge(["domicilio"=>NULL]);
                $reg_pac->merge(["imagen"=>NULL]);
                $reg_pac->merge(["imgDocIdentidad"=>NULL]);
                $reg_pac->merge(["imgSoyChacao"=>NULL]);
                $reg_pac->merge(["tarjeta_soy_chacao"=>NULL]);
                $reg_pac->merge(["created_at"=>date('Y-m-d H:i:s')]);

                $modelPac = new UserPacienteController();
                $modelPac->consultaExternaMasivo($reg_pac);
            }
        }
        //dd($cedulas_no_encontradas);
        $total = count( $cedulas_no_encontradas );
        echo "Total cédulas pacientes únicas NO encontradas en BD: $total<br>";
        //-------------------------
        //-------------------------
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("I{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $total = count( array_unique( $cedulas_a_buscar ) );
        echo "Total cédulas medicos únicas encontradas en Excel: $total<br>";
        $user_profiles_medicos = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        $cedulas = array_column($user_profiles_medicos,"cedula" );
        $user_id_medicos = array_column($user_profiles_medicos,"user_id" );
        $total = count( $cedulas );
        echo "Total cédulas medicos únicas encontradas en BD: $total<br>";

        $cedulas_no_encontradas = array_diff( array_unique( $cedulas_a_buscar ) , $cedulas );
        $total = count( $cedulas_no_encontradas );
        echo "Total cédulas medicos únicas NO encontradas en BD: $total<br>";
        //-------------------------

        $ambulatorios = [
            "Ambulatorio Bello Campo"=>5,
            "Ambulatorio Altamira"=>3,
            //"Ambulatorio Centro de Especialidades Quirúrgicas (Sede Administrativa VISITECA)"=>4,
        ];
        $especialidades = [
            "CIRUGIA"=>11,
            "ECOSONOGRAFIA ESPECIAL GINECOLOGICO Y EMBARAZADAS (TRANSVAGINAL y DOPPLER DE OVARIO)"=>70,
            "ENDOCRINOLOGIA"=>70,
            "ENDODONCIA (TRATAMIENTO DE CONDUCTO)"=>69,
            "GASTROENTEROLOGÍA"=>26,
            "GINECOLOGÍA"=>28,
            "INTERNISTA"=>32, //medicina interna
            "NEUMOPEDIATRA"=>36,
            "ODONTOLOGIA"=>42,
            "OFTALMOLOGIA"=>45,
            "OTORRINOLARINGOLOGÍA"=>49,
            "PEDIATRA"=>50,
            "PSICOLOGÍA ADULTO"=>73,
            "PSIQUIATRA"=>55,
            "TERAPISTA DE LENGUAJE"=>78,
            "TRAUMATOLOGÍA"=>59,
            "UROLOGÍA"=>61,
        ];
        $horas_tardes = [
            1=>13,
            2=>14,
            3=>15,
            4=>16,
            5=>17,
            6=>18,
            7=>19,
            8=>20,
            9=>21,
            10=>22,
            11=>23
        ];
        $resultSet_citas =[];
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("E{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $user_profiles_pacientes = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        for ($row=7; $row <= $totalRow; $row++) {
            $centro_salud =  $sheet->getCell("A{$row}")->getValue();
            $cedula_paciente =  $sheet->getCell("E{$row}")->getValue();
            $cedula_medico =  $sheet->getCell("I{$row}")->getValue();
            $especialidad =  $sheet->getCell("B{$row}")->getValue();
            $apellidos =  $sheet->getCell("C{$row}")->getValue();
            $nombres =  $sheet->getCell("D{$row}")->getValue();



            if (
                in_array($centro_salud, array_keys($ambulatorios)) &&
                //in_array($cedula_paciente, array_column($user_profiles_pacientes,"cedula" )) &&
                in_array($cedula_medico, array_column($user_profiles_medicos,"cedula" ))
            ) {




                $fecha = $sheet->getCell("J{$row}")->getValue(); //valor recogido de la celda del archivo excel

                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha);


                $fecha = date("Y-m-d", strtotime( $date->format("Y-m-d") ) );
                $year =  date("Y", strtotime( $fecha ) );
                $month =  date("m", strtotime( $fecha ) );
                $day =  date("d", strtotime( $fecha ) );
                $hour =  explode(" ",$sheet->getCell("K{$row}")->getValue());

                $meridean = substr($hour[1], 0, 1);


                if ($meridean === "p") {
                    $hora = explode(":",$hour[0]);
                    $hour = $horas_tardes[ $hora[0] ].":".$hora[1];
                }else{
                    $hour = $hour[0];
                }


                $cita = new Request();
                if (array_key_exists($especialidad, $especialidades)) {
                    $cita->merge(["cat_especialidad_id"=> $especialidades[ $especialidad ]]);
                }
                if (array_key_exists($centro_salud, $ambulatorios)) {
                    $cita->merge(["centro_salud_id"=>$ambulatorios[ $centro_salud ]]);
                }

                $cita->merge(["cita_hora"=> $fecha." ".$hour ]);
                $cita->merge(["cat_seguro_id"=>NULL]);
                $cita->merge(["cita_motivo"=>NULL]);
                $cita->merge(["cat_user_cita_status_id"=>1]);
                $cita->merge(["condicion_administrativa"=>"Tuvecinoweb"]);
                $cita->merge(["condicion_descripcion"=>NULL]);
                $cita->merge(["created_at"=>date('Y-m-d H:i:s')]);
                //$cita->merge(["file_type"=>NULL]);
                //$cita->merge(["informe_general"=>NULL]);
                $cita->merge(["reason_for_consultation"=>NULL]);
                $cita->merge(["updated_at"=>date('Y-m-d H:i:s')]);
                $cita->merge(["user_id_autorizacion"=>NULL]);
                $cita->merge(["user_id_medico"=>NULL]);
                $cita->merge(["user_id_paciente"=>NULL]);
                $user_id_medico = array_column( array_filter($user_profiles_medicos, function ($e) use ($cedula_medico)
                {
                    return $e['cedula'] == $cedula_medico;
                }),"user_id" );

                if (!empty($user_id_medico)) {
                    $cita->merge(["user_id_medico"=>$user_id_medico[0]]);
                }
                $user_id_paciente = array_column( array_filter($user_profiles_pacientes, function ($e) use ($cedula_paciente)
                {
                    return $e['cedula'] == $cedula_paciente;
                }),"user_id" );

                if (!empty($user_id_paciente)) {
                    $cita->merge(["user_id_paciente"=>$user_id_paciente[0]]);
                }

                //dump($cita->all());
                //dd($cita->all());
                $user_cita = new UserCitaController();
                $user_cita->store($cita);
            }





        }
        dd($resultSet_citas); */
    }
    public function readExcel()
    {


        $rutaArchivo = "hello world.xlsx";

        $reader = new ReaderXlsx();
        $spreadsheet = $reader->load( $rutaArchivo );
        $sheet = $spreadsheet->getActiveSheet();

        $worksheetInfo = $reader->listWorkSheetInfo( $rutaArchivo );

        $totalRow = $worksheetInfo[0]['totalRows'];

        //-------------------------
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("E{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $total = count( array_unique( $cedulas_a_buscar ) );
        echo "Total cédulas pacientes únicas encontradas en Excel: $total<br>";
        $user_profiles_pacientes = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        $cedulas = array_column($user_profiles_pacientes,"cedula" );
        $user_id_pacientes = array_column($user_profiles_pacientes,"user_id" );
        $total = count( $cedulas );
        echo "Total cédulas pacientes únicas encontradas en BD: $total<br>";
        $cedulas_no_encontradas = array_diff( array_unique( $cedulas_a_buscar ) , $cedulas );
        for ($row=7; $row <= $totalRow; $row++) {

            $cedula_paciente =  $sheet->getCell("E{$row}")->getValue();
            $apellidos =  $sheet->getCell("C{$row}")->getValue();
            $nombres =  $sheet->getCell("D{$row}")->getValue();
            if ( in_array($cedula_paciente, $cedulas_no_encontradas ) ) {
                $reg_pac = new Request();
                $reg_pac->merge(["email"=>$cedula_paciente."@correotemporal.com"]);
                $reg_pac->merge(["nacionalidad"=>"V"]);
                $reg_pac->merge(["cedula"=>$cedula_paciente]);
                $reg_pac->merge(["nombres"=>$nombres]);
                $reg_pac->merge(["genero"=>"m"]);
                $reg_pac->merge(["apellidos"=>$apellidos]);
                $reg_pac->merge(["fnacimiento"=>date('Y-m-d H:i:s')]);
                $reg_pac->merge(["telefono_movil"=>NULL]);
                $reg_pac->merge(["cat_estado_id"=>NULL]);
                $reg_pac->merge(["cat_municipio_id"=>NULL]);
                $reg_pac->merge(["description"=>NULL]);
                $reg_pac->merge(["domicilio"=>NULL]);
                $reg_pac->merge(["imagen"=>NULL]);
                $reg_pac->merge(["imgDocIdentidad"=>NULL]);
                $reg_pac->merge(["imgSoyChacao"=>NULL]);
                $reg_pac->merge(["tarjeta_soy_chacao"=>NULL]);
                $reg_pac->merge(["created_at"=>date('Y-m-d H:i:s')]);

                $modelPac = new UserPacienteController();
                $modelPac->consultaExternaMasivo($reg_pac);
            }
        }
        //dd($cedulas_no_encontradas);
        $total = count( $cedulas_no_encontradas );
        echo "Total cédulas pacientes únicas NO encontradas en BD: $total<br>";
        //-------------------------
        //-------------------------
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("I{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $total = count( array_unique( $cedulas_a_buscar ) );
        echo "Total cédulas medicos únicas encontradas en Excel: $total<br>";
        $user_profiles_medicos = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        $cedulas = array_column($user_profiles_medicos,"cedula" );
        $user_id_medicos = array_column($user_profiles_medicos,"user_id" );
        $total = count( $cedulas );
        echo "Total cédulas medicos únicas encontradas en BD: $total<br>";

        $cedulas_no_encontradas = array_diff( array_unique( $cedulas_a_buscar ) , $cedulas );
        $total = count( $cedulas_no_encontradas );
        echo "Total cédulas medicos únicas NO encontradas en BD: $total<br>";
        //-------------------------

        $ambulatorios = [
            "Ambulatorio Bello Campo"=>5,
            "Ambulatorio Altamira"=>3,
            //"Ambulatorio Centro de Especialidades Quirúrgicas (Sede Administrativa VISITECA)"=>4,
        ];
        $especialidades = [
            "CIRUGIA"=>11,
            "ECOSONOGRAFIA ESPECIAL GINECOLOGICO Y EMBARAZADAS (TRANSVAGINAL y DOPPLER DE OVARIO)"=>70,
            "ENDOCRINOLOGIA"=>70,
            "ENDODONCIA (TRATAMIENTO DE CONDUCTO)"=>69,
            "GASTROENTEROLOGÍA"=>26,
            "GINECOLOGÍA"=>28,
            "INTERNISTA"=>32, //medicina interna
            "NEUMOPEDIATRA"=>36,
            "ODONTOLOGIA"=>42,
            "OFTALMOLOGIA"=>45,
            "OTORRINOLARINGOLOGÍA"=>49,
            "PEDIATRA"=>50,
            "PSICOLOGÍA ADULTO"=>73,
            "PSIQUIATRA"=>55,
            "TERAPISTA DE LENGUAJE"=>78,
            "TRAUMATOLOGÍA"=>59,
            "UROLOGÍA"=>61,
        ];
        $horas_tardes = [
            1=>13,
            2=>14,
            3=>15,
            4=>16,
            5=>17,
            6=>18,
            7=>19,
            8=>20,
            9=>21,
            10=>22,
            11=>23
        ];
        $resultSet_citas =[];
        $cedulas_a_buscar = [];
        for ($row=7; $row <= $totalRow; $row++) {
            $data = $sheet->getCell("E{$row}")->getValue();
            array_push($cedulas_a_buscar, (String) $data )  ;
        }
        $user_profiles_pacientes = UserProfile::whereIn("cedula", array_unique( $cedulas_a_buscar ) )->select("cedula","user_id")->get()->toArray();
        for ($row=7; $row <= $totalRow; $row++) {
            $centro_salud =  $sheet->getCell("A{$row}")->getValue();
            $cedula_paciente =  $sheet->getCell("E{$row}")->getValue();
            $cedula_medico =  $sheet->getCell("I{$row}")->getValue();
            $especialidad =  $sheet->getCell("B{$row}")->getValue();
            $apellidos =  $sheet->getCell("C{$row}")->getValue();
            $nombres =  $sheet->getCell("D{$row}")->getValue();



            if (
                in_array($centro_salud, array_keys($ambulatorios)) &&
                //in_array($cedula_paciente, array_column($user_profiles_pacientes,"cedula" )) &&
                in_array($cedula_medico, array_column($user_profiles_medicos,"cedula" ))
            ) {




                $fecha = $sheet->getCell("J{$row}")->getValue(); //valor recogido de la celda del archivo excel

                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha);


                $fecha = date("Y-m-d", strtotime( $date->format("Y-m-d") ) );
                $year =  date("Y", strtotime( $fecha ) );
                $month =  date("m", strtotime( $fecha ) );
                $day =  date("d", strtotime( $fecha ) );
                $hour =  explode(" ",$sheet->getCell("K{$row}")->getValue());

                $meridean = substr($hour[1], 0, 1);


                if ($meridean === "p") {
                    $hora = explode(":",$hour[0]);
                    $hour = $horas_tardes[ $hora[0] ].":".$hora[1];
                }else{
                    $hour = $hour[0];
                }


                $cita = new Request();
                if (array_key_exists($especialidad, $especialidades)) {
                    $cita->merge(["cat_especialidad_id"=> $especialidades[ $especialidad ]]);
                }
                if (array_key_exists($centro_salud, $ambulatorios)) {
                    $cita->merge(["centro_salud_id"=>$ambulatorios[ $centro_salud ]]);
                }

                $cita->merge(["cita_hora"=> $fecha." ".$hour ]);
                $cita->merge(["cat_seguro_id"=>NULL]);
                $cita->merge(["cita_motivo"=>NULL]);
                $cita->merge(["cat_user_cita_status_id"=>1]);
                $cita->merge(["condicion_administrativa"=>"Tuvecinoweb"]);
                $cita->merge(["condicion_descripcion"=>NULL]);
                $cita->merge(["created_at"=>date('Y-m-d H:i:s')]);
                //$cita->merge(["file_type"=>NULL]);
                //$cita->merge(["informe_general"=>NULL]);
                $cita->merge(["reason_for_consultation"=>NULL]);
                $cita->merge(["updated_at"=>date('Y-m-d H:i:s')]);
                $cita->merge(["user_id_autorizacion"=>NULL]);
                $cita->merge(["user_id_medico"=>NULL]);
                $cita->merge(["user_id_paciente"=>NULL]);
                $user_id_medico = array_column( array_filter($user_profiles_medicos, function ($e) use ($cedula_medico)
                {
                    return $e['cedula'] == $cedula_medico;
                }),"user_id" );

                if (!empty($user_id_medico)) {
                    $cita->merge(["user_id_medico"=>$user_id_medico[0]]);
                }
                $user_id_paciente = array_column( array_filter($user_profiles_pacientes, function ($e) use ($cedula_paciente)
                {
                    return $e['cedula'] == $cedula_paciente;
                }),"user_id" );

                if (!empty($user_id_paciente)) {
                    $cita->merge(["user_id_paciente"=>$user_id_paciente[0]]);
                }

                //dump($cita->all());
                //dd($cita->all());
                $user_cita = new UserCitaController();
                $user_cita->store($cita);
            }





        }
        dd($resultSet_citas);
    }
    public function createExcel()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }










}
