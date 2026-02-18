<?php

namespace App\Http\Controllers;

use App\Models\UserCuestEpisodio;
use Illuminate\Http\Request;
use App\Models\UserCuestAntecedente;
use App\Models\UserCuestComorbilidad;
use App\Models\UserCuestEgreso;
use App\Models\UserCuestEstudio;
use App\Models\UserCuestFotografia;
use App\Models\UserCuestGlic;
use App\Models\UserCuestImagen;
use App\Models\UserCuestImpresionDiagnostica;
use App\Models\UserCuestInforme;
use App\Models\UserCuestLaboratorio;
use App\Models\UserCuestMedicoPaciente;
use App\Models\UserCuestObservacion;
use App\Models\UserCuestOtroArchivo;
use App\Models\UserCuestOximetria;
use App\Models\UserCuestPlan;
use App\Models\UserCuestPruebaCovid;
use App\Models\CatUserUbicacion;
use App\Models\UserCuestRecipe;
use App\Models\UserCuestPeso;
use App\Models\UserTalla;
use App\Models\UserCuestSintoma;
use App\Models\UserCuestTa;
use App\Models\UserCuestTac;
use App\Models\UserCuestTemperatura;
use App\Models\UserCuestUbicacion;
use App\Models\UserCuestEvolucion;

use App\Models\UserCuestRiesgoQuirurgico;
use App\Models\UserCuestResbalar;
use App\Models\UserCuestAlert;
use App\Models\UserVip;

