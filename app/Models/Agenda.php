<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Agenda extends Model
{
    protected $table = 'agenda';
    protected $fillable = ['agenda',"user_id_medico","cat_especialidad_id", 'agenda_year', 'created_at', 'updated_at'];
    static function getAll()
    {

        $agendas= Agenda::where("active",1)
                ->select(
                    "agenda",
                    "agenda_year",
                    "user_id_medico",
                    "cat_especialidad_id",
                    DB::raw("id AS agenda_id")
                )
                ->get();
        $models = $agendas->toArray();

        foreach ($models as $key => $value) {
            $agenda = json_decode( $value['agenda'] );

            $models[ $key ]['agenda'] = Agenda::deployAgenda( $agenda ,$value['agenda_year'] );

        }

        return $models;
    }
    static function deployAgenda($agenda,$anio_agendado){
        $response = [];

        foreach ($agenda as $key => $mes) {
            $hoy = date( "Y-m-d 12:00");
            $mes_actual = date("m");
            $dia_actual = date("d");
            $mes_agendado = ($mes->mes_numero +1);
            $mes_formateado = date ("Y" ."-". $mes_agendado ."-". "d");
            $mes_agendado_num_dias = date( 't', strtotime( date("Y-". $mes_agendado ."-01" ) ) );
            $response['mes_del_anio'][] = $mes_agendado;
            $dias_de_semanas_agendados = Agenda::dias_de_semana_a_filtrar($mes->horario);

            for ($dia_del_mes=1; $dia_del_mes <= $mes_agendado_num_dias; $dia_del_mes++) {

                $fecha_dia_del_mes = date( $anio_agendado ."-". $mes_agendado ."-".  $dia_del_mes);

                $fecha_1 = strtotime($hoy);
                $fecha_2 = strtotime($fecha_dia_del_mes);

                if  (
                    $fecha_2 >= $fecha_1
                )
                {

                    $num_dia_semana = date("w", strtotime( $fecha_dia_del_mes ) );
                    if ( in_array( $num_dia_semana , $dias_de_semanas_agendados ) ) {
                        $response['dias_del_mes'][] = $dia_del_mes;
                        $horas = Agenda::horas_del_dia_a_filtrar($mes->horario,$num_dia_semana);
                        foreach ($horas as $hora) {
                            $fecha_dia = date( "Y" ."-". date("m", strtotime($mes_formateado ) ) ."-".  $dia_del_mes ." ".$hora);

                            //saber si es am o pm
                            $temp = date( "Y-m-d ".$hora);
                            $response['mes_numero'] = $mes_agendado;
                            $response['mes_nombre'] = $mes->mes_nombre;
                            if (strtotime($hoy) > strtotime($temp)) {
                                $response['horas_am'][] = $fecha_dia;
                            }else{
                                $response['horas_pm'][] = $fecha_dia;
                            }
                        }
                    }
                }
            }
        }
        return $response;
    }
    static function dias_de_semana_a_filtrar($mes)
    {
        $dias_de_semanas_agendados = [];
            foreach ($mes as $semana) {
                $dias_de_semanas_agendados[] = $semana->dia_semana;
            }
            return $dias_de_semanas_agendados;
    }
    static function horas_del_dia_a_filtrar($mes,$dia_semana)
    {

        foreach ($mes as $semana) {
            if ($semana->dia_semana == $dia_semana) {
                return $semana->horas;
            }
        }
        return [];
    }
    static function store(){
        $json =[
                //mes
                [
                    "mes_numero"=>2,
                    "mes_nombre"=>"marzo",
                    "horario"=>[
                            [
                                "dia_semana"=>3,
                                "dia_nombre"=>"miercoles",
                                "horas"=>  ['8:00','9:00','10:00','11:00','12:00','13:00','14:00'],
                            ],
                            [
                                "dia_semana"=>4,
                                "dia_nombre"=>"jueves",
                                "horas"=>  ['12:00','13:00','14:00'],
                            ],
                        ],
                ],
                [
                    "mes_numero"=>3,
                    "mes_nombre"=>"abril",
                    "horario"=>[
                            [
                                "dia_semana"=>3,
                                "dia_nombre"=>"miercoles",
                                "horas"=>  ['8:00','9:00','10:00','11:00','12:00','13:00','14:00'],
                            ],

                        ],
                ],
            ];
            dd( json_encode($json ) );
    }
}
