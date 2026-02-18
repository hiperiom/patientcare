<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
// use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserEspecialidad;
use App\Models\UserProfile;
use App\Models\AreaQuirurgica;
use App\Models\UserType;
use App\Models\ConsultaExterna;
use App\Models\UserCentroSalud;
use App\Models\CentroSalud;
use App\Models\UserFamily;
use App\Models\UserCita;
use App\Models\UserFamilyConsultaExterna;
use App\Models\CatEspecialidad;
use App\Models\UserMedico;
use App\Models\UserMedicoActivo;
use App\Models\UserMedicoAgenda;
use App\Models\UserCortesia;
use App\Models\UserProfileImages;
use App\Models\UserCuestDireccion;
use App\Models\TarjetaSoyChacao;

class ConsultaExternaController extends Controller
{

    public function storeUserCita(Request $request)
    {
        $model = UserCita::store($request);
        return Response()->json( $model ) ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("consultaexterna.index");
    }
    public function app()
    {
        return view("consultaExterna.app");
    }
    public function verificarCredenciales(Request $request)
    {
        //21404281

        $response = [];
        $user_profile = UserProfile::where('cedula', $request->email)
            ->select('user_id', 'fnacimiento')
            ->first();

        if (!is_null($user_profile)) {
            $user_id = $user_profile->user_id;

            $user = User::where('id', $user_id)
                ->where('password', $request->password)
                ->where('active', 1)
                ->first();
            //->pluck('password')->implode('password');
        } else {
            $user = User::where('email', $request->email)
                ->where('password', $request->password)
                ->where('active', 1)
                ->first();
            if (is_null($user)) {
                $response['success'] = false;
                return Response()->json($response);
            }
            $user_profile = UserProfile::where('user_id', $user->id)
                ->select('user_id', 'fnacimiento')
                ->first();
            $response['user_id']    = $user->id;
        }

        if (is_null($user)) {
            $response['success'] = false;
        } else {
            $response['success'] = true;
            $response['fnacimiento'] = $user_profile->fnacimiento;
            /* $model = UserCentroSalud::where('user_centro_salud.user_id_paciente', $user->id)
                ->join('centro_salud', 'user_centro_salud.centro_salud_id', 'centro_salud.id')
                ->join('cat_grupo_centro_salud', 'centro_salud.cat_grupo_centro_salud_id', 'cat_grupo_centro_salud.id')
                ->where('centro_salud.cat_grupo_centro_salud_id', 1)
                ->where('user_centro_salud.active', 1)
                ->get()
                ->toArray(); */
            //el rol 1 paciente puede acceder al centro salud con el id 1
            $response['user_centro_salud'][1] = 1;
            //el rol 2 medico puede acceder al centro salud con el id 1
            $response['user_centro_salud'][2] = 1;
            $response['user_centro_salud'][6] = 1;
            $response['user_centro_salud'][7] = 1;


            /* $response['user_centro_salud'][1] = array_column(
                array_filter($model, function ($centro) {
                    return is_null($centro['cat_user_type_id']);
                }),
                'centro_salud_id'
            );
            $response['user_centro_salud'][2] = array_column(
                array_filter($model, function ($centro) {
                    return $centro['cat_user_type_id'] == 2;
                }),
                'centro_salud_id'
            );
            $response['user_centro_salud'][6] = array_column(
                array_filter($model, function ($centro) {
                    return $centro['cat_user_type_id'] == 2;
                }),
                'centro_salud_id'
            );
            $response['user_centro_salud'][7] = array_column(
                array_filter($model, function ($centro) {
                    return in_array($centro['cat_user_type_id'], [2, 7, 6]);
                }),
                'centro_salud_id'
            ); */

            //array_push($response['user_centro_salud'][2], 10);
            $model = UserType::where('user_id', $user->id)
                ->get()
                ->where('active', 1)
                ->toArray();
            $roles =    array_column($model, 'cat_user_type_id');

            $response['user_type'] = $roles;
            if (!in_array(1, $response['user_type'])) {
                array_push($response['user_type'], 1);
            }

            //$response['user_type']=[1]; //temporal
            // dd($response['user_type']);
            foreach ($response['user_type'] as $value) {
                if ($value == 1) {
                    //paciente
                    $response['user_type_routes'][$value] = '/consultaexterna/paciente/home';
                }
                if ($value == 2) {
                    //medico
                    $response['user_type_routes'][$value] = '/consultaexterna/medico/tablero';
                    // $response['user_type_routes'][$value] = '/consultaexterna/app/citalistado/porconfirmar';
                }
                //3 familiar
                if ($value == 4) {
                    //admintrador
                    $response['user_type_routes'][$value] = '/consultaexterna/admintrador/tablero';
                }
                //5 inactivo
                if ($value == 6) {
                    //enfermeria
                    $response['user_type_routes'][$value] = '/consultaexterna/medico/cita/tablero';
                }
                if ($value == 7) {
                    //atencion paciente
                    $response['user_type_routes'][$value] = '/consultaexterna/medico/cita/tablero';
                }
                if ($value == 9) {
                    //reportes
                    $response['user_type_routes'][$value] = '/consultaexterna/admintrador/reportes';
                }
            }
        }
        return Response()->json($response);
    }
    public function initSession()
    {
        $request = json_decode($_GET['data']);
        //dd($request);
        $user_id = UserProfile::where('cedula', $request->email)->value('user_id');
        if (!is_null($user_id)) {
            $user = User::where('id', $user_id)
                ->where('password', $request->password)
                ->where('active', 1)
                ->first();
            //->pluck('password')->implode('password');
        } else {
            $user = User::where('email', $request->email)
                ->where('password', $request->password)
                ->where('active', 1)
                ->first();
        }


        Auth::login($user);
        $centro_salud = CentroSalud::where('centro_salud.id', 1)
            ->select(
                'centro_salud.*',
                DB::raw("
                                (
                                    SELECT
                                        CONCAT( user_profile.nombres,' ',user_profile.apellidos )
                                        FROM user_profile
                                    WHERE user_profile.user_id = centro_salud.user_id_gerente
                                ) AS gerente_nombre
                            ")
            )
            ->first();
        $user_type = array_column(
            UserType::where('user_id', $user->id)
                ->select('user_type.cat_user_type_id')
                ->get()
                ->toArray(),
            'cat_user_type_id'
        );

        if (!in_array(1, $user_type)) {
            array_push($user_type, 1);
        }


        //dd($centro_salud->user_id_gerente);
        Session::put('user_id_gerente', is_null($centro_salud) ? null : $centro_salud->user_id_gerente);
        Session::put('gerente_nombre', is_null($centro_salud) ? null : $centro_salud->gerente_nombre);
        Session::put('email', $user->email);
        Session::put('cat_user_type_id', $request->cat_user_type_id);
        Session::put('filtrar_por', 'solo_yo');
        if (in_array(4, $user_type) || in_array(6, $user_type) || in_array(7, $user_type)) {
            Session::put('filtrar_por', 'todas');
        }

        if (in_array(10, $user_type)) {
            Session::put('ver_citas_privadas', TRUE);
        } else {
            Session::put('ver_citas_privadas', FALSE);
        }

        Session::put('roles', $user_type);
        //Session::put('default_route', $request->cat_area_atencion_route);
        Session::put('user_centro_salud_id', 1);
        if ($request->cat_user_type_id == 1) {
            $paciente = UserProfile::where('user_id', $user->id)
                ->select("user_profile.*", DB::raw("tarjeta_soy_chacao.description AS tarjeta_soy_chacao"))
                ->leftJoin("tarjeta_soy_chacao", "user_profile.user_id", "tarjeta_soy_chacao.user_id_paciente")
                ->first();

            $pacienteData = [
                'nombre' => $paciente->nombres,
                'apellido' => $paciente->apellidos,
                'cedula' => $paciente->cedula,
                'telefono_movil' => $paciente->telefono_movil,
                'genero' => $paciente->genero,
                'imagen' => $paciente->imagen,
                'tarjeta_soy_chacao' => $paciente->tarjeta_soy_chacao,
            ];
            Session::put('userData', $pacienteData);

            //si existe el paciente lo llevo a su pantalla principal de sesion
            return redirect('/consultaexterna/paciente/home');
        }
        // dd($user->userType->cat_user_type_id );
        //4 si el usuario tiene el id medico
        if ($request->cat_user_type_id == 2 || $request->cat_user_type_id == 6 || $request->cat_user_type_id == 7) {
            Session::put('user_centro_salud_nombre', $centro_salud->description);
            Session::put('user_centro_salud_direccion', $centro_salud->coments);



            //5 consulto los datos del medico
            $medico = UserProfile::where('user_id', $user->id)->first();
            $especialidad = UserEspecialidad::show($user->id);
            //6 si no existe el medico lo llevo a la pantalla de registro
            //dd($medico);
            $medicoData = [
                'fullname' => (!is_null($medico->prefijo) ? $medico->prefijo . ' ' : '') . $medico->nombres . ' ' . $medico->apellidos,
                'prefijo' => !is_null($medico->prefijo) && $medico->prefijo != 'null' ? $medico->prefijo : '',
                'nombre' => $medico->nombres,
                'apellido' => $medico->apellidos,
                'cedula' => $medico->cedula,
                'telefono_movil' => $medico->telefono_movil,
                'genero' => $medico->genero,
                'especialidad_id' => isset($especialidad->cat_user_especialidad_id) ? $especialidad->cat_user_especialidad_id : 68,
                'especialidad' => isset($especialidad->description) ? $especialidad->description : "Sin especialidad",
                'imagen' => $medico->imagen,
                'firma' => $medico->firma,
                'sello' => $medico->sello,
                'mpps' => $medico->mpps,
                'colegio_medico' => $medico->colegio_medico,
            ];
            Session::put('userData', $medicoData);

            //si existe el medico lo llevo a su pantalla principal de sesion
            //return redirect("/medico");
            if ($request->centro_salud_id == 10) {
                return redirect('/medico');
            } else {
                return redirect($request->cat_area_atencion_route);
            }
        }

        if ($request->cat_user_type_id == 4 || $request->cat_user_type_id == 9) {
            //5 consulto los datos del medico
            $medico = UserProfile::where('user_id', $user->id)->first();

            //dd($medico);
            $medicoData = [
                'fullname' => (!is_null($medico->prefijo) ? $medico->prefijo . ' ' : '') . $medico->nombres . ' ' . $medico->apellidos,
                'prefijo' => !is_null($medico->prefijo) && $medico->prefijo != 'null' ? $medico->prefijo : '',
                'nombre' => $medico->nombres,
                'apellido' => $medico->apellidos,
                'cedula' => $medico->cedula,
                'telefono_movil' => $medico->telefono_movil,
                'genero' => $medico->genero,

                'imagen' => $medico->imagen,
                'firma' => $medico->firma,
                'sello' => $medico->sello,
                'mpps' => $medico->mpps,
                'colegio_medico' => $medico->colegio_medico,
            ];
            Session::put('userData', $medicoData);

            //si existe el paciente lo llevo a su pantalla principal de sesion
            if ($request->cat_user_type_id == 4) {
                return redirect('admin/index');
            }
            if ($request->cat_user_type_id == 9) {
                return redirect('consultaexterna/admin/reportes');
            }
        }
        if (is_null(Auth()->user())) {
            return redirect('/');
        }
    }
    public function consultaExternaHome(Request $request)
    {
        // dd(Auth()->user());
        if (is_null(Auth()->user())) {
            return redirect('/consultaexterna');
        }
        $cat_grupo_centro_salud_id = 1;

        $model = [];
        $model['paciente']["correo"] = Auth::user()->email;
        // dd($model);
        return view(
            "consultaexterna.home",
            compact(
                'model'
            )
        );
    }
    public function citas_activas(Request $request)
    {
        $familiar = UserFamily::where("user_id_paciente",$request->user_id_paciente)
            ->pluck("user_id_pariente");
        if(!empty($familiar)){
            $familiar = $familiar->toArray();
        } else {
            $familiar = [];
        }

        $model = new UserCita();
        $model = $model->whereNotIn("cat_user_cita_status_id", [3, 7, 8, 9]);
        $model = $model->whereIn("user_id_paciente", array_merge($familiar, [$request->user_id_paciente]));
        $model = $model->join("user_profile AS upPac", "user_cita.user_id_paciente", "upPac.user_id");
        $model = $model->join("user_profile AS upMed", "user_cita.user_id_medico", "upMed.user_id");
        $model = $model->join("centro_salud AS cs", "user_cita.centro_salud_id", "cs.id");
        $model = $model->join("cat_user_especialidad AS cue", "user_cita.cat_especialidad_id", "cue.id");
        $model = $model->join("cat_user_cita_status AS cuce", "user_cita.cat_user_cita_status_id", "cuce.id");
        $model = $model->select(
            "user_cita.*",
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
        $model = $model->get();


        return $model;
    }
    public function citas_historial(Request $request)
    {
        $model = new UserCita();
        $model = $model->whereIn("cat_user_cita_status_id", [3, 7, 8, 9]);
        $model = $model->where("user_id_paciente", $request->user_id_paciente);
        $model = $model->join("user_profile AS upPac", "user_cita.user_id_paciente", "upPac.user_id");
        $model = $model->join("user_profile AS upMed", "user_cita.user_id_medico", "upMed.user_id");
        $model = $model->join("centro_salud AS cs", "user_cita.centro_salud_id", "cs.id");
        $model = $model->join("cat_user_especialidad AS cue", "user_cita.cat_especialidad_id", "cue.id");
        $model = $model->join("cat_user_cita_status AS cuce", "user_cita.cat_user_cita_status_id", "cuce.id");
        $model = $model->select(
            "user_cita.*",
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
        $model = $model->get();
        return $model;
    }
    public function existeCita(Request $request)
    {
        //dd($request->all());
        //VALIDAR SI YA EXISTE UNA CITA EL DIA Y HORA A REGISTRAR
        return Response()->json(UserCita::where("user_id_medico",$request->user_id_medico)
        //->whereNotIn("cat_user_cita_status_id",[3,7,8,9])
        ->where("centro_salud_id",$request->centro_salud_id)
        ->where("cat_especialidad_id",$request->cat_especialidad_id)
        ->where("year", date("Y",strtotime($request->cita_hora)) )
        ->where("month", date("m",strtotime($request->cita_hora)) )
        ->where("day", date("d",strtotime($request->cita_hora)) )
        ->where("hour", date("H:i",strtotime($request->cita_hora)) )
        ->where("cancelada_paciente",0)
        ->whereIn('cancelada_medico', [0,1])
        ->whereIn('reprogramada', [0,1])
        ->count());
    }
    public function show_by_cedula($cedula)
    {
        return UserProfile::where("user.active", 1)
            ->where("cedula", $cedula)
            ->join("user", "user_profile.user_id", "user.id")
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

    public function get_familiares($user_id, $cedula)
    {
        $familiares = UserFamily::where('user_family.user_id_paciente',$user_id)
            ->join("user_profile","user_family.user_id_pariente","user_profile.user_id")
            ->join("cat_user_family","user_family.cat_user_family_id","cat_user_family.id")
            ->select(
                "user_profile.cedula",
                DB::raw("user_family.active"),
                DB::raw("user_family.revisado"),
                DB::raw("user_family.revisado_fecha"),
                DB::raw("user_family.coments"),
                DB::raw("cat_user_family.id AS cat_user_family_id"),
                DB::raw("cat_user_family.description AS cat_user_family_description"),
                DB::raw("user_family.id AS user_family_id")
            )
            ->get()->toArray();

        foreach ($familiares as $key => $value) {

            $familiares[$key] = array_merge(
                $value,
                $this->show_by_cedula($value['cedula'])[0]
            );
        }
        return $familiares;
    }
    public function get_especialidades()
    {


        return CatEspecialidad::where("cat_user_especialidad.active",1)
        /* ->where(
            DB::raw("
                (
                    SELECT
                        GROUP_CONCAT( centro_salud.description )
                    FROM centro_salud_especialidades
                    INNER JOIN centro_salud ON centro_salud_especialidades.centro_salud_id = centro_salud.id
                    WHERE centro_salud_especialidades.cat_especialidad_id = cat_user_especialidad.id
                    AND centro_salud_especialidades.active = 1
                )
            "),
            "!=",
            NULL
        ) */
        ->select(
                "cat_user_especialidad.*",
                "cat_user_especialidad.id AS cat_especialidad_id",
                //CENTROS DE SALUD QUE DAN ESA ESPECIALIDAD
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( user_medico_agenda.centro_salud_id )
                                FROM user_medico_agenda
                            WHERE user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_id
                    "),
                DB::raw("
                        (
                            SELECT
                                GROUP_CONCAT( centro_salud.description )
                            FROM user_medico_agenda
                            INNER JOIN centro_salud ON user_medico_agenda.centro_salud_id = centro_salud.id
                            WHERE user_medico_agenda.cat_especialidad_id = cat_user_especialidad.id
                            AND user_medico_agenda.active = 1
                        ) AS centro_salud_description
                    ")

            )
            ->get();
    }
    public function get_medicos()
    {
        return UserMedico::getMedicosCitas();
    }
    public function nuevasCitas()
    {
        $model = new UserCita();
        $model = $model->join("cat_user_especialidad AS cue", "user_cita.cat_especialidad_id", "cue.id");
        $model = $model->leftJoin("user_cuest_direction AS ucd", "user_cita.user_id_paciente", "ucd.user_id");
        $model = $model->join("centro_salud", "user_cita.centro_salud_id", "centro_salud.id");
        $model = $model->leftJoin("user_profile AS upAuto", "user_cita.user_id_autorizacion", "upAuto.user_id");
        $model = $model->join("user_profile AS upMed", "user_cita.user_id_medico", "upMed.user_id");
        $model = $model->join("user_profile AS upPac", "user_cita.user_id_paciente", "upPac.user_id");
        $model = $model->join("user", "user_cita.user_id_paciente", "user.id");
        $model = $model->leftJoin("tarjeta_soy_chacao", "user_cita.user_id_paciente", "tarjeta_soy_chacao.user_id_paciente");
        if (session('cat_user_type_id') == 2) { //medico
            //$model = $model->whereIn("cat_user_cita_status_id",[5,6]); //preconsulta | consulta
            $model = $model->whereIn("cat_user_cita_status_id", [1, 2, 4, 5, 6]); //por confirmar | reprogramada | confirmada | preconsulta | consulta
            //$model = $model->where("user_cita.user_id_medico",Auth::id());
        }
        if (in_array(session('cat_user_type_id'), [7, 6])) { //atencion al paciente | enfermeria
            $model = $model->whereIn("cat_user_cita_status_id", [1, 2, 4, 5]); //por confirmar | reprogramada | cancelada | confirmada | preconsulta
        }
        if (in_array(session('cat_user_type_id'), [8, 4])) { //gerente | administrador
            $model = $model->whereIn("cat_user_cita_status_id", [1, 2, 3, 4, 5, 6, 7, 8, 9]);
        }
        $model =    $model->where("centro_salud_id", session('user_centro_salud_id'));
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
                    YEAR(CURDATE())-YEAR(upPac.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(upPac.fnacimiento,'%m-%d'), 0 , -1 )
                    AS edad
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


        $model =    $model->orderBy('fecha_cita', "ASC");
        $model =    $model->get()->toArray();



        return $this->getCitas($model, true);
    }

    public function getAllCentroSalud()
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

    public function getCitas($citas, $all = true)
    {
        $mes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $pacientes_ids = array_unique(array_column($citas, "user_id_paciente"));

        $medicos_ids = array_unique(array_column($citas, "user_id_medico"));
        $citas_ids = array_unique(array_column($citas, "id"));

        foreach ($citas as $key => $value) {

            $citas[$key]["user_cita_id"] = $value['id'];

            $citas[$key]["mes_nombre"] = $mes[(int) $value['month'] - 1];

            $hoy = date("Y-m-d");

            $dia_siguiente = date("Y-m-d", strtotime($hoy . "+ 1 days"));

            $dia_cita = date("Y-m-d", strtotime($value['year'] . "-" . $value['month'] . "-" . $value['day']));

            if (
                strtotime($hoy) >= strtotime($dia_cita) &&
                strtotime($dia_cita) <= strtotime($dia_siguiente) &&
                $citas[$key]["cat_user_cita_status_id"] == 4
            ) {
                $citas[$key]["cat_user_cita_status_id"] = 5;
            }

            $citas[$key]["user_cortesia"] = UserCortesia::where("user_cita_id", $citas[$key]['user_cita_id'])->first();
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

        $model["user_condicion_medica"]     = []; //UserCondicionMedica::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_medicamento"]          = []; //UserCuestMedicamento::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_antecedente"]          = []; //UserCuestAntecedente::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();
        $model["user_alergias"]             = []; //UserAlergia::whereIn("user_id_paciente",$pacientes_ids )->get()->toArray();


        $model["user_recipe"]               = NULL; //UserCuestRecipe::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_estudio"]              = NULL; //UserCuestEstudio::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_laboratorio"]          = NULL; //UserCuestLaboratorio::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_fotografia"]           = NULL; //UserCuestFotografia::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_imagenes"]             = NULL; //UserCuestImagen::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
        $model["user_otro_archivo"]         = NULL; //UserCuestOtroArchivo::whereIn("user_id",$pacientes_ids )->whereIn("user_cita_id",$citas_ids)->orderBy("id","DESC")->get()->toArray();
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
    public function getAll_centros_salud()
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
    public function getAllByMedicos(Request $request)
    {

        $medicos_id = explode(',', $request->medicos_id );

        $usermedicoactivo = UserMedicoActivo::whereIn('user_id_medico', $medicos_id )
                ->where('active', 1)
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->get()
                //->take(1)
                ->pluck("user_id_medico")
                ->toArray();
        if (!empty($usermedicoactivo)) {

            foreach ($medicos_id as $key => $value) {
                if (!in_array($value,$usermedicoactivo)) {
                    $ultimo_registro = UserMedicoActivo::where('user_id_medico', $value )->count();

                    if($ultimo_registro === 0){
                        $model = new UserMedicoActivo();
                        $model->user_id_medico = $value;
                        $model->active = 1;
                        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                        $model->save();
                        array_push( $usermedicoactivo, $value);
                    }

                }
            }
        }

        if (!empty($usermedicoactivo)) {
            $data =[
                "selector"=>"all",
                "centro_salud_id"=>$request->centro_salud_id,
                "especialidad_id"=>$request->especialidad_id,
                "medicos_id"=> $usermedicoactivo
            ];
            $model = UserMedicoAgenda::getMedicos($data);
            //dd($model );
        }else {
            $model = NULL;
        }


        $model = UserMedicoAgenda::agendaDeploy($model);

        return $model;
    }
    public function tablero_cita()
    {
        if (is_null(Auth()->user())) {
            return redirect('/consultaexterna');
        }
        $centro_salud_nombre = session('user_centro_salud_nombre');
        $citas = $this->nuevasCitas();
        // dd($centro_salud_nombre);
        // dd($citas);
        return view('consultaexterna.tablero_medico', compact('citas', 'centro_salud_nombre'));
        //return view('paciente.solicitud_cita/index_nuevo' );
    }
    public function finalizarSesion(Request $request)
    {

        Auth::logout();
        // return redirect('/consultaexterna');
        return redirect(env('APP_URL').'consultaexterna');
    }

    public function show2Paciente($user_id_paciente)
    {
        try {
            $model = DB::select("
                SELECT

                    upp.id as up_id,
                    upp.user_id,
                    upp.nombres,
                    upp.apellidos,
                    upp.nacionalidad,
                    upp.cedula,
                    upp.fnacimiento,
                    upp.genero,
                    upp.telefono_movil,
                    upp.imagen AS userImagen,

                    user.email,

                    ucd.id AS ucd_id,
                    ucd.cat_estado_id,
                    ucd.cat_municipio_id,
                    ucd.description,
                    ucd.domicilio,
                    (
                        SELECT tsc.description
                        FROM tarjeta_soy_chacao AS tsc
                        WHERE tsc.user_id_paciente = upp.user_id
                        LIMIT 1
                    ) tarjeta_soy_chacao,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'imgDocIdentidad'
                        LIMIT 1
                    ) imgDocIdentidad,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'imgSoyChacao'
                        LIMIT 1
                    ) imgSoyChacao,
                    (
                        SELECT upi.value
                        FROM user_profile_images AS upi
                        WHERE upi.user_id_paciente = upp.user_id
                        AND upi.coments = 'partidaNacimiento'
                        LIMIT 1
                    ) partidaNacimiento,
                    (
                        SELECT GROUP_CONCAT(ut.cat_user_type_id)
                        FROM user_type AS ut
                        WHERE ut.user_id = upp.user_id
                    ) roles

                FROM user_profile AS upp
                LEFT JOIN user ON upp.user_id = user.id
                LEFT JOIN user_cuest_direction  AS ucd ON upp.user_id = ucd.user_id

                WHERE upp.user_id = ".$user_id_paciente."
                AND user.active = 1
            ",[]);
        } catch (\Throwable $th) {
           dd($th);
        }

        return $model;
    }

    public function storeFamiliar(Request $request)
    {
        // dd($request);
        //SAMPLE
        /*  $request = new Request();
        $request->merge(["email"=>"aaaa"]);
        $request->merge(["nombres"=>"Nombre 1"]);
        $request->merge(["apellidos"=>"Apellido 1"]);
        $request->merge(["nacionalidad"=>"V"]);
        $request->merge(["cedula"=>"22014778.01"]);
        $request->merge(["genero"=>"m"]);
        $request->merge(["fnacimiento"=>"1984-10-06"]);
        $request->merge(["telefono_movil"=>"04149320905"]);
        $request->merge(["created_at"=>date('Y-m-d H:i:s')]); */
        //dd($request->all());
        $resultSet = [];
        try {

            DB::beginTransaction();
            /* //1 USER
                    $model = User::firstOrCreate(
                        ['email' => $request->email],
                        [
                            'email'          => $request->email,
                            'password'       => isset( $request->password ) ? $request->password : "123456",
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s', strtotime( $request->created_at ) )
                        ]
                    );

                    $user_id = $model->id;
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    } */

            //VERIFICAR SI LA CEDULA EXISTE
            //$user_id =NULL;
            $email = NULL;

            //if ($email != $request->email) {
            $email = $request->email;
            //}

            //BUSCAMOS LA CEDULA A VER SI EXISTE
            $existe_cedula =    UserProfile::where("cedula", $request->cedula)
                ->leftJoin("user", "user_profile.user_id", "user.id")
                ->select("user.email", "user_profile.user_id")
                ->orderBy("user_profile.user_id", "DESC")->get()->take(1)->toArray();

            if (!empty($existe_cedula)) {
                $user_id = $existe_cedula[0]['user_id'];
                $email =  $existe_cedula[0]['email'];

                if ($email !=  $existe_cedula[0]['email']) {
                    $email = $request->email;
                }
            }

            //dd($existe_cedula);

            //-----------
            if (!empty($existe_cedula)) {
                //$email =  $existe_cedula[0]['email'];
                /* if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        } */
                $model = User::firstOrCreate(
                    [
                        'id' => $user_id,

                    ],
                    [
                        'email'          => $email,
                        'password'       => isset($request->password) ? $request->password : "123456",
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime($request->created_at))
                    ]
                );
                $user_id = $model->id;
            } else {

                $existe_email = User::where("email", $request->email)->first();
                if (!is_null($existe_email)) {
                    $temp_email['id'] = $existe_email->id;
                } else {
                    $temp_email['email'] = $email;
                }
                $model = User::firstOrCreate(
                    $temp_email,
                    [
                        'email'          => $email,
                        'password'       => isset($request->password) ? $request->password : "123456",
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime($request->created_at))
                    ]
                );
                $user_id = $model->id;
            }
            $request->merge(["user_id_paciente" => $user_id]);
            $request->merge(["user_id" => $user_id]);
            if ($model->exists) {
                $resultSet[$model->getTable()] = $model->toArray();
            }
            //-------------


            //2 USER_TYPE
            $model = UserType::updateOrCreate(
                [
                    'user_id'   => $user_id,
                ],
                [
                    'user_id'          => $user_id,
                    'cat_user_type_id' => 1, // Paciente
                    'user_id_medico'   => Auth::id(),
                    "created_at"       => date('Y-m-d H:i:s', strtotime($request->created_at))
                ]
            );
            if ($model->exists) {
                $resultSet[$model->getTable()] = $model->toArray();
            }
            //3 USER_PROFILE
            $nombre = "/image/system/patient.svg";
            $file = $request->file('imagen');
            if (!is_null($file)) {
                $aleatotio = Str::random(6);
                $ruta = 'image/user/foto_perfil/';
                $nombre = "fp_" . $aleatotio . $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                if (!file_exists($ruta . $nombre)) {
                    $file->move($ruta, $nombre);
                    $nombre = '/' . $ruta . $nombre;
                }
            }
            $model = UserProfile::updateOrCreate(
                [
                    "user_id" => $request->user_id,
                ],
                [
                    'nombres'        => !is_null($request->nombres) ? $request->nombres : "",
                    'apellidos'      => !is_null($request->apellidos) ? $request->apellidos : "",
                    'nacionalidad'   => $request->nacionalidad,
                    'cedula'         => $request->cedula,
                    'genero'         => $request->genero,
                    'fnacimiento'    => $request->fnacimiento,
                    'telefono_movil' => $request->telefono_movil,
                    'imagen'         => $nombre,
                    "user_id"        => $request->user_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime($request->created_at))
                ]
            );

            if ($model->exists) {
                $resultSet[$model->getTable()] = $model->toArray();
            }
            //4 USER_IMAGES_FILES
            $imagenesDefault = [
                "partidaNacimiento" => "/image/system/fnacimiento.svg",
                "imgSoyChacao" => "/image/system/card.svg",
                "imgDocIdentidad" => "/image/system/card.svg",
            ];

            foreach ($request->file() as $key => $file) {
                $nombre    = null;
                $extension = null;
                if ($key != "imagen") {
                    if (!is_null($file)) {

                        if (
                            $key == "partidaNacimiento" ||
                            $key == "imgSoyChacao" ||
                            $key == "imgDocIdentidad"
                        ) {
                            $nombre = $imagenesDefault[$key];
                            $aleatotio = Str::random(6);
                            $ruta = 'image/user/userProfileImage/';
                            $nombre = "upi_" . $aleatotio . $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                            $extension = $file->getClientOriginalExtension();
                            if (!file_exists($ruta . $nombre)) {
                                $file->move($ruta, $nombre);
                                $nombre = '/' . $ruta . $nombre;
                            }

                            $model = UserProfileImages::updateOrCreate(
                                [
                                    'user_id_paciente'   => $request->user_id,
                                    'coments'     => $key,
                                    'active'     => 1,
                                ],
                                [
                                    'value'     => $nombre,
                                    'user_id_paciente'     => $request->user_id,
                                    'file_type'     => $extension,
                                    'coments'     => $key,
                                    'active'     => 1,
                                    'user_id_medico'     => Auth::id(),
                                    'created_at'     => date('Y-m-d H:i:s', strtotime($request['created_at'])),
                                ]
                            );

                            if ($model->exists) {
                                $resultSet[$model->getTable() . "_" . $key] = $model->toArray();
                            }
                        }
                    }
                }
            }
            //5 USER_DIRECCION
            $model = UserCuestDireccion::updateOrCreate(
                [
                    'user_id' => $request->user_id
                ],
                [
                    'cat_estado_id'    => isset($request->cat_estado_id) ? $request->cat_estado_id : null,
                    'cat_municipio_id' => isset($request->cat_municipio_id) ? $request->cat_municipio_id : null,
                    'description'      => isset($request->description) ? $request->description : null,
                    'domicilio'        => isset($request->domicilio) ? $request->domicilio : null,
                    'user_id'          => isset($request->user_id) ? $request->user_id : null,
                ]
            );
            if ($model->exists) {
                $resultSet[$model->getTable()] = $model->toArray();
            }

            //6 TARJETA SOYCHACAO
            $model = TarjetaSoyChacao::updateOrCreate(
                [
                    'user_id_paciente'   => $user_id,
                ],
                [
                    'description'   =>  isset($request->tarjeta_soy_chacao) ? $request->tarjeta_soy_chacao : NULL,
                    'user_id_paciente'   => $user_id,
                    'user_id_medico' => Auth::id(),
                    "created_at"     => date('Y-m-d H:i:s', strtotime($request->created_at))
                ]
            );
            if ($model->exists) {
                $resultSet[$model->getTable()] = $model->toArray();
            }
            //7 REGISTRO FAMILIAR
            if (isset($request->registro_familiar) && $request->registro_familiar) {
                $model = UserFamily::updateOrCreate(
                    [
                        'user_id_paciente'   => $request->user_id_pariente,
                        'user_id_pariente'   => $user_id
                    ],
                    [
                        // 'user_id_paciente'   => $request->user_id_pariente,
                        // 'user_id_pariente'   => $user_id,
                        'cat_user_family_id'   => $request->cat_user_family_id_pariente,
                        'revisado' => 0,
                        'active' => 1,
                        'user_id_medico' => Auth::id(),
                        "created_at"     => date('Y-m-d H:i:s', strtotime($request->created_at))
                    ]
                );

                if ($model->exists) {
                    $newFamiliar = $model->toArray();
                    $user_familiar = new UserFamilyController();
                    $resultSet[$model->getTable()] = $user_familiar->show($request->user_id_pariente, $request->cedula_pariente)[0];
                }
            }
            // dd($resultSet);
            DB::commit();
            $resultSet["success"] = true;
            if ($resultSet["success"]) {
                /* if ( config("app.APP_SEND_EMAILS") ) { */
                $model['case'] = 1;
                $model['email'] = $request->email;
                $model['password'] = $request->password;

                $model['logo'] = config('app.url') . "/image/system/salud_chacao.png";
                $model['subject'] = "Bienvenido al sistema.";

                /* if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{ */
                //$model['emails'] = $request->email;
                /* } */
                $model['emails'] = $request->email;
                /* Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( "hiperiom412@gmail.com" )
                            ->subject($model['subject']);
                    });
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                            $message->to( $model['emails'] )
                            ->subject($model['subject']);
                    }); */
                /* Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
                        foreach ($model['emails'] as $key => $correo) {
                            $message->to( $correo )
                            ->subject($model['subject']);
                        }
                    }); */
                /* } */
            }

            return Response()->json($resultSet);
        } catch (\Throwable $th) {

            DB::rollBack();
            $resultSet = [];
            $resultSet["success"] = false;
            $resultSet["message"] = $th;
            return Response()->json($resultSet);
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
     * @param  \App\ConsultaExterna  $consultaExterna
     * @return \Illuminate\Http\Response
     */
    public function show(ConsultaExterna $consultaExterna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsultaExterna  $consultaExterna
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultaExterna $consultaExterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConsultaExterna  $consultaExterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultaExterna $consultaExterna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConsultaExterna  $consultaExterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultaExterna $consultaExterna)
    {
        //
    }
}
