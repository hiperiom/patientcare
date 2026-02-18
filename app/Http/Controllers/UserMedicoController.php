<?php

namespace App\Http\Controllers;

use App\Models\CatEspecialidad;
use App\Models\CatUserUbicacion;
use App\Models\Cita;
use App\Models\UserCuestAntg;
use App\Models\UserCuestChat;
use App\Models\UserCuestComorbilidad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Http\Request;
//monitoreo
use App\Models\Monitoreo\UserCuestPruebaCovid;
use App\Models\Monitoreo\UserCuestSintoma;
use App\Models\Monitoreo\UserCuestTac;
use App\Models\Monitoreo\UserCuestFc;
use App\Models\Monitoreo\UserCuestFr;
use App\Models\Monitoreo\UserCuestGlic;
use App\Models\Monitoreo\UserCuestOxigenoterapia;
use App\Models\Monitoreo\UserCuestOximetria;
use App\Models\Monitoreo\UserCuestPcr;
use App\Models\Monitoreo\UserCuestPdr;
use App\Models\Monitoreo\UserCuestTa;
use App\Models\Monitoreo\UserCuestTemperatura;
use App\Models\UserCuestMonitoreo;
use App\Models\UserPacienteSintoma;

//usuario
use App\Models\UserDireccion;
use App\Models\UserCuestDireccion;
use App\Models\UserCuestFichaMedica;
use App\Models\UserCuestVinculoInstitucion;
use App\Models\UserCuestEquipoSalud;
use App\Models\UserEspecialidad;
use App\Models\UserFamily;
use App\Models\UserMedico;
use App\Models\UserProfile;
use App\Models\UserType;
use App\Models\UserVip;
use App\User;

//episodio
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestConsulta;
use App\Models\UserCuestCormorbilidad;
use App\Models\UserCuestEvolucion;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestObservacion;
use App\Models\UserCuestEstudio;
use App\Models\UserCuestRecipe;
use App\Models\UserCuestPlan;
use App\Models\UserEquipoSalud;
use App\Models\UserCuestUbicacion;
use App\Models\UserCuestFotografia;
use App\Models\UserMedicoPosicion;
use App\Models\UserCuestImagen;
use App\Models\UserCuestLaboratorio;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestOtroArchivo;
use App\Models\UserCuestPad;
use App\Models\UserCuestPendiente;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use App\Models\UserProfileImages;
use App\Models\UserCentroSalud;
use App\Models\TarjetaSoyChacao;
use Illuminate\Support\Facades\Mail;

use DateTime;
use Illuminate\Support\Facades\DB;
use App\Models\UserMedicoAgenda;
use App\Models\UserMedicoActivo;
use App\Models\UserCortesia;

use App\Models\UserCita;
use GuzzleHttp\Psr7\Response;

class UserMedicoController extends Controller
{

