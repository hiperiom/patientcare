<?php

namespace App\Models;
use \App\Models\CentroSalud;
use \App\Models\CatUserCitaStatus;
use \App\Models\UserProfile;
use \App\Models\CatEspecialidad;
use \App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SplFileInfo;
use App\Http\Controllers\Controller;

class UserCita extends Model
{
    protected $table = 'user_cita';
    protected $fillable = [
        'id',
        'year',
        'month',
        'day',
        'hour',
        'reason_for_consultation',
        'hospitalizacion',
        'turno_numero',
        'cat_especialidad_id',
        'terapia_intensiva',
        'cirugia',
        'coments',
        'coments2',
        'user_id_paciente',
        'user_id_medico',
        'file_type',
        'informe_general',
        'centro_salud_id',
        'condicion_administrativa',
        'condicion_descripcion',
        'user_id_autorizacion',
        'cat_seguro_id',
        'poliza_numero',
        'reprogramada',
        'cancelada_medico',
        'cancelada_paciente',
        'user_cita_id_referenciado',
        'descripcion_referenciado',
        'cat_user_cita_status_id',
        'department_id',
        'cat_empresa_id',
        'created_at',
        'updated_at'
    ];
    static function store(Request $request)
    {
        //dd($request->all());
        try {

            // $total_activas = UserCita::where("user_id_paciente",$request->user_id_paciente)
            //          ->whereNotIn("cat_user_cita_status_id",[3,7,8,9])
            //          ->count();

            // if ($total_activas > 2) {
            //     return "maximo_citas_alcanzado";
            // }

            $nombre = null;
            $extension = null;
            $file = $request->file('file');
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $nombre = "inf_general_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                if (file_exists('image/user/informe_general/'.$nombre)) {
                    return "archivo existe";
                }
                $file->move('image/user/informe_general/', $nombre);
                $nombre ='image/user/informe_general/'. $nombre;
                $extension = $file->getClientOriginalExtension();
                $public_path = public_path();
                $info = new SplFileInfo($file->getClientOriginalName());
            }

            $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $model = UserCita::create(
            [
                "user_id_paciente"=>$request->user_id_paciente,
                "user_id_medico"=>isset($request->user_id_medico) && $request->user_id_medico != "null" ? $request->user_id_medico:NULL,
                "cat_especialidad_id"=>$request->cat_especialidad_id,
                "centro_salud_id"=>$request->centro_salud_id,
                "informe_general"=>$nombre,
                "file_type"=>$extension,
                "reason_for_consultation"=>$request->cita_motivo,
                "cat_user_cita_status_id"=>$request->cat_user_cita_status_id,
                "year"=>date("Y",strtotime($request->cita_dia)),
                "month"=>date("m",strtotime($request->cita_dia)),
                "day"=>date("d",strtotime($request->cita_dia)),
                "hour"=>date("H:i",strtotime($request->cita_hora)),
                "coments"=>NULL,
                "coments2"=>NULL,
                "condicion_administrativa"=>$request->condicion_administrativa,
                "condicion_descripcion"=>$request->condicion_descripcion,
                "user_id_autorizacion"=>$request->user_id_autorizacion,
                "cat_seguro_id"=>$request->cat_seguro_id,
                "poliza_numero"=>$request->poliza_numero,
                "department_id"=>$request->directorio_organizacional_id,
                "cat_empresa_id"=>$request->cat_empresa_id,
                "created_at"=>date('Y-m-d H:i:s', strtotime($request['created_at'])),
            ]);

            $model = UserCita::where("user_cita.id",$model->id);
            $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
            $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
            $model = $model->join("user AS userPac","user_cita.user_id_paciente","userPac.id");
            $model = $model->join("user AS userMed","user_cita.user_id_medico","userMed.id");

