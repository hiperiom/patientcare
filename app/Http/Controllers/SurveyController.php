<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Section;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Discharged;
use App\Models\UserCuestEpisodio;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class SurveyController extends Controller
{
    public function index(Request $request){
        return view('paciente.encuestas.index');
    }

    public function getSurveys(Request $request){
        if($request->dateEnd == null || $request->dateInit == null){
            $dateEnd = Carbon::now();
            $dateInit = Carbon::parse('2023-01-01 00:00:00'); // fecha inicial
        }else{
            $dateEnd = Carbon::parse($request->dateEnd.' 23:59:59');
            $dateInit = Carbon::parse($request->dateInit.' 00:00:00');;
        }
        $surveys = Survey::orderBy('order')->get();

        foreach($surveys as $survey){
            $totalSurvey = 0;
            $totalSurveySent = 0;
            $totalSurveyViewed = 0;
            $totalSurveyAnswered = 0;
            $survey->totalTimeToAnswered = 0;
            $surveysDischargeds = $survey->dischargeds()->whereBetween('discharged_survey.created_at', [$dateInit, $dateEnd])->get();
            // foreach($surveysDischargeds as $surveyDischarged){
            //     $totalSurvey++;
            //     if($surveyDischarged->pivot->dateInit != null){
            //         $totalSurveyViewed++;
            //         if($surveyDischarged->pivot->dateSent != null){
            //             $totalSurveySent++;
            //             $survey->totalTimeToSent += Carbon::parse($surveyDischarged->pivot->dateInit)->floatDiffInMinutes($surveyDischarged->pivot->dateSent);
            //         }
            //     }
            // }
            foreach($surveysDischargeds as $surveyDischarged){
                $totalSurvey++;
                switch ($surveyDischarged->pivot->status) {
                    case 1:
                        $totalSurveySent++;
                        break;
                    case 2:
                        $totalSurveySent++;
                        $totalSurveyViewed++;
                        break;
                    case 3:
                        $totalSurveySent++;
                        $totalSurveyViewed++;
                        $totalSurveyAnswered++;
                        $survey->totalTimeToAnswered += Carbon::parse($surveyDischarged->pivot->dateInit)->floatDiffInMinutes($surveyDischarged->pivot->dateSent);
                        break;
                }
            }
            $survey->totalSurvey = $totalSurvey;
            $survey->totalSurveySent = $totalSurveySent;
            $survey->totalSurveyViewed = $totalSurveyViewed;
            $survey->totalSurveyAnswered = $totalSurveyAnswered;
        }

        return response()->json([
            'surveys' => $surveys,
        ],200);
    }

    public function getSurvey(Request $request){
        $token = $request->token;
        $discharged = Discharged::where('token', $request->token)->firstOrFail();
        // return 'Status: '.$discharged->surveys[0]->pivot->status.', Fecha Inicial: '.$discharged->surveys[0]->pivot->dateInit.', Fecha Final: '.$discharged->surveys[0]->pivot->dateSent;
        if($discharged->surveys[0]->pivot->status < 3){
            $discharged->surveys()->syncWithoutDetaching([$request->survey_id => ['status' => 2, 'dateInit' => now()]]);
        }
        $res = Survey::find($request->survey_id);
        $sections = Section::where('survey_id', $request->survey_id)->orderBy('order', 'ASC')->get();
        $res->sections = $sections;
        foreach($sections as $section){
            $questions = Question::where('section_id',$section->id)->orderBy('order', 'ASC')->get();
            $section->questions = $questions;
            foreach($questions as $question){
                // $answers = Answer::where('question_id', $question->id)->orderBy('value', 'ASC')->get();
                $answers = Answer::where('question_id', $question->id)->orderBy('orden', 'ASC')->orderBy('value', 'ASC')->get();
                $question->comment = false;
                $question->answers = $answers;
                foreach($answers as $answer){
                    if($answer->comment){
                        $question->comment = true;
                    }
                }
            }
        }
        $survey = $res;
        $platform = $request->platform;
        // $userIsLogged = Auth::check();
        $userIsLogged = is_null(Auth()->user()) ? false : true;
        // dd(Auth::check());
        return view('paciente.encuestas.encuesta', compact('survey','discharged','platform','userIsLogged'));
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }

    public function getStatistics(Request $request){
        $survey = Survey::find($request->survey_id);
        $date_start = $request->date_start;
        $date_end = $request->date_end;
        return view('paciente.encuestas.estadisticas', compact('survey', 'date_start', 'date_end'));
    }

    // public function getStatisticsAjax(Request $request){ // survey_id, dateEnd, dateInit
    //     if($request->dateEnd == null || $request->dateInit == null){
    //         $dateEnd = Carbon::now();
    //         $dateInit = Carbon::parse('2023-01-01 23:59:59'); // fecha inicial
    //     }else{
    //         $dateEnd = Carbon::parse($request->dateEnd.' 23:59:59');
    //         $dateInit = Carbon::parse($request->dateInit.' 23:59:59');;
    //     }
    //     $res = Survey::find($request->survey_id);
    //     $commentsSurvey = []; // comentarios adicionales a las encuestas
    //     $totalSurveys = 0; // total de encuestas que fueron enviadas
    //     $totalSurveysSent = 0; // total de encuestas que fueron respondidas
    //     $dischargeds = $res->dischargeds()->whereBetween('dateInit', [$dateInit, $dateEnd])->get();
    //     //variables que llevaran la máxima puntuación y la puntuación de la encuesta
    //     $maxPuntuacionGlobal = 0;
    //     $puntuacionGlobal = 0;
    //     if(count($dischargeds) != 0){

    //         foreach ( $dischargeds as $discharged){
    //             $totalSurveys++;
    //             if($discharged->pivot->dateSent != null){
    //                 $totalSurveysSent++;
    //             }
    //             if($discharged->pivot->comment != null){
    //                 $commentsSurvey[] = ['comment'=> $discharged->pivot->comment, 'dateSent' => $discharged->pivot->dateSent];
    //             }
    //         }
    //         //ordenamos el arreclo de comentarios por fechas descendientes
    //         usort($commentsSurvey, function ($a, $b) {
    //             return strcmp($b["dateSent"],$a["dateSent"]);
    //         });

    //         $sections = Section::where('survey_id', $request->survey_id)->orderBy('order', 'ASC')->get();
    //         $res->sections = $sections;
    //         foreach($res->sections as $section){
    //             $section->maxPuntuacion = 0;
    //             $section->puntuacion = 0;
    //             $questions = Question::where('section_id',$section->id)->orderBy('order', 'ASC')->get();
    //             $section->questions = $questions;
    //             foreach($section->questions as $question){
    //                 $question->comments = collect();
    //                 $answers = Answer::where('question_id', $question->id)->orderBy('orden', 'ASC')->orderBy('value', 'ASC')->get();
    //                 $question->answers = $answers;
    //                 $question->totalResponses = count($question->answers);
    //                 $question->responses = count($question->answersMN);
    //                 $question->responses1 = 0;
    //                 $question->responses2 = 0;
    //                 $question->responses3 = 0;
    //                 $question->responses4 = 0;
    //                 $question->responses5 = 0;
    //                 foreach($question->answers as $answer){
    //                     $answers_question = $question->answersMN()->where('answer_id', $answer->id)->whereBetween('answer_discharged_question.created_at', [$dateInit, $dateEnd])->get();
    //                     foreach($answers_question as $answerMN){
    //                         if($answerMN->pivot->comment != null && $answerMN->pivot->comment != ""){
    //                             $question->comments->push(['comment' => $answerMN->pivot->comment, 'date' => $answerMN->pivot->updated_at]);
    //                             $question->comments->sortByDesc('date');
    //                         }
    //                         if( $question->totalResponses > 1){
    //                             $section->maxPuntuacion = $section->maxPuntuacion + $question->totalResponses;
    //                             $section->puntuacion += $answerMN->value;
    //                             switch ($answerMN->value) {
    //                                 case 1:
    //                                     $question->responses1++;
    //                                     break;
    //                                 case 2:
    //                                     $question->responses2++;
    //                                     break;
    //                                 case 3:
    //                                     $question->responses3++;
    //                                     break;
    //                                 case 4:
    //                                     $question->responses4++;
    //                                     break;
    //                                 case 5:
    //                                     $question->responses5++;
    //                                     break;
    //                             }
    //                         }

    //                     }
    //                 }
    //             }
    //             $maxPuntuacionGlobal = $maxPuntuacionGlobal + $section->maxPuntuacion;
    //             $puntuacionGlobal = $puntuacionGlobal + $section->puntuacion;
    //         }
    //     }
    //     $survey = $res;
    //     return response()->json([
    //         'survey' => $survey,
    //         'totalSurveys' => $totalSurveys,
    //         'totalSurveysSent' => $totalSurveysSent,
    //         'commentsSurvey' => $commentsSurvey,
    //         'maxPuntuacionGlobal' => $maxPuntuacionGlobal,
    //         'puntuacionGlobal' => $puntuacionGlobal
    //     ]);

    // }

// FUNCIONAL 04062024
    public function getStatisticsAjax(Request $request){ // survey_id, dateEnd, dateInit

        if($request->dateEnd == null || $request->dateInit == null){
            $dateEnd = Carbon::now();
            $dateInit = Carbon::parse('2024-01-01 00:00:00'); // fecha inicial
        }else{
            $dateEnd = Carbon::parse($request->dateEnd.' 23:59:59');
            $dateInit = Carbon::parse($request->dateInit.' 00:00:00');;
        }

        $survey = Survey::where('id',$request->survey_id)->with([
                'dischargeds' => function($query) use ($dateInit,$dateEnd) {return $query->whereBetween('discharged_survey.created_at', [$dateInit, $dateEnd]);},
                'sections' => function($query){return $query->orderBy('order','ASC');},
                'sections.questions' => function($query){return $query->orderBy('order', 'ASC');},
                'sections.questions.answers' => function($query){return $query->orderBy('orden', 'ASC');},
                // 'sections.questions.answersMN'
            ])->first();

        // $survey = Survey::where('id',$request->survey_id)->first();

        $commentsSurvey = [];       // comentarios adicionales a las encuestas
        $totalSurveys = 0;          // total de encuestas a enviar
        $totalSurveysSent = 0;      // total de encuestas enviadas
        $totalSurveysViewed = 0;    // total de encuestas vistas
        $totalSurveysAnswered = 0;  // total de encuestas contestadas
        $maxPuntuacionGlobal = 0;   // Máxima puntuación ques se puede obtener en la encuesta
        $puntuacionGlobal = 0;      // puntuación de la encuesta según las respuestas

        // dd($survey);
        if(count($survey['dischargeds']) != 0){

            foreach ($survey['dischargeds'] as $discharged){

                switch ($discharged->pivot->status) {
                    case 0:
                        $totalSurveys++;
                        break;
                    case 1:
                        $totalSurveys++;
                        $totalSurveysSent++;
                        break;
                    case 2:
                        $totalSurveys++;
                        $totalSurveysSent++;
                        $totalSurveysViewed++;
                        break;
                    case 3:
                        $totalSurveys++;
                        $totalSurveysSent++;
                        $totalSurveysViewed++;
                        $totalSurveysAnswered++;
                        break;
                }

                if($discharged->pivot->comment != null){

                    if (
                            $discharged->episodio->egreso == NULL &&
                            $discharged->episodio->ubicacion == NULL &&
                            $discharged->episodio->active == 1
                        ) {
                            $habitacion = $discharged->ubicacion != null ? ' - '.$discharged->ubicacion : ' - '.$discharged->episodio->paciente->ubicaciones[count($discharged->episodio->paciente->ubicaciones)-1]->ubicacion->coments;
                        }else{
                            $habitacion = $discharged->ubicacion != null ? ' - '.$discharged->ubicacion : ' - '.$discharged->episodio->ubicacion->coments;
                        }

                    $commentsSurvey[] = ['comment'=> $discharged->pivot->comment . $habitacion, 'dateSent' => $discharged->pivot->dateSent];
                }

            }

            //ordenamos el arreglo de comentarios por fechas descendientes
            usort($commentsSurvey, function ($a, $b) {
                return strcmp($b["dateSent"],$a["dateSent"]);
            });

            foreach($survey->sections as $section){
                $section->maxPuntuacion = 0;
                $section->puntuacion = 0;

                foreach($section->questions as $question){
                    $question->comments = collect();
                    $question->totalResponses = count($question->answers);
                    // $question->responses = count($question->answersMN);
                    $question->responses = 0;
                    $question->responses1 = 0;
                    $question->responses2 = 0;
                    $question->responses3 = 0;
                    $question->responses4 = 0;
                    $question->responses5 = 0;
                    $question->responses6 = 0;
                    $question->responses7 = 0;
                    $question->responses8 = 0;
                    $question->responses9 = 0;
                    $question->responses10 = 0;

                    foreach($question->answers as $answer){
                        $answers_question = $question->answersMN()->where('answer_id', $answer->id)->whereBetween('answer_discharged_question.created_at', [$dateInit, $dateEnd])->get();

                        foreach($answers_question as $answerMN){

                            if($answerMN->pivot->comment != null && $answerMN->pivot->comment != ""){

                                if (
                                    $discharged->episodio->egreso == NULL &&
                                    $discharged->episodio->ubicacion == NULL &&
                                    $discharged->episodio->active == 1
                                ) {
                                    $habitacion = $discharged->ubicacion != null ? ' - '.$discharged->ubicacion : ' - '.$discharged->episodio->paciente->ubicaciones[count($discharged->episodio->paciente->ubicaciones)-1]->ubicacion->coments;
                                }else{
                                    $habitacion = $discharged->ubicacion != null ? ' - '.$discharged->ubicacion : ' - '.$discharged->episodio->ubicacion->coments;
                                }

                                $question->comments->push(['comment' => $answerMN->pivot->comment . $habitacion, 'date' => $answerMN->pivot->updated_at]);
                                // $question->comments->push(['comment' => $answerMN->pivot->comment, 'date' => $answerMN->pivot->updated_at]);
                            }

                            if( $question->totalResponses > 1){
                                $max = 0;
                                foreach($question->answers as $answer){
                                    if($answer->value > $max){
                                        $max = $answer->value;
                                    }
                                }
                                $section->maxPuntuacion += $max;
                                $section->puntuacion += $answerMN->value;

                                switch ($answerMN->orden) {
                                    case 1:
                                        $question->responses1++;
                                        $question->responses++;
                                        break;
                                    case 2:
                                        $question->responses2++;
                                        $question->responses++;
                                        break;
                                    case 3:
                                        $question->responses3++;
                                        $question->responses++;
                                        break;
                                    case 4:
                                        $question->responses4++;
                                        $question->responses++;
                                        break;
                                    case 5:
                                        $question->responses5++;
                                        $question->responses++;
                                        break;
                                    case 6:
                                        $question->responses6++;
                                        $question->responses++;
                                        break;
                                    case 7:
                                        $question->responses7++;
                                        $question->responses++;
                                        break;
                                    case 8:
                                        $question->responses8++;
                                        $question->responses++;
                                        break;
                                    case 9:
                                        $question->responses9++;
                                        $question->responses++;
                                        break;
                                    case 10:
                                        $question->responses10++;
                                        $question->responses++;
                                        break;
                                }

                            }

                        }

                    }

                    $question->comments->sortByDesc('date');

                }
                $maxPuntuacionGlobal = $maxPuntuacionGlobal + $section->maxPuntuacion;
                $puntuacionGlobal = $puntuacionGlobal + $section->puntuacion;
            }
        }

        return response()->json([
            'survey' => $survey,
            'commentsSurvey' => $commentsSurvey,
            'totalSurveys' => $totalSurveys,
            'totalSurveysSent' => $totalSurveysSent,
            'totalSurveysViewed' => $totalSurveysViewed,
            'totalSurveysAnswered' => $totalSurveysAnswered,
            'puntuacionGlobal' => $puntuacionGlobal,
            'maxPuntuacionGlobal' => $maxPuntuacionGlobal,
        ]);

    }

    public function getStatisticsByAreaAjax(Request $request){ // area_id, dateEnd, dateInit

        if($request->dateEnd == null || $request->dateInit == null){
            $dateEnd = Carbon::now();
            $dateInit = Carbon::parse('2024-01-01 00:00:00'); // fecha inicial
        }else{
            $dateEnd = Carbon::parse($request->dateEnd.' 23:59:59');
            $dateInit = Carbon::parse($request->dateInit.' 00:00:00');;
        }

        $sections = Section::where('area_id', $request->area_id)->with('survey')->get();

        $maxPuntuacionGlobal = 0;   // Máxima puntuación que se puede obtener en la sección
        $puntuacionGlobal = 0;      // puntuación de la sección según las respuestas

        foreach($sections as $section){

            $section->maxPuntuacion = 0;
            $section->puntuacion = 0;
            $section->totalRespuestas = 0;

            foreach($section->questions as $question){

                $question->totalResponses = count($question->answers);

                foreach($question->answers as $answer){

                    $answers_question = $question->answersMN()->where('answer_id', $answer->id)->whereBetween('answer_discharged_question.created_at', [$dateInit, $dateEnd])->get();

                    foreach($answers_question as $answerMN){

                        $section->totalRespuestas++;

                        if( $question->totalResponses > 1){

                            $max = 0;
                            foreach($question->answers as $answer){
                                if($answer->value > $max){
                                    $max = $answer->value;
                                }
                            }
                            $section->maxPuntuacion += $max;
                            $section->puntuacion += $answerMN->value;

                        }

                    }

                }

            }

            $maxPuntuacionGlobal = $maxPuntuacionGlobal + $section->maxPuntuacion;
            $puntuacionGlobal = $puntuacionGlobal + $section->puntuacion;
        }

        return response()->json([
            'sections' => $sections,
            'puntuacionGlobal' => $puntuacionGlobal,
            'maxPuntuacionGlobal' => $maxPuntuacionGlobal,
        ]);

    }

    public function getListSurveys(){
        return Survey::orderBy('order','asc')->get();
    }

    public function sendSpecificSurvey(Request $request){ // survey_id, skip, take


        // $usuarios = User::where('active','=','1')->skip(0)->take(100)->with('profile')->get();
        // $usuarios = User::where('active','=','1')->get();
        $skip = $request->skip;
        $take = $request->take;

        $usuarios = User::select('user.email','user.id')
            ->skip($skip-1)
            ->take($take)
            ->join("user_cuest_episodio", "user_cuest_episodio.user_id", "=", "user.id")
            ->where('user.active','=','1')
            ->groupBy('user.email','user.id')
            ->orderBy('user.id')
            ->get();

        $audiencia = [];

        foreach($usuarios as $usuario){

            $validator = Validator::make(['email' => $usuario->email], [
                'email' => 'required|email',
            ]);

            if (!$validator->fails()) {
                $audiencia[] = $usuario;
            }

        }

        foreach($audiencia as $person){

            $episodio = UserCuestEpisodio::where('user_id',$person->id)->orderBy('ingreso','desc')->first();

            $discharged = new Discharged;

            $discharged->user_id = $episodio->user_id_med_esp;
            $discharged->token = Str::random(45,'0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ|-_');
            $discharged->user_cuest_episodio_id = $episodio->id;
            $discharged->egress_date = Carbon::now();

            $details = [
                'nombrePaciente' => $episodio->paciente->profile->nombres . ' ' . $episodio->paciente->profile->apellidos,
                'token' => $discharged->token,
                'survey_id' => $request->survey_id
            ];

            echo $person." | ".$episodio->id."<br>";

            Mail::to($person->email)->queue(new \App\Mail\SurveySent($details));
            $discharged->sent_email = true;
            $discharged->status = true;
            $discharged->saveOrFail();
            $discharged->surveys()->syncWithoutDetaching([$request->survey_id => ['status' => 1]]);
        }

        return response()->json([
            'audiencia' => count($audiencia),
            'take' => $take,
            'proximo_skip' => $skip + $take
        ],200);

    }

    public function surveyInsituIndex(){
        return view('paciente.encuestas.insitu');
    }

    public function surveyInsitu(){ //devuelve la lista de los pacientes que están hospitalizados y salen hoy o mañana de alta

        /* $pacientes = User::select('user.id','user_cuest_episodio.pre_alta')
        ->join("user_cuest_episodio", "user_cuest_episodio.user_id", "=", "user.id")
        ->where('user_cuest_episodio.egreso','=',null)
        ->where('user_cuest_episodio.prealta','!=',null)
        //->whereBetween('user_cuest_episodio.pre_alta',[Carbon::now()->startOfDay(),Carbon::tomorrow()->startOfDay()])
        //->//('user_cuest_episodio.pre_alta','=',Carbon::now()->startOfDay())
        //->orWhere('user_cuest_episodio.pre_alta','=',Carbon::tomorrow()->startOfDay())
        ->with('profile','ubicaciones.ubicacion')
        ->orderBy('user_cuest_episodio.pre_alta','asc')
        ->orderBy('user.id','asc')
        ->get(); */
        $pacientes = DB::select("
            /*SELECT
	CASE 
                	WHEN 
                    	48 IN (SELECT id FROM cat_user_ubicacion WHERE cat_user_ubicacion.parent_cat_user_ubicacion_id IN (42) ) THEN 'HP2'
                        end*/
                        
            SELECT 
            	user.id AS 'user_id',
                user_cuest_episodio.id AS 'episodio_id' , 
                user_cuest_episodio.pre_alta AS 'fecha_del_alta' , 
                CONCAT(
                	user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS 'paciente',
                (
                	SELECT cat_user_ubicacion.coments 
                    FROM user_cuest_ubicacion 
                    INNER JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.user_cuest_episodio_id = user_cuest_episodio.id
                    ORDER BY user_cuest_ubicacion.id DESC
                    LIMIT 1
                ) AS 'habitacion',
                (
                    SELECT id
                    FROM dischargeds
                    WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                    LIMIT 1
                ) AS 'discharged_id',
                (
                	SELECT cat_user_ubicacion.description 
                    FROM user_cuest_ubicacion 
                    INNER JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.user_cuest_episodio_id = user_cuest_episodio.id
                    ORDER BY user_cuest_ubicacion.id DESC
                    LIMIT 1
                ) AS 'piso',
                
                (
                    SELECT id
                    FROM dischargeds
                    WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                    LIMIT 1
                ) AS 'discharged_status',
                (
                    CASE WHEN
                    (
                        SELECT id
                        FROM dischargeds
                        WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                        LIMIT 1
                   	) IS NOT NULL THEN 
                    (
                        SELECT dischargeds.close_by_user
                        FROM dischargeds
                        WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                        LIMIT 1
                   	)
                    ELSE 0 END
                ) AS 'close_by_user',
                CONCAT(
                    user_profile.nacionalidad,
                    user_profile.cedula
                ) AS 'cedula'
            FROM user_cuest_episodio 
            INNER JOIN user ON user_cuest_episodio.user_id = user.id
            INNER JOIN user_profile ON user.id = user_profile.user_id
            WHERE user_cuest_episodio.egreso IS NULL
            AND user_cuest_episodio.pre_alta IS NOT NULL
            AND user_cuest_episodio.active = 1
            AND 
            (
                	SELECT cat_user_ubicacion_id 
                    FROM user_cuest_ubicacion 
                    WHERE user_cuest_ubicacion.user_cuest_episodio_id = user_cuest_episodio.id
                    AND user_cuest_ubicacion.active = 1
                    ORDER BY user_cuest_ubicacion.id
                    LIMIT 1
                )
            IN (SELECT id FROM cat_user_ubicacion WHERE cat_user_ubicacion.parent_cat_user_ubicacion_id IN (42,71,235,236,99,127,234,155) )
            AND (
                CASE WHEN
                (
                    SELECT id
                    FROM dischargeds
                    WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                    LIMIT 1
                ) IS NOT NULL THEN 
                (
                    SELECT dischargeds.close_by_user
                    FROM dischargeds
                    WHERE dischargeds.user_cuest_episodio_id = user_cuest_episodio.id
                    LIMIT 1
                )
                ELSE 0 END
            ) = 0
            ORDER BY user_cuest_episodio.pre_alta DESC
        ");
        $listaPacientesAlta = ['HP2' => [], 'HP3' => [], 'HP4' => [], 'HP5' => [], 'HP6' => []];
        $listaPacientesPreAlta = ['HP2' => [], 'HP3' => [], 'HP4' => [], 'HP5' => [], 'HP6' => []];

        foreach($pacientes as $paciente){
            $listaPacientesAlta[ $paciente->piso ][] = $paciente;
            // verifico si existe discharged para el episodio asociado al paciente
          /*   $discharged = new Discharged();
            $discharged = $discharged
                ->where(
                    'user_cuest_episodio_id',
                    '=',
                    $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id
                )
                ->where("close_by_user","!=",1)
                ->first(); */
             
            /* if(!$discharged){
                // No existe aún discharged asociado
                $discharged_id = null;
                $discharged_status = null;
                $close_by_user = null;
            }else{ */
                // Existe discharged asociado
              /*   $discharged_id = $discharged->id;
                $discharged_status = $discharged->status;
                $close_by_user = $discharged->close_by_user; */
                
            //}

            /* if($paciente->pre_alta !== NULL){ */
                // armo la lista de pacientes en alta (salen hoy)

                /* if(in_array($paciente->piso,['HP2'])){ //piso 2 = 42
                    $listaPacientesAlta['HP2'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[71,235])){ // piso 3 = 71,235
                    $listaPacientesAlta['HP3'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[236,99])){ //piso 4 = 236,99
                    $listaPacientesAlta['HP4'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[127,234])){ //piso 5 = 127,234
                    $listaPacientesAlta['HP5'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[155])){ //piso 6 = 155
                    $listaPacientesAlta['HP6'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                } */
            /* } */ /* else{
                // armo la lista de pacientes en pre-alta (salen mañana)
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[42])){ //piso 2 = 42
                    $listaPacientesPreAlta['HP2'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[71,235])){ // piso 3 = 71,235
                    $listaPacientesPreAlta['HP3'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[236,99])){ //piso 4 = 236,99
                    $listaPacientesPreAlta['HP4'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[127,234])){ //piso 5 = 127,234
                    $listaPacientesPreAlta['HP5'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
                if(in_array($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[155])){ //piso 6 = 155
                    $listaPacientesPreAlta['HP6'][] = 
                    [
                        'user_id' => $paciente->id, 
                        'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 
                        'fecha_del_alta' => $paciente->pre_alta, 
                        'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 
                        'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->coments, 
                        'discharged_id' => $discharged_id, 
                        'discharged_status' => $discharged_status, 
                        'close_by_user' => $close_by_user,
                        'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula
                    ];
                }
            } */

        }
        return response()->json([
            'alta' => $listaPacientesAlta,
            'pre_alta' => $listaPacientesPreAlta
        ],200);

        // return $listaPacientesPreAlta;
    }

    public function pacientesHospitalizados(){

        $episodios = UserCuestEpisodio::where('egreso',null)
            ->with('paciente.profile', 'reubicacion.ubicacion')
            ->get();

        $listaPacientesHospitalizados = ['HP2' => [], 'HP3' => [], 'HP4' => [], 'HP5' => [], 'HP6' => []];

        foreach($episodios as $episodio){

            if(count($episodio->reubicacion) > 0){

                if(
                    in_array($episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id,[42, 71,235, 236,99, 127,234, 155])
                    /*    $episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id == 42
                    || $episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id == 70
                    || $episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id == 98
                    || $episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id == 126
                    || $episodio->reubicacion[count($episodio->reubicacion)-1]->ubicacion->parent_cat_user_ubicacion_id == 154 */
                ){

                    // verifico si existe discharged para el episodio asociado al paciente
                    $discharged = Discharged::where('user_cuest_episodio_id','=',$episodio->id)->first();
                    if(!$discharged){
                        // No existe aún discharged asociado
                        $discharged_id = null;
                    }else{
                        // Existe discharged asociado
                        $discharged_id = $discharged->id;
                    }

                    if($episodio->paciente->profile){
                        // armo la lista de pacientes hospitalizados
                            if(in_array($episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[42]) ){ //piso 2 = 42
                                $listaPacientesHospitalizados['HP2'][] = ['user_id' => $episodio->paciente->id, 'episodio_id' => $episodio->id, 'fecha_del_alta' => $episodio->pre_alta, 'paciente' => $episodio->paciente->profile->nombres . " " . $episodio->paciente->profile->apellidos, 'habitacion' => $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments, 'discharged_id' => $discharged_id, 'cedula' => $episodio->paciente->profile->nacionalidad."-".$episodio->paciente->profile->cedula];
                            }
                            if(in_array($episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[71,235]) ){ // piso 3 = 70
                                $listaPacientesHospitalizados['HP3'][] = ['user_id' => $episodio->paciente->id, 'episodio_id' => $episodio->id, 'fecha_del_alta' => $episodio->pre_alta, 'paciente' => $episodio->paciente->profile->nombres . " " . $episodio->paciente->profile->apellidos, 'habitacion' => $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments, 'discharged_id' => $discharged_id, 'cedula' => $episodio->paciente->profile->nacionalidad."-".$episodio->paciente->profile->cedula];
                            }
                            if(in_array($episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[236,99]) ){ //piso 4 = 98
                                $listaPacientesHospitalizados['HP4'][] = ['user_id' => $episodio->paciente->id, 'episodio_id' => $episodio->id, 'fecha_del_alta' => $episodio->pre_alta, 'paciente' => $episodio->paciente->profile->nombres . " " . $episodio->paciente->profile->apellidos, 'habitacion' => $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments, 'discharged_id' => $discharged_id, 'cedula' => $episodio->paciente->profile->nacionalidad."-".$episodio->paciente->profile->cedula];
                            }
                            if(in_array($episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[127,234]) ){ //piso 5 = 126
                                $listaPacientesHospitalizados['HP5'][] = ['user_id' => $episodio->paciente->id, 'episodio_id' => $episodio->id, 'fecha_del_alta' => $episodio->pre_alta, 'paciente' => $episodio->paciente->profile->nombres . " " . $episodio->paciente->profile->apellidos, 'habitacion' => $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments, 'discharged_id' => $discharged_id, 'cedula' => $episodio->paciente->profile->nacionalidad."-".$episodio->paciente->profile->cedula];
                            }
                            if(in_array($episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id,[155]) ){ //piso 6 = 154
                                $listaPacientesHospitalizados['HP6'][] = ['user_id' => $episodio->paciente->id, 'episodio_id' => $episodio->id, 'fecha_del_alta' => $episodio->pre_alta, 'paciente' => $episodio->paciente->profile->nombres . " " . $episodio->paciente->profile->apellidos, 'habitacion' => $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments, 'discharged_id' => $discharged_id, 'cedula' => $episodio->paciente->profile->nacionalidad."-".$episodio->paciente->profile->cedula];
                            }
                    }
                }
            }
        }

        return $listaPacientesHospitalizados;

        // $pacientesHospitalizadosSinPrealta = User::select('user.id','user_cuest_episodio.pre_alta')
        // ->join("user_cuest_episodio", "user_cuest_episodio.user_id", "=", "user.id")
        // // ->where('user_cuest_episodio.active','=',1)
        // // ->where('user_cuest_episodio.pre_alta','=',null)
        // ->where('user_cuest_episodio.egreso','=',null)
        // ->with('profile','ubicaciones.ubicacion')
        // // ->groupBy('user.id','user_cuest_episodio.pre_alta')
        // ->orderBy('user_cuest_episodio.id','desc')
        // ->orderBy('user.id','asc')
        // ->get();

        // $listaPacientesHospitalizados = ['HP2' => [], 'HP3' => [], 'HP4' => [], 'HP5' => [], 'HP6' => []];

        // foreach($pacientesHospitalizadosSinPrealta as $paciente){
        //     if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 42
        //     || $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 70
        //     || $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 98
        //     || $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 126
        //     || $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 154){

        //         // verifico si existe discharged para el episodio asociado al paciente
        //         $discharged = Discharged::where('user_cuest_episodio_id','=',$paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id)->first();
        //         if(!$discharged){
        //             // No existe aún discharged asociado
        //             $discharged_id = null;
        //         }else{
        //             // Existe discharged asociado
        //             $discharged_id = $discharged->id;
        //         }

        //         if($paciente->profile){
        //         // armo la lista de pacientes hospitalizados
        //             if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 42){ //piso 2 = 42
        //                 $listaPacientesHospitalizados['HP2'][] = ['user_id' => $paciente->id, 'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 'fecha_del_alta' => $paciente->pre_alta, 'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->description, 'discharged_id' => $discharged_id, 'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula];
        //             }
        //             if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 70){ // piso 3 = 70
        //                 $listaPacientesHospitalizados['HP3'][] = ['user_id' => $paciente->id, 'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 'fecha_del_alta' => $paciente->pre_alta, 'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->description, 'discharged_id' => $discharged_id, 'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula];
        //             }
        //             if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 98){ //piso 4 = 98
        //                 $listaPacientesHospitalizados['HP4'][] = ['user_id' => $paciente->id, 'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 'fecha_del_alta' => $paciente->pre_alta, 'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->description, 'discharged_id' => $discharged_id, 'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula];
        //             }
        //             if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 126){ //piso 5 = 126
        //                 $listaPacientesHospitalizados['HP5'][] = ['user_id' => $paciente->id, 'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 'fecha_del_alta' => $paciente->pre_alta, 'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->description, 'discharged_id' => $discharged_id, 'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula];
        //             }
        //             if($paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->parent_cat_user_ubicacion_id == 154){ //piso 6 = 154
        //                 $listaPacientesHospitalizados['HP6'][] = ['user_id' => $paciente->id, 'episodio_id' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->user_cuest_episodio_id, 'fecha_del_alta' => $paciente->pre_alta, 'paciente' => $paciente->profile->nombres . " " . $paciente->profile->apellidos, 'habitacion' => $paciente->ubicaciones[count($paciente->ubicaciones)-1]->ubicacion->description, 'discharged_id' => $discharged_id, 'cedula' => $paciente->profile->nacionalidad."-".$paciente->profile->cedula];
        //             }
        //         }
        //     }
        // }

        // return $listaPacientesHospitalizados;
    }

    public function getSurveysList(){
        return Survey::select('name','id')->orderBy('order','asc')->get();
    }
}
