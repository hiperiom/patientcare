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
use Illuminate\Http\Request;
use Carbon\Carbon;

class SolicitudQuirofanoController extends Controller
{
    public function store(Request $request){
        //dd($request->all());
        //SAMPLE
        $resultSet = [];
        try {

            DB::beginTransaction();
                 //1 USER


                    //VERIFICAR SI LA CEDULA EXISTE
                    $user_id =NULL;
                    $email = NULL;
                    $existe_cedula =    UserProfile::where("cedula",$request->cedula)
                                        ->leftJoin("user", "user_profile.user_id", "user.id")
                                        ->select("user.email","user_profile.user_id")
                                        ->orderBy("user_profile.user_id","DESC")->get()->take(1)->toArray();
                    if ( !empty($existe_cedula) ) {
                        $user_id = $existe_cedula[0]['user_id'];
                        $email =  $existe_cedula[0]['email'];
                    }
                    if ($email != $request->email) {
                        $email = $request->email;
                    }
                    $existe_email = User::where("email",$request->email)->first();
                    if (is_null($existe_email)) {
                        $email = $request->email;

                    }else{
                        $user_id = $existe_email->id;
                        $email = $request->cedula."@correotemporal.com";
                    }
                    //dd($existe_cedula);

                    //-----------
                    if ( !empty($existe_cedula) ) {
                        $email =  $existe_cedula[0]['email'];
                        if ($existe_cedula[0]['email']!= $request->email) {
                            $email = $request->email;
                        }
                        $model = User::firstOrCreate(
                            ['id' => $user_id],
                            [
                                'email'          => $email,
                                'password'       => isset( $request->password ) ? $request->password : "123456",
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
                                'password'       => isset( $request->password ) ? $request->password : "123456",
                                'user_id_medico' => Auth::id(),
                                "created_at"     => date('Y-m-d H:i:s' )
                            ]
                        );
                        $user_id = $model->id;
                    }
                    $request->merge(["user_id_paciente"=>$user_id]);
                    $request->merge(["user_id"=>$user_id]);
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }
                    //-------------


                //2 USER_TYPE
                    $model = UserType::updateOrCreate(
                        [
                        'user_id'   => $user_id,
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
                    $nombre ="/image/system/patient.svg";
                    $file = $request->file('imagen');
                    if (!is_null($file)) {
                        $aleatotio = Str::random(6);
                        $ruta = 'image/user/foto_perfil/';
                        $nombre = "fp_".$aleatotio. $request->user_id . '-' .  str_replace(' ', '', $file->getClientOriginalName());
                        $extension = $file->getClientOriginalExtension();
                        if (!file_exists($ruta.$nombre)) {
                            $file->move($ruta , $nombre);
                            $nombre ='/'. $ruta . $nombre;
                        }
                    }
                    $model = UserProfile::updateOrCreate(
                        [
                            "user_id"=>$request->user_id,
                        ],
                        [
                            'nombres'        => !is_null($request->nombres)?$request->nombres:"",
                            'apellidos'      => !is_null($request->apellidos)?$request->apellidos:"",
                            'nacionalidad'   => $request->nacionalidad,
                            'cedula'         => $request->cedula,
                            'genero'         => $request->genero,
                            'fnacimiento'    => $request->fnacimiento,
                            'telefono_movil' => $request->telefono_movil,
                            'telefono_hogar' => $request->telefono_hogar,
                            'imagen'         => $nombre,
                            "user_id"        => $request->user_id,
                            'user_id_medico' => Auth::id(),
                            "created_at"     => date('Y-m-d H:i:s' )
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                //5 USER_DIRECCION
                    $model = UserCuestDireccion::firstOrCreate(
                        [
                            'user_id' => $request->user_id
                        ],
                        [
                            'cat_estado_id'    => null,
                            'cat_municipio_id' => null,
                            'description'      => null,
                            'domicilio'        => null,
                            'user_id'          => isset($request->user_id)?$request->user_id:null,
                        ]
                    );
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }

                    SolicitudQuirofano::where('active', 1)
                    ->where('n_quirofano', $request->n_quirofano)
                    ->update(['active' => 0]);

                    $model = new SolicitudQuirofano();
                    $model->user_id_paciente = $request->user_id;
                    $model->h_inicio =  $request->h_inicio;
                    $model->h_real_inicio = json_encode(["id"=>1,"description"=>"","user_id"=>$request->user_id_medico,"created_at"=>Carbon::now()->toDateString()]);
                    $model->h_aprox_fin =  $request->h_fin;
                    $model->user_id = $request->user_id_medico;
                    $model->tipo_cupo = $request->tipo_cupo;
                    $model->n_quirofano = $request->n_quirofano;
                    $model->intervencion = $request->intervencion;
                    $model->equipos_especiales = $request->equipos_especiales;
                    $model->cirujano_principal = $request->cirujano_principal;
                    $model->anestesiologo = $request->anestesiologo;
                    $model->anestesia_sugerida = $request->anestesia_sugerida;
                    $model->destino = $request->destino;

                    $model->save();
                    if ($model->exists) {
                        $resultSet[ $model->getTable() ] = $model->toArray();
                    }


            DB::commit();
            $resultSet[ "success" ] = true;
            if ($resultSet[ "success" ]) {
                /* if ( config("app.APP_SEND_EMAILS") ) { */
                    /* $model['case']=1;
                    $model['email']=$request->email;
                    $model['password']=$request->password;

                    $model['logo'] = config('app.url')."/image/system/salud_chacao.png" ;
                    $model['subject']= "Bienvenido al sistema."; */

                    /* if ( config("app.APP_TEST_MODE") ) {
                        $team_test = explode(",",config("app.APP_ADDRESS_TEAM_TEST"));
                        $model['emails'] = $team_test;
                    }else{ */
                        //$model['emails'] = $request->email;
                    /* } */
                    /* $model['emails'] = $request->email;
                    Mail::send('emails.paciente_status', ["model"=>$model], function ($message) use ($model) {
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
            //dd($resultSet);
            return Response()->json($resultSet);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            $resultSet = [];
            $resultSet[ "success" ] = false;
            $resultSet[ "message" ] = $th;
            return Response()->json($resultSet);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visibilidadReservacion($id,$estatus_id)
    {
        $model =SolicitudQuirofano::where('id', $id)
            ->update(['status_id' => $estatus_id]);
        return $model;
    }
    public function index()
    {
        //return view('vistas.plan_quirurgico');
        return view('area_quirurgica.cupo.index');
    }
    public function edit($solicitud_id)
    {
        $model = new SolicitudQuirofano();

        $model = $model->where('solicitud_quirofano.id', $solicitud_id );
        $model = $model->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $model = $model->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $model = $this->solicitudes($model);

        $model = $model->first();
        return $model;
    }
    public function solicitudes($model){
        $model2 = $model->select(
            DB::raw("DATE_FORMAT( solicitud_quirofano.fecha_reservacion,'%Y-%m-%d' ) AS fecha_reservacion"),
            "solicitud_quirofano.active",
            "solicitud_quirofano.id",
            "solicitud_quirofano.episodio_id",
            "solicitud_quirofano.n_cubiculo",
            "solicitud_quirofano.status_id",
            "solicitud_quirofano.convenio",
            "solicitud_quirofano.tipo_reservacion",
            "solicitud_quirofano.destino",
            "solicitud_quirofano.anestesiologo",
            "solicitud_quirofano.tipo_cupo",
            "solicitud_quirofano.fase_ubicacion",
            "solicitud_quirofano.cirujano_principal",
            "solicitud_quirofano.ayudante_1",
            "solicitud_quirofano.ayudante_2",
            "solicitud_quirofano.ayudante_3",
            "solicitud_quirofano.n_quirofano",
            "solicitud_quirofano.intervencion",
            "solicitud_quirofano.equipos_especiales",
            //DB::raw("DATE_FORMAT( solicitud_quirofano.h_inicio,'%h:%i ) AS h_inicio"),
            "solicitud_quirofano.h_inicio",
            "solicitud_quirofano.h_real_inicio",
            "solicitud_quirofano.h_fin",
            "solicitud_quirofano.h_aprox_fin",
            "solicitud_quirofano.circulante_anestesia",
            "solicitud_quirofano.circulante_cirugia",
            "solicitud_quirofano.instrumentista",
            "solicitud_quirofano.n_presupuesto",
            "solicitud_quirofano.dias_hospitalizacion",
            "solicitud_quirofano.anestesia_sugerida",
            "solicitud_quirofano.diagnostico_preoperatorio",
            "solicitud_quirofano.dias_uti",
            "solicitud_quirofano.area_intervencion",
            "user_profile.nacionalidad",
            "user_profile.nombres",
            "user_profile.apellidos",
            "user_profile.genero",
            "user_profile.fnacimiento",
            "user_profile.telefono_movil",
            "user_profile.telefono_hogar",

            "user.email",
            DB::raw("
                user_profile.user_id AS user_id_paciente
            "),
            DB::raw("
                (
                    TIMESTAMPDIFF(YEAR, user_profile.fnacimiento, CURDATE())
                ) AS 'edad'

            "),
            DB::raw("
                DATE_FORMAT(h_inicio, '%h:%i') AS hora_inicio_formated
            "),
            DB::raw("
                user_profile.cedula AS documento_identidad
            "),
            DB::raw("
                CONCAT(
                    user_profile.nacionalidad,
                    ' ',
                    user_profile.cedula
                ) AS cedula
            "),
            DB::raw("
                CONCAT(
                    SUBSTRING_INDEX( user_profile.nombres, ' ', 1),
                    ' ',
                    SUBSTRING_INDEX( user_profile.apellidos, ' ', 1)
                ) AS paciente
            "),
            DB::raw("
                (
                    SELECT
                        IFNULL(
                            JSON_ARRAYAGG(
                                JSON_OBJECT(
                                    'id', pa.id,
                                    'active', pa.active,
                                    'cat_quirofano_id', pa.cat_quirofano_id,
                                    'solicitud_quirofano_id', pa.solicitud_quirofano_id,
                                    'user_id', pa.user_id,
                                    'tipo_personal', pa.tipo_personal,
                                    'user_id_medico', pa.user_id_medico,
                                    'personal', CONCAT(SUBSTRING_INDEX(up.nombres , ' ', 1),' ',SUBSTRING_INDEX(up.apellidos , ' ', 1)),
                                    'registrado_por', CONCAT(SUBSTRING_INDEX(up2.nombres , ' ', 1),' ',SUBSTRING_INDEX(up2.apellidos , ' ', 1))
                                )
                            ), JSON_ARRAY()
                        )
                    FROM personal_asistencial pa
                    INNER JOIN user_profile up ON pa.user_id = up.user_id
                    INNER JOIN user_profile up2 ON pa.user_id_medico = up2.user_id
                    WHERE pa.solicitud_quirofano_id = solicitud_quirofano.id
                    #AND pa.active = 1
                ) AS personal_asistencial
            "),


            DB::raw("
                CASE WHEN solicitud_quirofano.h_aprox_fin < 1 THEN
                CONCAT(  (solicitud_quirofano.h_aprox_fin  *60) ,'min' )
                ELSE CONCAT(solicitud_quirofano.h_aprox_fin,'h') END AS horas_intervencion
            ")
        );
        return $model2;
    }
    public function getAllFinalizadas() {
        /*
        $model = new SolicitudQuirofano();

        $model = $model->whereDate('solicitud_quirofano.h_inicio', '<', Carbon::now()->toDateString());
        $model = $model->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $model = $model->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $model = $this->solicitudes($model);

        //->groupBy("n_quirofano")
        $model = $model->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $model = $model->orderBy("solicitud_quirofano.h_inicio","ASC");
        $model = $model->get();
        return $model;*/
    }
    public function getAllInterno() {
        //dd($_GET['startDate']);
        try {
            $area_intervencion_id = [];
            if($_GET['area_intervencion']=="hospitalizacion"){
                $area_intervencion_id = [418,422];
            }
            if($_GET['area_intervencion']=="mapm"){
                $area_intervencion_id = [424,425];
            }
            $model = new SolicitudQuirofano();
            //$model = $model->whereDate('solicitud_quirofano.h_inicio', '>=',/*  "2024-02-16" */ Carbon::now()->toDateString());
            $model = $model->whereIn('solicitud_quirofano.area_intervencion', $area_intervencion_id );
            $model = $model->whereBetween('solicitud_quirofano.fecha_reservacion', [ $_GET['startDate'], $_GET['endDate'] ]);
            $model = $model->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
            $model = $model->join("user","solicitud_quirofano.user_id_paciente","user.id");

            $model = $this->solicitudes($model);

            //->groupBy("n_quirofano")
            $model = $model->orderBy("solicitud_quirofano.n_quirofano","ASC");
            $model = $model->orderBy("solicitud_quirofano.h_inicio","ASC");
            $model = $model->get();

            foreach ($model as $key => $value) {
                //$model[$key]->personal_asistencial = json_decode($value->personal_asistencial);
                $registros = json_decode($value->personal_asistencial);
           
                $temp = [];
                $ultimoCAnestesia = null;
                $ultimoCCirugia = null;
                $ultimoInstrumentista = null;

                foreach ($registros as $registro) {
                    switch ($registro->tipo_personal) {
                        case 'c_anestesia':
                            if ($ultimoCAnestesia === null || $registro->id > $ultimoCAnestesia->id) {
                                $ultimoCAnestesia = $registro;
                            }
                            break;
                        case 'c_cirugia':
                            if ($ultimoCCirugia === null || $registro->id > $ultimoCCirugia->id) {
                                $ultimoCCirugia = $registro;
                            }
                            break;
                        case 'instrumentista':
                            if ($ultimoInstrumentista === null || $registro->id > $ultimoInstrumentista->id) {
                                $ultimoInstrumentista = $registro;
                            }
                            break;
                    }
                }
                array_push($temp, $ultimoCAnestesia);
                array_push($temp, $ultimoCCirugia);
                array_push($temp, $ultimoInstrumentista);
                $model[$key]->personal_asistencial = $temp;
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        return $model;
    }
    public function getAllExterno($fecha_reporte) {
        $area_intervencion_id = [];
            if($_GET['area_intervencion']=="hospitalizacion"){
                $area_intervencion_id = [418,422];
            }
            if($_GET['area_intervencion']=="mapm"){
                $area_intervencion_id = [424,425];
            }
        $model = new SolicitudQuirofano();
        $model = $model->whereIn('solicitud_quirofano.area_intervencion', $area_intervencion_id );
        $model = $model->whereBetween('solicitud_quirofano.fecha_reservacion', [ $fecha_reporte, $fecha_reporte ]);
        $model = $model->join("user_profile","solicitud_quirofano.user_id_paciente","user_profile.user_id");
        $model = $model->join("user","solicitud_quirofano.user_id_paciente","user.id");
        $model = $this->solicitudes($model);

        //->groupBy("n_quirofano")
        $model = $model->orderBy("solicitud_quirofano.n_quirofano","ASC");
        $model = $model->orderBy("solicitud_quirofano.h_inicio","ASC");
        $model = $model->get();
        return $model;
    }
    public function index_familiar()
    {
        return view("vistas.paciente_quirurgico");
    }
    public function index_familiar2()
    {
        return view("vistas.paciente_quirurgico2");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function create()
    {
        return view("area_quirurgica.create");
    } */
    public function create()
    {
        return view("area_quirurgica.cupo.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeXEXISTEOTRA(Request $request)
    {
        dd($request->all());
        //dump(json_decode($request->intervencion));
        //dump(json_decode($request->equipos_especiales));
        //dump(json_decode($request->cirujano_principal));
        //dd(json_decode($request->anestesiologo));




        $model = new SolicitudQuirofano();
        $model->user_id_paciente = $request->user_id_paciente;
        $model->h_inicio =  $request->h_inicio;
        $model->h_aprox_fin =  $request->h_fin;
        $model->user_id = $request->user_id_medico;
        $model->save();

        $model2 = new IntQuirurgicaMedicos();
        $medicos_principales = json_decode($request->cirujano_principal);
        foreach ($medicos_principales as $key => $value) {
            $model2->user_id_medico = 22; //$value->id;
            $model2->especialidad_id = NULL;
            $model2->int_quirurgica_id = $model->id;
            $model2->save();
        }


        return $model;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IntQuirurgica  $intQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function show(IntQuirurgica $intQuirurgica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IntQuirurgica  $intQuirurgica
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IntQuirurgica  $intQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IntQuirurgica $intQuirurgica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IntQuirurgica  $intQuirurgica
     * @return \Illuminate\Http\Response
     */
    public function destroy(IntQuirurgica $intQuirurgica)
    {
        //
    }
}
