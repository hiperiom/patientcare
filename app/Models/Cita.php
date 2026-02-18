<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cita extends Model
{
    protected $table = 'cita';
    protected $fillable = [
        'year', 
        'month', 
        'day', 
        'hour', 
        'reason_for_consultation', 
        'coment',
        'user_id_paciente',
        'user_id_medico', 
        'status', 
        'created_at', 
        'updated_at'
    ];
    static function store(Request $request)
    {
        //dd($request->all());
        try {

            $model = new Cita();
            $model->user_id_paciente = $request->user_id;
            $model->user_id_medico = $request->user_id_medico;
            $model->cat_especialidad_id = $request->cat_especialidad_id;
            $model->reason_for_consultation = $request->cita_motivo;
            $model->status = 0;
            $model->year = date("Y",strtotime($request->cita_hora));
            $model->month = date("m",strtotime($request->cita_hora));
            $model->day = date("d",strtotime($request->cita_hora));
            $model->hour = date("h:s",strtotime($request->cita_hora));
            $model->agenda_id = isset($request->agenda_id) ?$request->agenda_id:NULL;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
            return Response()->json($model);
        } catch (\Throwable $th) {
            //return $th->errorInfo[2];
            dd( $th->errorInfo[2]);
        }

    }
    static function index()
    {
        return Cita::where("active",1)->orderBy("created_at","DESC")->get();
    }
}
