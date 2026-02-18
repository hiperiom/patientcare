<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserCuestRiesgoQuirurgico extends Model
{
    protected $table = "user_cuest_riesgo_quirurgico";

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
        try {
            UserCuestRiesgoQuirurgico::where("user_id_paciente",$request->user_id_paciente)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestRiesgoQuirurgico();
            $model->description = $request->description;
            $model->value = $request->value;
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
        return UserCuestRiesgoQuirurgico::where("user_id_paciente",$user_id)->where("active",1)->value('value');
    }
}