    public function getPersonalSalud()
    {

        ini_set('memory_limit', '2048M');

        $model =    UserType::whereIn("user_type.cat_user_type_id",[2,6,7])
        // $model =    UserType::where("user_type.cat_user_type_id",2)
                    ->join("cat_user_type","user_type.cat_user_type_id", "cat_user_type.id")
                    ->leftJoin("user_medico_posicion","user_type.user_id","user_medico_posicion.user_id") // añadí esta
                    // ->where("user_type.active",1) // comenté esta
                    ->where("user_medico_posicion.active",1)
                    ->select(
                        DB::raw("cat_user_type.description AS cat_user_type_description"),
                        DB::raw("user_type.user_id AS user_id"),
                        DB::raw("user_type.id AS user_type_id"),
                        DB::raw("user_type.cat_user_type_id")
                    )
                    ->get()
                    // ->take(100)
                    ->toArray();
                    // dd($model);
        $keys_to_delete = [];

        foreach($model as $key => $value){
            // dd($key);
            try {
                $profile_jj = UserProfile::where("user_id",$value['user_id'])->first(); // se verifica que el usuario tenga perfil asociado
                if($profile_jj != null){

                    $model[$key] = array_merge(
                        $model[$key],
                        UserProfile::where("user_id",$value['user_id'])
                            ->select(
                                "user_profile.imagen",
                                "user_profile.nacionalidad",
                                "user_profile.cedula AS cedula_unformatted",
                                "user_profile.nombres",
                                "user_profile.apellidos",
                                "user_profile.fnacimiento",
                                "user_profile.telefono_movil",
                                "user_profile.firma",
                                "user_profile.sello",
                                "user_profile.mpps",
                                "user_profile.colegio_medico",
                                DB::raw("
                                    CASE
                                        WHEN user_profile.genero = 'm' THEN 'M'
                                        WHEN user_profile.genero = 'f' THEN 'F'
                                        ELSE ''
                                    END  AS genero
                                "),
                                DB::raw("
                                    YEAR( CURDATE() ) - YEAR( user_profile.fnacimiento ) +
                                    IF( DATE_FORMAT( CURDATE() ,'%m-%d' ) > DATE_FORMAT( user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad"
                                ),
                                DB::raw("
                                    CASE
                                        WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                                    ELSE ''
                                    END AS prefijo
                                "),
                                DB::raw("
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
                                    ) AS medico
                                "),
                                DB::raw("
                                    CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                                ")
                            )
                            ->first()
                            ->toArray()
                    );

                    $model[$key]['especialidad'] = UserEspecialidad::where("user_id",$value['user_id'])
                        ->join('cat_user_especialidad', 'user_especialidad.cat_user_especialidad_id', 'cat_user_especialidad.id')
                        ->select(
                            DB::raw("user_especialidad.id AS user_especialidad_id"),
                            DB::raw("user_especialidad.cat_user_especialidad_id"),
                            DB::raw("cat_user_especialidad.description AS cat_user_especialidad_description"),
                            DB::raw("cat_user_especialidad.image AS cat_user_especialidad_image")
                        )
                        ->get()
                        ->toArray();

                    $equipo_salud = UserEquipoSalud::where("user_id",$value['user_id'])
                        ->where("user_equipo_salud.active",1)
                        ->join('cat_user_equipo_salud', 'user_equipo_salud.cat_user_equipo_salud_id', 'cat_user_equipo_salud.id')
                        ->select(
                            DB::raw("user_equipo_salud.id AS user_equipo_salud_id"),
                            DB::raw("user_equipo_salud.cat_user_equipo_salud_id"),
                            DB::raw("cat_user_equipo_salud.description AS cat_user_equipo_salud_description")
                        )
                        ->first();
                    $model[$key]['user_equipo_salud_id'] = NULL;
                    $model[$key]['cat_user_equipo_salud_id'] = NULL;
                    $model[$key]['cat_user_equipo_salud_description'] = NULL;
                    if (!is_null($equipo_salud)) {

                        $model[$key] = array_merge(
                            $model[$key],
                            $equipo_salud->toArray()
                        );
                    }
                    //$model[$key]['user_cuest_direction'] = NULL;
                    $model[$key]['user_cuest_direction_id'] = NULL;
                    $model[$key]['user_cuest_direction_description'] = NULL;
                    $model[$key]['user_cuest_direction_domicilio'] = NULL;
                    $model[$key]['cat_estado_id'] = NULL;
                    $model[$key]['cat_municipio_id'] = NULL;
                    $direccion = UserCuestDireccion::where("user_id",$value['user_id'])
                        ->select(
                            DB::raw("user_cuest_direction.id  AS user_cuest_direction_id"),
                            DB::raw("user_cuest_direction.description  AS user_cuest_direction_description"),
                            DB::raw("user_cuest_direction.domicilio  AS user_cuest_direction_domicilio"),
                            "user_cuest_direction.cat_estado_id",
                            "user_cuest_direction.cat_municipio_id"
                        )
                        ->first();
                    if (!is_null($direccion)) {
                        $model[$key] = array_merge(
                            $model[$key],
                            $direccion->toArray()
                        );
                    }

                    $model[$key]['user_medico_posicion_id'] = NULL;
                    $model[$key]['cat_user_medico_posicion_description'] = NULL;
                    $position = UserMedicoPosicion::where("user_medico_posicion.user_id",$value['user_id'])
                    ->join("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
                    ->where("user_medico_posicion.active",1)
                    ->select(
                        "user_medico_posicion.id AS user_medico_posicion_id",
                        "user_medico_posicion.cat_user_medico_posicion_id",
                        "cat_user_medico_posicion.description AS cat_user_medico_posicion_description"
                    )
                    ->first();

                    if (!is_null($position)) {

                        $model[$key] = array_merge(
                            $model[$key],
                            $position->toArray()
                        );
                    }

                    $model[$key] = array_merge(
                        $model[$key],
                        User::where("id",$value['user_id'])
                        ->select(
                            DB::raw("email")
                        )
                        ->first()
                        ->toArray()
                    );

                    $model[$key]['tarjeta_soy_chacao'] = NULL;
                    $soy_chacao = TarjetaSoyChacao::where("user_id_paciente",$value['user_id'])
                        ->select(
                            DB::raw("description AS tarjeta_soy_chacao")
                        )
                        ->first();
                    if (!is_null($soy_chacao)) {
                        $model[$key] = array_merge(
                            $model[$key],
                            $soy_chacao->toArray()
                        );
                    }

                    $model[$key]['imgSoyChacao'] = NULL;
                    $imgSoyChacao = UserProfileImages::where("user_id_paciente",$value['user_id'])
                        ->where("user_profile_images.coments",'imgSoyChacao' )
                        ->where("user_profile_images.active",1 )
                        ->select(
                            DB::raw("user_profile_images.value AS imgSoyChacao")
                        )
                        ->first();
                    if (!is_null($imgSoyChacao)) {
                        $model[$key] = array_merge(
                            $model[$key],
                            $imgSoyChacao->toArray()
                        );
                    }
                    $model[$key]['imgDocIdentidad'] = NULL;
                    $imgDocIdentidad = UserProfileImages::where("user_id_paciente",$value['user_id'])
                        ->where("user_profile_images.coments",'imgDocIdentidad' )
                        ->where("user_profile_images.active",1 )
                        ->select(
                            DB::raw("user_profile_images.value AS imgDocIdentidad")
                        )
                        ->first();
                    if (!is_null($imgDocIdentidad)) {
                        $model[$key] = array_merge(
                            $model[$key],
                            $imgDocIdentidad->toArray()
                        );
                    }
                    $model[$key]['agendas'] = UserMedicoAgenda::where("user_id_medico",$value['user_id'])
                        ->where("active",1)
                        ->select(
                            DB::raw("id AS agenda_id"),
                            DB::raw("agenda"),
                            DB::raw("cat_especialidad_id"),
                            DB::raw("
                                (
                                    SELECT description
                                    FROM cat_user_especialidad
                                    WHERE id = user_medico_agenda.cat_especialidad_id
                                ) AS especialidad_description
                            "),
                            DB::raw("centro_salud_id"),
                            DB::raw("
                                (
                                    SELECT description
                                    FROM centro_salud
                                    WHERE id = user_medico_agenda.centro_salud_id
                                ) AS centro_salud_description
                            ")
                        )
                        ->get()
                        ->toArray();
                    $model[$key]['centros_salud_asignado'] = UserCentroSalud::where("user_id_paciente",$value['user_id'])
                        ->where("cat_user_type_id",2)
                        ->where("active",1)
                        ->select(
                            DB::raw("id AS user_centro_salud_id"),
                            DB::raw("centro_salud_id"),
                            DB::raw("
                                (
                                    SELECT description
                                    FROM centro_salud
                                    WHERE id = user_centro_salud.centro_salud_id
                                ) AS centro_salud_description
                            ")
                        )
                        ->get()
                        ->toArray();
                    $model[$key]['user_medico_activo'] = UserMedicoActivo::where("user_id_medico",$value['user_id'])
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->take(1);
                }else{
                    array_push($keys_to_delete, $key); // se anota el indice del elemento a eliminar por no tener un perfil asociado
                }
            } catch (\Throwable $th) {
                echo "ERROR --> ".$th;
                dd( $value['user_id']);
            }
        }

        foreach($keys_to_delete as $key){
            unset($model[$key]); // se eliminan los elementos que no tengan perfil asociado
        }
        // dd($model);
        $model_clean = [];
        foreach ($model as $item) {
            array_push($model_clean,$item); // se arma un arreglo limpio (todos sus elementos tienen perfiles asociados)
        }

        return Response()->json($model_clean); // se retorna un arreglo limpio (todos sus elementos tienen perfiles asociados)

    }

    public function consultaExternaStore(Request $request)
    {
        //1 User
        //2 UserType
        //3 Profile
        //4 Direction
        //5 Episodio
        //6 Ubicación en area
        //7 Estatus (alerta)
        //8 Vip
        //9 MedicoEspecialidad
        //10 MedicoPosicion
        //11 Centro Salud
        //12 Equipo salud

        try {
            //1 USER
                $user = User::firstOrCreate(
                    ['email' => $request->email],
                    [
                        'email'          => $request->email,
                        'password'       => isset( $request->password ) ? $request->password : "123456",
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );
                $user_id = $user->id;
                //dump($user);

                $request->merge(["user_id_paciente"=>$user_id]);
                $request->merge(["user_id"=>$user_id]);
            //2 USER_TYPE
                $cat_user_type_id = [];
                if (isset($request->cat_user_type_id)) {
                    $cat_user_type_id = explode(",",$request->cat_user_type_id );
                }else{
                    dd("Cat user type id no encontrados");
                }

                foreach( $cat_user_type_id as $value){
                    $user_type = UserType::updateOrCreate(
                        [
                            'user_id'   => $user_id,
                            'cat_user_type_id' => $value,
                        ],
                        [
                            'user_id'     => $user_id,
                            'cat_user_type_id' => $value,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }


            //3 USER_PROFILE
                $user_profile = UserProfile::store($request);

                $userImage = UserProfileImages::store($request);



            //4 DIRECTION
                $direction = UserCuestDireccion::store($request);

            //5 EPISODIO
                /*
                $episodio=null;
                $valida_episodio = UserCuestEpisodio::where("user_id",$request->user_id)
                ->where("egreso",NULL)
                ->where("active",1)
                ->orderBy("created_at","DESC")
                ->take(1)
                ->get();

                if ( count($valida_episodio) == 0 ) {
                    $episodio = UserCuestEpisodio::create(
                            [
                                'user_id'=> $request->user_id,
                                'user_id_medico' => Auth::id(),
                                "ingreso"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) ),
                                "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                            ]
                        );
                    $episodio = $episodio->id;
                }else{
                    $episodio = $valida_episodio[0]->id;
                    $valida_ubi_area = UserCuestUbicacion::where("user_id_paciente",$request->user_id)
                        ->where("user_cuest_episodio_id",$episodio)
                        ->where("active",1)
                        ->orderBy("created_at","DESC")
                        ->take(1)
                        ->get();
                    if (count($valida_ubi_area) > 0 ) {
                        $request->merge([ "cat_user_ubicacion_id" => $valida_ubi_area[0]->cat_user_ubicacion_id ]) ;
                        $request->merge([ "value" => $valida_ubi_area[0]->value ]) ;
                    }
                }*/

            //6 UBICACIÓN EN AREA
                /*$ubi_area = UserCuestUbicacion::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    'user_cuest_episodio_id'   => $episodio,
                    ],
                    [
                        'cat_user_ubicacion_id'=> isset($request->cat_user_ubicacion_id) ? $request->cat_user_ubicacion_id : 387,//
                        'user_cuest_episodio_id'   => $episodio,
                        'value'=> isset($request->value) ? $request->value : NULL,
                        'user_id_paciente'=> $request->user_id,
                        'value'=> "Ingreso Emergencia",
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );*/
            //7 ESTATUS (ALERTA)
                /*$prioridad_value=1;
                $valida_prioridad = UserCuestAlert::where("user_id_paciente",$request->user_id)
                ->where("user_cuest_episodio_id",$episodio)
                ->where("active",1)
                ->orderBy("created_at","DESC")
                ->take(1)
                ->get();
                if (count( $valida_prioridad ) > 0 ) {
                    $prioridad_value = $valida_prioridad[0]->value;
                }
                $prioridad = UserCuestAlert::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    'user_cuest_episodio_id'   => $episodio,
                    ],
                    [
                        'value'=> $prioridad_value,
                        'user_cuest_episodio_id'   => $episodio,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );*/

            //8 VIP
                /*$vip_value=0;
                $valida_vip = UserVip::where("user_id_paciente",$request->user_id)
                ->where("user_cuest_episodio_id",$episodio)
                ->where("active",1)
                ->orderBy("created_at","DESC")
                ->take(1)
                ->get();
                if (count( $valida_vip ) > 0 ) {
                    $vip_value = $valida_vip[0]->value;
                }*/
                /*$vip = UserVip::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    'user_cuest_episodio_id'   => $episodio,
                    ],
                    [
                        'value'=> $vip_value,
                        'user_cuest_episodio_id'   => $episodio,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );*/
            //9 USER CENTRO SALUD (AMBULATORIO)
                $centro_salud_id = [config("app.APP_CENTRO_SALUD_ID")];
                if (isset($request->centro_salud_id)) {
                    $centro_salud_id = explode(",",$request->centro_salud_id);
                }

                foreach ($centro_salud_id as $value) {
                    $user_centro_salud = UserCentroSalud::updateOrCreate(
                        [
                        'user_id_paciente'   => $user_id,
                        'centro_salud_id'   => $value,
                        ],
                        [
                            'centro_salud_id'   => $value,
                            'cat_user_type_id'   => isset($request->user_type_id) ? $request->user_type_id : 2,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }

            //10 TARJETA SOYCHACAO
                $tarjeta_soy_chacao = NULL;
                if (isset($request->tarjeta_soy_chacao)) {
                    $tarjeta_soy_chacao = $request->tarjeta_soy_chacao;
                }else{
                    $tarjeta_soy_chacao = TarjetaSoyChacao::where("user_id_paciente",$user_id)->first();

                    if ( !is_null($tarjeta_soy_chacao) ) {
                        $tarjeta_soy_chacao = $tarjeta_soy_chacao->description;
                    }else{
                        $tarjeta_soy_chacao = NULL;
                    }

                }
                TarjetaSoyChacao::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    ],
                    [
                        'description'   => $tarjeta_soy_chacao,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );


            //PARA EL MEDICO:

            //11 MEDICO ESPECIALIDAD
                $cat_especialidad_id = [1];
                if (isset($request->cat_user_especialidad_id)) {
                    $cat_especialidad_id = explode(",",$request->cat_user_especialidad_id);
                }
                foreach ($cat_especialidad_id as $value) {
                    $user_centro_salud = UserEspecialidad::updateOrCreate(
                        [
                            'user_id'   => $user_id,
                            'cat_user_especialidad_id'   => $value,
                        ],
                        [
                            'cat_user_especialidad_id'   => $value,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }

            //12 MEDICO POSICION
                $cat_medico_posicion_id = [1];
                if (isset($request->cat_medico_posicion_id)) {
                    $cat_medico_posicion_id = [$request->cat_medico_posicion_id];
                }
                foreach ($cat_medico_posicion_id as $value) {
                    $cat_medico_posicion_id = UserMedicoPosicion::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        'cat_user_medico_posicion_id'   => $value,
                        ],
                        [
                            'cat_user_medico_posicion_id'   => $value,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }
            //13 EQUIPO SALUD
                $cat_user_equipo_salud_id = 1;
                    if (isset($request->cat_user_equipo_salud_id)) {
                        $cat_user_equipo_salud_id = $request->cat_user_equipo_salud_id;
                    }

                    $cat_user_equipo_salud_id = UserEquipoSalud::updateOrCreate(
                        [
                            'user_id'   => $user_id,
                            'cat_user_equipo_salud_id'   => $cat_user_equipo_salud_id,
                        ],
                        [
                            'cat_user_equipo_salud_id'   => $cat_user_equipo_salud_id,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );


            if ( config("app.APP_SEND_EMAILS") ) {
                $model['case']=2;

                $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                $model['subject']= "Actualización de datos";

                if ( config("app.APP_TEST_MODE") ) {
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
            }else{
                //dump("El envio de correos está desabilitado.") ;
            }
            return UserMedico::getMedico($user_id);
        } catch (\Throwable $th) {
            echo "Error en UserMedicoController -> consultaExternaStore() -> ".$th;
        }
        return Response()->json(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function app()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view('medico.app');
    }
    public function appHomecare()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view('homecare.app');
    }
    public function storeMedicoFromFile()
    {
        try {
            //code...
            $rutaArchivo = "usuarios_patientcare.xlsx";
            //$reader = new Spreadsheet();
            //dd( $reader->import($rutaArchivo));
            $spreadsheet = IOFactory::load( $rutaArchivo );
            $sheet = $spreadsheet->getActiveSheet();
            $totalRow = $sheet->getHighestRow();
            $resultSet = [];
            for ($row=2; $row <= $totalRow; $row++) {
                $correo = $sheet->getCell("B{$row}")->getValue();
                $cedula = $sheet->getCell("C{$row}")->getValue();
                $fnacimiento = date('Y-m-d',$sheet->getCell("G{$row}")->getValue() );
                $telefono_movil = $sheet->getCell("H{$row}")->getValue();
                $nombres = "";
                $apellidos = "";
                $genero = $sheet->getCell("F{$row}")->getValue() == "Masculino" ? "m":"f";
                $prefijo = "";
                $temp_prefijo = $sheet->getCell("I{$row}")->getValue();
                if ( $temp_prefijo =="Licenciad@") {
                    if ($genero=="m") {
                        $prefijo = "Licdo.";
                    }else{
                        $prefijo = "Licda.";
                    }
                }
                if ( $temp_prefijo =="TSU") {
                    $prefijo = "TSU";
                }

                $nombreApellidos = explode(" ",$sheet->getCell("E{$row}")->getValue());
                if (count($nombreApellidos) == 2) {
                    $nombres    = $nombreApellidos[0];
                    $apellidos  = $nombreApellidos[1];
                }
                if (count($nombreApellidos) == 3) {
                    $nombres    = $nombreApellidos[0];
                    $apellidos  = $nombreApellidos[1]." ".$nombreApellidos[2];
                }
                if (count($nombreApellidos) > 3) {
                    $nombres    = $nombreApellidos[0]." ".$nombreApellidos[1];
                    $apellidos  = $nombreApellidos[2]." ".$nombreApellidos[3];
                }

                //dump(  $correo ." ". $cedula ." ". $genero ." ".  trim($nombres." ".$apellidos) ." ".$cedula  );
                try {
                    //VERIFICAR SI LA CEDULA EXISTE
                        $user_id =NULL;
                        $email = NULL;
                        $existe_cedula =    UserProfile::where("cedula",$cedula)
                                            ->leftJoin("user", "user_profile.user_id", "user.id")
                                            ->select("user.email","user_profile.user_id","user.password")
                                            ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();
                        if ( !empty($existe_cedula) ) {
                            $user_id = $existe_cedula[0]['user_id'];
                            $email =  $existe_cedula[0]['email'];
                        }
                        if ($email != $correo) {
                            $email = $correo;
                        }
                        $existe_email = User::where("email",$correo)->first();
                        if (is_null($existe_email)) {
                            $email = $correo;

                        }else{
                            $user_id = $existe_email->id;
                            $email = $cedula."@correotemporal.com";
                        }
                        //dd($existe_cedula);

                        //-----------
                        if ( !empty($existe_cedula) ) {
                            $email =  $existe_cedula[0]['email'];
                            if ($existe_cedula[0]['email']!= $correo) {
                                $email = $correo;
                            }
                            $model = User::firstOrCreate(
                                ['id' => $user_id],
                                [
                                    'email'          => $email,
                                    'password'       => $existe_cedula[0]['password'] ,
                                    'user_id_medico' => Auth::id(),
                                    "created_at"     => date('Y-m-d H:i:s' )
                                ]
                            );
                            $user_id = $model->id;
                        }else{
                            $model = User::firstOrCreate(
                                ['email' => $email],
                                [
                                    'email'          => $email,
                                    'password'       => "123456",
                                    'user_id_medico' => Auth::id(),
                                    "created_at"     => date('Y-m-d H:i:s' )
                                ]
                            );
                            $user_id = $model->id;
                        }
                        //$request->merge(["user_id_paciente"=>$user_id]);
                        //$request->merge(["user_id"=>$user_id]);
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                        //-------------
                    //2 USER_TYPE
                        $model = UserType::updateOrCreate(
                            [
                            'user_id'   => $user_id,
                            'cat_user_type_id' => 2,
                            ],
                            [
                                'user_id'          => $user_id,
                                'cat_user_type_id' => 2,
                                'user_id_medico'   => Auth::id(),
                                "created_at"       => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                        $model = UserType::updateOrCreate(
                            [
                            'user_id'   => $user_id,
                            'cat_user_type_id' => 1,
                            ],
                            [
                                'user_id'          => $user_id,
                                'cat_user_type_id' => 1,
                                'user_id_medico'   => Auth::id(),
                                "created_at"       => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                    //3 USER_PROFILE

                        $model = UserProfile::updateOrCreate(
                            [
                                "user_id"=>$user_id,
                            ],
                            [
                                'nombres'        => $nombres,
                                'apellidos'      => $apellidos,
                                'nacionalidad'   => "V",
                                'cedula'         => $cedula,
                                'genero'         => $genero,
                                'fnacimiento'    => $fnacimiento,
                                'telefono_movil' => $telefono_movil,
                                'imagen'         => "/image/system/patient.svg",
                                "user_id"        => $user_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                    //5 USER_DIRECCION
                        $model = UserCuestDireccion::updateOrCreate(
                            [
                                'user_id' => $user_id
                            ],
                            [
                                'cat_estado_id'    => NULL,
                                'cat_municipio_id' => NULL,
                                'description'      => NULL,
                                'domicilio'        => NULL,
                                'user_id'          => $user_id,
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                    //11 MEDICO ESPECIALIDAD
                        $model = UserEspecialidad::updateOrCreate(
                            [
                                'user_id'   => $user_id,
                                'cat_user_especialidad_id'   => 67,
                            ],
                            [
                                'cat_user_especialidad_id'   => 67,
                                'user_id'   => $user_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                    //12 MEDICO POSICION
                        $model = UserMedicoPosicion::updateOrCreate(
                            [
                            'user_id'   => $user_id,
                            'cat_user_medico_posicion_id'   => 10,
                            ],
                            [
                                'cat_user_medico_posicion_id'   => 10,
                                'user_id'   => $user_id,
                                'user_id_medico' => 22,
                                "created_at"     => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                    //13 EQUIPO SALUD
                        $model = UserEquipoSalud::updateOrCreate(
                            [
                                'user_id'   => $user_id,
                                'cat_user_equipo_salud_id'   => 2,
                            ],
                            [
                                'cat_user_equipo_salud_id'   => 2,
                                'user_id'   => $user_id,
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s' )
                            ]
                        );
                        if ($model->exists) {
                            $resultSet[ $model->getTable() ] = $model->toArray();
                        }
                        //dump($resultSet);
                } catch (\Throwable $th) {
                    dd($th);
                }
                //dump($resultSet);
            }





            dd("Listo");
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function index_medicos()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }else{
            if(UserType::where('user_id',Auth::id())->where("cat_user_type_id",4)->count() === 0){
                return redirect('/auth/menu_inicial_principal');
            }else{
                return view("medico.index_medicos");
            }
        }
    
    }
    // public function nuevasCitas()
    // {
    //     $citas = Cita::index()->toArray();
    //     $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    //     foreach ($citas as $key => $value) {
    //         //dd($value);
    //         $citas[$key]["mes_nombre"] = $mes[ (int) $value['month'] -1 ];
    //         $citas[$key]["paciente"] = UserProfile::where("user_id",$value['user_id_paciente'])
    //                     ->select(
    //                         DB::raw("
    //                             CONCAT(
    //                                 nombres,
    //                                 ' ',
    //                                 apellidos
    //                                 ) as paciente
    //                         ")
    //                     )->value('paciente');
    //         $citas[$key]["medico"] = UserProfile::where("user_id",$value['user_id_medico'])
    //                     ->select(
    //                         DB::raw("
    //                             CONCAT(
    //                                 nombres,
    //                                 ' ',
    //                                 apellidos
    //                                 ) as medico
    //                         ")
    //                     )->value('medico');
    //         $citas[$key]["especialidad_nombre"] = CatEspecialidad::where("id",$value['cat_especialidad_id'])
    //                     ->value('description');

    //     }
    //    return $citas;
    // }
    public function nuevasCitas()
    {
        $citas = UserCita::index_medico()->toArray();
        return $this->getCitas($citas, true);
    }
    // public function tablero_cita()
    // {
    //     $citas = $this->nuevasCitas();
    //     //dd($citas);
    //     return view('paciente.solicitud_cita/index' , compact('citas'));
    // }
    public function tablero_cita()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        $centro_salud_nombre = session('user_centro_salud_nombre');
        $citas = $this->nuevasCitas();
        //dd($citas);
        return view('paciente.solicitud_cita/index' , compact('citas','centro_salud_nombre'));
        //return view('paciente.solicitud_cita/index_nuevo' );
    }
    public function guardias()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("medico.guardias");
    }
    public function getMedicoPerfil()
    {
       return Auth::user()->profile;
    }
    public function index()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        //$userInfo = UserProfile::where("user_id",Auth::id())->first();

        //$hospitalizados = UserCuestUbicacion::getAllHospitalizados();
        //$pad = UserCuestUbicacion::getAllPad();
        return view("medico.indexNUEVO");
        //return view("paciente.index_nose");
    }
    public function copia()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        //$userInfo = UserProfile::where("user_id",Auth::id())->first();

        //$hospitalizados = UserCuestUbicacion::getAllHospitalizados();
        //$pad = UserCuestUbicacion::getAllPad();
        return view("medico.copia");
        //return view("paciente.index_nose");
    }
    public function getPacientes($user_id){
        function posibleEgreso($episodio){
            $prealta = $episodio->pre_alta;
            $prealta =  !is_null($prealta) ? (new DateTime($prealta))->format('Y-m-d') : $prealta ;
            $model['prealta'] = $prealta;
            $model['prealta_color']  = "info";
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
                    $model['prealta_color'] = "success";
                }
                if ($diff->days == 1) {
                    $model['prealta_color'] = "warning";
                }
                if ($diff->days == 0) {
                    $model['prealta_color'] = "danger";
                }
            }
            return $model;
        }
        /*
            QUE NO ESTEN EN ESTAS UBICACIONES:
            246 Alta
            247 Contraopinion
            248 Fallecido
            249 Otra
            250 Reingreso
            251 Traslado
            364 Whatsapp
            365 Telefono convencional
            366 Web
            367 Instagram
        */
        $filter = "";

        if(!is_null($user_id) && $user_id != "null"){
            $filter = "AND user.id=".$user_id;
        }
        $query = "
            SELECT
                #USER
                    DISTINCT user.id AS user_id,
                    user.email AS email,
                #USER_PROFILE
                    up.*,
                    YEAR(CURDATE())-YEAR(up.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(up.fnacimiento,'%m-%d'), 0 , -1 ) AS edad,
                    CONCAT(
                        up.nacionalidad,
                        '-',
                        FORMAT(up.cedula, 0, 'de_DE')
                    ) AS cedula_formateada,
                    CONCAT(
                        up.nombres,
                        ' ',
                        up.apellidos
                    ) AS paciente,
                #UBICACION
                    (TO_DAYS(NOW()) - TO_DAYS(ucu.created_at)) AS ubicacion_dias,
                    cuu.id AS ubicacion_id,
                    cuu.parent_cat_user_ubicacion_id AS parent_cat_user_ubicacion_id,
                    CONCAT(
                        cuu.description,
                        ' | ',
                        cuu.coments
                    ) AS ubicacion,


                #PRIORIDAD
                    (
                        SELECT value
                        FROM user_cuest_alert
                        WHERE user_id_paciente = user.id
                        AND active=1
                    ) AS alert


                #-----
                FROM user

                JOIN user_profile AS up ON user.id                          = up.user_id
                JOIN user_type AS ut ON user.id                             = ut.user_id
                JOIN user_cuest_ubicacion AS ucu ON user.id                 = ucu.user_id_paciente
                JOIN cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
                JOIN user_cuest_episodio AS uce ON user.id                 = uce.user_id
                WHERE  ucu.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)
                AND up.apellidos IS NOT NULL
                AND up.fnacimiento IS NOT NULL
                AND up.genero IS NOT NULL
                AND ucu.active = 1
                AND uce.active = 1
                AND  cuu.parent_cat_user_ubicacion_id IN (224,372,379)
                LIMIT 1
            ";

            $model = DB::select($query, [1]);
           // return $model;
            $paciente = [];
            $user_id_filtrados=[];
            foreach ($model as $key => $value) {
                //if (!in_array($value->user_id,$user_id_filtrados)) {
                    $user_id_filtrados[]=$value->user_id;

                    $paciente[$key]['user_id']= $value->user_id;
                    $paciente[$key]['data_user']['vip']= uservip::show($value->user_id);
                    $paciente[$key]['data_user']['image']= $value->imagen;
                    $paciente[$key]['data_user']['email']= $value->email;
                    $paciente[$key]['data_user']['name']= $value->nombres;
                    $paciente[$key]['data_user']['lastname']= $value->apellidos;
                    $paciente[$key]['data_user']['nacionality']= $value->nacionalidad;
                    $paciente[$key]['data_user']['document_id']= $value->cedula;
                    $paciente[$key]['data_user']['document_id_formated']= $value->cedula_formateada;
                    $paciente[$key]['data_user']['patient_name']= $value->paciente;

                    $paciente[$key]['data_user']['age']= $value->edad;
                    $paciente[$key]['data_user']['gender']=  strtoupper($value->genero);
                    $paciente[$key]['data_user']['birtday']= $value->fnacimiento;
                    $paciente[$key]['data_user']['telephone_contact']= $value->telefono_movil;
                    $paciente[$key]['data_user']['blood_type']= $value->tipo_sangre;
                    $direction = UserCuestDireccion::show($value->user_id);
                    $paciente[$key]['data_user']['estado']= $direction["cat_estado_id"];
                    $paciente[$key]['data_user']['municipio']= $direction["cat_municipio_id"];
                    $paciente[$key]['data_user']['city']= $direction["ciudad"];
                    $paciente[$key]['data_user']['address']= $direction["domicilio"];
                    $paciente[$key]['data_user']['family_contact']= [];

                    $episodioactual = UserCuestEpisodio::show($value->user_id);
                    $paciente[$key]['current_episode']['episode_id']= $episodioactual->id;
                    $paciente[$key]['current_episode']['alert']= $value->alert;
                    $paciente[$key]['current_episode']['admission_date']=$episodioactual->ingreso;

                    $prealta = posibleEgreso($episodioactual);
                    $paciente[$key]['current_episode']['probable_departure_date']=$prealta['prealta'];
                    $paciente[$key]['current_episode']['probable_departure_date_color']=$prealta['prealta_color'];


                    $paciente[$key]['current_episode']['blue_code']=$episodioactual->codigo_azul;
                    $paciente[$key]['current_episode']['current_location_days']=$value->ubicacion_dias;
                    $paciente[$key]['current_episode']['current_location_id']=$value->ubicacion_id;
                    $paciente[$key]['current_episode']['current_location_id_parent']=$value->parent_cat_user_ubicacion_id;
                    $paciente[$key]['current_episode']['current_location_description']=$value->ubicacion;
                    $paciente[$key]['current_episode']['location_history']= UserCuestUbicacion::historialubiepisodio($value->user_id);;

                    $paciente[$key]['current_episode']['historia_inicial']=[
                        "vital_signs"=>[
                            "temp"  => ["value"=>null,"color"=>null,"unity"=>"°c"],
                            "pa"    => ["value"=>null,"color"=>null,"unity"=>"lat/min"],
                            "imc"   => ["value"=>null,"color"=>null,"unity"=>"imc"],
                            "height"=> ["value"=>null,"color"=>null,"unity"=>"cm"],
                            "weight"=> ["value"=>null,"color"=>null,"unity"=>"kg"],
                            "ta"    => ["value"=>null,"color"=>null,"unity"=>"mmhg"],
                            "fr"    => ["value"=>null,"color"=>null,"unity"=>"resp/min"],
                            "fc"    => ["value"=>null,"color"=>null,"unity"=>"lat/min"],
                        ],
                        "consulta_motivo"=>null,
                        "consulta_enfermedad_actual"=>null,
                        "consulta_examen_fisico"=>[],
                    ];

                    $paciente[$key]['current_episode']['doctors'] = UserCuestMedicoPaciente::getMedicosByPaciente($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['diagnostic_probability']=usercuestimpresiondiagnostica::show($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['antecedentes']=[];//no existe

                    $paciente[$key]['current_episode']['cormobilitys']=usercuestcomorbilidad::getComorbilidad($value->user_id);

                    $paciente[$key]['current_episode']['alergy']=[];//no existe

                    $paciente[$key]['current_episode']['permanent_medicines']=[];//no existe

                    $paciente[$key]['current_episode']['reports']=[];//no existe

                    $paciente[$key]['current_episode']['laboratory']=UserCuestLaboratorio::getLaboratorios($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['pictures']=usercuestimagen::getImagenes($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['fotografy']=usercuestfotografia::getFotografy($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['otros_archivos']=usercuestotroarchivo::getOtrosArchivos($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['evolution']= usercuestevolucion::getevolutions($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['ordenes_medicas']=[];
                    $paciente[$key]['current_episode']['ordenes_medicas']=[
                        "recipes"=>UserCuestRecipe::getRecipes($value->user_id,$episodioactual->id),
                        "estudios_diagnosticos"=>UserCuestEstudio::getEstudiosDiagn($value->user_id,$episodioactual->id),
                    ];
                    $paciente[$key]['current_episode']['observation']=UserCuestObservacion::getObservations($value->user_id,$episodioactual->id);

                    $paciente[$key]['current_episode']['pendientes']= UserCuestPendiente::getPendientes($value->user_id,$episodioactual->id);

                    /*temporal* */
                    /*UserCuestTemperatura::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->where("cat_user_cuestionario_id",84)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestTa::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestFr::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestFc::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestGlic::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestGlic::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestOximetria::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->where("cat_user_cuestionario_id",73)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestOxigenoterapia::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestSintoma::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestPcr::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestPdr::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestAntg::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestTac::where("user_id",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);

                    UserCuestChat::where("user_id_paciente",$value->user_id)
                    ->where("user_cuest_episodio_id",NULL)
                    ->update(["user_cuest_episodio_id"=>$episodioactual->id]);*/

                    /*temporal* */

                    $paciente[$key]['current_episode']['monitoreo']=[
                        "pa"            => ["value"=>null,"color"=>null,"unity"=>"lat/min"],
                        "imc"           => ["value"=>null,"color"=>null,"unity"=>"imc"],
                        "height"        => ["value"=>null,"color"=>null,"unity"=>"cm"],
                        "weight"        => ["value"=>null,"color"=>null,"unity"=>"kg"],
                        "temp"          => UserCuestTemperatura::index($value->user_id,$episodioactual->id),
                        "ta"            => UserCuestTa::index($value->user_id,$episodioactual->id),
                        "fr"            => UserCuestFr::index($value->user_id,$episodioactual->id),
                        "fc"            => UserCuestFc::index($value->user_id,$episodioactual->id),
                        "gl"            => UserCuestGlic::index($value->user_id,$episodioactual->id),
                        "spo2"          => UserCuestOximetria::index($value->user_id,$episodioactual->id),
                        "oxit"          => UserCuestOxigenoterapia::index($value->user_id,$episodioactual->id),#
                        "sintoma"      =>  UserCuestSintoma::index($value->user_id,$episodioactual->id),#
                        "pcr"           => UserCuestPcr::index($value->user_id,$episodioactual->id),
                        "pdr"           => UserCuestPdr::index($value->user_id,$episodioactual->id),
                        "antg"          => UserCuestAntg::index($value->user_id,$episodioactual->id),
                        "tac"           => UserCuestTac::index($value->user_id,$episodioactual->id),#
                        "chat_whatsapp" => UserCuestChat::index($value->user_id,$episodioactual->id)
                    ];
                    $paciente[$key]['consultas']=[
                        "citas_activas"=>[],
                    ];
                    $paciente[$key]['encuestas']=[];
                    $paciente[$key]['pad']=UserCuestPad::index($value->user_id);
                    $paciente[$key]['clinicas']=[];


                //}
            }



            return $paciente;
            //dd( $paciente);
    }
    public function indexnuevo()
    {



        //dd(Response()->json($this->getPacientes(null)));
       // dd($this->getPacientes(null));
        /*
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }*/
       // dd("aaa");
        //$userInfo = UserProfile::where("user_id",Auth::id())->first();

        //$hospitalizados = UserCuestUbicacion::getAllHospitalizados();
        //$pad = UserCuestUbicacion::getAllPad();
        return view("paciente.index_nose");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("medico.create");
    }
    public function create_externo()
    {

        return view("medico.create_externo");
    }
    public function create_monitoreo()
    {
        return view("medico.create_monitoreo");
    }
    public function getMedicos()
    {
        return Response()->json(UserMedico::getMedicos());
    }
    public function updateRol(Request $request)
    {
        $model = UserType::where('user_id',$request->user_id)->where("cat_user_type_id",$request->role_id)->first();
        if(is_null($model)){

          UserType::create([
            'user_id'=>$request->user_id,
            'cat_user_type_id'=>$request->role_id,
            'user_id_medico'=>Auth::id(),
            'created_at'=>date('Y-m-d H:i:s'),
            'active'=>1
          ]);
        }else{
            $model->delete();
        }
        return Response()->json(['success'=>true]);
    
    }
    public function posicionAleatoriaMedico()
    {
    /* return Response()->json(UserMedico::posicionAleatoriaMedico());*/
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        /*
        $model = UserProfile::store($request);

        UserType::store($request);

        UserEspecialidad::store($request);

        UserCuestEquipoSalud::store($request);



        return Response()->json($model);*/
    }
    public function store_monitoreo(Request $request)
    {
        dd($request->all());
       /* if(UserPacienteSintoma::storeMonitoreo($request)){
            return redirect()->route("medico");
        }*/
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }

        return view("medico.edit",compact('user_id'));

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
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
    }
    public function create_paciente()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("medico.create_paciente");
    }
    public function store_paciente(Request $request)
    {

    }
    public function addSeguimiento(Request $request)
    {
        UserCuestImpresionDiagnostica::store($request);
        UserCuestEvolucion::store($request);
        UserCuestPlan::store($request);
        UserCuestObservacion::store($request);
        UserCuestRecipe::store($request);
        UserCuestEstudio::store($request);

    }
    public function luisParodi()
    {
        //$userInfo = UserProfile::where("user_id",Auth::id())->first();
        $pacientes = DB::select("SELECT * FROM v_tp", [1]);
        $hospitalizados = UserCuestUbicacion::getAllHospitalizados();
        $pad = UserCuestUbicacion::getAllPad();
        return view("system_temp.index",compact("hospitalizados","pad","pacientes"));
    }
    public function consultaExternaUpdate(Request $request)
    {
        //1 User
        //2 UserType
        //3 Profile
        //4 Direction
        //5 Episodio
        //6 Ubicación en area
        //7 Estatus (alerta)
        //8 Vip
        //9 MedicoEspecialidad

        //10 MedicoPosicion
        //11 Centro Salud
        //12 Equipo salud




        try {
            //1 USER

            $user = User::find($request->user_id);
                $user->email =$request->email;
                $user->save();

                $user_id = $user->id;
                //dump($user);

                $request->merge(["user_id_paciente"=>$user_id]);
                $request->merge(["user_id"=>$user_id]);
            //3 USER_PROFILE






                $user_profile = UserProfile::store($request);


                if (!is_null(Auth::id())) {
                    session(['userData.imagen'=>$user_profile['imagen']]);
                    session(['userData.nombres'=>$request->nombres]);
                    session(['userData.apellidos'=>$request->apellidos]);
                    session(['userData.prefijo'=>$request->prefijo]);
                    session(['userData.genero'=>$request->genero]);
                    session(['userData.fullname'=>$request->prefijo." ".$request->nombres." ".$request->apellidos]);

                }
                $userImage = UserProfileImages::store($request);

            //4 DIRECTION
                $direction = UserCuestDireccion::store($request);


            //9 USER CENTRO SALUD (AMBULATORIO)
                $centro_salud_id = [config("app.APP_CENTRO_SALUD_ID")];
                UserCentroSalud::where("user_id_paciente", $user_id)->delete();
                if (isset($request->centro_salud_id)) {
                    $centro_salud_id = explode(",",$request->centro_salud_id);
                }
                //dd($request->all());
                foreach ($centro_salud_id as $value) {

                    $user_centro_salud = UserCentroSalud::create(
                        [
                            'centro_salud_id'   => $value,
                            'cat_user_type_id'   => isset($request->user_type_id) ? $request->user_type_id : 2,
                            'user_id_paciente'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }

            //10 TARJETA SOYCHACAO
                $tarjeta_soy_chacao = NULL;
                if (isset($request->tarjeta_soy_chacao)) {
                    $tarjeta_soy_chacao = $request->tarjeta_soy_chacao;
                }else{
                    $tarjeta_soy_chacao = TarjetaSoyChacao::where("user_id_paciente",$user_id)->first();

                    if ( !is_null($tarjeta_soy_chacao) ) {
                        $tarjeta_soy_chacao = $tarjeta_soy_chacao->description;
                    }else{
                        $tarjeta_soy_chacao = NULL;
                    }

                }
                TarjetaSoyChacao::updateOrCreate(
                    [
                    'user_id_paciente'   => $user_id,
                    ],
                    [
                        'description'   => $tarjeta_soy_chacao,
                        'user_id_paciente'   => $user_id,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                    ]
                );


                //PARA EL MEDICO:

            //11 MEDICO ESPECIALIDAD
                $cat_especialidad_id = [68];
                if (isset($request->cat_user_especialidad_id)) {
                    $cat_especialidad_id = explode(",",$request->cat_user_especialidad_id);
                }
                foreach ($cat_especialidad_id as $value) {
                    $user_centro_salud = UserEspecialidad::updateOrCreate(
                        [
                            'user_id'   => $user_id,
                            'cat_user_especialidad_id'   => $value,
                        ],
                        [
                            'cat_user_especialidad_id'   => $value,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }

            //12 MEDICO POSICION
                $cat_medico_posicion_id = [1];
                if (isset($request->cat_medico_posicion_id)) {
                    $cat_medico_posicion_id = [$request->cat_medico_posicion_id];
                }
                foreach ($cat_medico_posicion_id as $value) {
                    $cat_medico_posicion_id = UserMedicoPosicion::updateOrCreate(
                        [
                        'user_id'   => $user_id,
                        'cat_user_medico_posicion_id'   => $value,
                        ],
                        [
                            'cat_user_medico_posicion_id'   => $value,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );
                }
            //13 EQUIPO SALUD
                $cat_user_equipo_salud_id = 1;
                    if (isset($request->cat_user_equipo_salud_id)) {
                        $cat_user_equipo_salud_id = $request->cat_user_equipo_salud_id;
                    }

                    $cat_user_equipo_salud_id = UserEquipoSalud::updateOrCreate(
                        [
                            'user_id'   => $user_id,
                            'cat_user_equipo_salud_id'   => $cat_user_equipo_salud_id,
                        ],
                        [
                            'cat_user_equipo_salud_id'   => $cat_user_equipo_salud_id,
                            'user_id'   => $user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );


                /* if ( config("app.APP_SEND_EMAILS") ) {
                    $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/".config('app.APP_LOGO_VERSION_REPORTS_COLOR') ;
                    $model['subject']= "Bienvenido al sistema.";

                    if ( config("app.APP_TEST_MODE") ) {
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
                }else{
                    //dump("El envio de correos está desabilitado.") ;
                } */

                //UserMedicoActivo   JO

                $userMedicoActivo = UserMedicoActivo::updateOrCreate(
                    ['user_id_medico' => $user_id],
                    ['active' => 1]
                );

                return $this->getPersonalSaludOne($user_id);
                //return UserMedico::getMedico($user_id);
        } catch (\Throwable $th) {
            echo "Error UserMedicoController --> consultaExternaUpdate() --> ".$th;
            // dd($th);
        }
        return Response()->json(true);
    }

    public function getPersonalSaludOne($user_id_medico)
    {
        $model =    UserType::whereIn("user_type.cat_user_type_id",[2,6,7])
                    ->where("user_type.user_id",$user_id_medico)
                    ->join("cat_user_type","user_type.cat_user_type_id", "cat_user_type.id")
                    ->where("user_type.active",1)
                    ->select(
                        DB::raw("cat_user_type.description AS cat_user_type_description"),
                        DB::raw("user_type.user_id AS user_id"),
                        DB::raw("user_type.id AS user_type_id"),
                        DB::raw("user_type.cat_user_type_id")
                    )
                    ->get()
                    ->take(1)
                    ->toArray();
        foreach($model as $key => $value){
            $model[$key] = array_merge(
                $model[$key],
                UserProfile::where("user_id",$value['user_id'])
                    ->select(
                        "user_profile.imagen",
                        "user_profile.nacionalidad",
                        "user_profile.cedula AS cedula_unformatted",
                        "user_profile.nombres",
                        "user_profile.apellidos",
                        "user_profile.fnacimiento",
                        "user_profile.telefono_movil",
                        "user_profile.firma",
                        "user_profile.sello",
                        "user_profile.mpps",
                        "user_profile.colegio_medico",
                        DB::raw("
                            CASE
                                WHEN user_profile.genero = 'm' THEN 'M'
                                WHEN user_profile.genero = 'f' THEN 'F'
                                ELSE ''
                            END  AS genero
                        "),
                        DB::raw("
                            YEAR( CURDATE() ) - YEAR( user_profile.fnacimiento ) +
                            IF( DATE_FORMAT( CURDATE() ,'%m-%d' ) > DATE_FORMAT( user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad"
                        ),
                        DB::raw("
                            CASE
                                WHEN user_profile.prefijo IS NOT NULL AND user_profile.prefijo != 'null' THEN user_profile.prefijo
                            ELSE ''
                            END AS prefijo
                        "),
                        DB::raw("
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
                            ) AS medico
                        "),
                        DB::raw("
                            CONCAT(user_profile.nacionalidad,'',user_profile.cedula) AS cedula
                        ")
                    )
                    ->first()
                    ->toArray()
            );

            $model[$key]['especialidad'] = UserEspecialidad::where("user_id",$value['user_id'])
                ->join('cat_user_especialidad', 'user_especialidad.cat_user_especialidad_id', 'cat_user_especialidad.id')
                ->select(
                    DB::raw("user_especialidad.id AS user_especialidad_id"),
                    DB::raw("user_especialidad.cat_user_especialidad_id"),
                    DB::raw("cat_user_especialidad.description AS cat_user_especialidad_description"),
                    DB::raw("cat_user_especialidad.image AS cat_user_especialidad_image")
                )
                ->get()
                ->toArray();

            $equipo_salud = UserEquipoSalud::where("user_id",$value['user_id'])
                ->where("user_equipo_salud.active",1)
                ->join('cat_user_equipo_salud', 'user_equipo_salud.cat_user_equipo_salud_id', 'cat_user_equipo_salud.id')
                ->select(
                    DB::raw("user_equipo_salud.id AS user_equipo_salud_id"),
                    DB::raw("user_equipo_salud.cat_user_equipo_salud_id"),
                    DB::raw("cat_user_equipo_salud.description AS cat_user_equipo_salud_description")
                )
                ->first();
            $model[$key]['user_equipo_salud_id'] = NULL;
            $model[$key]['cat_user_equipo_salud_id'] = NULL;
            $model[$key]['cat_user_equipo_salud_description'] = NULL;
            if (!is_null($equipo_salud)) {

                $model[$key] = array_merge(
                    $model[$key],
                    $equipo_salud->toArray()
                );
            }

            //$model[$key]['user_cuest_direction'] = NULL;
            $model[$key]['user_cuest_direction_id'] = NULL;
            $model[$key]['user_cuest_direction_description'] = NULL;
            $model[$key]['user_cuest_direction_domicilio'] = NULL;
            $model[$key]['cat_estado_id'] = NULL;
            $model[$key]['cat_municipio_id'] = NULL;
            $direccion = UserCuestDireccion::where("user_id",$value['user_id'])
                ->select(
                    DB::raw("user_cuest_direction.id  AS user_cuest_direction_id"),
                    DB::raw("user_cuest_direction.description  AS user_cuest_direction_description"),
                    DB::raw("user_cuest_direction.domicilio  AS user_cuest_direction_domicilio"),
                    "user_cuest_direction.cat_estado_id",
                    "user_cuest_direction.cat_municipio_id"
                )
                ->first();
            if (!is_null($direccion)) {
                $model[$key] = array_merge(
                    $model[$key],
                    $direccion->toArray()
                );
            }

            $model[$key]['user_medico_posicion_id'] = NULL;
            $model[$key]['cat_user_medico_posicion_description'] = NULL;
            $position = UserMedicoPosicion::where("user_medico_posicion.user_id",$value['user_id'])
            ->join("cat_user_medico_posicion","user_medico_posicion.cat_user_medico_posicion_id","cat_user_medico_posicion.id")
            ->where("user_medico_posicion.active",1)
            ->select(
                "user_medico_posicion.id AS user_medico_posicion_id",
                "user_medico_posicion.cat_user_medico_posicion_id",
                "cat_user_medico_posicion.description AS cat_user_medico_posicion_description"
            )
            ->first();

            if (!is_null($position)) {

                $model[$key] = array_merge(
                    $model[$key],
                    $position->toArray()
                );
            }



            $model[$key] = array_merge(
                $model[$key],
                User::where("id",$value['user_id'])
                ->select(
                    DB::raw("email")
                )
                ->first()
                ->toArray()
            );

            $model[$key]['tarjeta_soy_chacao'] = NULL;
            $soy_chacao = TarjetaSoyChacao::where("user_id_paciente",$value['user_id'])
                ->select(
                    DB::raw("description AS tarjeta_soy_chacao")
                )
                ->first();
            if (!is_null($soy_chacao)) {
                $model[$key] = array_merge(
                    $model[$key],
                    $soy_chacao->toArray()
                );
            }

            $model[$key]['imgSoyChacao'] = NULL;
            $imgSoyChacao = UserProfileImages::where("user_id_paciente",$value['user_id'])
                ->where("user_profile_images.coments",'imgSoyChacao' )
                ->where("user_profile_images.active",1 )
                ->select(
                    DB::raw("user_profile_images.value AS imgSoyChacao")
                )
                ->first();
            if (!is_null($imgSoyChacao)) {
                $model[$key] = array_merge(
                    $model[$key],
                    $imgSoyChacao->toArray()
                );
            }

            $model[$key]['imgDocIdentidad'] = NULL;
            $imgDocIdentidad = UserProfileImages::where("user_id_paciente",$value['user_id'])
                ->where("user_profile_images.coments",'imgDocIdentidad' )
                ->where("user_profile_images.active",1 )
                ->select(
                    DB::raw("user_profile_images.value AS imgDocIdentidad")
                )
                ->first();
            if (!is_null($imgDocIdentidad)) {
                $model[$key] = array_merge(
                    $model[$key],
                    $imgDocIdentidad->toArray()
                );
            }

            $model[$key]['agendas'] = UserMedicoAgenda::where("user_id_medico",$value['user_id'])
                ->where("active",1)
                ->select(
                    DB::raw("id AS agenda_id"),
                    DB::raw("agenda"),
                    DB::raw("cat_especialidad_id"),
                    DB::raw("
                        (
                            SELECT description
                            FROM cat_user_especialidad
                            WHERE id = user_medico_agenda.cat_especialidad_id
                        ) AS especialidad_description
                    "),
                    DB::raw("centro_salud_id"),
                    DB::raw("
                        (
                            SELECT description
                            FROM centro_salud
                            WHERE id = user_medico_agenda.centro_salud_id
                        ) AS centro_salud_description
                    ")
                )
                ->get()
                ->toArray();
            $model[$key]['centros_salud_asignado'] = UserCentroSalud::where("user_id_paciente",$value['user_id'])
                ->where("cat_user_type_id",2)
                ->where("active",1)
                ->select(
                    DB::raw("id AS user_centro_salud_id"),
                    DB::raw("centro_salud_id"),
                    DB::raw("
                        (
                            SELECT description
                            FROM centro_salud
                            WHERE id = user_centro_salud.centro_salud_id
                        ) AS centro_salud_description
                    ")
                )
                ->get()
                ->toArray();
            $model[$key]['user_medico_activo'] = UserMedicoActivo::where("user_id_medico",$value['user_id'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(1);

        }

        //dd($model);
        $model = $model[0];

        return Response()->json($model);

    }

    public function removeRol($user_id)
    {

        $model = UserCentroSalud::where("user_id_paciente",$user_id)
        ->where("cat_user_type_id",2);
        $model->delete();


        $model = UserMedicoPosicion::where("user_id",$user_id);
        $model->delete();

        $model = UserEspecialidad::where("user_id",$user_id);
        $model->delete();

        $model = UserEquipoSalud::where("user_id",$user_id);
        $model->delete();

        $model = UserType::where("user_id",$user_id)
        ->where("cat_user_type_id",2);
        $model->delete();
        $model = UserMedicoAgenda::where("user_id_medico",$user_id);
        $model->delete();
        return UserMedico::getMedico($user_id);
    }

    public function citasCompletadas($user_id)
    {
        $citas =    UserCita::whereIn("cat_user_cita_status_id",[7])
                    ->where("user_id",Auth::id())
                    ->orderBy("created_at","DESC")
                    ->get()
                    ->toArray();
        return $this->getCitas($citas, true);
    }

    public function citasCompletadas_paciente($user_id)
    {
        $resource = [];
        $model =   new UserCita();
        $model = $model->join("cat_user_especialidad AS cue","user_cita.cat_especialidad_id","cue.id");
        $model = $model->join("centro_salud","user_cita.centro_salud_id","centro_salud.id");
        $model = $model->join("user_profile AS upMed","user_cita.user_id_medico","upMed.user_id");

        $model = $model->where("user_id_paciente",$user_id);
        $model = $model->whereIn("cat_user_cita_status_id",[7]);
        $model = $model->select(
                        "user_cita.*",
                        DB::raw("
                            centro_salud.description AS centro_salud_description
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
                            );
        $model = $model->orderBy("created_at","DESC");
        $model = $model->get();
        $model = $model->toArray();



        return $this->getCitas($model, false);
    }

    public function nuevasCitasOne($user_cita_id)
    {
        //$citas = UserCita::where("id",$user_cita_id)->get()->toArray();
        $citas = UserCita::index_medicoOne($user_cita_id)->toArray();
        return $this->getCitas($citas, false);
    }

    public function addRol($user_id)
    {
       /*  $user_profile = UserProfile::where('id', $user_id)->first();
        dd($user_profile); */
        UserCentroSalud::updateOrCreate(
            [
                "user_id_paciente"=>$user_id,
                "cat_user_type_id"=> 2,
                "centro_salud_id"=>  config("app.APP_CENTRO_SALUD_ID")
            ],
            [
                "user_id_paciente"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_type_id"=> 2,
                "centro_salud_id"=>  config("app.APP_CENTRO_SALUD_ID"),
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );
        UserMedicoPosicion::updateOrCreate(
            [
                "user_id"=>$user_id,
                "cat_user_medico_posicion_id"=>2
            ],
            [
                "user_id"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_medico_posicion_id"=>2,
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );
        UserEspecialidad::updateOrCreate(
            [
                "user_id"=>$user_id,
                "cat_user_especialidad_id"=>68
            ],
            [
                "user_id"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_especialidad_id"=>68,
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );
        UserEquipoSalud::updateOrCreate(
            [
                "user_id"=>$user_id,
                "cat_user_equipo_salud_id"=>1
            ],
            [
                "user_id"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_equipo_salud_id"=>1,
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );

        UserType::updateOrCreate(
            [
                "user_id"=>$user_id,
                "cat_user_type_id"=>2
            ],
            [
                "user_id"=>$user_id,
                "user_id_medico"=>Auth::id(),
                "cat_user_type_id"=>2,
                "created_at"=>date('Y-m-d H:i:s'),
                "active"=>1
            ]
        );
        return UserMedico::getMedico($user_id);
    }

    public function getMedico($user_id_medico)
    {
        return UserMedico::getMedico($user_id_medico);
    }

    public function getAll()
    {
        return Response()->json(UserMedico::getMedicos());
    }

    public function getAllCitas()
    {
        return Response()->json(UserMedico::getMedicosCitas());
    }

    public function getCitas($citas,$all=true){
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $pacientes_ids = array_unique ( array_column($citas,"user_id_paciente") );

        $medicos_ids = array_unique ( array_column($citas,"user_id_medico") );
        $citas_ids = array_unique ( array_column($citas,"id") );

        foreach ($citas as $key => $value) {

            $citas[$key]["user_cita_id"] = $value['id'];

            $citas[$key]["mes_nombre"] = $mes[ (int) $value['month'] -1 ];

            $hoy = date("Y-m-d");

            $dia_siguiente = date("Y-m-d",strtotime($hoy . "+ 1 days")) ;

            $dia_cita = date("Y-m-d", strtotime( $value['year'] ."-". $value['month'] ."-". $value['day'] ) ) ;

            if (
                strtotime( $hoy ) >= strtotime( $dia_cita ) &&
                strtotime( $dia_cita ) <= strtotime( $dia_siguiente ) &&
                $citas[$key]["cat_user_cita_status_id"] == 4
            ) {
                $citas[$key]["cat_user_cita_status_id"] = 5;
            }

            $citas[$key]["user_cortesia"] = UserCortesia::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_autorizacion"] = NULL;
            /* if (!is_null($value['user_id_autorizacion'])) {
                $citas[$key]["user_autorizacion"]      = UserProfile::where("user_id",$value['user_id_autorizacion'])
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
            } */



            $citas[$key]["user_peso"]                  = NULL; //UserCuestPeso::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_altura"]                = NULL; //UserCuestAltura::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_temp"]                  = NULL; //UserTemp::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_spo2"]                  = NULL; //UserOxi::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_fc"]                    = NULL; //UserFc::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_fr"]                    = NULL; //UserFr::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_glic"]                  = NULL; //UserGlic::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_ta"]                    = NULL; //UserTa::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_motivo_consulta"]       = NULL; //MotivoConsulta::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_impresion_diagnostica"] = NULL; //UserCuestImpresionDiagnostica::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_examen_fisico"]         = NULL; //ExamenFisico::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_enfermedad_actual"]     = NULL; //EnfermedadActual::where("user_cita_id",$citas[$key]['user_cita_id'])->first();
            $citas[$key]["user_plan"]                  = NULL; //UserCuestPlan::where("user_cita_id",$citas[$key]['user_cita_id'])->first();

            $citas[$key]["user_laboratorios"]          = [];
            $citas[$key]["user_fotografias"]           = [];

            $citas[$key]["user_otros_archivos"]        = [];
            $citas[$key]["user_citas_completadas"]    = [];


        }
        //fin foreach
        $model["citas"] = $citas;

        $model["user_condicion_medica"]     = [];//UserCondicionMedica::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_medicamento"]          = [];//UserCuestMedicamento::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_antecedente"]          = [];//UserCuestAntecedente::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_alergias"]             = [];//UserAlergia::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();


        $model["user_recipe"]               = NULL;//UserCuestRecipe::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_estudio"]              = NULL;//UserCuestEstudio::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_laboratorio"]          = NULL;//UserCuestLaboratorio::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_fotografia"]           = NULL;//UserCuestFotografia::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_imagenes"]             = NULL;//UserCuestImagen::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_otro_archivo"]         = NULL;//UserCuestOtroArchivo::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["cat_grupo_centro_salud_id"] = config('app.APP_GRUPO_CENTRO_SALUD_ID');

        if ($all) {
            $model['medicos'] = []; //UserMedico::getMedicos();
        }
        if ($all) {
            $model['medicos_agenda'] = []; //UserMedicoAgenda::getAll();
        }
        if ($all) {

            $model["centro_salud"] = NULL; //$centro_salud;
        }
        if ($all) {
            $model["users"] =  []; //User::userCita( $pacientes_ids );

        }
        //dd($model);
        return $model;
    }



}
