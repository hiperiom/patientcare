<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestCal extends Model
{
    protected $table = "user_cuest_cal";

    static function store(Request $request)
    {
        //dd($request->all());
        try {
            UserCuestCal::where("user_id_paciente",$request->user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestCal();
            $model->description = null;
            $model->value = $request->alert;
            $model->user_id_paciente = $request->user_id_paciente;
            $model->user_id_medico = $request->user_id_medico;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();

            return true;
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
        }
    }
    static function show($user_id)
    {
        return UserCuestCal::where("user_id_paciente",$user_id)->where("active",1)->value('value');
    }
}