            $model = $model->join("centro_salud AS cs","user_cita.centro_salud_id","cs.id");
            $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
            $model = $model->join("cat_user_cita_status AS cuce","user_cita.cat_user_cita_status_id","cuce.id");
            $model = $model->select(
                "userPac.email as email_paciente",
                "userMed.email as email_medico",
                "user_cita.*",
                DB::raw("
                    user_cita.id AS user_cita_id
                "),
                DB::raw("
                    user_cita.reason_for_consultation AS cita_motivo
                "),
                DB::raw("
                    CONCAT(
                        upPac.nombres,
                        ' ' ,
                        upPac.apellidos
                    ) AS paciente
                "),
                DB::raw("
                    CONCAT(
                        upMed.nombres,
                        ' ',
                        upMed.apellidos
                    ) AS medico
                "),
                DB::raw("
                    upMed.imagen AS medico_imagen
                "),
                DB::raw("
                    cs.description AS centro_salud_description
                "),
                DB::raw("
                    cue.description AS especialidad_description
                "),
                DB::raw("
                    cue.image AS especialidad_imagen
                "),
                DB::raw("
                    cuce.description AS cat_user_cita_status_description
                "),
                DB::raw("

                    CONCAT(
                        user_cita.year,'-',
                        user_cita.month,'-',
                        user_cita.day,' ',
                        user_cita.hour
                    ) AS fecha_cita
                "),
                DB::raw("
                    CASE
                        WHEN user_cita.cat_user_cita_status_id = 1 THEN 'info'
                        WHEN user_cita.cat_user_cita_status_id = 2 THEN 'warning'
                        WHEN user_cita.cat_user_cita_status_id = 3 THEN 'danger'
                        WHEN user_cita.cat_user_cita_status_id = 4 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 5 THEN 'warning'
                        WHEN user_cita.cat_user_cita_status_id = 6 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 7 THEN 'success'
                        WHEN user_cita.cat_user_cita_status_id = 8 THEN 'secondary'
                        WHEN user_cita.cat_user_cita_status_id = 9 THEN 'danger'
                        ELSE 'info'
                    END AS cat_user_cita_status_id_color
                "),
                DB::raw("
                    CASE
                        WHEN user_cita.cat_user_cita_status_id = 1 THEN 'pc-cita_por_confirmar'
                        WHEN user_cita.cat_user_cita_status_id = 2 THEN 'pc-cita_reprogramada'
                        WHEN user_cita.cat_user_cita_status_id = 3 THEN 'pc-cita_cancelada'
                        WHEN user_cita.cat_user_cita_status_id = 4 THEN 'pc-cita_confirmada'
                        WHEN user_cita.cat_user_cita_status_id = 5 THEN 'pc-preconsulta'
                        WHEN user_cita.cat_user_cita_status_id = 6 THEN 'pc-consulta'
                        WHEN user_cita.cat_user_cita_status_id = 7 THEN 'pc-check'
                        WHEN user_cita.cat_user_cita_status_id = 8 THEN 'pc-check'
                        WHEN user_cita.cat_user_cita_status_id = 9 THEN 'pc-check'
                        ELSE 'pc-cita_por_confirmar'
                        END AS cat_user_cita_status_id_icono
                ")
            );
            $model = $model->get()->toArray();
            $model = $model[0];

            /* if ( config("app.APP_SEND_EMAILS") ) { */
                $model['case']=3;
                $model['especialidad']= CatEspecialidad::where("id",$request->cat_especialidad_id)->value("description");
                $model['medico']= UserProfile::where("user_id",$request->user_id_medico)
                                    ->select(
                                        DB::raw("
                                            CONCAT(
                                                CASE
                                                    WHEN prefijo IS NOT NULL THEN prefijo
                                                    ELSE ''
                                                END,
                                                ' ',
                                                nombres,
                                                ' ',
                                                apellidos
                                                ) as medico
                                        ")
                                    )->value('medico');

                $model['year']=date("Y",strtotime($request->cita_dia));
                $model['month_nombre']= $mes[ (int) date("m",strtotime($request->cita_dia)) -1 ] ;
                $model['day']=date("d",strtotime($request->cita_dia));
                $model['hour']=date("h:i A",strtotime($request->cita_hora));
                $centro_salud = CentroSalud::where("id",$request->centro_salud_id )->first();
                $model['centro_salud']= $centro_salud->description;
                $model['address']= $centro_salud->coments;
                $model['location_link']= $centro_salud->location_link;
                $model['cat_user_cita_status_id']= $request->cat_user_cita_status_id; //CatUserCitaStatus::where("id", $request->cat_user_cita_status_id)->value("description");

                $model['logo'] = config('app.url')."/image/system/salud_chacao.png" ;
                //$model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                $model['subject']= "Cita agendada";

                /* if (config("app.APP_TEST_MODE") ) {
                    $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                    $model['emails'] = $team_test;
                }else{
                    $model['emails'] = $request->email;
                } */
                $model['emails'] = $model['email_paciente'];


                Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                    $message->to( "hiperiom412@gmail.com" )
                    ->subject($model['subject']);
                });
                Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                    $message->to( $model['emails'] )
                    ->subject($model['subject']);
                });

                if($request->condicion_administrativa=="Cortesía"){
                    $model['case']=8;
                    $model['paciente'] = UserProfile::where("user_id",$request->user_id_paciente)
                    ->select(
                        DB::raw("
                            CONCAT(
                                nombres,
                                ' ',
                                apellidos
                            ) as nombre
                        "),
                        DB::raw("
                            CONCAT(
                                nacionalidad,
                                cedula
                            ) as cedula
                        "),
                        "genero as genero"
                    )
                    ->first()
                    ->toArray();
                    $model['user_autorizacion'] = UserProfile::where("user_id",$request->user_id_autorizacion)
                    ->select(
                        DB::raw("
                            CONCAT(
                                nombres,
                                ' ',
                                apellidos
                            ) as autorizacion
                        ")
                    )
                    ->value('autorizacion');

                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach (["hiperiom412@gmail.com","correoadministrativo@cmdlt.edu.ve"] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    });
                }
        } catch (\Throwable $th) {
            dd($th);
        }


        return $model;

    }
    static function referencia_store(Request $request)
    {

        //dd($request->all());
        try {
            $nombreArchivo = null;
            $objeto = new Controller();
            $nombreArchivo = $objeto->referenciainformeCita(
                $request->centro_salud_id,
                $request->user_id_medico,
                $request->user_cita_id_referenciado,
                $request->user_id_paciente,
                "color"
            );

            $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

            $model = new UserCita();
            $model->user_id_paciente = $request->user_id_paciente;
            $model->user_id_medico = isset($request->user_id_medico) ?$request->user_id_medico:NULL;
            $model->cat_especialidad_id = $request->cat_especialidad_id;
            $model->centro_salud_id = $request->centro_salud_id;
            $model->informe_general = $nombreArchivo;
            $model->file_type = "pdf";
            $model->reason_for_consultation = $request->cita_motivo;
            $model->cat_user_cita_status_id = $request->cat_user_cita_status_id;
            $model->year = date("Y",strtotime($request->cita_hora));
            $model->month = date("m",strtotime($request->cita_hora));
            $model->day = date("d",strtotime($request->cita_hora));
            $model->hour = date("H:s",strtotime($request->cita_hora));

            $model->condicion_administrativa = $request->condicion_administrativa;
            $model->condicion_descripcion = $request->condicion_descripcion;
            $model->user_id_autorizacion = $request->user_id_autorizacion;
            $model->cat_seguro_id = $request->cat_seguro_id;
            $model->poliza_numero = $request->poliza_numero;

            $model->user_cita_id_referenciado = $request->user_cita_id_referenciado;
            $model->descripcion_referenciado = $request->descripcion_referenciado;
            $model->poliza_numero = $request->poliza_numero;

            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();



            if ( config("app.APP_SEND_EMAILS") ) {
                $model['case']=3;
                $model['especialidad']= CatEspecialidad::where("id",$request->cat_especialidad_id)->value("description");
                $model['medico']= UserProfile::where("user_id",$request->user_id_medico)
                                    ->select(
                                        DB::raw("
                                            CONCAT(
                                                CASE
                                                    WHEN prefijo IS NOT NULL THEN prefijo
                                                    ELSE ''
                                                END,
                                                ' ',
                                                nombres,
                                                ' ',
                                                apellidos
                                                ) as medico
                                        ")
                                    )->value('medico');

                $model['year']=date("Y",strtotime($request->cita_hora));
                $model['month']= $mes[ (int) date("m",strtotime($request->cita_hora)) -1 ] ;
                $model['day']=date("d",strtotime($request->cita_hora));
                $model['hour']=date("h:i A",strtotime($request->cita_hora));
                $centro_salud = CentroSalud::where("id",$request->centro_salud_id )->first();
                $model['centro_salud']= $centro_salud->description;
                $model['address']= $centro_salud->coments;
                $model['location_link']= $centro_salud->location_link;
                $model['cat_user_cita_status_id']= $request->cat_user_cita_status_id; //CatUserCitaStatus::where("id", $request->cat_user_cita_status_id)->value("description");


                $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                $model['subject']= "Cita agendada";

                if (config("app.APP_TEST_MODE") ) {
                    $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                    $model['emails'] = $team_test;
                }else{
                    $model['emails'] = $request->email;
                }


                Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                    foreach ($model['emails'] as $key => $correo) {
                        $message->to( $correo )
                        ->subject($model['subject']);
                    }
                });
                if($request->condicion_administrativa=="Cortesía"){
                    $model['case']=8;
                    $model['paciente'] = UserProfile::where("user_id",$request->user_id_paciente)
                                                        ->select(
                                                            DB::raw("
                                                                CONCAT(
                                                                    nombres,
                                                                    ' ',
                                                                    apellidos
                                                                ) as nombre
                                                            "),
                                                            DB::raw("
                                                                CONCAT(
                                                                    nacionalidad,
                                                                    cedula
                                                                ) as cedula
                                                            "),
                                                            "genero as genero"
                                                        )
                                                        ->first()
                                                        ->toArray();
                    $model['user_autorizacion'] = UserProfile::where("user_id",$request->user_id_autorizacion)
                                                        ->select(
                                                            DB::raw("
                                                                CONCAT(
                                                                    nombres,
                                                                    ' ',
                                                                    apellidos
                                                                ) as autorizacion
                                                            ")
                                                        )
                                                        ->value('autorizacion');
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                    foreach ($model['emails'] as $key => $correo) {
                        $message->to( $correo )
                        ->subject($model['subject']);
                    }
                });
                }
            }else{
                //echo "El envio de correos está desabilitado.<br>" ;
            }

            return $model;
        } catch (\Throwable $th) {
            //return $th->errorInfo[2];
            dd( $th);
        }

    }
    static function actualizar(Request $request)
    {

        $campo = $request->campo;

        $cambiar = [
            $campo =>$request->valor
        ];
        if (isset($request->coments2)) {
            $cambiar['coments2'] = $request->coments2;
        }

        $model = UserCita::updateOrCreate(
        [
            'id'=>$request->cita_id
        ],
            $cambiar
        );
        return Response()->json($model);
    }
    static function index_paciente()
    {
        /*
            1 - Creada
            2 - Reprogramada
            4 - Aprobada
        */
        return UserCita::whereIn("cat_user_cita_status_id",[1,2,4])
            ->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id")
            ->where("user_id_paciente",Auth::id())
            ->select(
                "user_cita.*",
                DB::raw("
                    CONCAT(
                        upMed.nombres,
                        ' ',
                        upMed.apellidos
                    ) AS medico
                ")
            )
            ->orderBy("created_at","DESC")->get();
    }
    static function index_medicoOne($user_cita_id)
    {

        $model = UserCita::where("user_cita.id",$user_cita_id);
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->leftJoin("user_cuest_direction AS ucd","user_cita.user_id_paciente","ucd.user_id");
        $model = $model->join("centro_salud","user_cita.centro_salud_id","centro_salud.id");
        $model = $model->leftJoin("user_profile AS upAuto","user_cita.user_id_autorizacion","upAuto.user_id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->join("user","user_cita.user_id_paciente","user.id");
        $model = $model->leftJoin("tarjeta_soy_chacao","user_cita.user_id_paciente","tarjeta_soy_chacao.user_id_paciente");

        $model = $model->select(
                    "user_cita.*",
                    "ucd.cat_estado_id",
                    "ucd.cat_municipio_id",
                    "ucd.description",
                    "ucd.domicilio",
                    DB::raw("
                        centro_salud.description AS centro_salud_description
                    "),
                    DB::raw("
                        user.email
                    "),
                    DB::raw("
                        tarjeta_soy_chacao.description AS tarjeta_soy_chacao
                    "),
                    DB::raw("
                        CASE
                            WHEN upPac.fnacimiento IS NULL THEN ''
                            ELSE  DATE_FORMAT(upPac.fnacimiento, '%d/%m/%Y')
                        END AS nacimiento
                    "),
                    DB::raw("
                        upPac.imagen AS imagen_paciente
                    "),
                    DB::raw("
                        upPac.telefono_movil
                    "),
                    DB::raw("
                        CONCAT(
                            upPac.nacionalidad,
                            upPac.cedula
                        ) AS cedula_paciente
                    "),
                    DB::raw("
                        upPac.genero AS genero_paciente
                    "),
                    DB::raw("
                        upMed.imagen AS imagen_medico
                    "),
                    DB::raw("
                    YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                    "),
                    DB::raw("
                        cue.description AS especialidad_nombre
                    "),
                    DB::raw("
                        CONCAT(
                            upMed.nombres,
                            ' ',
                            upMed.apellidos
                        ) AS medico
                    "),
                    DB::raw("
                        CONCAT(
                            upPac.nombres,
                            ' ',
                            upPac.apellidos
                        ) AS paciente
                    "),
                    DB::raw("
                        CONCAT(
                            upAuto.nombres,
                            ' ',
                            upAuto.apellidos
                        ) as user_autorizacion
                    "),
                    DB::raw("
                        STR_TO_DATE(
                            CONCAT(
                                user_cita.year,'/',
                                user_cita.month,'/',
                                user_cita.day,' ',
                                user_cita.hour
                            ),
                            '%Y/%m/%d %T'
                        ) AS fecha_cita
                    ")
                );


        $model =    $model->orderBy('fecha_cita',"ASC");
        $model =    $model->get();

        /* foreach ($model as $key => $value) {
            $model[$key]["user_autorizacion"] = NULL;

            if (!is_null($value['user_id_autorizacion'])) {
                $model[$key]["user_autorizacion"]      = UserProfile::where("user_id",$value['user_id_autorizacion'])
                                                        ->select(
                                                            DB::raw("
                                                                CONCAT(
                                                                    nombres,
                                                                    ' ',
                                                                    apellidos
                                                                ) as autorizacion
                                                            ")
                                                        )
                                                        ->value('autorizacion');
            }
        } */
        return $model;
    }
    static function index_medico()
    {

        $model = new UserCita();
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->leftJoin("user_cuest_direction AS ucd","user_cita.user_id_paciente","ucd.user_id");
        $model = $model->join("centro_salud","user_cita.centro_salud_id","centro_salud.id");
        $model = $model->leftJoin("user_profile AS upAuto","user_cita.user_id_autorizacion","upAuto.user_id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");
        $model = $model->join("user_profile AS upPac","user_cita.user_id_paciente","upPac.user_id");
        $model = $model->join("user","user_cita.user_id_paciente","user.id");
        $model = $model->leftJoin("tarjeta_soy_chacao","user_cita.user_id_paciente","tarjeta_soy_chacao.user_id_paciente");
        if (session('cat_user_type_id') == 2) {//medico
            //$model = $model->whereIn("cat_user_cita_status_id",[5,6]); //preconsulta | consulta
            $model = $model->whereIn("cat_user_cita_status_id",[1,2,4,5,6]);//por confirmar | reprogramada | confirmada | preconsulta | consulta
            //$model = $model->where("user_cita.user_id_medico",Auth::id());
        }
        if ( in_array(session('cat_user_type_id'),[7,6]) ) { //atencion al paciente | enfermeria
            $model = $model->whereIn("cat_user_cita_status_id",[1,2,4,5]); //por confirmar | reprogramada | cancelada | confirmada | preconsulta
        }
        if ( in_array(session('cat_user_type_id'),[8,4]) ) { //gerente | administrador
            $model = $model->whereIn("cat_user_cita_status_id",[1,2,3,4,5,6,7,8,9]);
        }
        $model =    $model->where("centro_salud_id",session('user_centro_salud_id'));
        $model = $model->select(
                    "user_cita.*",
                    "ucd.cat_estado_id",
                    "ucd.cat_municipio_id",
                    "ucd.description",
                    "ucd.domicilio",
                    DB::raw("
                        centro_salud.description AS centro_salud_description
                    "),
                    DB::raw("
                        user.email
                    "),
                    DB::raw("
                        tarjeta_soy_chacao.description AS tarjeta_soy_chacao
                    "),
                    DB::raw("
                        CASE
                            WHEN upPac.fnacimiento IS NULL THEN ''
                            ELSE  DATE_FORMAT(upPac.fnacimiento, '%d/%m/%Y')
                        END AS nacimiento
                    "),
                    DB::raw("
                        upPac.imagen AS imagen_paciente
                    "),
                    DB::raw("
                        upPac.telefono_movil
                    "),
                    DB::raw("
                        CONCAT(
                            upPac.nacionalidad,
                            upPac.cedula
                        ) AS cedula_paciente
                    "),
                    DB::raw("
                        upPac.genero AS genero_paciente
                    "),
                    DB::raw("
                        upMed.imagen AS imagen_medico
                    "),
                    DB::raw("
                    YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 ) AS edad
                    "),
                    DB::raw("
                        cue.description AS especialidad_nombre
                    "),
                    DB::raw("
                        CONCAT(
                            upMed.nombres,
                            ' ',
                            upMed.apellidos
                        ) AS medico
                    "),
                    DB::raw("
                        CONCAT(
                            upPac.nombres,
                            ' ',
                            upPac.apellidos
                        ) AS paciente
                    "),
                    DB::raw("
                        CONCAT(
                            upAuto.nombres,
                            ' ',
                            upAuto.apellidos
                        ) as nombre_user_autorizacion
                    "),
                    DB::raw("
                        STR_TO_DATE(
                            CONCAT(
                                user_cita.year,'/',
                                user_cita.month,'/',
                                user_cita.day,' ',
                                user_cita.hour
                            ),
                            '%Y/%m/%d %T'
                        ) AS fecha_cita
                    ")
                );


        $model =    $model->orderBy('fecha_cita',"ASC");
        $model =    $model->get();

        /* foreach ($model as $key => $value) {
            $model[$key]["user_autorizacion"] = NULL;

            if (!is_null($value['user_id_autorizacion'])) {
                $model[$key]["user_autorizacion"]      = UserProfile::where("user_id",$value['user_id_autorizacion'])
                                                        ->select(
                                                            DB::raw("
                                                                CONCAT(
                                                                    nombres,
                                                                    ' ',
                                                                    apellidos
                                                                ) as autorizacion
                                                            ")
                                                        )
                                                        ->value('autorizacion');
            }
        } */
        return $model;
    }
}
