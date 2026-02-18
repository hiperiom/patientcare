<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCuestAlert extends Model
{
    protected $table = "user_cuest_alert";

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        try {
            UserCuestAlert::where("user_id_paciente",$request->user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestAlert();
            $model->description = $request->description;
            $model->value = $request->alert;
            $model->user_id_paciente = $request->user_id_paciente;
            $model->user_id_medico = Auth::id();
            $model->user_cuest_episodio_id = $episode_id;
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
            //dump($request->all());
            return $model; //UserCuestAlert::show($model->id);
        } catch (\Throwable $th) {
            return $th->errorInfo[2];
        }
    }
    static function show($user_id)
    {
        return UserCuestAlert::where("user_id_paciente",$user_id)->where("active",1)->value('value');
    }
}
