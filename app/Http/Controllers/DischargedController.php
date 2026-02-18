<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discharged;
use App\Models\UserCuestEpisodio;
use App\Models\Survey;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Validator;

class DischargedController extends Controller
{
    public function sendAnswers(Request $request){ // Dentro del $request -> $token, $question_id, $answer_id, $survey_id, $comment, $platform

        $discharged = Discharged::where('token',$request->token)->firstOrFail();
        $discharged->update(['close_by_user' => 1]);
        // dd($request);

        // $survey = Survey::where('id',$request->survey_id)->with('questions')->first();

        // selcción simple
        // foreach($request->answers as $currentAnswer){
        //     $discharged->questions()->syncWithoutDetaching([$currentAnswer['question'] => ['answer_id' => $currentAnswer['answer'], 'comment' => $currentAnswer['comment']]]);
        // }

        //selección múltiple
        foreach($request->answers as $currentAnswer){

            if(is_array($currentAnswer['answer'])){

                $discharged->questions()->detach($currentAnswer['question']);

                $comment = true;

                foreach($currentAnswer['answer'] as $answer){

                    if($comment){

                        $discharged->questions()->attach([$currentAnswer['question'] => ['answer_id' => $answer, 'comment' => $currentAnswer['comment']]]);
                        $comment = false;

                    }else{

                        $discharged->questions()->attach([$currentAnswer['question'] => ['answer_id' => $answer]]);

                    }
                }

            }else{

                $discharged->questions()->syncWithoutDetaching([$currentAnswer['question'] => ['answer_id' => $currentAnswer['answer'], 'comment' => $currentAnswer['comment']]]);

            }
        }

        if($discharged->surveys[0]->pivot->status < 3){
            $discharged->surveys()->syncWithoutDetaching([$request->survey_id => ['status' => 3, 'dateSent' => now(), 'comment' => $request->comment]]);
        }else{
            $discharged->surveys()->syncWithoutDetaching([$request->survey_id => ['comment' => $request->comment]]);
        }
        if($request->platform == 1){ // fue por la plataforma email
            $discharged->sent_email = 2;
        }elseif($request->platform == 2){ // fue por la plataforma de whatsapp
            $discharged->sent_whatsapp = 2;
        }elseif($request->platform == 3){ // fue por la plataforma de insitu
            $discharged->sent_insitu = 2;
        }
        $discharged->status = 2;
        $discharged->save();

        return response()->json(['message' => 'Respuestas almacenadas con éxito'], 200);

    }

    public function index(Request $request){

    }