use Illuminate\Support\Facades\DB;
use App\Models\UserCuestFc;
use App\Models\UserCuestPendiente;
use App\Models\UserCuestFr;
use App\Models\UserCuestMonitoreo;
use App\Models\CatUserCuestionario;
use App\Models\MotivoConsulta;
use App\Models\EnfermedadActual;
use App\Models\ExamenFisico;
use App\Models\UserMedicoPosicion;
use App\Models\UserCuestChat;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserCuestEpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function get_historiaIngreso(Request $request)
    {
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


        $user_id = $request->user_id;
        $user = User::where("user.id",$user_id)
                ->leftJoin("user_profile","user.id","user_profile.user_id")
                ->leftJoin("user_cuest_direction","user.id","user_cuest_direction.user_id")
                ->leftJoin("cat_estado","user_cuest_direction.cat_estado_id","cat_estado.id")
                ->leftJoin("cat_municipio","user_cuest_direction.cat_municipio_id","cat_municipio.id")
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
        //dd($user );
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
        $model["user"] =$user;
        $model["episodio"]["FECHA_INFORME"] =date("d")." de ".$mes[ (int) date("m")-1 ].", ".date("Y");  //esta fecha debe venir de user cuest informe
        $model["episodio"]['ID'] = $cod_episodio;
        $model["episodio"]['INGRESO'] = $episodio['INGRESO_FORMATED'];
        $model["episodio"]['SIGNOS']['TEMP'] = UserCuestTemperatura::where("user_cuest_episodio_id",$episodio['id'])->where("cat_user_cuestionario_id",84)->first();
        $model["episodio"]['SIGNOS']['OXI'] =   UserCuestOximetria::where("user_cuest_episodio_id",$episodio['id'])->where("cat_user_cuestionario_id",73)->first();
        $model["episodio"]['SIGNOS']['FC'] =    UserCuestFc::where("user_cuest_episodio_id",$episodio['id'])->first();
        $model["episodio"]['IMP_DIAG'] =    UserCuestImpresionDiagnostica::where("user_cuest_episodio_id",$episodio['id'])->first();
        $model["episodio"]['SIGNOS']['FR'] =    UserCuestFr::where("user_cuest_episodio_id",$episodio['id'])->first();
        $model["episodio"]['SIGNOS']['GLIC'] =    UserCuestGlic::where("user_cuest_episodio_id",$episodio['id'])->first();

        $model["episodio"]['SIGNOS']['TA'] =    UserCuestTa::where("user_cuest_episodio_id",$episodio['id'])->first();
        $model["episodio"]['SIGNOS']['PESO'] =    UserCuestPeso::where("user_cuest_episodio_id",$episodio['id'])->where("active",1)->first();
        $model["episodio"]['SIGNOS']['TALLA'] =    UserTalla::where("user_cuest_episodio_id",$episodio['id'])->where("active",1)->first();

        $model["episodio"]["MOTIVO_CONSULTA"] =MotivoConsulta::where("user_cuest_episodio_id",$episodio['id'])->value('value');  ;
        $model["episodio"]["ENFERMEDAD_ACTUAL"] =EnfermedadActual::where("user_cuest_episodio_id",$episodio['id'])->value('value');
        $model["episodio"]["EXAMEN_FISICO"] = ExamenFisico::where("user_cuest_episodio_id",$episodio['id'])->value('value');
        $model["episodio"]["ANTECEDENTES"] = UserCuestAntecedente::where("user_cuest_episodio_id",$episodio['id'])->value('value');
        $model["episodio"]["ATENCION_EMERGENCIA"] =$episodio['atencion_emergencia'];
        $model["episodio"]["HOSPITALIZACION"] =$episodio['hospitalizacion'];
        $model["episodio"]["TERAPIA_INTENSIVA"] =$episodio['terapia_intensiva'];
        $model["episodio"]["CASO_TIPO_MEDICO"] =$episodio['caso_tipo_medico'];
        $model["episodio"]["CIRUGIA"] =$episodio['cirugia'];
        $model["episodio"]["NIVEL_TRIAJE"] =$episodio['nivel_triaje'];
        $model["episodio"]["REQUIERE_INTERCONSULTA"] =$episodio['requiere_interconsulta'];
        $model["episodio"]["REALIZAR_PROCEDIMIENTO"] =$episodio['realizar_procedimiento'];
        $model["episodio"]["CANTIDAD_ESPECIALISTAS"] =$episodio['cantidad_especialistas'];
        $model["episodio"]["PROCEDIMIENTO_COMPLEJIDAD"] =$episodio['procedimiento_complejidad'];

        return $model;
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
        return UserCuestEpisodio::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function episodioPendiente()
    {
        return UserCuestEpisodio::episodioPendiente();
    }
    public function restablecer_episodio(Request $request)
    {
        //Cerrar episodios activos
        $episodio = UserCuestEpisodio::where('user_id', $request->user_id)->where('active', 1)->first();
        if($episodio){
            $date1 = new DateTime(date('Y-m-d H:i:s'));
            $date2 = new DateTime(date('Y-m-d H:i:s', strtotime($episodio->ingreso)));
            $diff = $date1->diff($date2);
            $dia_hos = $diff->days;
    
            $ultimaUbicacion = new UserCuestUbicacion();
            $ultimaUbicacion = $ultimaUbicacion->where("user_cuest_ubicacion.user_cuest_episodio_id",$episodio->id)
            ->orderBy('user_cuest_ubicacion.id','desc')
            ->first();
    
            UserCuestEpisodio::where('id', $episodio->id)
            ->update([
                'egreso' => date('Y-m-d H:i:s'),
                'cat_user_ubicacion_id' => $ultimaUbicacion->cat_user_ubicacion_id,
                'cat_user_ubicacion_id_destino' => 246,
                'dia_hos' => $dia_hos,
                "active"=>0
            ]);
            //Cerrar ubicaciones de episodios activos
            UserCuestUbicacion::where('user_cuest_episodio_id', $episodio->id)
            ->update([
                "active"=>0
            ]);
        }
    
        //Reactivar el episodio
        UserCuestEpisodio::where('id', $request->episodio_id)
        ->update([
            'egreso' => NULL,
            'cat_user_ubicacion_id' => NULL,
            'cat_user_ubicacion_id_destino' => NULL,
            'dia_hos' => NULL,
            "active"=>1
        ]);
        //Reactivar ubicaciones del episodio.
        //Lo siguiente es para desactivar  ubicaciones que tengan que ver con altas.
        UserCuestUbicacion::where('user_cuest_episodio_id', $request->episodio_id)
        ->update([
            "active"=>0
        ]);

        $ultimaUbicacion = new UserCuestUbicacion();
        $ultimaUbicacion = $ultimaUbicacion->where("user_cuest_ubicacion.user_cuest_episodio_id",$request->episodio_id)
        ->whereNotIn('cat_user_ubicacion_id', [246,247,248,249,250,251,364,365,366,367,371,386,387])
        ->orderBy('user_cuest_ubicacion.id','desc')
        ->first();
        UserCuestUbicacion::where('id', $ultimaUbicacion->id)
        ->update([
            "active"=>1
        ]);



        return Response()->json(['success'=>true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return UserCuestEpisodio::actualizar($request);
    }
    public function blue_code($user_id,$result)
    {
        return UserCuestEpisodio::blue_code($user_id,$result);
    }
    public function update2(Request $request)
    {
        return UserCuestEpisodio::actualizar2($request);
    }
    public function prealta(Request $request)
    {
        return UserCuestEpisodio::prealta($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /* Public function historial($user_id)
    {

        $datas = DB::table('user_cuest_episodio')
        ->join("cat_user_ubicacion","user_cuest_episodio.cat_user_ubicacion_id","cat_user_ubicacion.id")
        ->select(
            'user_cuest_episodio.id',
            'user_cuest_episodio.ingreso',
            'user_cuest_episodio.egreso',
            'user_cuest_episodio.dia_hos',
            DB::raw("cat_user_ubicacion.description as area_de_egreso"),
            'user_cuest_episodio.cat_user_ubicacion_id',
            'user_cuest_episodio.uti', 'uti_causa',
            'user_cuest_episodio.codigo_azul'
        )
        ->where ('user_cuest_episodio.user_id',$user_id)
        ->whereNotNull ('user_cuest_episodio.egreso') //el episodio debe tener una fecha de egreso
        ->get();

        $respuesta = [];

        foreach($datas as $key => $item){
            $respuesta[$key]['episodio']['antecedente']           = UserCuestAntecedente::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['area_de_egreso_id']     = $item->cat_user_ubicacion_id;
            $respuesta[$key]['episodio']['area_de_egreso']        = $item->area_de_egreso;
            $respuesta[$key]['episodio']['comorbilidad']          = UserCuestComorbilidad::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['dias_hos']              = $item->dia_hos;
            $respuesta[$key]['episodio']['egreso']                = UserCuestEgreso::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['episodio_id']           = $item->id;
            $respuesta[$key]['episodio']['evolucion']               = UserCuestEvolucion::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['estudio']               = UserCuestEstudio::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['fecha_egreso']          = $item->egreso;
            $respuesta[$key]['episodio']['fecha_ingreso']         = $item->ingreso;
            $respuesta[$key]['episodio']['fotografia']            = UserCuestFotografia::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['historia_inicial']      = [];                                                                   //UserCuestHistoriaMedica::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['traslados']   = UserCuestUbicacion::trasladosEnEpisodio($item->id);
            $respuesta[$key]['episodio']['imagenes_episodio'] = UserCuestImagen::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['impresion_diagnostica'] = UserCuestImpresionDiagnostica::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['informe']               = UserCuestInforme::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['laboratorio']           = UserCuestLaboratorio::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['medico_paciente']       = UserCuestMedicoPaciente::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['observacion']           = UserCuestObservacion::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['otro_archivo']          = UserCuestOtroArchivo::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['plan']                  = UserCuestPlan::index_episodio($item->id)->toArray();
            $respuesta[$key]['episodio']['recipe']                = UserCuestRecipe::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['glicemia']             = UserCuestGlic::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['oximetria']            = UserCuestOximetria::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['prueba_covid']          = UserCuestPruebaCovid::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['sintoma']              = UserCuestSintoma::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['tac']                  = UserCuestTac::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['temperatura']          = UserCuestTemperatura::index_episodio($item->id)->toArray();
            $respuesta[$key]['monitoreo']['tension_arterial']     = UserCuestTa::index_episodio($item->id)->toArray();

        }
        //dump($respuesta);
        return Response()->json($respuesta);
    } */
    public function pacientes_activos($area)
    {

        /*
            Obtener los episodios activos
        */
        $models = new UserCuestEpisodio();
        $models = $models->join("user_cuest_ubicacion","user_cuest_episodio.id","user_cuest_ubicacion.user_cuest_episodio_id");
        $models = $models->join("user","user_cuest_episodio.user_id","user.id");
        $models = $models->join("user_profile","user_cuest_episodio.user_id","user_profile.user_id");
        $models = $models->join("cat_user_ubicacion","user_cuest_ubicacion.cat_user_ubicacion_id","cat_user_ubicacion.id");
        //$models = $models->join("user_type","user_cuest_episodio.user_id","user_type.user_id");
        $models = $models->whereNotIn("user_cuest_ubicacion.cat_user_ubicacion_id",[246,247,248,249,251]);
        $models = $models->whereNotNull("user_profile.nombres");
        $models = $models->whereNotNull("user_profile.apellidos");
        $models = $models->whereNotNull("user_profile.cedula");
        $models = $models->where("user_cuest_episodio.active",1);
        $models = $models->where("user_cuest_ubicacion.active",1);


        if ($area =="hospitalizacion") {
            $models = $models->whereIn("cat_user_ubicacion.parent_cat_user_ubicacion_id",[42,235,236,99,71,234,127,155]);
        }
        if ($area =="emergencia") {
            $ubicaciones_id = CatUserUbicacion::whereIn("parent_cat_user_ubicacion_id",[2,3,270,28,29,32,392])->select("id")->get()->pluck("id");
            $models = $models->whereIn("cat_user_ubicacion.id", $ubicaciones_id);
        }
        if ($area =="uti") {
            $ubicaciones_id = CatUserUbicacion::whereIn("parent_cat_user_ubicacion_id",[182,211,391])->select("id")->get()->pluck("id");
            $models = $models->whereIn("cat_user_ubicacion.id", $ubicaciones_id);
        }


        $models = $models->whereNull("user_cuest_episodio.egreso");
        //$models = $models->where("user_type.cat_user_type_id",1);
        $models = $models->select(
            "user_profile.user_id",
            "user.email AS email,",
            "user_profile.*",
            "user_cuest_episodio.*",
            DB::raw( "user_cuest_episodio.id AS episodio_id"),
            DB::raw( "cat_user_ubicacion.id AS cat_user_ubicacion_id"),
            DB::raw( "cat_user_ubicacion.description AS cat_user_ubicacion_description"),
            DB::raw( "cat_user_ubicacion.coments AS cat_user_ubicacion_coments"),
            DB::raw( "cat_user_ubicacion.parent_cat_user_ubicacion_id"),
            DB::raw( "( TO_DAYS( NOW() ) - TO_DAYS( user_cuest_episodio.ingreso) ) AS dias"),
            DB::raw( "YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad"),
        );
        $models = $models->orderBy("cat_user_ubicacion.coments","ASC");
        $models = $models->get();

        //dd($models );
        //$models = $models->take(1);
        $models = $models->toArray();
        //CatUserLaboratorioController.phpdd($models);
        foreach ($models as $key => $model) {
            $resultset = UserCuestRiesgoQuirurgico::where("user_cuest_episodio_id",$model['episodio_id'])->where("active",1)->select('description','value')->first();
            $models[$key]['cirugia_riesgo_value'] = isset($resultset->value) ? (int) $resultset->value:1;
            $models[$key]['cirugia_riesgo_description'] = isset($resultset->description) ? $resultset->description:NULL;

            $resultset = UserCuestResbalar::where("user_cuest_episodio_id",$model['episodio_id'])->where("active",1)->select('description','value')->first();
            $models[$key]['resbalar_riesgo_value'] = isset($resultset->value) ? (int) $resultset->value:3;
            $models[$key]['resbalar_riesgo_description'] = isset($resultset->description) ? $resultset->description:NULL;

            $resultset = UserCuestAlert::where("user_cuest_episodio_id",$model['episodio_id'])->where("active",1)->select('description','value')->first();
            $models[$key]['alerta_riesgo_value'] = isset($resultset->value) ? (int) $resultset->value:3;
            $models[$key]['alerta_riesgo_description'] = isset($resultset->description) ? $resultset->description:NULL;

            $resultset = UserVip::where("user_cuest_episodio_id",$model['episodio_id'])->where("active",1)->select('description','value')->first();
            $models[$key]['user_vip_value'] = isset($resultset->value) ? (int) $resultset->value:3;
            $models[$key]['user_vip_description'] = isset($resultset->description) ? $resultset->description:NULL;

            $resultset = UserCuestMedicoPaciente::where("user_cuest_medico_paciente.user_cuest_episodio_id",$model['episodio_id'])
                        ->where("user_cuest_medico_paciente.active",1)
                        ->where("user_medico_posicion.active",1)
                        ->whereIn("user_cuest_medico_paciente.cat_user_medico_posicion_id",[1])

                        ->join("user_profile","user_cuest_medico_paciente.user_id_medico","user_profile.user_id")
                        ->join("user_especialidad","user_cuest_medico_paciente.user_id_medico","user_especialidad.user_id")
                        ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                        ->join("user_medico_posicion","user_profile.user_id","user_medico_posicion.user_id")
                        ->select(
                            "user_profile.*",
                            DB::raw("cat_user_especialidad.description AS especialidad"),
                            "user_medico_posicion.cat_user_medico_posicion_id"
                        )
                        ->orderBy("user_cuest_medico_paciente.id","DESC")
                        ->get()
                        ->take(1);
            $models[$key]['equipo_medico_paciente']['tratante'] = count($resultset) > 0 ? $resultset[0] :NULL ;

            $resultset = UserCuestMedicoPaciente::where("user_cuest_medico_paciente.user_cuest_episodio_id",$model['episodio_id'])
                        ->where("user_cuest_medico_paciente.active",1)
                        ->where("user_medico_posicion.active",1)
                        ->whereIn("user_cuest_medico_paciente.cat_user_medico_posicion_id",[5,6,7,8,9])

                        ->join("user_profile","user_cuest_medico_paciente.user_id_medico","user_profile.user_id")
                        ->join("user_especialidad","user_cuest_medico_paciente.user_id_medico","user_especialidad.user_id")
                        ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                        ->join("user_medico_posicion","user_profile.user_id","user_medico_posicion.user_id")
                        ->select(
                            "user_profile.*",
                            DB::raw("cat_user_especialidad.description AS especialidad"),
                            "user_medico_posicion.cat_user_medico_posicion_id"
                        )
                        ->orderBy("user_cuest_medico_paciente.id","DESC")
                        ->get();
            $models[$key]['equipo_medico_paciente']['residente'] = count($resultset) > 0 ? $resultset :NULL ;
            $resultset = UserCuestMedicoPaciente::where("user_cuest_medico_paciente.user_cuest_episodio_id",$model['episodio_id'])
                        ->where("user_cuest_medico_paciente.active",1)
                        ->where("user_medico_posicion.active",1)
                        ->whereIn("user_cuest_medico_paciente.cat_user_medico_posicion_id",[10])

                        ->join("user_profile","user_cuest_medico_paciente.user_id_medico","user_profile.user_id")
                        ->join("user_especialidad","user_cuest_medico_paciente.user_id_medico","user_especialidad.user_id")
                        ->join("cat_user_especialidad","user_especialidad.cat_user_especialidad_id","cat_user_especialidad.id")
                        ->join("user_medico_posicion","user_profile.user_id","user_medico_posicion.user_id")
                        ->select(
                            "user_profile.*",
                            DB::raw("cat_user_especialidad.description AS especialidad"),
                            "user_medico_posicion.cat_user_medico_posicion_id"
                        )
                        ->orderBy("user_cuest_medico_paciente.id","DESC")
                        ->get()
                        ->take(1);
            $models[$key]['equipo_medico_paciente']['enfermeria'] = count($resultset) > 0 ? $resultset[0] :NULL ;

            $models[$key]['pendientes'] = UserCuestPendiente::where("user_cuest_episodio_id",$model['episodio_id'])
                        ->where("user_cuest_pendiente.active",1)
                        ->select(
                            "user_cuest_pendiente.*",
                            DB::raw("user_cuest_pendiente.value AS title"),
                            DB::raw("user_cuest_pendiente.coments AS description")
                        )
                        ->get();


            $prealta = $model['pre_alta'];
            //$prealta =  (new DateTime($prealta))->format('Y-m-d') ;
            //$models[$key]['pre_alta'] = $prealta;
            $models[$key]['pre_alta_color'] = "info";

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
                    $models[$key]['pre_alta_color'] = "success";
                }
                if ($diff->days == 1) {
                    $models[$key]['pre_alta_color'] = "warning";
                }
                if ($diff->days == 0) {
                    $models[$key]['pre_alta_color'] = "danger";
                }
            }


            //dump( );
            //dump( $model->toArray() );

            //dump(is_null( $model->profile ) ? [] : $model->profile->toArray() );
            //dump(is_null( $model->reubicacion ) ? [] : $model->reubicacion->toArray() );
            //if ( !is_null( $model->reubicacion ) ) {
                /* foreach ($model->reubicacion as $key1 => $reubicacion) {
                    dump($reubicacion->ubicacion->description);
                } */

                /* foreach ($model->reubicacion as $key1 => $reubicacion) {
                dump($reubicacion->profilePaciente->toArray());
                } */

                /* foreach ($model->reubicacion as $key1 => $reubicacion) {
                    dump($reubicacion->episodio->toArray());
                } */

            //}
            //dump(is_null( $model->antecedente ) ? [] : $model->antecedente->toArray() );
            //dump(is_null( $model->comorbilidad ) ? [] : $model->comorbilidad->toArray() );
            //dump(is_null( $model->evolucion ) ? [] : $model->evolucion->toArray() );
            //dump(is_null( $model->estudioDiagnostico ) ? [] : $model->estudioDiagnostico->toArray() );
            //dump(is_null( $model->fotografia ) ? [] : $model->fotografia->toArray() );
            //dump(is_null( $model->imagen ) ? [] : $model->imagen->toArray() );
            //dump(is_null( $model->impresionDiagnostica ) ? [] : $model->impresionDiagnostica->toArray() );
            //dump(is_null( $model->laboratorio ) ? [] : $model->laboratorio->toArray() );

            //dump(is_null( $model->observacion ) ? [] : $model->observacion->toArray() );
            //dump(is_null( $model->otroArchivo ) ? [] : $model->otroArchivo->toArray() );
            //dump(is_null( $model->plan ) ? [] : $model->plan->toArray() );
            //dump(is_null( $model->recipe ) ? [] : $model->recipe->toArray() );
            //dump(is_null( $model->glicemia ) ? [] : $model->glicemia->toArray() );
            //dump(is_null( $model->sintomas ) ? [] : $model->sintomas->toArray() );
            //dump(is_null( $model->oximetria ) ? [] : $model->oximetria->where("cat_user_cuestionario_id",73)->toArray() );
            //dump(is_null( $model->temperatura ) ? [] : $model->temperatura->where("cat_user_cuestionario_id",84)->toArray() );
            //dump(is_null( $model->tensionArterial ) ? [] : $model->tensionArterial->toArray() );
            //echo"<br>";

        }
        return $models;
    }
    public function historial($user_id)
    {

        $datas = DB::table('user_cuest_episodio')
        ->leftJoin("user_profile","user_cuest_episodio.user_id","user_profile.user_id")
        ->leftJoin("cat_user_ubicacion","user_cuest_episodio.cat_user_ubicacion_id","cat_user_ubicacion.id")
        ->select(
            DB::raw("CONCAT(
                user_profile.nombres,
                ' ',
                user_profile.apellidos
            ) AS paciente"),
            DB::raw("CONCAT(
                user_profile.nacionalidad,
                user_profile.cedula
            ) AS cedula"),
            DB::raw("user_profile.imagen AS imagen_paciente"),
            DB::raw("user_cuest_episodio.id AS episodio_id"),
            DB::raw("user_cuest_episodio.ingreso AS fecha_ingreso"),
            DB::raw("user_cuest_episodio.egreso AS fecha_egreso"),
            'user_cuest_episodio.episodio_sap',
            'user_cuest_episodio.dia_hos',
            DB::raw("cat_user_ubicacion.description as area_de_egreso"),
            'user_cuest_episodio.cat_user_ubicacion_id',
            'user_cuest_episodio.uti', 'uti_causa',
            'user_cuest_episodio.codigo_azul',
            'user_cuest_episodio.hospitalizacion',
            'user_cuest_episodio.terapia_intensiva',
            'user_cuest_episodio.cirugia',
            'user_cuest_episodio.nivel_triaje',
            'user_cuest_episodio.requiere_interconsulta',
            'user_cuest_episodio.realizar_procedimiento',
            'user_cuest_episodio.cantidad_especialistas',
            'user_cuest_episodio.procedimiento_complejidad',
        )
        ->where ('user_cuest_episodio.active',0)
        ->where ('user_cuest_episodio.user_id',$user_id)
        ->orderBy('user_cuest_episodio.id','DESC')
        //->whereNotNull ('user_cuest_episodio.egreso') //el episodio debe tener una fecha de egreso
        ->get();

        $respuesta = [];

        foreach($datas as $key => $item){
            $respuesta[$key]['area_de_egreso_id']       = $item->cat_user_ubicacion_id;
            $respuesta[$key]['area_de_egreso']          = $item->area_de_egreso === NULL ? '' :  $item->area_de_egreso;
            $respuesta[$key]['dia_hos']                 = $item->dia_hos === NULL ? 0 :  $item->dia_hos;
            $respuesta[$key]['fecha_egreso']            = $item->fecha_egreso === NULL ? '' :  $item->fecha_egreso;
            $respuesta[$key]['cedula']                  = $item->cedula;
            $respuesta[$key]['fecha_ingreso']           = $item->fecha_ingreso;
            $respuesta[$key]['paciente']                = $item->paciente;
            $respuesta[$key]['imagen_paciente']         = $item->imagen_paciente;
            $respuesta[$key]['episodio_id']             = $item->episodio_id;
            $respuesta[$key]['codigo_azul']             = $item->codigo_azul;
            $respuesta[$key]['uti_causa']               = $item->uti_causa;
            $respuesta[$key]['episodio_sap']            = $item->episodio_sap;

            $respuesta[$key]['episodio']['historia_inicial']['title']                       =   "Historia Inicial";
            $respuesta[$key]['episodio']['historia_inicial']['items']                       =   [];
            $respuesta[$key]['episodio']['historia_inicial']['items']['IMP_DIAG']           =   UserCuestImpresionDiagnostica::where("user_cuest_episodio_id", $item->episodio_id)->first();
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['FR']       =   UserCuestFr::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['GLIC']     =   UserCuestGlic::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['TA']       =   UserCuestTa::where("user_cuest_episodio_id", $item->episodio_id)->select(DB::raw("CONCAT(value,'/',value2) AS value"))->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['PESO']     =   UserCuestPeso::where("user_cuest_episodio_id", $item->episodio_id)->where("active", 1)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['TALLA']    =   UserTalla::where("user_cuest_episodio_id", $item->episodio_id)->where("active", 1)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['TEMP']     =   UserCuestTemperatura::where("user_cuest_episodio_id", $item->episodio_id)->where("cat_user_cuestionario_id", 84)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['OXI']      =   UserCuestOximetria::where("user_cuest_episodio_id", $item->episodio_id)->where("cat_user_cuestionario_id", 73)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']['SIGNOS']['FC']       =   UserCuestFc::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']["MOTIVO_CONSULTA"]    =   MotivoConsulta::where("user_cuest_episodio_id", $item->episodio_id)->value('value');;
            $respuesta[$key]['episodio']['historia_inicial']['items']["ANTECEDENTES"]       =   UserCuestAntecedente::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']["ENFERMEDAD_ACTUAL"]  =   EnfermedadActual::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            $respuesta[$key]['episodio']['historia_inicial']['items']["EXAMEN_FISICO"]      =   ExamenFisico::where("user_cuest_episodio_id", $item->episodio_id)->value('value');
            
             
            $respuesta[$key]['episodio']['historia_inicial']['items']["HOSPITALIZACION"] =$item->hospitalizacion;
            $respuesta[$key]['episodio']['historia_inicial']['items']["TERAPIA_INTENSIVA"] =$item->terapia_intensiva;
            $respuesta[$key]['episodio']['historia_inicial']['items']["CIRUGIA"] =$item->cirugia;
            $respuesta[$key]['episodio']['historia_inicial']['items']["REQUIERE_INTERCONSULTA"] =$item->requiere_interconsulta;
            $respuesta[$key]['episodio']['historia_inicial']['items']["REALIZAR_PROCEDIMIENTO"] =$item->realizar_procedimiento;
            $respuesta[$key]['episodio']['historia_inicial']['items']["CANTIDAD_ESPECIALISTAS"] =$item->cantidad_especialistas;
            $respuesta[$key]['episodio']['historia_inicial']['items']["PROCEDIMIENTO_COMPLEJIDAD"] =$item->procedimiento_complejidad;
            $nivel_triaje = "No indicado";
            if($item->nivel_triaje){
                $nivel_triaje = "Nivel ".$item->nivel_triaje;
            }
            $respuesta[$key]['episodio']['historia_inicial']['items']["NIVEL_TRIAJE"] = $nivel_triaje;


            $respuesta[$key]['episodio']['laboratorio']['title']          = "Laboratorio";
            $respuesta[$key]['episodio']['laboratorio']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestLaboratorio::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['imagenes_episodio']['title'] = "Imagenes";
            $respuesta[$key]['episodio']['imagenes_episodio']['items']  = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestImagen::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['fotografia']['title']            = "Fotografías";
            $respuesta[$key]['episodio']['fotografia']['items']             = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestFotografia::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['otro_archivo']['title']          = "Otros archivos";
            $respuesta[$key]['episodio']['otro_archivo']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestOtroArchivo::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['impresion_diagnostica']['title']          = "Impresión diágnóstica";
            $respuesta[$key]['episodio']['impresion_diagnostica']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestImpresionDiagnostica::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['evolucion']['title']          = "Evolución";
            $respuesta[$key]['episodio']['evolucion']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestEvolucion::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['plan']['title']          = "Plan";
            $respuesta[$key]['episodio']['plan']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestPlan::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['recipe']['title']          = "Récipe";
            $respuesta[$key]['episodio']['recipe']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestRecipe::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['observacion']['title']          = "Observación";
            $respuesta[$key]['episodio']['observacion']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestObservacion::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['estudio']['title']          = "Estudio";
            $respuesta[$key]['episodio']['estudio']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['value'])) {
                    $item['description'] = $item['value'];
                    unset($item['value']);
                }

                return $item;
            }, UserCuestEstudio::index_episodio($item->episodio_id)->toArray());

            $respuesta[$key]['episodio']['chat_whatsapp']['title']          = "Chat Whatsapp";
            $respuesta[$key]['episodio']['chat_whatsapp']['items']          = array_map(function ($item) {
                // Cambia 'nombre' por 'nombre_completo'
                if (isset($item['message'])) {
                    $item['description'] = $item['message'];
                    unset($item['message']);
                }

                return $item;
            }, UserCuestChat::index_episodio($item->episodio_id)->toArray());

            /* $respuesta[$key]['episodio']['medico_paciente']['title']          = "Equipo Médico";
            $respuesta[$key]['episodio']['medico_paciente']['items']          = UserCuestMedicoPaciente::index_episodio($item->episodio_id)->toArray(); */

            $respuesta[$key]['episodio']['antecedente']['title']          = "Antecedentes";
            $respuesta[$key]['episodio']['antecedente']['items']          = UserCuestAntecedente::index_episodio($item->episodio_id)->toArray();

            $respuesta[$key]['episodio']['comorbilidad']['title']          = "Comorbilidad";
            $respuesta[$key]['episodio']['comorbilidad']['items']          = UserCuestComorbilidad::index_episodio($item->episodio_id)->toArray();

            $respuesta[$key]['episodio']['informe']['title']          = "Informes";
            $respuesta[$key]['episodio']['informe']['items']          = UserCuestInforme::index_episodio($item->episodio_id)->toArray();

            $respuesta[$key]['episodio']['egreso']['title']          = "Egreso";
            $respuesta[$key]['episodio']['egreso']['items']          = UserCuestEgreso::index_episodio($item->episodio_id)->toArray();

            /* $respuesta[$key]['episodio']['traslados']['title']          = "Traslados";
            $respuesta[$key]['episodio']['traslados']['items']          = UserCuestUbicacion::trasladosEnEpisodio($item->episodio_id); */



            /* $respuesta[$key]['episodio']['glicemia']['title']          = "Glicemia";
            $respuesta[$key]['episodio']['glicemia']['items']          = UserCuestGlic::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['oximetria']['title']          = "Oximetría";
            $respuesta[$key]['episodio']['oximetria']['items']          = UserCuestOximetria::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['prueba_covid']['title']          = "Prueba Covid";
            $respuesta[$key]['episodio']['prueba_covid']['items']          = UserCuestPruebaCovid::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['sintoma']['title']          = "Síntomas";
            $respuesta[$key]['episodio']['sintoma']['items']          = UserCuestSintoma::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['tac']['title']          = "TAC";
            $respuesta[$key]['episodio']['tac']['items']          = UserCuestTac::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['temperatura']['title']          = "Temperatura";
            $respuesta[$key]['episodio']['temperatura']['items']          = UserCuestTemperatura::index_episodio($item->episodio_id)->toArray();
            $respuesta[$key]['episodio']['tension_arterial']['title']          = "Tensión Arterial";
            $respuesta[$key]['episodio']['tension_arterial']['items']          = UserCuestTa::index_episodio($item->episodio_id)->toArray();
 */
        }
        //dump($respuesta);
        return $respuesta;
    }

    public function setDischargedToday(Request $request){ // episodio_id
        $episodio = UserCuestEpisodio::where('id',$request->episodio_id)->first();
        $episodio->pre_alta = Carbon::now()->startOfDay();
        $episodio->save();
        return response()->json([
            'message' => 'Estatus cambiado con éxito!',
        ],200);
    }
}
