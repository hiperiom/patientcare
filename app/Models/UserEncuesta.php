<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEncuesta extends Model
{
    protected $table = "user_encuesta";
    protected $fillable = [
        "id",
        "user_cuest_episodio_id",
        "cat_encuesta_id",
        "nombres",
        "apellidos",
        "cedula",
        "email",
        "user_id",
        "user_id_medico",
        "coment",
        "active",
        "created_at",
    ];
    static function store(Request $request){

        $user_id = null;
        $user_cuest_episodio_id = null;

        //dd($request->all());

        try {
            if (
                isset($request->cedula) &&
                !is_null($request->cedula)
            ) {
                $user_id =UserProfile::where("cedula",$request->cedula)->value("user_id");
            }

            if (
                is_null($user_id)
            ) {
                if (
                    isset($request->email) &&
                    !is_null($request->email)
                ) {
                    $user_id =User::where("email",$request->email)->value("id");
                }
            }
            if (
                is_null($user_id)
            ) {
                if (
                    isset($request->nacionalidad) &&
                    !is_null($request->nacionalidad) &&
                    isset($request->email) &&
                    !is_null($request->email)
                ) {
                    $user_id =User::where("email",$request->nacionalidad.$request->cedula)->value("id");
                }
            }
            $total_contestadas = 0;

            foreach (json_decode($request->user_encuesta_pregunta) as $key => $value) {
                if($value->cat_encuesta_preg_value > 0){
                    $total_contestadas++;
                }
            }
            //if ($total_contestadas > 0) {

                $user_encuesta_id = null;
                $model = new UserEncuesta();
                $model->user_id  =$user_id;
                $model->nombres  =empty($request->nombres) ? null:$request->nombres;
                $model->apellidos  =empty($request->apellidos) ? null:$request->apellidos;
                $model->email  =empty($request->email) ? null:$request->email;
                $model->cedula  =empty($request->cedula) ? null:$request->nacionalidad.$request->cedula;
                $model->user_cuest_episodio_id  = null;
                $model->cat_encuesta_id = $request->cat_encuesta_id;
                $model->coment = empty($request->coment) ? null:$request->coment;
                $model->user_id_medico  = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

                $request->merge(["user_id"=>$user_id]);
                $request->merge(["user_encuesta_id"=>$model->id]);

                $encuesta_pregunta = UserEncuestaPregunta::store($request);
            /*}else{
                return Response()->json(200) ;
            }*/

        } catch (\Throwable $th) {
            dd($th);
        }


        if (!is_null($encuesta_pregunta)) {
            return Response()->json(200) ;
        }





    }
    static function getAll(Request $request)
    {
        $encuesta_id = $request->user_encuesta_id;

        $enviadas = DB::table('cat_encuesta')->where("id",$encuesta_id)->first();

        $total_encuestas =  DB::table('user_encuesta')
                            ->where("user_encuesta.cat_encuesta_id",$encuesta_id)
                            ->whereBetween('user_encuesta.created_at', [$request->date_start." 00:00:00", $request->date_end." 23:59:59"])
                            ->count();
        $comentarios_generales =  DB::table('user_encuesta')
                            ->where("user_encuesta.cat_encuesta_id",$encuesta_id)
                            ->whereBetween('user_encuesta.created_at', [$request->date_start." 00:00:00", $request->date_end." 23:59:59"])
                            ->orderBy('user_encuesta.id',"DESC")
                            ->get();
        $MODEL =    DB::table('user_encuesta')
                    ->where("user_encuesta.cat_encuesta_id",$encuesta_id)
                    ->whereBetween('user_encuesta.created_at', [$request->date_start." 00:00:00", $request->date_end." 23:59:59"])
                    ->join("user_encuesta_pregunta","user_encuesta.id","user_encuesta_pregunta.user_encuesta_id")
                    ->get()->toArray();
        $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $response = [];

        if (!empty($comentarios_generales)) {
            foreach ($comentarios_generales as $key => $value) {
                if (!is_null($value->coment)) {
                    $response['comentarios_globabes'][] = $value;
                }
            }
        }

        $grupoRespuesta=[

            5=>[
                5=>['puntos'=>5,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'5 Estrellas'],
                1=>['puntos'=>1,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'1 Estrellas'],
            ],
            6=>[
                5=>['puntos'=>5,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'5 Estrellas'],
                4=>['puntos'=>4,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'4 Estrellas'],
                3=>['puntos'=>3,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'3 Estrellas'],
                2=>['puntos'=>2,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'2 Estrellas'],
                1=>['puntos'=>1,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'1 Estrellas'],
            ],
            7=>[
                4=>['puntos'=>4,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'4 Estrellas'],
                3=>['puntos'=>3,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'3 Estrellas'],
                2=>['puntos'=>2,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'2 Estrellas'],
                1=>['puntos'=>1,'total_encontrado'=>0,'porcentaje_del_global'=>0,'color'=>"gray",'description'=>'1 Estrellas'],
            ],
        ];
        $i = 1;
        $preguntas = [
            ["grupo"=>1, "pregunta"=>"¿Cómo evalúas la calidad de nuestro proceso de admisión o ingreso?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>2, "pregunta"=>"¿Las enfermeras te trataban con cortesía y te escuchaban con atención?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>2, "pregunta"=>"¿Las enfermeras te explicaban las cosas de una manera que pudieras entender?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>2, "pregunta"=>"Después de usar el botón para llamar a la enfermera, ¿te atendían tan pronto como querías?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>3, "pregunta"=>"¿Los médicos residentes te trataban con cortesía y te escuchaban con atención?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>3, "pregunta"=>"¿Los médicos residentes te explicaban las cosas de una manera que pudieras entender?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>"¿Los médicos especialistas te trataban con cortesía y te escuchaban con atención?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>"¿Los médicos especialistas te explicaban las cosas de una manera que pudieras entender?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>5, "pregunta"=>"¿Mantenían tu cuarto y tu baño limpios?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>5, "pregunta"=>"¿Estaba silenciosa el área alrededor de tu habitación por la noche?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>"¿Cómo evalúas las habitaciones en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            //["grupo"=>6, "pregunta"=>"¿Cómo evalúas la calidad de conexión a internet en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>"¿Cómo evalúas la sala de espera en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>"¿Cómo evalúas las áreas públicas en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>"¿Cómo evalúas los sanitarios en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>"¿Cómo evalúas la limpieza en nuestras instalaciones?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>$i++],


            ["grupo"=>7, "pregunta"=>"Las enfermeras u otro personal ¿Te ayudaron a ir al baño, o a usar un dispositivo de apoyo para aseo personal en la cama, tan pronto como querías?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>7, "pregunta"=>"Si tuviste algún dolor: ¿Consideras fue tratado a tiempo?","grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+2)],

            ["grupo"=>8, "pregunta"=>"¿Cómo evalúas la calidad del alimento suministrado?","grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>9, "pregunta"=>'¿Te dieron información por escrito o verbal, sobre los síntomas o problemas de salud a los que debías poner atención cuando salieras del hospital?',"grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>9, "pregunta"=>'Indica que tan de acuerdo estás con la siguiente afirmación: "Cuando salí del hospital, entendía claramente la razón por la que tomaba cada una de mis medicinas y entendí perfectamente el tratamiento indicado".',"grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de protocolo?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de camareras?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de lenceras?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de admisión?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de enfermeras?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de médicos residentes?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de camilleros?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de nutrición?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>10,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar a nuestro personal de médicos especialistas?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>11,"pregunta"=>'En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar este hospital?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>11,"pregunta"=>'¿Recomendarías este hospital a tus amigos y familiares?',"grupo_respuesta"=>7,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
            ["grupo"=>12,"pregunta"=>'¿Cómo evalúas la calidad de nuestro proceso de salida o egreso?',"grupo_respuesta"=>6,"cat_encuesta_id"=>1,"pregunta_id"=>($i=$i+1)],
        ];
        $i = 1;
        $preguntas += [
            ["grupo"=>1, "pregunta"=>'¿Te fúe facil contactar al especialista deseado y pautar tu cita?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>2, "pregunta"=>'En una escala del 1 al 5 siendo 1 el peor, y 5 el mejor, ¿Cómo evaluas el ambiente de espera?',"grupo_respuesta"=>6,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>3, "pregunta"=>'¿Te atendieron con puntualidad a la hora prevista?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>'¿El especialista escuchó atentamente tu problema de salud?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>'¿El especialista te explicó en un lenguaje sencillo y entendible tu condición de salud?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>'¿Entendiste el plan propuesto por el especialista para mejorar tu condición de salud?"',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>'¿Sientes confianza y estás de acuerdo con el plan propuesto por el especialista?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>5, "pregunta"=>'En una escala del 1 al 5 siendo 1 el peor, y 5 el mejor, ¿Cómo calificarias el proceso de la consulta?',"grupo_respuesta"=>6,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
            ["grupo"=>6, "pregunta"=>'¿Calificarías al CMDLT para consultas externas a familiares y amigos?',"grupo_respuesta"=>7,"cat_encuesta_id"=>2,"pregunta_id"=>$i++],
        ];
        $i = 1;
        $preguntas += [
            ["grupo"=>1, "pregunta"=>"¿Le fue posible contactar a la Emergencia, antes de venir?","grupo_respuesta"=>7,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>1, "pregunta"=>"¿Fue recibido con cordialidad y atendido como usted esperaba?","grupo_respuesta"=>7,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>1, "pregunta"=>"En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Atención al Paciente?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>1, "pregunta"=>"En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Recepción?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>1, "pregunta"=>"En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Admisión?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>2, "pregunta"=>"¿Cómo evalúas la calidad, en la atención y amabilidad, del Médico que te atendió en el cubículo de triaje?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>3, "pregunta"=>"En el área de Observación, ¿el médico te explicó el plan con respecto a tu condición de salud?","grupo_respuesta"=>7,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>4, "pregunta"=>"¿Cómo evalúas la calidad, en la atención y amabilidad, del personal de enfermería que te atendió en el cubículo de triaje?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>5, "pregunta"=>"En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar al personal de Enfermería en el área de Observación?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>6,"pregunta"=>"De haber sido atendido por alguno de nuestros especialistas en el área de Emergencia: en una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificarlo?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>6,"pregunta"=>"¿Quedaste satisfecho con la atención de nuestro médico especialista?","grupo_respuesta"=>7,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>7,"pregunta"=>"En una escala del 1 al 5, siendo 1 el peor, y 5 el mejor, ¿qué número usarías para calificar el servicio de Emergencia?","grupo_respuesta"=>6,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],
            ["grupo"=>7,"pregunta"=>"¿Recomendarías este hospital a tus amigos y familiares?","grupo_respuesta"=>7,"cat_encuesta_id"=>3,"pregunta_id"=>$i++],

        ];

        $preguntas = array_filter($preguntas,function( $e) use ($encuesta_id) { return $e['cat_encuesta_id'] == $encuesta_id;});

        foreach ($preguntas as $key => $value) {
            $preguntas[$key]["comentarios"] = [];
            $preguntas[$key]["total_respuestas_encontrada"] = 0;
            $preguntas[$key]["total_estrellas_encontrada"] = 0;
            $preguntas[$key]["grupo_respuesta"] = $grupoRespuesta[$value['grupo_respuesta']];
        }

        $grupo = [];
        $cantidadDeGrupos = count(array_unique(array_column($preguntas,"grupo")));
        for ($i=1; $i <=$cantidadDeGrupos; $i++) {
            $grupo[$i] = [];
        }


        $nameGroup = [];
        foreach ($grupo as $key => $value) {
            $grupo_id = $key;
            $grupo[$grupo_id] = [
                "grupo_id"=>$grupo_id,
                "maximo_estrellas_grupo"=>0,
                "total_respuestas_encontradas"=>0,
                "total_estrellas_encontradas"=>0,
                "porcentaje_global_grupo"=>0,
                "global_color"=> "primary",
                "preguntas"=>   array_filter( $preguntas, function( $e ) use ($grupo_id) {
                                    return $e['grupo'] == $grupo_id;
                                }),
            ];
        }
        //dd($grupo);
        if (count($MODEL) > 0) {
            foreach ($grupo as $key1 => $attr) {
                //extract convierte cada propiedad deltro del array en una variable.
                extract($attr);

                //Obtenemos los id de las pregguntas
                $grupo_preguntas = array_column($preguntas, 'pregunta_id');

                //buscamos id obtenidos en el modelo de bd
                $respuestas_encontradas = array_filter( $MODEL, function( $e ) use ($grupo_preguntas) {
                    return in_array($e->cat_encuesta_preg_id , $grupo_preguntas);
                });
                if (count($respuestas_encontradas) > 0) {

                    //guardamos numero global total de respuestas encontradas
                    $grupo[$key1]['total_respuestas_encontradas'] = count($respuestas_encontradas);

                    //guardamos maximo de estrellas por grupo
                    foreach ($grupo[$key1]['preguntas'] as $key3 => $value) {
                        $grupo[$key1]['maximo_estrellas_grupo'] += count($value['grupo_respuesta']);
                    }

                    //guardamos el total de respuestas encontradas
                    $grupo[$key1]['total_estrellas_encontradas'] = array_sum(array_column($respuestas_encontradas, 'cat_encuesta_preg_value'));

                    //CALCULO PORCENTAJE GLOBAL
                    //FORMULA:
	                //x = (total_estrellas_encontradas * 100) / (total_respuestas_encontradas * maximo_estrellas_grupo)
                    //OPERACION
                    $x = (int) round( (($grupo[$key1]['total_estrellas_encontradas'] * 100) / ($grupo[$key1]['total_respuestas_encontradas'] * $grupo[$key1]['maximo_estrellas_grupo']) * count($grupo_preguntas)),0);
                    $grupo[$key1]['porcentaje_global_grupo'] = $x;

                    //guardamos el color dependiendo del porcentaje
                    if ($x >= 80) {
                        $grupo[$key1]['global_color'] = "success";
                    }
                    if ($x >= 50 && $x <= 79.99) {
                        $grupo[$key1]['global_color'] = "warning";
                    }
                    if ($x <= 49.99) {
                        $grupo[$key1]['global_color'] = "danger";
                    }

                    foreach ($grupo[$key1]['preguntas'] as $clave => $p) {
                        $pregunta_id = $p['pregunta_id'];
                        $respuestas_pregunta=  array_filter( $respuestas_encontradas, function( $e ) use ($pregunta_id) {
                            return $e->cat_encuesta_preg_id == $pregunta_id;
                        });
                        $grupo[$key1]['preguntas'][$clave]['total_respuestas_encontrada'] = count(array_column($respuestas_pregunta,"cat_encuesta_preg_value"));
                        $grupo[$key1]['preguntas'][$clave]['total_estrellas_encontrada'] = array_sum(array_column($respuestas_pregunta,"cat_encuesta_preg_value"));

                        foreach ($respuestas_pregunta as $key => $value) {
                            if (!is_null($value->coment)) {
                                $fechaComoEntero = strtotime($value->created_at);
                                $anio = date("Y", $fechaComoEntero);
                                $mesnuevo = strtoupper(substr($mes[ (int) (date("m", $fechaComoEntero)-1) ],0,3));
                                $dia= date("d", $fechaComoEntero);
                                array_push($grupo[$key1]['preguntas'][$clave]['comentarios'],["id"=>$value->id,"coment"=>$value->coment,"date"=>$dia." ".$mesnuevo." ".$anio]);
                            }
                        }


                        //$grupo[$key1]['preguntas'][$clave]['comentarios'] = array_filter(array_column($respuestas_pregunta,"coment"),function ($e){return !is_null($e);});


                        foreach ($grupo[$key1]['preguntas'][$clave]['grupo_respuesta'] as $r) {
                            $puntos = $r['puntos'];
                            $total_r = count(array_filter(array_column($respuestas_pregunta,"cat_encuesta_preg_value"),function ($e) use ($puntos){return $e==$puntos;}));

                            $grupo[$key1]['preguntas'][$clave]['grupo_respuesta'][$puntos]['total_encontrado'] = $total_r;

                            if (!empty( $total_r)) {
                                $x = round(($total_r * 100) / $grupo[$key1]['preguntas'][$clave]['total_respuestas_encontrada'],2);
                                $grupo[$key1]['preguntas'][$clave]['grupo_respuesta'][$puntos]['porcentaje_del_global'] = $x;

                                if ($x >= 80) {
                                    $grupo[$key1]['preguntas'][$clave]['grupo_respuesta'][$puntos]['color'] = "success";
                                }
                                if ($x >= 50 && $x <= 79.99) {
                                    $grupo[$key1]['preguntas'][$clave]['grupo_respuesta'][$puntos]['color'] = "warning";
                                }
                                if ($x <= 49.99) {
                                    $grupo[$key1]['preguntas'][$clave]['grupo_respuesta'][$puntos]['color'] = "danger";
                                }
                            }

                        }


                    }

                }
            }
        }
        $response["enviadas"] = $enviadas;
        $response["test_header"]["test_total"] = $total_encuestas;

        $response['test_section'] = $grupo;

        return $response;
    }


        //dd($response);
       // return $response;
        /*
        TRUNCATE `user_encuesta`;
        TRUNCATE `user_encuesta_pregunta`;

         */
    //}
}