    public function store(Request $request){ // recibe por post user_id_paciente
        // $episodio = UserCuestEpisodio::where('user_id',$request->user_id_paciente)->orderBy('egreso','desc')->first();
        $episodio = UserCuestEpisodio::where('user_id',$request->user_id_paciente)->orderBy('ingreso','desc')->first();

        // verifico que el paciente no haya respondido la encuesta en la habitación
        $flag = false;
        if($episodio->discharged == null || in_array($episodio->ubicacion->survey_id, [4,5,6,7,8])){
            // El episodio NO tiene un discharged asociado
            $discharged = new Discharged;
            $flag = true;
        }else{
            $discharged = Discharged::where('id',$episodio->discharged->id)->first();
            if($discharged->status != 2){
                // la encuesta no ha sido contestada insitu
                $flag = true;
            }
        }

        if($episodio->ubicacion->survey_id != null){ // si es igual a null es que la ubicación del paciente dado de alta no tiene asociada ninguna encuesta
            // debe ser enviada una encuesta
            $email = $episodio->paciente->email;
            $discharged->user_id = $episodio->user_id_med_esp;
            $discharged->token = Str::random(45,'0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ|-_');
            $discharged->user_cuest_episodio_id = $episodio->id;
            $discharged->egress_date = Carbon::now();
            $discharged->ubicacion = $episodio->ubicacion->description .' | '.$episodio->ubicacion->coments;

            $survey_id = $discharged->episodio->ubicacion->survey_id;
            $fechaNacimientoPaciente = $discharged->episodio->paciente->profile->fnacimiento;

            if($survey_id == 7){
                if(Carbon::parse($fechaNacimientoPaciente)->age < 18){
                    $survey_id = 5;
                }
            }

            // identificamos si el egreso no proviene del PAD
            if(!in_array($episodio->ubicacion->survey_id, [4,5,6,7,8])){

                // si $flag == true la encuesta no fue respondida insitu
                if($flag){
                    $validator = Validator::make(['email' => $email], [
                        'email' => 'required|email',
                    ]);

                    if (!$validator->fails()) {

                        $details = [
                            'nombrePaciente' => $episodio->paciente->profile->nombres . ' ' . $episodio->paciente->profile->apellidos,
                            'token' => $discharged->token,
                            'survey_id' => $survey_id
                        ];

                        if (strpos($email, "@correotemporal.com") == false){

                            Mail::to($email)->queue(new \App\Mail\SurveySent($details));
                            $discharged->sent_email = true;
                            $discharged->status = true;
                            $discharged->saveOrFail();
                            $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 1]]);

                        }

                    } else {

                        $discharged->saveOrFail();
                        $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 0]]);

                    }

                    return response('Discharged creado con éxito.', 200);

                } else {

                    return response('La encuesta ya fue respondida en la habitación.', 200);

                }

            } else {

                $hospitalizacion = false;
                $ubi = '';
                // echo 'Ubicaciones --> '.$episodio->paciente->ubicaciones;
                foreach($episodio->paciente->ubicaciones as $ubicacion){
                    if($ubicacion->ubicacion->survey_id == 1){// el paciente estuvo hospitalizado
                        $hospitalizacion = true;
                        $ubi = $ubicacion->ubicacion->description .' | '.$ubicacion->ubicacion->coments;
                    }
                }

                if($hospitalizacion){

                    $survey_idH = 1;
                    $flagH = false;

                    if($episodio->discharged == null){
                        // El episodio NO tiene un discharged asociado
                        $dischargedH = new Discharged;
                        $flagH = true;
                    }else{
                        $dischargedH = Discharged::where('id',$episodio->discharged->id)->first();
                        if($dischargedH->status != 2){
                            // la encuesta no ha sido contestada insitu
                            $flagH = true;
                        }
                    }

                    if($flagH){
                        $dischargedH->user_id = $episodio->user_id_med_esp;
                        $dischargedH->token = Str::random(45,'0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ|-_');
                        $dischargedH->user_cuest_episodio_id = $episodio->id;
                        $dischargedH->egress_date = Carbon::now();
                        $dischargedH->ubicacion = $ubi;
                        $validator = Validator::make(['email' => $email], [
                            'email' => 'required|email',
                        ]);

                        if (!$validator->fails()) {

                            $details = [
                                'nombrePaciente' => $episodio->paciente->profile->nombres . ' ' . $episodio->paciente->profile->apellidos,
                                'token' => $dischargedH->token,
                                'survey_id' => $survey_idH
                            ];

                            if (strpos($email, "@correotemporal.com") == false){

                                Mail::to($email)->queue(new \App\Mail\SurveySent($details));
                                $dischargedH->sent_email = true;
                                $dischargedH->status = true;
                                $dischargedH->saveOrFail();
                                $dischargedH->surveys()->syncWithoutDetaching([$survey_idH => ['status' => 1]]);

                            }

                        } else {

                            $dischargedH->saveOrFail();
                            $dischargedH->surveys()->syncWithoutDetaching([$survey_idH => ['status' => 0]]);

                        }
                    }
                }

                $discharged->saveOrFail();
                $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 0]]);
                return response('El episodio está asociado al PAD, la encuesta será enviada por whatsapp manualmente', 200);

            }

        }else{

            return response('El episodio asociado no tiene asociada ninguna encuesta.', 200);

        }

    }

    public function storeInsitu(Request $request){ // recibe por post episodio_id, fecha_del_alta
        // esta funcion por ahora sólo funciona con la encuesta de hospitalización
        $episodio = UserCuestEpisodio::where('id',$request->episodio_id)->orderBy('egreso','desc')->first();
        // return $episodio;
        $discharged = new Discharged;

        $discharged->user_id = $episodio->user_id_med_esp;
        $discharged->token = Str::random(45,'0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ|-_');
        $discharged->user_cuest_episodio_id = $episodio->id;
        $discharged->egress_date = Carbon::now();
        $discharged->ubicacion = $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->description.' | '.$episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->coments;
        $discharged->sent_insitu = 1;
        $discharged->status = 1;

        // $survey_id = $discharged->episodio->ubicacion->survey_id;
        // $survey_id = 1; // id de la encuesta de hospitalización
        $fechaNacimientoPaciente = $discharged->episodio->paciente->profile->fnacimiento;
        $survey_id = $episodio->paciente->ubicaciones[count($episodio->paciente->ubicaciones)-1]->ubicacion->survey_id;

        if($survey_id == 7){
            if(Carbon::parse($fechaNacimientoPaciente)->age < 18){
                $survey_id = 5;
            }
        }

        $discharged->saveOrFail();
        $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 1]]);

        return response()->json([
            'token' => $discharged->token,
            'survey_id' => $survey_id,
            'discharged_id' => $discharged->id,
        ]);

        // return response('Discharged insitu creado con éxito.', 200);
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){
    }

    public function showListToSend(){
        return view('paciente.encuestas.enviar');
    }


    public function updateListToSend(Request $request){ // from, to

        $toSend = Discharged::where('status','=',0)->whereBetween('egress_date', [$request->from, $request->to])->orderBy('egress_date','asc')->with(['episodio.paciente.profile','episodio.ubicacion', 'surveys'])->get();
        $send = Discharged::where('status','=',1)->whereBetween('egress_date', [$request->from, $request->to])->orderBy('egress_date','asc')->with(['episodio.paciente.profile','episodio.ubicacion', 'surveys'])->get();
        $noSend = Discharged::where('status','=',9)->whereBetween('egress_date', [$request->from, $request->to])->orderBy('egress_date','asc')->with(['episodio.paciente.profile','episodio.ubicacion', 'surveys'])->get();
        $sent = Discharged::where('status','=',2)->whereBetween('egress_date', [$request->from, $request->to])->orderBy('egress_date','asc')->with(['episodio.paciente.profile','episodio.ubicacion', 'surveys'])->get();

        return response()->json([
            'toSend' => $toSend,
            'send' => $send,
            'noSend' => $noSend,
            'sent' => $sent
        ]);
    }

    public function reSendEmailWhatsapp(Request $request){ // discharged_id

        $messageEmail = '';
        $messageErrorEmail = '';
        $messageWhatsapp = '';
        $messageErrorWhatsapp = '';

        $discharged = Discharged::find($request->discharged_id);

        $survey_id = $discharged->episodio->ubicacion->survey_id;
        $fechaNacimientoPaciente = $discharged->episodio->paciente->profile->fnacimiento;
        if($survey_id == 7){
            if(Carbon::parse($fechaNacimientoPaciente)->age < 18){
                $survey_id = 5;
            }
        }

        $email = $discharged->episodio->paciente->email;

        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if (!$validator->fails()) {

            if($discharged->sent_email == false){

                $details = [
                    'nombrePaciente' => $discharged->episodio->paciente->profile->nombres . ' ' . $discharged->episodio->paciente->profile->apellidos,
                    'token' => $discharged->token,
                    'survey_id' => $survey_id
                ];

                if (strpos($email, "@correotemporal.com") == false){
                    Mail::to($email)->queue(new \App\Mail\SurveySent($details));
                    $discharged->sent_email = true;
                    $discharged->status = true;
                    $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 1]]);
                    $messageEmail = 'Correo electrónico enviado con éxito!';
                }else{
                    $messageErrorEmail = 'El correo eletrónico es un correo de prueba del sistema!';
                }

            }

        }else{

            $messageErrorEmail = 'El formato del correo eletrónico no es válido!';

        }

        // if($discharged->sent_whatsapp == false && substr($discharged->episodio->paciente->profile->telefono_movil, 0, 4) == '+584' && strlen($discharged->episodio->paciente->profile->telefono_movil) == 13){
        if($discharged->sent_whatsapp == false && $request->isPhone == true){
            $discharged->sent_whatsapp = true;
            $discharged->status = true;
            $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 1]]);
            $messageWhatsapp = 'Whatsapp enviado con éxito!';
        }else{
            if($discharged->sent_whatsapp == false){
                $messageErrorWhatsapp = 'El formato del whatsapp es incorrecto!';
            }
        }

        $discharged->save();

        $message = '';
        $errorMessage = '';

        if($messageEmail != ''){
            $message = $messageEmail;
        }
        if($messageWhatsapp != ''){
            if($messageEmail == ''){
                $message = $messageWhatsapp;
            }else{
                $message = $messageEmail . ', ' . $messageWhatsapp;
            }
        }

        if($messageErrorEmail != ''){
            $errorMessage .= $messageErrorEmail;
        }
        if($messageErrorWhatsapp != ''){
            if ($messageErrorEmail == '') {
                $errorMessage = $messageErrorWhatsapp;
            }else{
                $errorMessage = $messageErrorEmail.', '. $messageErrorWhatsapp;
            }
        }

        // return response($message, 200);
        return response()->json([
            'successMessage' => $message,
            'errorMessage' => $errorMessage
        ]);

    }

    public function updateStatus(Request $request){
        $discharged = Discharged::find($request->discharged_id);
        $discharged->status = $request->newStatus;
        $discharged->save();
        return response('Paciente movido con éxito.', 200);
    }

    public function rollbackEmail(Request $request){ // id, motivo
        $discharged = Discharged::find($request->id);
        $discharged->sent_email = 0;
        $discharged->motivo_email = $request->motivo;

        $survey_id = $discharged->episodio->ubicacion->survey_id;
        $fechaNacimientoPaciente = $discharged->episodio->paciente->profile->fnacimiento;
        if($survey_id == 7){
            if(Carbon::parse($fechaNacimientoPaciente)->age < 18){
                $survey_id = 5;
            }
        }

        if($discharged->sent_whatsapp == 0){
            $discharged->status = 0;
            $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 0]]);
        }
        $discharged->save();
        return response('Estatus de envío vía correo cambiado a "No enviado".', 200);
    }

    public function rollbackWhatsapp(Request $request){ // id, motivo
        $discharged = Discharged::find($request->id);
        $discharged->sent_whatsapp = 0;
        $discharged->motivo_whatsapp = $request->motivo;

        $survey_id = $discharged->episodio->ubicacion->survey_id;
        $fechaNacimientoPaciente = $discharged->episodio->paciente->profile->fnacimiento;
        if($survey_id == 7){
            if(Carbon::parse($fechaNacimientoPaciente)->age < 18){
                $survey_id = 5;
            }
        }

        if($discharged->sent_email == 0){
            $discharged->status = 0;
            $discharged->surveys()->syncWithoutDetaching([$survey_id => ['status' => 0]]);
        }
        $discharged->save();
        return response('Estatus de envío vía whatsapp cambiado a "No enviado".', 200);
    }
}
