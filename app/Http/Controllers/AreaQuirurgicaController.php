<?php

namespace App\Http\Controllers;
use App\Models\SolicitudQuirofano;
use App\Models\SolicitudQuirofanoMedicos;
use App\Models\UserProfile;
use App\Models\UserType;
use App\Models\UserCuestDireccion;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AreaQuirurgica;
use App\Models\UserCuestEpisodio;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestUbicacion;
use App\Models\UserEspecialidad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateTimeImmutable;
use DateInterval;
class AreaQuirurgicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tablero()
    {

        return view("area_quirurgica.indexTablero");
    }
    public function index()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_quirurgica.index");
    }
    public function index2()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_quirurgica.index_enfermeria");
    }
    public function indexAmb()
    {
        if(is_null(Auth()->user())){
            return redirect()->route('/');
        }
        return view("area_quirurgica.indexAmb");
    }
    public function indexExterno()
    {
        return view("area_quirurgica.index_externo");
    }
    public function indexExternoMAPM()
    {
        return view("area_quirurgica.index_externoMAPM");
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
    public function getProcedimientos()
    {
        return DB::table("procedimientos_qx")->get();
    }
    public function getProcedimientosMAPM()
    {
        return DB::table("procedimientos_qx_mapm")->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
        // dd($request);
        //dd($request->files());
        //dd(is_null($request->user_id) && empty($request->user_id));
        $user_id =NULL;
        try {

            //VERIFICAR SI LA CEDULA EXISTE
            $resultSet = [];
            $correo = is_null($request->email) && empty($request->email) ? $request->cedula."@correotemporal.com": $request->email;
            $email = NULL;
            $cedula = $request->cedula;
            $existe_cedula =    UserProfile::where("cedula",$request->cedula)
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
                    //dd("bandera");
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
                    //dd($email);

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
                //dd($user_id);
                if ($model->exists) {
                    $resultSet[ $model->getTable() ] = $model->toArray();
                }
                //-------------
            //2 USER_TYPE
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

            $userProfile = UserProfile::where('user_id', $user_id)->first();

                if($userProfile == null){

                    $model = new UserProfile();

                    $model->nombres = $request->nombres;
                    $model->apellidos = $request->apellidos;
                    $model->nacionalidad = $request->nacionalidad;
                    $model->cedula = $request->cedula;
                    $model->genero = $request->genero;
                    $model->fnacimiento = $request->fnacimiento;
                    $model->telefono_movil = $request->telefono_movil;
                    $model->telefono_hogar = $request->telefono_movil;
                    $model->imagen = "/image/system/patient.svg";
                    $model->user_id = $user_id;
                    $model->user_id_medico = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s');

                    $model->save();

                    $resultSet[ $model->getTable() ] = $model->toArray();

                }else{

                    $userProfile->nombres = $request->nombres;
                    $userProfile->apellidos = $request->apellidos;
                    $userProfile->nacionalidad = $request->nacionalidad;
                    $userProfile->cedula = $request->cedula;
                    $userProfile->genero = $request->genero;
                    $userProfile->fnacimiento = $request->fnacimiento;
                    if($request->telefono_movil != ""){
                        $userProfile->telefono_movil = $request->telefono_movil;
                        $userProfile->telefono_hogar = $request->telefono_movil;
                    }
                    $userProfile->imagen = "/image/system/patient.svg";
                    $userProfile->user_id = $user_id;
                    $userProfile->user_id_medico = Auth::id();
                    $userProfile->created_at = date('Y-m-d H:i:s');

                    $userProfile->save();

                    $resultSet[ $userProfile->getTable() ] = $userProfile->toArray();

                }


            //5 USER_DIRECCION

                $userAddress = UserCuestDireccion::where('user_id', $user_id)->first();

                if($userAddress == null){

                    $model = new UserCuestDireccion();
                    $model->cat_estado_id = null;
                    $model->cat_municipio_id = null;
                    $model->description = null;
                    $model->domicilio = null;
                    $model->user_id = $user_id;
                    $model->save();

                    $resultSet[ $model->getTable() ] = $model->toArray();

                }

        } catch (\Throwable $th) {

            dd($th);
        }

        //PARA CREAR EL EPISODIO
        $request->merge(['value'=>'Ingreso']);
        $request->merge(['created_at'=>date('Y-m-d H:i:s', strtotime(date($request->fecha_reservacion." ".$request->h_inicio) ) ) ]);

        //UserCuestEpisodio::store($request);
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);


        $existeEpisodio = false;
        if (is_null($episode_id)) {// si no existe episodio activo

            $episodio = new UserCuestEpisodio();
            $episodio->ingreso = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $episodio->user_id = $user_id;
            $episodio->user_id_med_esp = Auth::id();
            $episodio->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $episodio->active=0;
            $episodio->save();
            $episode_id = $episodio->id;
            UserCuestImpresionDiagnostica::where("user_id",$user_id)
            ->where("active",1)
            ->update(["active"=>0]);

            $existeEpisodio = true;
        }









        $soliQx = new SolicitudQuirofano();
        $soliQx->user_id_paciente = $user_id;
        $soliQx->episodio_id = $episode_id;
        $soliQx->h_inicio =  $request->h_inicio == "null" ? NULL : date('Y-m-d H:i:s', strtotime(date($request->fecha_reservacion." ".$request->h_inicio) ) );
        $soliQx->h_real_inicio = $request->h_inicio == "null" ? NULL : "[". json_encode(["id"=>1,"h_inicio"=>($request->h_inicio == "null" ? NULL :  date('Y-m-d H:i:s', strtotime(date($request->fecha_reservacion." ".$request->h_inicio) ) )),"description"=>"","user_id"=>Auth::id(),"created_at"=>date('Y-m-d H:i:s') ]). "]";

        $soliQx->h_aprox_fin =  $request->h_fin;
        $soliQx->intervencion =  $request->intervencion;
        $soliQx->equipos_especiales =  $request->equipos_especiales;
        $soliQx->cirujano_principal =  $request->cirujano_principal;
        $soliQx->anestesiologo =  $request->anestesiologo;
        $soliQx->circulante_anestesia =  $request->circulante_anestesia;
        $soliQx->circulante_cirugia =  $request->circulante_cirugia;
        $soliQx->n_quirofano =  $request->n_quirofano;
        $soliQx->tipo_cupo =  $request->tipo_cupo;
        $soliQx->tipo_reservacion =  $request->tipo_reservacion;
        $soliQx->fecha_reservacion =  $request->fecha_reservacion;
        $soliQx->destino =  $request->destino;
        $soliQx->user_id = Auth::id();
        $soliQx->instrumentista = $request->instrumentista;
        $soliQx->anestesia_sugerida = $request->anestesia_sugerida;
        $soliQx->convenio = isset($request->convenio) ? $request->convenio :NULL;
        $soliQx->n_presupuesto = $request->n_presupuesto;
        $soliQx->dias_hospitalizacion = $request->dias_hospitalizacion;
        $soliQx->diagnostico_preoperatorio = $request->diagnostico_preoperatorio;
        $soliQx->dias_uti = $request->dias_uti;
        $soliQx->anestesia_sugerida = $request->anestesia_sugerida;
        $soliQx->fase_ubicacion = $request->fase_ubicacion;
        $soliQx->ayudante_1 = $request->ayudante_1;
        $soliQx->ayudante_2 = $request->ayudante_2;
        $soliQx->ayudante_3 = $request->ayudante_3;
        $soliQx->area_intervencion = $request->area_intervencion;
        $soliQx->save();

        //ELIMINADO EL SIGUIENTE CÓDIGO PORQUE TRASLADABA AL
        //PACIENTE A AREA QUIRURGICA SI EL PACIENTE TIENE UN EPISODIO ACTIVO

        if( $existeEpisodio ){
            UserCuestUbicacion::where("user_cuest_episodio_id",$episode_id)
            ->where("active",1)
            ->update([
                "active"=>0,
                "deleted_at"=>date('Y-m-d H:i:s')
            ]);
            try {
                $ubicacion = new UserCuestUbicacion();
                $ubicacion->user_cuest_episodio_id = $episode_id;
                $ubicacion->cat_user_ubicacion_id = $soliQx->area_intervencion;
                $ubicacion->user_id_paciente = $user_id;
                $ubicacion->user_id_medico = Auth::id();
                $ubicacion->value = 'Ingreso AQ';
                $ubicacion->prioridad = 0;
                $ubicacion->active = 1;
                $ubicacion->created_at = date('Y-m-d H:i:s');
                $ubicacion->save();
                if ($ubicacion->exists) {
                    $resultSet[ $ubicacion->getTable() ] = $ubicacion->toArray();
                }
            } catch (\Throwable $th) {
                dd($th);
            }

        }

        //BUSCAR LA UBICACIÓN ACTUAL DEL EPISODIO.
        //SI LA UBICACIÓN ACTIVA DEL EPISODIO ACTUAL ES EA O EP NO TRASLADARLO
        //SINO MOVERLO A AQ TORRE HOSP o AQ MAPM

        $tiene_ubicacion_actual = DB::select("
            SELECT COUNT(active) AS total
            FROM user_cuest_ubicacion
            WHERE user_cuest_episodio_id = ".$episode_id."
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
                    ".$request->area_intervencion.",
                    ".$user_id.",
                    ".Auth::id().",
                    'Ingreso Solicitud AQ',
                    NULL,
                    '0',
                    '1',
                    ".$episode_id.",
                    '".$fechaRegistro."',
                    '".$fechaRegistro."',
                    NULL
                )
            ");
        }

        //dd($resultSet);
        //dd($episode_id."----".$soliQx->area_intervencion."----".$user_id);

        return Response()->json($resultSet);


    }
     public function updateForm(Request $request)
    {
        // dd($request);
        //dd($request->files());
        //dd(is_null($request->user_id) && empty($request->user_id));
        $user_id =NULL;
        try {

            //VERIFICAR SI LA CEDULA EXISTE
            $resultSet = [];
            $correo = is_null($request->email) && empty($request->email) ? $request->cedula."@correotemporal.com": $request->email;
            $email = NULL;
            $cedula = $request->cedula;
            $existe_cedula =    UserProfile::where("cedula",$request->cedula)
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
                    //dd("bandera");
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
                    //dd($email);

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
                //dd($user_id);
                if ($model->exists) {
                    $resultSet[ $model->getTable() ] = $model->toArray();
                }
                //-------------
            //2 USER_TYPE
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
            $userProfile = UserProfile::where('user_id', $user_id)->first();

                if($userProfile == null){

                    $model = new UserProfile();

                    $model->nombres = $request->nombres;
                    $model->apellidos = $request->apellidos;
                    $model->nacionalidad = $request->nacionalidad;
                    $model->cedula = $request->cedula;
                    $model->genero = $request->genero;
                    $model->fnacimiento = $request->fnacimiento;
                    $model->telefono_movil = $request->telefono_movil;
                    $model->telefono_hogar = $request->telefono_movil;
                    $model->imagen = "/image/system/patient.svg";
                    $model->user_id = $user_id;
                    $model->user_id_medico = Auth::id();
                    $model->created_at = date('Y-m-d H:i:s');

                    $model->save();

                    $resultSet[ $model->getTable() ] = $model->toArray();

                }else{

                    $userProfile->nombres = $request->nombres;
                    $userProfile->apellidos = $request->apellidos;
                    $userProfile->nacionalidad = $request->nacionalidad;
                    $userProfile->cedula = $request->cedula;
                    $userProfile->genero = $request->genero;
                    $userProfile->fnacimiento = $request->fnacimiento;
                    if($request->telefono_movil != ""){
                        $userProfile->telefono_movil = $request->telefono_movil;
                        $userProfile->telefono_hogar = $request->telefono_movil;
                    }
                    $userProfile->imagen = "/image/system/patient.svg";
                    $userProfile->user_id = $user_id;
                    $userProfile->user_id_medico = Auth::id();
                    $userProfile->created_at = date('Y-m-d H:i:s');

                    $userProfile->save();

                    $resultSet[ $userProfile->getTable() ] = $userProfile->toArray();

                }


            //5 USER_DIRECCION

                $userAddress = UserCuestDireccion::where('user_id', $user_id)->first();

                if($userAddress == null){

                    $model = new UserCuestDireccion();
                    $model->cat_estado_id = null;
                    $model->cat_municipio_id = null;
                    $model->description = null;
                    $model->domicilio = null;
                    $model->user_id = $user_id;
                    $model->save();

                    $resultSet[ $model->getTable() ] = $model->toArray();

                }

        } catch (\Throwable $th) {

            dd($th);
        }


        $model = SolicitudQuirofano::find($request->solicitud_id);

        //dd( $model);
        $model->user_id_paciente = $user_id;
        $model->h_inicio =  date('Y-m-d H:i:s', strtotime(date($request->fecha_reservacion." ".$request->h_inicio) ) );
        $model->h_aprox_fin =  $request->h_fin;
        $model->intervencion =  $request->intervencion;
        $model->equipos_especiales =  $request->equipos_especiales;
        $model->cirujano_principal =  $request->cirujano_principal;
        $model->anestesiologo =  $request->anestesiologo;
        $model->circulante_anestesia =  $request->circulante_anestesia;
        $model->circulante_cirugia =  $request->circulante_cirugia;
        $model->n_quirofano =  $request->n_quirofano;
        $model->tipo_cupo =  $request->tipo_cupo;
        $model->tipo_reservacion =  $request->tipo_reservacion;
        $model->fecha_reservacion =  $request->fecha_reservacion;
        $model->destino =  $request->destino;
        $model->user_id = Auth::id();
        $model->instrumentista = $request->instrumentista;
        $model->convenio = isset($request->convenio) ? $request->convenio :NULL;
        $model->n_presupuesto = $request->n_presupuesto;
        $model->dias_hospitalizacion = $request->dias_hospitalizacion;
        $model->diagnostico_preoperatorio = $request->diagnostico_preoperatorio;
        $model->dias_uti = $request->dias_uti;
        $model->anestesia_sugerida = $request->anestesia_sugerida;
        //$model->fase_ubicacion = $request->fase_ubicacion;
        $model->ayudante_1 = $request->ayudante_1;
        $model->ayudante_2 = $request->ayudante_2;
        $model->ayudante_3 = $request->ayudante_3;
        $model->area_intervencion = $request->area_intervencion;
        $model->save();


        return Response()->json($resultSet);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaQuirurgica  $areaQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function show(AreaQuirurgica $areaQuirurgica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaQuirurgica  $areaQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaQuirurgica $areaQuirurgica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AreaQuirurgica  $areaQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $solicQx = SolicitudQuirofano::find($request->id);
        $h_inicio = $solicQx->select("h_inicio")->first();
        $user_id_paciente = $solicQx->user_id_paciente;
        $request->merge(['user_id'=>$user_id_paciente]);
        $episodio_id = $solicQx->episodio_id;
        $cat_user_ubicacion_id = $solicQx->area_intervencion;
        $values =[$request->field => $request->value];
        $fecha_ingreso = $request->value;

        
        if ($request->field ==="h_real_inicio") {
            $result = SolicitudQuirofano::where("id",$request->id)->first();
            if($result && $result->h_inicio == null){
                $hours_decode = json_decode($request->value);
                $rr = array_filter($hours_decode, function($v){
                    return $v->h_inicio != null;
                });
                SolicitudQuirofano::where("id",$request->id)->update([
                    "h_inicio"=>$hours_decode[ count($hours_decode)-1]->h_inicio,
                    "h_real_inicio"=>json_encode($rr)
                ]);
                return Response()->json($solicQx);
            }
        }
        if ($request->field ==="h_inicio") {
            if (is_null($episodio_id)) {
                $episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id_paciente);

                if (is_null($episodio_id)) {
                    $request->merge(['value'=>'Ingreso']);
                    $request->merge(['created_at'=>$fecha_ingreso ]);

                    $nuevoEpisodio = new UserCuestEpisodio();
                    $nuevoEpisodio->ingreso = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $nuevoEpisodio->user_id = $user_id_paciente;
                    $nuevoEpisodio->user_id_med_esp = Auth::id();
                    $nuevoEpisodio->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $nuevoEpisodio->active=0;
                    $nuevoEpisodio->save();
                    $episodio_id = $nuevoEpisodio->id;

                    UserCuestImpresionDiagnostica::where("user_id",$user_id_paciente)
                    ->where("active",1)
                    ->update(["active"=>0]);
                    UserCuestUbicacion::where("user_id_paciente",$user_id_paciente)
                    ->where("active",1)
                    ->update([
                        "active"=>0,
                        "deleted_at"=>date('Y-m-d H:i:s')
                    ]);
                   // dd($episodio_id);
                    $nuevaUbicacion = new UserCuestUbicacion();
                    $nuevaUbicacion->user_cuest_episodio_id = $episodio_id;
                    $nuevaUbicacion->cat_user_ubicacion_id = $cat_user_ubicacion_id;
                    $nuevaUbicacion->user_id_paciente = $user_id_paciente;
                    $nuevaUbicacion->user_id_medico = Auth::id();
                    $nuevaUbicacion->value = 'Ingreso';
                    $nuevaUbicacion->prioridad = 0;
                    $nuevaUbicacion->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $nuevaUbicacion->save();

                }else{

                    $model3 = UserCuestEpisodio::find($episodio_id);
                    $model3->ingreso = $fecha_ingreso;
                    $model3->save();
                }

            }
        }
        if ($request->field ==="destino") {
            //PARA CREAR EL EPISODIO
            $request->merge(['destino'=>$request->value]);
            $request->merge(['value'=>'Traslado']);
            UserCuestEpisodio::store($request);
            $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id_paciente);

            UserCuestImpresionDiagnostica::where("user_id",$user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0]);
            UserCuestUbicacion::where("user_id_paciente",$user_id_paciente)
            ->where("active",1)
            ->update([
                "active"=>0,
                "deleted_at"=>date('Y-m-d H:i:s')
            ]);
            $destiempo = SolicitudQuirofano::where('id', $request->id)
            ->select(
                DB::raw("
                    IF(
                        DATEDIFF(
                            NOW(),
                            JSON_UNQUOTE(
                                JSON_EXTRACT(
                                    h_real_inicio,
                                    CONCAT('$[', JSON_LENGTH(h_real_inicio) - 1, '].h_inicio')
                                )
                            )
                        ) > 0,
                        TRUE,
                        FALSE
                    ) AS destiempo
                ")
            )
            ->value('destiempo');



            if (!$destiempo) {
                $model2 = new UserCuestUbicacion();
                $model2->user_cuest_episodio_id = $episode_id;
                $model2->cat_user_ubicacion_id = $request->destino;
                $model2->user_id_paciente = $user_id_paciente;
                $model2->user_id_medico = Auth::id();
                $model2->value = 'Traslado';
                $model2->prioridad = 0;
    
    
                $model2->created_at = date('Y-m-d H:i:s');
                $model2->save();
            }
           

        }
        if ($request->field ==="area_intervencion") {
            //dd("aaa");
            //PARA CREAR EL EPISODIO
            //$request->merge(['value'=>'Traslado']);

            UserCuestEpisodio::store($request);
            $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id_paciente);

            UserCuestImpresionDiagnostica::where("user_id",$user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0]);
            UserCuestUbicacion::where("user_id_paciente",$user_id_paciente)
            ->where("active",1)
            ->update([
                "active"=>0,
                "deleted_at"=>date('Y-m-d H:i:s')
            ]);

            $model2 = new UserCuestUbicacion();
            $model2->user_cuest_episodio_id = $episode_id;
            $model2->cat_user_ubicacion_id = $request->value;
            $model2->user_id_paciente = $user_id_paciente;
            $model2->user_id_medico = Auth::id();
            $model2->value = 'Traslado';
            $model2->prioridad = 0;

            $model2->created_at = date('Y-m-d H:i:s');
            $model2->save();

        }
        $solicQx->episodio_id = UserCuestEpisodio::ultimoEpisodio_id($user_id_paciente);
        $solicQx->update($values);

        /* if ($request->field =="fecha_reservacion") {
            $model->update(["h_inicio" => $request->value]);
        } */
        return Response()->json($solicQx);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaQuirurgica  $areaQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Eliminar la solicitud QX
        $model = SolicitudQuirofano::find($request->id);
       
        //consultar el episodio
        $episode = UserCuestEpisodio::find($model->episodio_id);
      
        if ($episode->exists()) {
            //Eliminar las ubicaciones
            $ubicaciones = UserCuestUbicacion::where("user_cuest_episodio_id",$episode->id)->orderBy("id","DESC")->get()->take(1);

            UserCuestUbicacion::where("user_cuest_episodio_id",$episode->id)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s')]);

            //Eliminar el episodio
            UserCuestEpisodio::where("id",$episode->id)
            ->update([
                "active"=>0, 
                "egreso"=>date('Y-m-d H:i:s'),
                "cat_user_ubicacion_id"=> $ubicaciones->count() > 0 
                ? $ubicaciones->toArray()[0]['cat_user_ubicacion_id']
                : 41
            ]);
        }
        //Eliminar la solicitud QX
        $model->delete();
        
        return Response()->json(['success'=>true]);
    }

    // funciones relacionadas al dashboard de qx -- INICIO
    public function getTotalesResumen(Request $request){ // fecha_inicial, fecha_final
        $fechaInicial = isset($GET_['fecha_inicial']) ? $GET_['fecha_inicial'] :  $request->fecha_inicial;
        $fechaFin = isset($GET_['fecha_final']) ? $GET_['fecha_final'] :  $request->fecha_final;

        //$fechaInicioActual = new DateTimeImmutable($fechaInicial);

       // $fechaFinActual = new DateTimeImmutable($fechaFin );

        //$diasARestar = $fechaInicioActual->diff($fechaFinActual)->days;

        $fechaInicioAnterior = date('Y-m-d', strtotime($fechaInicial. " -1 year"));
        $fechaFinAnterior = date('Y-m-d', strtotime($fechaFin . " -1 year"));

        //dd( "Desde: " . $fechaInicioAnterior . " Hasta: " . $fechaFinAnterior);
        $resultset=[];
        $resultset['total_programadas_actual'] = SolicitudQuirofano::whereIn('area_intervencion', [418, 420, 421, 422])
        ->whereBetween('fecha_reservacion', [$fechaInicial, $fechaFin])
        ->count();
        $resultset['periodo_fecha_actual']= "Desde el ".date('d/m/Y', strtotime($fechaInicial))." hasta el ".date('d/m/Y', strtotime($fechaFin));
        $resultset['periodo_fecha_anterior']= "Desde el ".date('d/m/Y', strtotime($fechaInicioAnterior))." hasta el ".date('d/m/Y', strtotime($fechaFinAnterior));



       // $resultset['diasARestar'] =  $diasARestar;
        $resultset['total_ejecutadas_actual'] = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
        ->whereIn('area_intervencion', [418, 420, 421, 422])
        ->whereNotNull('h_fin')
        ->whereBetween('fecha_reservacion', [$fechaInicial, $fechaFin])
        ->count();

        $resultset['total_programadas_anterior'] = SolicitudQuirofano::whereIn('area_intervencion', [418, 420, 421, 422])
        ->whereNotNull('h_fin')
        ->whereBetween('fecha_reservacion',[$fechaInicioAnterior, $fechaFinAnterior])
        ->count();
        $resultset['total_ejecutadas_anterior'] = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
        ->whereIn('area_intervencion', [418, 420, 421, 422])
        ->whereNotNull('h_fin')
        ->whereBetween('fecha_reservacion', [$fechaInicioAnterior, $fechaFinAnterior])
        ->count();

        $total_programadas_variacion_actual =  (  (int) round( ($resultset['total_ejecutadas_actual'] *100) / $resultset['total_programadas_actual'] ) );

        $resultset['total_programadas_variacion_actual'] =$total_programadas_variacion_actual > 100 ? 100 : $total_programadas_variacion_actual;

        $total_programadas_variacion_anterior = $resultset['total_programadas_anterior'] > 0 ? (  (int) round( ($resultset['total_ejecutadas_anterior'] *100) / $resultset['total_programadas_anterior'] ) ) : 0;

        $resultset['total_programadas_variacion_anterior'] =$total_programadas_variacion_anterior > 100 ? 100 : $total_programadas_variacion_anterior;



        return $resultset;
    }
    public function totalCirugiasHospitalizacion(Request $request){ // fecha_inicial, fecha_final

        $total_ejecutadas = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_ejecutadas_adultos = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_ejecutadas_pediatrico = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) < 18 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        $total_por_ejecutar = SolicitudQuirofano::whereIn('fase_ubicacion', ['Sin Estatus', 'En espera de clave', 'Pre-anestesia', 'Suspendida', 'En espera'])
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_por_ejecutar_adulto = SolicitudQuirofano::whereIn('fase_ubicacion', ['Sin Estatus', 'En espera de clave', 'Pre-anestesia', 'Suspendida', 'En espera'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_por_ejecutar_pediatrico = SolicitudQuirofano::whereIn('fase_ubicacion', ['Sin Estatus', 'En espera de clave', 'Pre-anestesia', 'Suspendida', 'En espera'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereNotNull('h_fin')
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) < 18 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_adulto = SolicitudQuirofano::whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_pediatrico = SolicitudQuirofano::whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) < 18 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        $total_hospitalizacion_torre = SolicitudQuirofano::whereIn('area_intervencion', [422])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereNotNull('h_fin')
            //->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            //->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_torre_adulto = SolicitudQuirofano::whereIn('area_intervencion', [422])
            ->whereNotNull('h_fin')
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_torre_pediatrico = SolicitudQuirofano::whereIn('area_intervencion', [422])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereNotNull('h_fin')
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) < 18 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        $total_hospitalizacion_hosp = SolicitudQuirofano::whereIn('area_intervencion', [418,420,421])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereNotNull('h_fin')
            //->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            //->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_hosp_adulto = SolicitudQuirofano::whereIn('area_intervencion', [418,420,421])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereNotNull('h_fin')
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) > 17 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();
        $total_hospitalizacion_hosp_pediatrico = SolicitudQuirofano::whereIn('area_intervencion', [418,420,421])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id")
            ->whereNotNull('h_fin')
            ->whereRaw('( TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE()) < 18 )', [])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        return Response()->json([

            'total_hospitalizacion'=>$total_ejecutadas + $total_por_ejecutar,
            'total_ejecutadas_hospitalizacion'=>$total_ejecutadas,
            'total_ejecutadas_hospitalizacion_adultos'=>$total_ejecutadas_adultos,
            'total_ejecutadas_hospitalizacion_pediatrico'=>$total_ejecutadas_pediatrico,

            'total_por_ejecutar_hospitalizacion'=>$total_por_ejecutar,
            'total_por_ejecutar_hospitalizacion_adulto'=>$total_por_ejecutar_adulto,
            'total_por_ejecutar_hospitalizacion_pediatrico'=>$total_por_ejecutar_pediatrico,

            'total_hospitalizacion_adulto'=>$total_hospitalizacion_adulto,
            'total_hospitalizacion_pediatrico'=>$total_hospitalizacion_pediatrico,

            'total_hospitalizacion_torre'=>$total_hospitalizacion_torre,
            'total_hospitalizacion_torre_adulto'=>$total_hospitalizacion_torre_adulto,
            'total_hospitalizacion_torre_pediatrico'=>$total_hospitalizacion_torre_pediatrico,

            'total_hospitalizacion_hosp'=>$total_hospitalizacion_hosp,
            'total_hospitalizacion_hosp_adulto'=>$total_hospitalizacion_hosp_adulto,
            'total_hospitalizacion_hosp_pediatrico'=>$total_hospitalizacion_hosp_pediatrico,


        ]);

    }

    /* public function totalCirugiasMapm(Request $request){ // fecha_inicial, fecha_final

        $total_ejecutadas = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereIn('area_intervencion', [419,423,424,425])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        $total_por_ejecutar = SolicitudQuirofano::whereIn('fase_ubicacion', ['Sin Estatus', 'En espera de clave', 'Pre-anestesia', 'Suspendida', 'En espera'])
            ->whereIn('area_intervencion', [419,423,424,425])
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->count();

        return Response()->json([
            'total_ejecutadas_mapm'=>$total_ejecutadas,
            'total_por_ejecutar_mapm'=>$total_por_ejecutar
        ]);

    } */

    public function cirugiasEjecutadasXMes(Request $request){ // delay [en minutos] | area ['Hospitalizacion' | 'MAPM']
        $model = [];
        if($request->area == 'Hospitalizacion'){
            $model[0] = new SolicitudQuirofano();
            $model[0] =  $model[0]->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
            $model[0] =  $model[0]->whereIn('area_intervencion', [418, 420, 421, 422]);
            $model[0] =  $model[0]->whereNotNull('h_fin');
            $model[0] =  $model[0]->whereBetween('fecha_reservacion', [date("Y")."-01-01", date("Y-m-d")]);
            $model[0] =  $model[0]->get()->toArray();

            $model[1] = new SolicitudQuirofano();
            $model[1] =  $model[1]->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
            $model[1] =  $model[1]->whereIn('area_intervencion', [418, 420, 421, 422]);
            $model[1] =  $model[1]->whereNotNull('h_fin');
            $model[1] =  $model[1]->whereBetween('fecha_reservacion', [(date("Y")-1)."-01-01", (date("Y")-1).date("-m-d")]);
            $model[1] =  $model[1]->get()->toArray();

        }
        $resultado = [];
        for ($i=0; $i < date('m'); $i++) {

            $resultado[$i]['mes']=$i+1;
            $resultado[$i]['total_actual'] = count( array_filter($model[0], function($qx) use ($i) {
                $fecha_reservacion = Carbon::parse(str_replace('"', '', $qx['fecha_reservacion']));
                $anio = $fecha_reservacion->format('Y');
                $mes = $fecha_reservacion->format('m');
                return $anio == date("Y") && $mes == ($i+1);
            }) );
            $resultado[$i]['total_anterior'] = count( array_filter($model[1], function($qx) use ($i) {
                $fecha_reservacion = Carbon::parse(str_replace('"', '', $qx['fecha_reservacion']));
                $anio = $fecha_reservacion->format('Y');
                $mes = $fecha_reservacion->format('m');
                return $anio == (date("Y")-1) && $mes == ($i+1);
            }) );

        }
        return $resultado;
    }
    public function getTurnosHorarios(Request $request){ // fecha_inicial fecha_final
        //$todos_los_turnos = SolicitudQuirofano::whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])->get();
        $todos_los_turnos = SolicitudQuirofano::whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereIn('area_intervencion', [418, 420, 421, 422])
            ->whereNotNull('h_fin')
            ->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final])
            ->select(
                "h_inicio",
                "h_real_inicio",
                DB::raw("DAYOFWEEK(fecha_reservacion) AS dia_semana"),
                DB::raw("
                     CASE
                        WHEN TIME(h_inicio) BETWEEN '07:00:00' AND '12:59:59' THEN 1
                        WHEN TIME(h_inicio) BETWEEN '13:00:00' AND '18:59:59' THEN 2
                        ELSE 3
                    END AS turno
                ")

            )
            ->get()->toArray();
            //dd( $todos_los_turnos);



        $final_madrugada = '07:00'; // 7:00 AM
        $final_manana = '13:00'; // 1:00 PM
        $final_tarde = '19:00'; // 7:00 PM

        $total_manana_lun_vie = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[2,3,4,5,6]) && $turno['turno'] ==1;
                                }
                            )
                        );
        $total_tarde_lun_vie = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[2,3,4,5,6]) && $turno['turno'] ==2;
                                }
                            )
                        );
        $total_madrugada_lun_vie = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[2,3,4,5,6]) && $turno['turno'] ==3;
                                }
                            )
                        );
        /******************************* */
        $total_manana_sab = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[7]) && $turno['turno'] ==1;
                                }
                            )
                        );
        $total_tarde_sab = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[7]) && $turno['turno'] ==2;
                                }
                            )
                        );
        $total_madrugada_sab = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[7]) && $turno['turno'] ==3;
                                }
                            )
                        );
        /******************************* */
        $total_manana_dom = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[1]) && $turno['turno'] ==1;
                                }
                            )
                        );
        $total_tarde_dom = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[1]) && $turno['turno'] ==2;
                                }
                            )
                        );
        $total_madrugada_dom = count(
                            array_filter(
                                $todos_los_turnos,
                                function($turno) {
                                    return in_array($turno['dia_semana'],[1]) && $turno['turno'] ==3;
                                }
                            )
                        );

        /* $total_tarde = 0;
        $total_madrugada = 0;

        foreach($todos_los_turnos as $turno){
            $hora_turno = Carbon::parse($turno->h_inicio);
            $horaActual = $hora_turno->format('H:i');

            if ($horaActual > $final_madrugada && $horaActual < $final_manana) {
                // echo "Turno de la mañana. <br>";
                $total_manana++;
            } else if ($horaActual > $final_manana && $horaActual < $final_tarde) {
                // echo "Turno de la tarde. <br>";
                $total_tarde++;
            } else {
                // echo "Turno de la madrugada. <br>";
                $total_madrugada++;
            }

        } */
        $result = [];
        //AM(07:00 AM a 12:59 PM)
        //(01:00 PM a 06:59 PM)
        //(07:00 PM a 06:59 AM)
        $result[0]["turno"]= "AM";
        $result[0]["total"]= $total_manana_lun_vie;
        $result[1]["turno"]= "PM";
        $result[1]["total"]= $total_tarde_lun_vie;
        $result[2]["turno"]= "MAD";
        $result[2]["total"]= $total_madrugada_lun_vie;

        $result[3]["turno"]= "AM";
        $result[3]["total"]= $total_manana_sab;
        $result[4]["turno"]= "PM";
        $result[4]["total"]= $total_tarde_sab;
        $result[5]["turno"]= "MAD";
        $result[5]["total"]= $total_madrugada_sab;

        $result[6]["turno"]= "AM";
        $result[6]["total"]= $total_manana_dom;
        $result[7]["turno"]= "PM";
        $result[7]["total"]= $total_tarde_dom;
        $result[8]["turno"]= "MAD";
        $result[8]["total"]= $total_madrugada_dom;

        /* $result[9]["turno"]= "Total IQX";
        $result[9]["total"]= count($todos_los_turnos); */


        return Response()->json($result);
    }

    public function getCirugiasByType(Request $request){ //fecha_inicial, fecha_final
        $model = [];
        $model[0] = new SolicitudQuirofano();
        $model[0] =  $model[0]->where('tipo_reservacion', 'Electiva');
        $model[0] =  $model[0]->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
        $model[0] =  $model[0]->whereIn('area_intervencion', [418,420,421,422]);
        $model[0] =  $model[0]->whereNotNull('h_fin');

        $model[0] =  $model[0]->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final]);
        $model[0] =  $model[0]->get();

        $model[1] = new SolicitudQuirofano();
        $model[1] =  $model[1]->where('tipo_reservacion', 'Emergencia');
        $model[1] =  $model[1]->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
        $model[1] =  $model[1]->whereIn('area_intervencion', [418,420,421,422]);
        $model[1] =  $model[1]->whereNotNull('h_fin');
        $model[1] =  $model[1]->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final]);
        $model[1] =  $model[1]->get();


        return Response()->json([
            'cirugias_electivas'=>$model[0]->count(),
            'cirugias_emergencias'=>$model[1]->count(),
        ]);
    }

    public function getEquiposEspeciales(Request $request){ //fecha_inicial, fecha_final, limit

        $equipos_especiales = new SolicitudQuirofano();
        $equipos_especiales =  $equipos_especiales->selectRaw("REPLACE(JSON_EXTRACT(intervencion, '$[0].equipos_especiales[0].description'), '\"', '') AS equipo_especial");
        $equipos_especiales =  $equipos_especiales->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
        $equipos_especiales =  $equipos_especiales->whereIn('area_intervencion', [418,420,421,422]);
        $equipos_especiales =  $equipos_especiales->whereBetween('fecha_reservacion', [$request->fecha_inicial, $request->fecha_final]);
        $equipos_especiales =  $equipos_especiales->whereRaw("JSON_EXTRACT(intervencion, '$[0].equipos_especiales[0].description') IS NOT NULL");
        $equipos_especiales =  $equipos_especiales->groupBy('equipo_especial');
        $equipos_especiales =  $equipos_especiales->whereNotNull('h_fin');
        $equipos_especiales =  $equipos_especiales->orderBy('cantidad','DESC');
        $equipos_especiales =  $equipos_especiales->selectRaw('COUNT(*) as cantidad');
        $equipos_especiales =  $equipos_especiales->get()->toArray();

        return Response()->json([
            'lista_equipos_especiales'=>$equipos_especiales,
        ]);
    }

    public function cirugiasCulminadasXMedico(Request $request){ // fecha_inicial, fecha_final, limit
        $fechaInicial = isset($GET_['fecha_inicial']) ? $GET_['fecha_inicial'] :  $request->fecha_inicial;
        $fechaFin = isset($GET_['fecha_final']) ? $GET_['fecha_final'] :  $request->fecha_final;
        $resultados = new SolicitudQuirofano();
        $resultados =  $resultados->selectRaw("JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].id') AS medico_id"); //extraemos el user_id del medico
        $resultados =  $resultados->selectRaw("MAX(JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].description')) AS name_medico"); //extraemos el nombre del medico
        $resultados =  $resultados->selectRaw('COUNT(*) AS total_iqx_ejecutadas');
        //$resultados =  $resultados->selectRaw("GROUP_CONCAT( JSON_EXTRACT(h_real_inicio, '$[0].h_inicio')  ) AS h_real_inicio");
        $resultados =  $resultados->selectRaw("
            GROUP_CONCAT( 
                JSON_EXTRACT(
                    JSON_EXTRACT(
                        h_real_inicio,
                        CONCAT(
                            '$[', JSON_LENGTH(h_real_inicio) - 1, ']'
                        ) 
                    ), 
                    '$[0].h_inicio'
                )  
            ) AS h_real_inicio");
        $resultados =  $resultados->selectRaw("GROUP_CONCAT( h_aprox_fin  ) AS h_aprox_fin");
        $resultados =  $resultados->selectRaw("GROUP_CONCAT( h_fin  ) AS h_fin");
        $resultados =  $resultados->selectRaw("GROUP_CONCAT( id  ) AS solicitud_id");
        $resultados =  $resultados->selectRaw("GROUP_CONCAT( fecha_reservacion  ) AS fecha_reservacion");

        $resultados =  $resultados->whereRaw("JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].id') IS NOT NULL");
        $resultados =  $resultados->whereRaw("JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].description') IS NOT NULL");
        $resultados =  $resultados->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI']);
        $resultados =  $resultados->whereIn('area_intervencion', [418,420,421,422]);
        $resultados =  $resultados->whereNotNull('h_fin');
        $resultados =  $resultados->whereBetween('fecha_reservacion', [$fechaInicial, $fechaFin]);
        $resultados =  $resultados->groupBy('medico_id');
        $resultados =  $resultados->orderByDesc('total_iqx_ejecutadas');
        $resultados =  $resultados->get()->toArray();
        $medicos_id =  implode(',', array_filter(array_column($resultados,"medico_id")));
        //dd($medicos_id );
        if (empty($medicos_id)) {
            return Response()->json($resultados);
        }
        $otros_datos = DB::select('
                        SELECT
                            user_profile.imagen,
                            user_profile.user_id,
                            cat_user_especialidad.description AS especialidad
                        FROM user_profile
                        LEFT JOIN user_especialidad ON  user_profile.user_id = user_especialidad.user_id
                        INNER JOIN cat_user_especialidad ON  user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
                        WHERE user_profile.user_id IN('.$medicos_id.')
                    ');

        foreach ($resultados as $key => $value) {
            $resultados[$key]['name_medico'] = trim(str_replace(array('"', '\n'), array('', ''), $value['name_medico']));
            $group_horas_inicio = explode(",",$value['h_real_inicio']);
            $group_horas_fin = explode(",",$value['h_fin']);
            $tiempo_horas = explode(",",$value['h_aprox_fin']);

            $resultados[$key]['tiempo_total_solicitado'] =0;
            $resultados[$key]['tiempo_total_utilizado'] =0;
           /*  if ($resultados[$key]['medico_id'] === "3524") {
                dd($value['h_real_inicio']);
            } */
            for ($i=0; $i < count($group_horas_inicio) ; $i++) {

                //OBTENER EL TOTAL HORAS SOLICITADAS DEL MEDICO
                $resultados[$key]['tiempo_total_solicitado'] += floor( (float) $tiempo_horas[$i] );

                //OBTENER EL TOTAL HORAS USADAS POR EL MEDICO
                $timestamp1 = strtotime( trim(str_replace(array('"', '\n'), array('', ''), $group_horas_inicio[$i]) ) );
                $fecha_inicio = explode(" ",$group_horas_inicio[$i]);
                $fecha_fin = explode(" ",$group_horas_fin[$i] );
                $timestamp2 = strtotime( trim(str_replace(array('"', '\n'), array('', ''), $fecha_inicio[0]." ".$fecha_fin[1] ) ) );


                // Crear objetos DateTime
                $date1 = new DateTime();
                $date1->setTimestamp($timestamp1);

                $date2 = new DateTime();
                $date2->setTimestamp($timestamp2);

                // Calcular la diferencia
                $interval = $date1->diff($date2);

                // Obtener la diferencia en horas
                $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);

                $resultados[$key]['tiempo_total_utilizado'] += floor( (float) $hours );
            }
            $resultados[$key]['tiempo_total_diferencia'] = $resultados[$key]['tiempo_total_solicitado'] - $resultados[$key]['tiempo_total_utilizado'];

            $imagen = array_column(
                array_filter(
                    $otros_datos,
                    function($otro_dato) use ($value) {
                        if ($otro_dato->user_id == $value['medico_id']) {
                            return $otro_dato->imagen;
                        }
                    }
                ),
                "imagen"
            );
            $resultados[$key]['imagen'] = count($imagen) > 0 ? $imagen[0]: NULL ;

            $especialidad = array_column(
                array_filter(
                    $otros_datos,
                    function($otro_dato) use ($value) {
                        if ($otro_dato->user_id == $value['medico_id']) {
                            return $otro_dato->especialidad;
                        }
                    }
                ),
                "especialidad"
            );
            $resultados[$key]['especialidad'] = count($especialidad) > 0 ? $especialidad[0]: NULL ;
            
        }
        return Response()->json($resultados);

    }
    public function cirugiasCulminadasXAnestesiologo(Request $request){ // fecha_inicial, fecha_final, limit
        $fechaInicial = isset($GET_['fecha_inicial']) ? $GET_['fecha_inicial'] :  $request->fecha_inicial;
        $fechaFin = isset($GET_['fecha_final']) ? $GET_['fecha_final'] :  $request->fecha_final;

        $resultados = SolicitudQuirofano::selectRaw('COUNT(*) AS cirugias_culminadas')

            ->selectRaw("JSON_EXTRACT(intervencion, '$[0].anestesiologo[0].id') AS id_medico")
            ->selectRaw("MAX(JSON_EXTRACT(intervencion, '$[0].anestesiologo[0].description')) AS name_medico")
            ->whereBetween('fecha_reservacion', [$fechaInicial, $fechaFin])
            ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
            ->whereRaw("JSON_EXTRACT(intervencion, '$[0].anestesiologo[0].id') IS NOT NULL")
            ->groupBy('id_medico')
            ->orderByDesc('cirugias_culminadas')
            //->limit($request->limit)
            ->get();

            foreach($resultados as $resultado){
                $resultado->imagen = NULL;
                $resultado->especialidad = NULL;
                try {

                    $imagen = DB::select('select imagen from user_profile where user_id = '.$resultado->id_medico);
                    if (count($imagen) > 0) {
                        $resultado->imagen = $imagen[0]->imagen;
                    }


                } catch (\Throwable $th) {
                    dd($resultado);
                }

                    $especialidad =DB::select('
                    select cat_user_especialidad.description AS especialidad
                    from user_especialidad
                    INNER JOIN cat_user_especialidad ON  user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
                    where user_id = '.$resultado->id_medico);
                    if (count($especialidad) > 0) {
                        $resultado->especialidad = $especialidad[0]->especialidad;
                    }

                $resultado->name_medico = trim(str_replace(array('"', '\n'), array('', ''), $resultado->name_medico));
            }

            return Response()->json([
                'resultado'=>$resultados,
            ]);

    }
    public function getTopEspecialidades(Request $request){

        $fechaInicial = isset($GET_['fecha_inicial']) ? $GET_['fecha_inicial'] :  $request->fecha_inicial;
        $fechaFin = isset($GET_['fecha_final']) ? $GET_['fecha_final'] :  $request->fecha_final;


        $resultados = SolicitudQuirofano::selectRaw('COUNT(*) AS cirugias_culminadas')

        ->selectRaw("JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].id') AS medico_id")
        ->selectRaw("MAX(JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].description')) AS name_medico")
        ->whereIn('area_intervencion', [418,420,421,422])
        ->whereBetween('fecha_reservacion', [$fechaInicial, $fechaFin])
        ->whereIn('fase_ubicacion', ['Alta', 'En quirófano', 'Hospitalización', 'Recuperación', 'UTI'])
        ->whereRaw("JSON_EXTRACT(intervencion, '$[0].cirujano_principal[0].id') IS NOT NULL")
        ->groupBy('medico_id')
        ->orderByDesc('cirugias_culminadas')
        ->get()->toArray();

        $medicos_id = array_column($resultados,"medico_id");
        $tales_cirugias_culminadas = array_column($resultados,"cirugias_culminadas");

        $user_especialidades = UserEspecialidad::whereIn("user_id",$medicos_id)
        ->join('cat_user_especialidad','user_especialidad.cat_user_especialidad_id','cat_user_especialidad.id')
        ->select("user_id as medico_id","description as especialidad_description")
        ->get()
        ->toArray();

        foreach ($user_especialidades as $key => $value) {
            $medico_id = $value['medico_id'];
            $user_especialidades[$key]['registros_medico'] =
            array_sum(
                array_column(
                    array_values(
                        array_filter(
                            $resultados,
                            function($registro) use ($medico_id) {
                                return (int) $registro['medico_id'] === (int) $medico_id;
                            }
                        )
                    ),
                    "cirugias_culminadas"
                )
            );
        }
        $especialidades_unicas = array_unique( array_column($user_especialidades,"especialidad_description") );
        $resultEspecialidades = [];
        foreach ($especialidades_unicas as $key => $especialidad) {
            $resultEspecialidades[$key]['especialidad'] = $especialidad;
            $resultEspecialidades[$key]['total'] =
            array_sum(
                array_column(
                    array_values(
                        array_filter(
                            $user_especialidades,
                            function($registro) use ($especialidad) {
                                return  $registro['especialidad_description'] === $especialidad;
                            }
                        )
                    ),
                    "registros_medico"
                )
            )
            ;
        }
        usort($resultEspecialidades, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });
        return $resultEspecialidades;


    }

    // funciones relacionadas al dashboard de qx -- FIN
}
