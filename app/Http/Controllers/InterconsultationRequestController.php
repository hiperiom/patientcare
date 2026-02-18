<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\InterconsultationRequest;
use Illuminate\Support\Facades\DB;
use DateTime;
class InterconsultationRequestController extends Controller{
    public function store(Request $request){

        try {
            $result = InterconsultationRequest::where('episode_id',  $request->episodio_id)
            ->where('end_date', NULL)
            ->where('doctor_id', $request->user_id_medico)
            ->first();
            if(!$result){
                $model = new InterconsultationRequest;
                $model->doctor_id = $request->user_id_medico;
                $model->patient_id = $request->user_id;
                $model->episode_id = $request->episodio_id;
                $model->start_date = date('Y-m-d H:i:s');
                $model->create_user_id = Auth::id();
                $model->save();

                $result = $this->index($request->episodio_id);

            }
          
        } catch (\Throwable $th) {
            return Response()->json($th->getMessage(),403 );
        }
        
        
        return Response()->json($result,200);
    }
    public function update(Request $request, $id){

        try {
            $episode_id = InterconsultationRequest::where('id', $id)->value('episode_id');

            $result = InterconsultationRequest::where('id', $id)
            //->where('end_date', NULL)
            ->update(['end_date' => date('Y-m-d H:i:s'),'answered' => $request->answered]);
            
            $result = $this->index($episode_id);
        } catch (\Throwable $th) {
            // dd($th);
            return Response()->json($th->getMessage(),403 );
        }
        
        
        return Response()->json($result,200);
    }
    public function index($episode_id){

        $temp = InterconsultationRequest::where('interconsultation_request.episode_id',$episode_id)
        ->join("user_profile as upm","interconsultation_request.doctor_id","upm.user_id")
        ->join("user_profile as upcu","interconsultation_request.create_user_id","upcu.user_id")
        ->select(
            DB::raw("
                interconsultation_request.id,
                interconsultation_request.start_date,
                interconsultation_request.end_date,
                interconsultation_request.doctor_id,
                interconsultation_request.patient_id,
                interconsultation_request.episode_id,
                interconsultation_request.answered,
                DATE_FORMAT(interconsultation_request.start_date, '%d/%m/%Y | %l:%i %p') AS fecha_solicitud,
                DATE_FORMAT(interconsultation_request.end_date, '%d/%m/%Y | %l:%i %p') AS fecha_confirmacion,
                upm.imagen as imagen_medico,
                CONCAT(
                    CASE 
                        WHEN upm.prefijo IS NOT NULL AND upm.prefijo NOT IN('UNDEFINED', 'undefined' 'null','NULL')
                            THEN  CONCAT(upm.prefijo , ' ') 
                        ELSE '' 
                    END,
                    upm.nombres,
                    ' ',
                    upm.apellidos
                ) AS medico,
                upm.extension_telefonica,
                upm.telefono_movil,
                upcu.imagen as imagen_created_user,
                CONCAT(
                    CASE WHEN upcu.prefijo IS NOT NULL AND upcu.prefijo NOT IN('UNDEFINED', 'undefined' 'null','NULL') 
                        THEN CONCAT(upcu.prefijo , ' ') ELSE '' END,
                    upcu.nombres,
                    ' ',
                    upcu.apellidos
                ) AS create_user
            ")
        )
        ->orderBy("interconsultation_request.id",'DESC')->get();
        if(!empty($temp)){
            foreach ($temp as $intercon) {
                $startTime = new DateTime($intercon->start_date);
                $endTime = new DateTime(date('Y-m-d H:i:s'));
                $interval = $startTime->diff($endTime);

                $hours = $interval->h + ($interval->days * 24);
                $minutes = $interval->i;
                $intercon->tiempo_transcurrido = $hours > 0 ? $hours . " h y " . $minutes . " m" :  $minutes . " m";
             

                if ($hours < 1) {
                    $intercon->color_tiempo_transcurrido = "success";
                }
                if ($hours >= 1 && $hours < 8) {
                    $intercon->color_tiempo_transcurrido = "warning";
                }
                if ($hours > 8) {
                    $intercon->color_tiempo_transcurrido = "danger";
                }

                if($intercon->end_date !== null){
                    $startTime = new DateTime($intercon->start_date);
                    $endTime = new DateTime($intercon->end_date);
                    $interval = $startTime->diff($endTime);
                    $hours = $interval->h + ($interval->days * 24);
                    $minutes = $interval->i;
                    $intercon->tiempo_respuesta = $hours > 0 ? $hours . " h y " . $minutes . " m" :  $minutes . " m";

                    if ($hours < 1) {
                        $intercon->color_tiempo_respuesta = "success";
                    }
                    if ($hours >= 1 && $hours < 8) {
                        $intercon->color_tiempo_respuesta = "warning";
                    }
                    if ($hours > 8) {
                        $intercon->color_tiempo_respuesta = "danger";
                    }
                }
            }
        }
        return $temp;
        
    }
}