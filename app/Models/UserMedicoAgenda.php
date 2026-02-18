<?php

namespace App\Models;
use App\Models\UserCita;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserMedicoActivo;

use Carbon\Carbon;

class UserMedicoAgenda extends Model
{
    protected $table = 'user_medico_agenda';
    protected $fillable = ['agenda', 'user_id_medico', 'fechas_excluidas', 'agenda_desde', 'agenda_hasta', 'cat_especialidad_id', 'centro_salud_id', 'cupos_por_dia', 'agenda_year', 'created_at', 'updated_at'];
    static function getAll()
    {
        $agendas = UserMedicoAgenda::where('active', 1)
            ->select('agenda', 'agenda_year', 'user_id_medico', 'agenda_desde', 'agenda_hasta', 'fechas_excluidas', 'centro_salud_id', 'cat_especialidad_id', DB::raw('id AS agenda_id'))
            ->get();
        $models = $agendas->toArray();
        $result = [];
        foreach ($models as $key => $value) {
            $models[$key]['agenda'] = json_decode($value['agenda']);
        }
        return $models;
    }
    static function getAllByEspecialidad($cat_especialidad_id)
    {
        $agendas = UserMedicoAgenda::where('active', 1)
            ->where('cat_especialidad_id', $cat_especialidad_id)
            ->select('agenda', 'agenda_year', 'agenda_desde', 'agenda_hasta', 'user_id_medico', 'fechas_excluidas', 'centro_salud_id', 'cat_especialidad_id', DB::raw('id AS agenda_id'))
            ->get();
        $models = $agendas->toArray();
        $result = [];
        foreach ($models as $key => $value) {
            $models[$key]['agenda'] = UserMedicoAgenda::deployAgenda($value);

            //EXCLUIR LAS HORAS QUE YA HAN SIDO TOMADAS POR OTRAS SOLICITUDES
            //PARA UN DIA ESPECIFICO
            $nuevas_citas_pendientes = UserCita::where('user_id_medico', $value['user_id_medico'])
                ->where('cat_user_cita_status_id', 1)
                ->where('created_at', '>=', date('Y-m-d'))
                ->select(DB::raw("CONCAT(year,'-',month,'-',day,' ',hour) AS day"))
                ->get()
                ->toArray();
            $nuevas_citas_pendientes = array_column($nuevas_citas_pendientes, 'day');
            foreach ($nuevas_citas_pendientes as $key2 => $value2) {
                foreach ($models[$key]['agenda']['horas_am'] as $key3 => $value3) {
                    if (strtotime($value2) == strtotime($value3)) {
                        unset($models[$key]['agenda']['horas_am'][$key3]);
                    }
                }
                $models[$key]['agenda']['horas_am'] = array_values($models[$key]['agenda']['horas_am']); //para resetear los indices del array
                foreach ($models[$key]['agenda']['horas_pm'] as $key4 => $value4) {
                    if (strtotime($value2) == strtotime($value4)) {
                        unset($models[$key]['agenda']['horas_pm'][$key4]);
                    }
                }
                $models[$key]['agenda']['horas_pm'] = array_values($models[$key]['agenda']['horas_pm']); //para resetear los indices del array
            }

            $usermedicoactivo = UserMedicoActivo::where('user_id_medico', $value['user_id_medico'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(1);
            if (count($usermedicoactivo) == 0) {
                $result[] = $models[$key];
            }
            if (count($usermedicoactivo) > 0) {
                if ($usermedicoactivo[0]['active'] == 1) {
                    $result[] = $models[$key];
                }
            }
            // dump($usermedicoactivo);
        }
        return $result;
    }
    static function getMedicos($data){
        $model = new UserMedicoAgenda();
        $model = $model->where('user_medico_agenda.active', 1);
        $model = $model->join('user_profile AS up', 'user_medico_agenda.user_id_medico', 'up.user_id');
        $model = $model->join('cat_user_especialidad AS cue', 'user_medico_agenda.cat_especialidad_id', 'cue.id');
        $model = $model->join('centro_salud AS cs', 'user_medico_agenda.centro_salud_id', 'cs.id');

        if ($data['selector']=="all") {
            $model = $model->where('user_medico_agenda.centro_salud_id', $data['centro_salud_id']);
            $model = $model->where('user_medico_agenda.cat_especialidad_id', $data['especialidad_id']);
            $model = $model->whereIn('user_medico_agenda.user_id_medico', $data['medicos_id']);
        }else{
            $model = $model->where('user_medico_agenda.user_id_medico', $data['medicos_id']);
        }

        $model = $model->select(
                'user_medico_agenda.agenda',
                'user_medico_agenda.agenda_year',
                'user_medico_agenda.fechas_excluidas',
                'user_medico_agenda.user_id_medico',
                'user_medico_agenda.centro_salud_id',
                'user_medico_agenda.agenda_desde',
                'user_medico_agenda.agenda_hasta',
                'user_medico_agenda.cat_especialidad_id',
                DB::raw('cue.description AS cat_especialidad_description'),
                DB::raw('cs.description AS centro_salud_description'),
                DB::raw('user_medico_agenda.id AS agenda_id'),
                DB::raw("CONCAT(up.nombres, ' ', up.apellidos) AS medico_descripcion")
        );

        $model = $model->get();
        $models= $model->toArray();
        return $model;
    }
    static function getAllByMedicos(Request $request)
    {
        // echo $request->medicos_id;

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
                        // $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                        $model->created_at = date('Y-m-d H:i:s', strtotime(Carbon::now()));
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
    static function getOne($user_id_medico)
    {
        /* $usermedicoactivo = UserMedicoActivo::where('user_id_medico', $user_id_medico )
                ->where('active', 1)
                ->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                //->get()
                ->take(1)
                ->value("user_id_medico"); */

        //if (!is_null($usermedicoactivo)) {
            $data =[
                "selector"=>"one",
                "centro_salud_id"=>NULL,
                "especialidad_id"=>NULL,
                "medicos_id"=>$user_id_medico
            ];
            $model = UserMedicoAgenda::getMedicos($data);
        //}else {
        //    $model = [];
        //}


        //$model = UserMedicoAgenda::agendaDeploy($model);

        //dd($model);
        return $model;
    }
    static function agendaDeploy($models){

        foreach ($models as $models_key => $value) {
            $user_id_medico = $value['user_id_medico'];
            $agenda = ((array) json_decode($value['agenda']));
            //dump($agenda);
            //dd(array_key_exists("agenda_month",$agenda));
            $existeAgendaMonth = array_key_exists("agenda_month",$agenda);
            if ($existeAgendaMonth) {


                $agenda_desde = $value['agenda_desde'];
                $agenda_hasta = $value['agenda_hasta'];
                $fecha_hoy = date('Y-m-d H:i');
                $mes_actual = date('m');
                $semana_number_actual = (int) date('W');
                $horas_ocupadas = UserMedicoAgenda::dias_ocupados($user_id_medico, $value['cat_especialidad_id']);
                $horas_ocupadas_a_milisegundos = [];

                $resultset = [];
                //dd( $horas_ocupadas );
                foreach ($agenda['agenda_month'] as $mes_number => $mes) {
                    $mes = (array) $mes;
                    //dump($mes);
                    if ((int) $mes["number"] >= (int) $mes_actual - 1) {
                        $semanas = (array) $mes['weeks'];
                        //dump($semanas);
                        foreach ($semanas as $semana_number => $semana) {
                            //dump($semana);
                            if (!is_null($semana)) {
                                if ((int) $semana_number >= $semana_number_actual) {
                                    //dump( (array)$semana );
                                    $horas_disponibles = [];
                                    foreach ($semana as $dia_number => $dia) {
                                        $dia = (array) $dia;
                                        //dump($semana_number);
                                        $hours = (array) $dia['hours'];

                                        foreach ($hours as $key => $hour) {
                                            $dia_del_mes = Carbon::now()->setISODate(date('Y'), (int) $semana_number, $dia['day_value']);

                                            $hour = (array) $hour;

                                            array_push($horas_disponibles, ['fecha' => $dia_del_mes->format('Y-m-d') . ' ' . $hour['hora'], 'visibilidad' => $hour['visibilidad']]);
                                        }
                                        //dd($horas_disponibles);
                                        $horas_disponibles_reales = [];
                                        foreach ($horas_disponibles as $key => $hora_disponible) {

                                            //dump("hora disponible: ".$hora_disponible['fecha']);
                                            //SI NO ESTÁ EN $HORAS OCUPADAS ENTONCES ES UNA HORA A MOSTRAR

                                            if (!in_array($hora_disponible['fecha'], $horas_ocupadas)) {
                                                array_push($horas_disponibles_reales, $hora_disponible );
                                            }else{
                                                //dump($value);
                                                //dump("Hora ocupada: ".$hora_disponible['fecha']." | cat_especialidad_id: ".$value['cat_especialidad_id']." | centro_salud_id: ". $value['centro_salud_id']);
                                            }
                                        }
                                        //dd($horas_disponibles_reales);
                                        $temp_fecha = '';
                                        $dias_horas = [];
                                        $dia_key = 0;
                                        foreach ($horas_disponibles_reales as $key => $dia_hora) {

                                            if (
                                                    strtotime(date($dia_hora['fecha'])) >= strtotime(date($agenda_desde) . ' 00:00:00') &&
                                                    strtotime(date($dia_hora['fecha'])) <= strtotime(date($agenda_hasta) . ' 23:59:59')
                                            ) {

                                                if ($temp_fecha !== date('Y-m-d', strtotime($dia_hora['fecha']))) {
                                                    $temp_fecha = date('Y-m-d', strtotime($dia_hora['fecha']));

                                                    $resultset[$temp_fecha] = [];
                                                    $dia_key++;
                                                }
                                                if (
                                                    strtotime( date($dia_hora['fecha']) ) >= strtotime( date( $fecha_hoy ) )
                                                ) {
                                                    $hora = date('H:i', strtotime($dia_hora['fecha']));
                                                    $resultset[$temp_fecha][] = ['day' => $dia_hora['fecha'], 'visibilidad' => $dia_hora['visibilidad']];
                                                    $hora;
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $result = [];
                foreach ($resultset as $key => $value) {
                    foreach ($value as $value2) {
                        $result[] = $value2;
                    }
                }
                //dd($result);
            }else{
                $result = [];
            }
            $models[$models_key]['agenda'] = json_encode($result);
        }
        return $models;
    }
    static function dias_ocupados($user_id_medico, $cat_especialidad_id)
    {
        $dias_ocupados = [];
        //CONSULTAMOS LAS FECHAS YA OCUPADAS POR OTRAS CITAS
        $model = UserCita::where('user_id_medico', $user_id_medico)
            ->where('cat_especialidad_id', $cat_especialidad_id)
            //->whereNotIn("cat_user_cita_status_id",[3])
            ->where("cancelada_paciente",0)
            ->whereIn('cancelada_medico', [0,1])
            ->whereIn('reprogramada', [0,1])
            ->where('year', '>=', date('Y'))
            ->where('month', '>=',  date('m') )
            //->where("day", ">=",(int) date("d") )
            ->select(
                DB::raw("id as cita_id"),
                DB::raw("
                    STR_TO_DATE(
                        CONCAT(
                            year,'-',
                            month,'-',
                            day,' ',
                            hour
                        ),
                        '%Y-%m-%d %T'
                    ) AS fecha
                ")
            )
            ->orderBy('fecha', 'ASC')
            ->get();
        //FORMATEAMOS LAS FECHAS
        if (!empty($model)) {
            $model = $model->toArray();
            foreach ($model as $key => $value) {
                $dias_ocupados[$key] = date('Y-m-d H:i', strtotime($value['fecha']));
            }
        }
        return $dias_ocupados;
    }
    static function store(Request $request)
    {
        //dd($request->all());
        try {
            $model = UserMedicoAgenda::updateOrCreate(
                [
                    'user_id_medico' => $request->user_id_medico,
                    'centro_salud_id' => $request->centro_salud_id,
                    'cat_especialidad_id' => $request->cat_especialidad_id,
                ],
                [
                    'agenda_year' => $request->agenda_year,
                    'agenda' => $request->agenda,
                    'user_id_medico' => $request->user_id_medico,
                    'centro_salud_id' => $request->centro_salud_id,
                    'cat_especialidad_id' => $request->cat_especialidad_id,
                    'cupos_por_dia' => $request->cupos_por_dia,
                    'fechas_excluidas' => isset($request->fechas_excluidas) && !is_null($request->fechas_excluidas) ? $request->fechas_excluidas : null,
                    'agenda_desde' => $request->agenda_desde, //( isset($request->agenda_desde) && !is_null($request->agenda_desde) ) ? $request->agenda_desde : date('Y')."-01-16" ,
                    'agenda_hasta' => $request->agenda_hasta, //( isset($request->agenda_hasta) && !is_null($request->agenda_hasta) ) ? $request->agenda_hasta : date('Y')."-12-31" ,
                    'created_at' => date('Y-m-d H:i:s', strtotime($request->created_at)),
                ]
            );

            return UserMedicoAgenda::where('user_id_medico', $request->user_id_medico)
                ->where('centro_salud_id', $request->centro_salud_id)
                ->where('cat_especialidad_id', $request->cat_especialidad_id)
                ->where('active', 1)
                ->select(
                    'user_id_medico',
                    DB::raw('id AS agenda_id'),
                    DB::raw('agenda'),
                    DB::raw('cat_especialidad_id'),
                    DB::raw("
                        (
                            SELECT description
                            FROM cat_user_especialidad
                            WHERE id = user_medico_agenda.cat_especialidad_id
                        ) AS especialidad_description
                    "),
                    DB::raw('centro_salud_id'),
                    DB::raw("
                        (
                            SELECT description
                            FROM centro_salud
                            WHERE id = user_medico_agenda.centro_salud_id
                        ) AS centro_salud_description
                    ")
                )
                ->first()
                ->toArray();

            // return $model; //UserMedicoAgenda::show($model->id);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    static function show($agenda_id)
    {
        $agendas = UserMedicoAgenda::where('active', 1)
            ->where('id', $agenda_id)
            ->select('agenda', 'agenda_year', 'user_id_medico', 'agenda_desde', 'agenda_hasta', 'fechas_excluidas', 'centro_salud_id', 'cat_especialidad_id', DB::raw('id AS agenda_id'))
            ->get();
        return UserMedicoAgenda::get_agenda($agendas);
    }


        /* $models = UserMedicoAgenda::where('user_medico_agenda.active', 1)
            ->join('user_profile AS up', 'user_medico_agenda.user_id_medico', 'up.user_id')
            ->join('cat_user_especialidad AS cue', 'user_medico_agenda.cat_especialidad_id', 'cue.id')
            ->join('centro_salud AS cs', 'user_medico_agenda.centro_salud_id', 'cs.id')
            ->where('user_medico_agenda.centro_salud_id', $request->centro_salud_id)
            ->where('user_medico_agenda.cat_especialidad_id', $request->especialidad_id)
            ->whereIn('user_medico_agenda.user_id_medico', $medicos_id)
            ->select(
                'user_medico_agenda.agenda',
                'user_medico_agenda.agenda_year',
                'user_medico_agenda.fechas_excluidas',
                'user_medico_agenda.user_id_medico',
                'user_medico_agenda.centro_salud_id',
                'user_medico_agenda.agenda_desde',
                'user_medico_agenda.agenda_hasta',
                'user_medico_agenda.cat_especialidad_id',
                DB::raw('cue.description AS cat_especialidad_description'),
                DB::raw('cs.description AS centro_salud_description'),
                DB::raw('user_medico_agenda.id AS agenda_id'),
                DB::raw("CONCAT(up.nombres, ' ', up.apellidos) AS medico_descripcion")
            )
            ->get(); */
        /* $models = UserMedicoAgenda::where('user_medico_agenda.active', 1)
            ->join('user_profile AS up', 'user_medico_agenda.user_id_medico', 'up.user_id')
            ->join('cat_user_especialidad AS cue', 'user_medico_agenda.cat_especialidad_id', 'cue.id')
            ->join('centro_salud AS cs', 'user_medico_agenda.centro_salud_id', 'cs.id')
            ->where('user_medico_agenda.user_id_medico', $user_id_medico)
            ->select(
                'user_medico_agenda.agenda',
                'user_medico_agenda.agenda_year',
                'user_medico_agenda.fechas_excluidas',
                'user_medico_agenda.user_id_medico',
                'user_medico_agenda.agenda_desde',
                'user_medico_agenda.agenda_hasta',
                'user_medico_agenda.centro_salud_id',
                'user_medico_agenda.cat_especialidad_id',
                DB::raw('cue.description AS cat_especialidad_description'),
                DB::raw('cs.description AS centro_salud_description'),
                DB::raw('user_medico_agenda.id AS agenda_id'),
                DB::raw("CONCAT(up.nombres, ' ', up.apellidos) AS medico_descripcion")
            )
            ->get(); */
    /*     static function getAllByMedicosRESPALDO(Request $request)
    {
        $medicos_id = explode(',', $request->medicos_id);

        $agendas = UserMedicoAgenda::where('user_medico_agenda.active', 1)
            ->join('user_profile AS up', 'user_medico_agenda.user_id_medico', 'up.user_id')
            ->where('user_medico_agenda.centro_salud_id', $request->centro_salud_id)
            ->where('user_medico_agenda.cat_especialidad_id', $request->especialidad_id)
            ->whereIn('user_medico_agenda.user_id_medico', $medicos_id)
            ->select(
                'user_medico_agenda.agenda',
                'user_medico_agenda.agenda_year',
                'user_medico_agenda.fechas_excluidas',
                'user_medico_agenda.user_id_medico',
                'user_medico_agenda.centro_salud_id',
                'user_medico_agenda.agenda_desde',
                'user_medico_agenda.agenda_hasta',
                'user_medico_agenda.cat_especialidad_id',
                DB::raw('user_medico_agenda.id AS agenda_id'),
                DB::raw("
                        CONCAT(up.nombres, ' ', up.apellidos) AS medico_descripcion"),
            )
            ->get();
        $models = $agendas->toArray();
        $result = [];
        foreach ($models as $key => $value) {
            $models[$key]['agenda'] = UserMedicoAgenda::deployAgenda($value);

            //EXCLUIR LAS HORAS QUE YA HAN SIDO TOMADAS POR OTRAS SOLICITUDES
            //PARA UN DIA ESPECIFICO
            $nuevas_citas_pendientes = UserCita::where('user_id_medico', $value['user_id_medico'])
                ->where('cat_user_cita_status_id', 1)
                ->where('created_at', '>=', date('Y-m-d'))
                ->select(DB::raw("CONCAT(year,'-',month,'-',day,' ',hour) AS day"))
                ->get()
                ->toArray();
            $nuevas_citas_pendientes = array_column($nuevas_citas_pendientes, 'day');
            foreach ($nuevas_citas_pendientes as $key2 => $value2) {
                foreach ($models[$key]['agenda']['horas_am'] as $key3 => $value3) {
                    if (strtotime($value2) == strtotime($value3)) {
                        unset($models[$key]['agenda']['horas_am'][$key3]);
                    }
                }
                $models[$key]['agenda']['horas_am'] = array_values($models[$key]['agenda']['horas_am']); //para resetear los indices del array
                foreach ($models[$key]['agenda']['horas_pm'] as $key4 => $value4) {
                    if (strtotime($value2) == strtotime($value4)) {
                        unset($models[$key]['agenda']['horas_pm'][$key4]);
                    }
                }
                $models[$key]['agenda']['horas_pm'] = array_values($models[$key]['agenda']['horas_pm']); //para resetear los indices del array
            }

            $usermedicoactivo = UserMedicoActivo::where('user_id_medico', $value['user_id_medico'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(1);
            if (count($usermedicoactivo) == 0) {
                $result[] = $models[$key];
            }
            if (count($usermedicoactivo) > 0) {
                if ($usermedicoactivo[0]['active'] == 1) {
                    $result[] = $models[$key];
                }
            }
            // dump($usermedicoactivo);
        }
        return $result;
    } */
    /*     static function getAllRESPALDO()
    {
        $agendas = UserMedicoAgenda::where('active', 1)
            ->select('agenda', 'agenda_year', 'user_id_medico', 'agenda_desde', 'agenda_hasta', 'fechas_excluidas', 'centro_salud_id', 'cat_especialidad_id', DB::raw('id AS agenda_id'))
            ->get();
        $models = $agendas->toArray();
        $result = [];
        foreach ($models as $key => $value) {
            $models[$key]['agenda'] = UserMedicoAgenda::deployAgenda($value);

            //EXCLUIR LAS HORAS QUE YA HAN SIDO TOMADAS POR OTRAS SOLICITUDES
            //PARA UN DIA ESPECIFICO
            $nuevas_citas_pendientes = UserCita::where('user_id_medico', $value['user_id_medico'])
                ->whereIn('cat_user_cita_status_id', [1, 2])
                ->where('created_at', '>=', date('Y-m-d'))
                ->select(DB::raw("CONCAT(year,'-',month,'-',day,' ',hour) AS day"))
                ->get()
                ->toArray();
            $nuevas_citas_pendientes = array_column($nuevas_citas_pendientes, 'day');
            foreach ($nuevas_citas_pendientes as $key2 => $value2) {
                foreach ($models[$key]['agenda']['horas_am'] as $key3 => $value3) {
                    if (strtotime($value2) == strtotime($value3)) {
                        unset($models[$key]['agenda']['horas_am'][$key3]);
                    }
                }
                $models[$key]['agenda']['horas_am'] = array_values($models[$key]['agenda']['horas_am']); //para resetear los indices del array
                foreach ($models[$key]['agenda']['horas_pm'] as $key4 => $value4) {
                    if (strtotime($value2) == strtotime($value4)) {
                        unset($models[$key]['agenda']['horas_pm'][$key4]);
                    }
                }
                $models[$key]['agenda']['horas_pm'] = array_values($models[$key]['agenda']['horas_pm']); //para resetear los indices del array
            }

            $usermedicoactivo = UserMedicoActivo::where('user_id_medico', $value['user_id_medico'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(1);
            if (count($usermedicoactivo) == 0) {
                $result[] = $models[$key];
            }
            if (count($usermedicoactivo) > 0) {
                if ($usermedicoactivo[0]['active'] == 1) {
                    $result[] = $models[$key];
                }
            }
            // dump($usermedicoactivo);
        }
        return $result;
    } */
    /* static function get_agenda($agendas){


        $models = $agendas;

        foreach ($models as $key => $value) {
            $agenda = json_decode( $value['agenda'] );

            $models[ $key ]['agenda'] = UserMedicoAgenda::deployAgenda( $agenda ,$value['agenda_year'],$value['fechas_excluidas'] );

            //EXCLUIR LAS HORAS QUE YA HAN SIDO TOMADAS POR OTRAS SOLICITUDES
            //PARA UN DIA ESPECIFICO
            $nuevas_citas_pendientes = UserCita::where("user_id_medico", $value['user_id_medico'] )
                            ->where("cat_user_cita_status_id",1)
                            ->where("created_at",">=",date("Y-m-d"))
                            ->select(
                                DB::raw("CONCAT(year,'-',month,'-',day,' ',hour) AS day")
                            )
                            ->get()
                            ->toArray();
            $nuevas_citas_pendientes   = array_column($nuevas_citas_pendientes,"day");
            foreach ($nuevas_citas_pendientes as $key2 => $value2) {
                foreach ($models[ $key ]['agenda']['horas_am'] as $key3 => $value3) {


                    if ( strtotime($value2) == strtotime($value3) ) {
                        unset($models[ $key ]['agenda']['horas_am'][$key3]);
                    }
                }
                $models[ $key ]['agenda']['horas_am'] = array_values( $models[ $key ]['agenda']['horas_am'] );//para resetear los indices del array
                foreach ($models[ $key ]['agenda']['horas_pm'] as $key4 => $value4) {

                    if ( strtotime($value2) == strtotime($value4) ) {
                        unset($models[ $key ]['agenda']['horas_pm'][$key4]);
                    }
                }
                $models[ $key ]['agenda']['horas_pm'] = array_values( $models[ $key ]['agenda']['horas_pm'] );//para resetear los indices del array
            }

        }


        return $models;
    } */
    /*     static function deployAgenda($value){
        $centro_salud_id = $value['centro_salud_id'];
        $user_id_medico = $value['user_id_medico'];
        $cat_especialidad_id = $value['cat_especialidad_id'];
        $agenda = json_decode( $value['agenda'] );
        $anio_agendado = $value['agenda_year'];
        $dias_excluidos = $value['fechas_excluidas'];
        $agenda_desde = $value['agenda_desde'];
        $agenda_hasta = date("Y-m-t 23:59:59", strtotime(date("Y-m-d"))); //$value['agenda_hasta'];

        $response = [];
        $response['horas_disponibles'] = [];
        $response['horas_am']=[];
        $response['horas_pm']=[];
        $dias_ocupados = [];
        //CONSULTAMOS LAS FECHAS YA OCUPADAS POR OTRAS CITAS
        $model = UserCita::where("user_id_medico",$user_id_medico)
                //->whereNotIn("cat_user_cita_status_id",[3])
                ->where("year", ">=",date("Y"))
                ->select(
                    DB::raw("
                        STR_TO_DATE(
                            CONCAT(
                                year,'-',
                                month,'-',
                                day,' ',
                                hour
                            ),
                            '%Y-%m-%d %T'
                        ) AS fecha
                    ")
                )
                //->orderBy("fecha","ASC")
                ->get();
        //FORMATEAMOS LAS FECHAS
        if (!empty($model)) {
            $model = $model->toArray();
            foreach ($model as $key => $value) {
                $dias_ocupados[$key] = date("Y-m-d H:i", strtotime($value['fecha']) );
            }
        }

        $fecha_hoy = date("Y-m-d H:i");

        if (
            strtotime( date($agenda_desde)." 00:00:00" ) <= strtotime( date($fecha_hoy) ) &&
            strtotime( date($fecha_hoy)  ) <= strtotime( date($agenda_hasta) )
            ) {
            foreach ($agenda as $key => $mes) {
                if ($mes->mes_numero == date("m",strtotime($fecha_hoy))) {
                    $response['mes_del_anio'][] = $mes->mes_numero;
                    $dias_de_semanas_agendados = UserMedicoAgenda::dias_de_semana_a_filtrar($mes->horario);
                    $dia_inicio = strtotime($fecha_hoy);
                    $dia_fin = strtotime($agenda_hasta);


                    while ($dia_inicio <= $dia_fin ) {
                        $fecha_dia = date("Y-m-d", $dia_inicio );
                        $num_dia_semana = (int) date("w", strtotime( $fecha_dia ) );

                        if (in_array($num_dia_semana,$dias_de_semanas_agendados)) {
                            $horas = UserMedicoAgenda::horas_del_dia_a_filtrar($mes->horario,$num_dia_semana);
                            foreach ($horas as $key => $hora) {
                                $fecha_temp = $fecha_dia." ".$hora;
                                if (!in_array($fecha_temp,$dias_ocupados)) {
                                    $temp = date( "Y-m-d ".$hora);
                                    $hoy = date( "Y-m-d 12:00");
                                    $mediodia = date( "Y-m-d 12:00:00");
                                    $response['dias_del_mes'][] = $fecha_dia;

                                    if (strtotime($mediodia) != strtotime($temp)) {
                                        //validacion para diferenciar horas am de pm
                                        if (strtotime($hoy) > strtotime($temp)) {
                                            $response['horas_am'][] = $fecha_temp;
                                        }else{
                                            $response['horas_pm'][] = $fecha_temp;
                                        }
                                    }
                                }

                            }
                        }
                        $dia_inicio = strtotime(date($fecha_dia)."+1 day") ;
                    }

                }
            }
        }
        return $response;
    } */
    /*  static function deployAgendaRESPALDO($value){
        $centro_salud_id = $value['centro_salud_id'];
        $user_id_medico = $value['user_id_medico'];
        $cat_especialidad_id = $value['cat_especialidad_id'];
        $agenda = json_decode( $value['agenda'] );
        $anio_agendado = $value['agenda_year'];
        $dias_excluidos = $value['fechas_excluidas'];
        $agenda_desde = $value['agenda_desde'];
        $agenda_hasta = $value['agenda_hasta'];

        $response = [];
        $response['horas_am']=[];
        $response['horas_pm']=[];

        foreach ($agenda as $key => $mes) {
            //dd($mes);
            $hoy = date( "Y-m-d 12:00");
            $mes_actual = date("m");
            $dia_actual = date("d");
            $mes_agendado = ($mes->mes_numero);
            $mes_formateado = date ("Y" ."-". $mes_agendado ."-". "d");
            $mes_agendado_num_dias = date( 't', strtotime( date("Y-". $mes_agendado ."-01" ) ) );
            $response['mes_del_anio'][] = $mes_agendado;
            $dias_de_semanas_agendados = UserMedicoAgenda::dias_de_semana_a_filtrar($mes->horario);
            $dias_semana = array_values($dias_de_semanas_agendados);
            $response['dias_semana'] = [];


                foreach ($mes->horario as $key1 => $dia) {
                    $dia_nombre = "";
                    switch ($dia->dia_semana ) {
                        case 1:
                            $dia_nombre = "Lunes";
                        break;
                        case 2:
                            $dia_nombre = "Martes";
                        break;
                        case 3:
                            $dia_nombre = "Miércoles";
                        break;
                        case 4:
                            $dia_nombre = "Jueves";
                        break;
                        case 5:
                            $dia_nombre = "Viernes";
                        break;
                        case 6:
                            $dia_nombre = "Sabado";
                        break;
                        case 7:
                            $dia_nombre = "Domingo";
                        break;

                    }
                    array_push($response['dias_semana'],array(
                        "dia_semana"=>$dia->dia_semana,
                        "dia_nombre"=>$dia_nombre,
                        "hora_inicio"=>date( "g:i A", strtotime( date("Y-m-d ").$dia->horas[0] ) ),
                        "hora_fin"=>date( "g:i A", strtotime( date("Y-m-d ").$dia->horas[ count($dia->horas) -1 ] ) ),
                    ));
                }

                $fechas_excluidas = !is_null($dias_excluidos) ? explode(",",$dias_excluidos) : [];
                for ($dia_del_mes=1; $dia_del_mes <= $mes_agendado_num_dias; $dia_del_mes++) {
                    //$dia_del_mes = date("m", strtotime( date( "Y-".$dia_del_mes."-d") ) );
                    //VALIDACION PARA EMPEZAR A PARTID DEL DIA 16 DE ENERO
                    $fecha_dia = date("Y") ."-".(str_pad($mes_agendado, 2, "0", STR_PAD_LEFT))."-".$dia_del_mes ;
                    if (
                        strtotime( date($fecha_dia)." 23:59:59" )  > strtotime( date($agenda_desde) ) &&
                        strtotime( date($fecha_dia)  ) <= strtotime( date("2023-02-28 23:59:59") )
                        //strtotime( date($fecha_dia)  ) <= strtotime( date($agenda_hasta." 23:59:59") )
                        ) {

                        //dump($fecha_dia);
                        //VALIDACION PARA EXCLUIR DIAS DE LA AGENDA
                        if (!in_array( $fecha_dia , $fechas_excluidas)) {

                            $fecha_dia_del_mes = date( $anio_agendado ."-". $mes_agendado ."-".  $dia_del_mes);

                            $fecha_1 = strtotime($hoy);
                            $fecha_2 = strtotime($fecha_dia_del_mes);

                            if  (
                                $fecha_2 >= $fecha_1
                            )
                            {

                                $num_dia_semana = date("w", strtotime( $fecha_dia_del_mes ) );
                                if ( in_array( $num_dia_semana , $dias_de_semanas_agendados ) ) {

                                    $horas = UserMedicoAgenda::horas_del_dia_a_filtrar($mes->horario,$num_dia_semana);
                                    $residio_horas_ocupadas = [];
                                    foreach ($horas as $hora) {
                                        $hora = date("H:i", strtotime( date( "Y-m-d ".$hora) ) );
                                        $fecha_dia = date( "Y" ."-". str_pad($mes_agendado, 2, "0", STR_PAD_LEFT)  ."-". str_pad($dia_del_mes, 2, "0", STR_PAD_LEFT)  ." ".$hora);
                                        //$fecha_dia = date( "Y" ."-". date("m", strtotime($mes_formateado ) ) ."-".  $dia_del_mes ." ".$hora);
                                        //dump($fecha_dia);
                                        $existe_cita = UserMedicoAgenda::existe_cita([
                                            "user_id_medico" => $user_id_medico,
                                            "centro_salud_id" => $centro_salud_id ,
                                            "cat_especialidad_id" =>$cat_especialidad_id ,
                                            "year" => date("Y",strtotime( $fecha_dia ) ),
                                            "month" => date("m",strtotime( $fecha_dia ) ),
                                            "day" => date("d",strtotime( $fecha_dia ) ),
                                            "hour" => $hora
                                        ]);

                                        if ($existe_cita == 0) {
                                            //saber si es am o pm
                                            $temp = date( "Y-m-d ".$hora);
                                            $mediodia = date( "Y-m-d 12:00:00");
                                            $response['mes_numero'] = $mes_agendado;
                                            $response['mes_nombre'] = $mes->mes_nombre;



                                                //validacion para que no muestre las 12 del medio dia
                                                if (strtotime($mediodia) != strtotime($temp)) {
                                                    //validacion para diferenciar horas am de pm
                                                    if (strtotime($hoy) > strtotime($temp)) {
                                                        $response['horas_am'][] = $fecha_dia;
                                                    }else{
                                                        $response['horas_pm'][] = $fecha_dia;
                                                    }
                                                }
                                        }else{
                                             array_push($residio_horas_ocupadas,$hora);
                                        }
                                    }
                                    if (count($residio_horas_ocupadas) != count($horas) ) {
                                        $response['dias_del_mes'][] = date( "$anio_agendado-$mes_agendado-$dia_del_mes" );
                                    }
                                }

                            }

                        }
                    }
                }

        }
        return $response;
    } */
    /*     static function existe_cita($request)
    {
        return UserCita::where("user_id_medico",$request['user_id_medico'])
        //->whereNotIn("cat_user_cita_status_id",[3])
        ->where("centro_salud_id",$request['centro_salud_id'])
        ->where("cat_especialidad_id",$request['cat_especialidad_id'])
        ->where("year",  $request['year'] )
        ->where("month", $request['month'] )
        ->where("day",   $request['day'] )
        ->where("hour",  $request['hour'] )
        ->count();
    } */
    /*     static function dias_de_semana_a_filtrar($mes)
    {
        $dias_de_semanas_agendados = [];
            foreach ($mes as $semana) {
                $dias_de_semanas_agendados[] = $semana->dia_semana;
            }
            return $dias_de_semanas_agendados;
    } */
    /*     static function horas_del_dia_a_filtrar($mes,$dia_semana)
    {

        foreach ($mes as $semana) {
            if ($semana->dia_semana == $dia_semana) {
                foreach ($semana->horas as $key => $value) {
                    $dato = explode(":",$value);
                    if (!in_array($dato[0],[12])) {
                        $semana->horas[$key] = (str_pad($dato[0], 2, "0", STR_PAD_LEFT)).":".$dato[1];
                    }else{
                        unset($semana->horas[$key]);
                    }
                }
                return $semana->horas;
            }
        }
        return [];
    } */

    /* static function getWeek(Carbon $date)
    {
        $d = Carbon::create($date->year, $date->month, $date->day, 0, 0, 0);
        $dayNum = $d->dayOfWeek ?: 7;
        $d->subDays($dayNum - 4);
        $yearStart = Carbon::createFromDate($d->year, 1, 1);
        return (int) ceil(($d->diffInDays($yearStart) + 1) / 7);
    } */
    /* static function getWeeksInMonth($month)
    {
        $weeks = [];
        $f = Carbon::now();
        $firstDayOfMonth = Carbon::create($f->year, $month, 1, 0, 0, 0);
        $lastDayOfMonth = Carbon::create($f->year, $month, 1, 0, 0, 0)->lastOfMonth();
        $numberOfDays = $lastDayOfMonth->day;

        $firstDayOfWeek = $firstDayOfMonth->day - $firstDayOfMonth->dayOfWeek;
        $lastDayOfWeek = $firstDayOfWeek + 6;

        while ($lastDayOfWeek < $numberOfDays) {
            $weeks[] = UserMedicoAgenda::getWeek(Carbon::create($f->year, $month, $lastDayOfWeek, 0, 0, 0));
            $firstDayOfWeek += 7;
            $lastDayOfWeek += 7;
        }

        if ($lastDayOfWeek > 31) {
            $lastDayOfWeek = 31;
        }

        $weeks[] = UserMedicoAgenda::getWeek(Carbon::create($f->year, $month, $lastDayOfWeek, 0, 0, 0));

        return $weeks;
    } */
    /* static function configMesObject($miAgenda,$agenda_year)
    {
        $turno = "Mañana";
        $dias_nombres =[
            "Domingo",
            "Lunes",
            "Martes",
            "Miércoles",
            "Jueves",
            "Viernes",
            "Sábado",
        ];
        $meses = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];
        $mesObject;
        $semanas;
        $formAgendaCreate = [
            'resultset' => [],
            //'agenda_year' => $miAgenda['agenda_year'],
            'agenda_month' => $miAgenda['agenda_month'],
        ];
        //return $formAgendaCreate;
        foreach ($meses as $mes_number => $mes) {
            // Si el mes no está excluido, incluirlo en los disponibles
            if (!in_array($mes, $miAgenda['meses_excluidos'])) {
                $mesObject = [
                    'number' => $mes_number,
                    'name' => $mes,
                    'weeks' => [],
                ];

                // Calculamos el total de semanas que vamos a agregar al mes
                $semanas = UserMedicoAgenda::getWeeksInMonth($mes_number);
                //dump( $miAgenda );

                // Por cada semana agregamos los días
                foreach ($semanas as $semana_key => $semana) {
                    $semanas_excluidas = (array) $miAgenda['semanas_excluidas'];

                    // Verificamos que la semana no esté excluida del mes.
                    if (!in_array($semana_key + 1, $semanas_excluidas[$mes])) {
                        $dias_semana = [];

                        foreach ($dias_nombres as $dia_number => $dia) {
                            // Verificamos que el día no esté excluido de la semana
                            if (!in_array($dia, $miAgenda['dias_excluidos'])) {
                                // Creamos las horas que tendrá el día
                                $agenda_horas = (array) $miAgenda['agenda_horas'];
                                $agenda_horas = (array) $agenda_horas[$dia_number];
                                $agenda_horas = (array) $agenda_horas[$turno];
                                //$agenda_horas = $agenda_horas[$dia_number][$turno];

                                $total_pacientes_por_horas = $agenda_horas['total_pacientes_por_horas'];
                                $visibilidad = $agenda_horas['visibilidad'];
                                $horas = $agenda_horas['horas'];

                                // Agregamos el día
                                $dias_semana[] = [
                                    'day' => $dia,
                                    'day_value' => $dia_number,
                                    'total_pacientes_por_horas' => $total_pacientes_por_horas,
                                    'hours' => $horas,
                                ];
                            }
                        }

                        // Agregamos los días que tendrá la semana
                        $mesObject['weeks'][$semana] = $dias_semana;


                    }
                    $formAgendaCreate['agenda_month'][] = $mesObject;
                }
            }
        }
        foreach ($formAgendaCreate['agenda_month'] as $mes) {
            $year = $agenda_year;
            $mes = (array) $mes;

            foreach ((array) $mes['weeks'] as $weekNumber => $week) {

                foreach ((array) $week as $keyWeek => $weekData) {
                    $weekData = (array) $weekData;

                    $day_value = $weekData['day_value'];
                    $hours = (array) $weekData['hours'];

                    foreach ($hours as $key_hours => $hour) {
                        $hour = (array) $hour;
                        //dump($hour);
                        $result = UserMedicoAgenda::getDatesOfWeekWithHours($weekNumber, $year, $day_value, $hour);
                        $formAgendaCreate['resultset'][] = $result;
                    }
                }
            }
        }
        // Resultado final
        //dump($formAgendaCreate['resultset']);
        return $formAgendaCreate['resultset'];

    } */
    /* static function getDatesOfWeekWithHours($weekNumber, $year, $dayOfWeek, $hour) {
        // Obtenemos la fecha del primer día del año
        $firstDayOfYear = Carbon::create($year, 1, 1);
        // Calculamos el número de días hasta el primer día de la semana actual
        $pastDaysOfYear = ($weekNumber - 1) * 7;
        // Añadimos los días al primer día del año para obtener el primer día de la semana especificada
        $firstDayOfWeek = $firstDayOfYear->copy()->addDays($pastDaysOfYear);

        // Calculamos el número de días hasta el día de la semana especificado
        $pastDaysOfWeek = ($dayOfWeek - $firstDayOfWeek->dayOfWeek + 7) % 7;
        // Obtenemos la fecha del día de la semana especificado sumando los días al primer día de la semana
        $dateOfWeek = $firstDayOfWeek->copy()->addDays($pastDaysOfWeek);

        // Separamos la hora y los minutos
        [$hourStr, $minuteStr] = explode(':', $hour['hora']);
        // Convertimos las horas y minutos a números
        $hourNum = (int)$hourStr;
        $minuteNum = (int)$minuteStr;
        // Creamos una fecha con la fecha y hora especificadas
        $dateWithHour = Carbon::create($dateOfWeek->year, $dateOfWeek->month, $dateOfWeek->day, $hourNum, $minuteNum);

        // Devolvemos el array con la fecha y la visibilidad
        return ["day" => $dateWithHour->toDateTimeString(), "visibilidad" => $hour['visibilidad']];
    } */
    /* static function horas_con_fecha($semana, $horas, $dia_semana) {
        // Obtener la fecha del primer día de la semana especificada
        $fecha = Carbon::now()->setISODate(Carbon::now()->year, $semana, $dia_semana);

        //dump($horas);
        // Crear un arreglo vacío para almacenar las horas con fecha
        $horas_con_fecha = array();
        dd($horas);
        // Iterar sobre el arreglo de horas y agregar la fecha correspondiente a cada hora
        foreach ($horas as $dia) {

            $dia = (array) $dia;
            $horas_con_fecha[$dia_semana] = [];
            foreach ($dia as $hora) {
                $hora = (array) $hora;
                $fecha_hora = $fecha->format('Y-m-d')." ".$hora['hora'];

                $horas_con_fecha[$dia_semana][]= ["fecha"=>$fecha_hora,"visibilidad"=>$hora['visibilidad']];
            }
        }
        dd($horas_con_fecha);
        return $horas_con_fecha;
    } */

    /* static function fecha_dia_en_semana($semana, $dia_semana) {
        // Obtener la fecha correspondiente al primer día de la semana especificada
        $fecha = Carbon::now()->setISODate(Carbon::now()->year, $semana, $dia_semana);

        // Convertir la fecha a timestamp y devolverla
        return $fecha->timestamp;
    } */
}
