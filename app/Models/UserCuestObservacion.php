<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestObservacion extends Model
{
    protected $table="user_cuest_observacion";
    protected $fillable = [
        "id",
        "cat_user_cuestionario_id",
        "value",
        "coments",
        "user_cuest_episodio_id",
        "active",
        "created_at",
        "user_id_medico",
    ];

    static function index_episodio($episodio_id)
    {
        return UserCuestObservacion::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //dd($request->all());
        if(isset($request->paciente_observacion) && !is_null($request->paciente_observacion)){
            try {
                $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id_paciente);
                UserCuestObservacion::where("user_id",$request->user_id_paciente)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                $model = new UserCuestObservacion();
                $model->user_cuest_episodio_id = $episode_id;
                $model->cat_user_cuestionario_id = 176;
                $model->value = $request->paciente_observacion;
                $model->user_cuest_episodio_id = $episode_id;
                $model->coments = isset($request->coments)?$request->coments:null;


                $model->user_id = $request->user_id_paciente;
                $model->user_id_medico = $request->user_id_medico;
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

                //return true;
            } catch (\Throwable $th) {
                dd($th->errorInfo[2]);
            }
        }else{
            try {
                $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
                UserCuestObservacion::where("user_id",$request->user_id_paciente)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                $model = new UserCuestObservacion();
                $model->user_cuest_episodio_id = $episode_id;
                $model->cat_user_cuestionario_id = 176;
                $model->value = $request->value;

                $model->user_cuest_episodio_id = $episode_id;
                $model->coments = isset($request->coments)?$request->coments:null;
                $model->user_id = $request->user_id;
                $model->user_id_medico = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

                //return true;
            } catch (\Throwable $th) {
                dd($th->errorInfo[2]);
            }
        }
        return UserCuestObservacion::show($request->user_id);
    }
    static function show($user_id)
    {
        return UserCuestObservacion::where("user_id",$user_id)->get();
    }
    static function eliminar($id)
    {
        $model = UserCuestObservacion::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestObservacion::show($id));
    }
}
