<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestEstudio extends Model
{
    protected $table = "user_cuest_estudio";
    static function index($user_id)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return UserCuestEstudio::where("user_id",$user_id)
            ->where("user_cuest_episodio_id",$episode_id)
            //->orWhere("user_cita_id",$cita_id)
            ->orderBy("id","DESC")
            ->get();
    }
    static function index_by_cita($cita_id)
    {
        return UserCuestEstudio::where("user_cita_id",$cita_id)
            ->orderBy("id","DESC")
            ->get();
    }
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

            try {
                UserCuestEstudio::where("user_id",$request->user_id_paciente)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                $model = new UserCuestEstudio();
                $model->user_cuest_episodio_id = $episode_id;
                $model->cat_user_cuestionario_id = 178;
                $model->value = $request->value;
                $episodio_id = DB::table('user_cuest_episodio')
                ->where("user_id",$request->user_id)
                ->where("active",1)
                ->select("id")
                ->orderBy("id","DESC")
                ->value('id');
                $model->user_cuest_episodio_id = $episodio_id;
                $model->coments = null;
                $model->user_id = $request->user_id;
                $model->user_id_medico =Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            } catch (\Throwable $th) {
                return $th->errorInfo[2];
            }
            return Response()->json(UserCuestEstudio::show($request->user_id));
    }
    static function scstore(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $model = new UserCuestEstudio();
        $model->user_cuest_episodio_id = $episode_id;
        $model->cat_user_cuestionario_id = 178;
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->coments = $request->coments;

        $model->user_cuest_episodio_id = $episode_id;
        $model->user_id = $request->user_id;
        $model->user_id_medico =Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();


        return Response()->json($model);
    }
    static function store_cita(Request $request)
    {


        $model = new UserCuestEstudio();
        $model->user_cita_id = $request->user_cita_id;
        $model->cat_user_cuestionario_id = 178;
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->coments = $request->coments;
        $model->estudio_num = $request->estudio_num;
        $model->user_cita_id = $request->user_cita_id;
        $model->user_id = $request->user_id;
        $model->user_id_medico =Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();


        return Response()->json($model);
    }
    static function actualizar(Request $request)
    {

                $model = UserCuestEstudio::find($request->estudio_id);
                $model->value = $request->value;
                $model->value2 = $request->value2;
                $model->coments = $request->coments;
                $model->estudio_num = $request->estudio_num;
                $model->user_id_medico =Auth::id();
                $model->updated_at = date('Y-m-d H:i:s');
                $model->save();
            return Response()->json($model);
    }

    static function index_episodio($episodio_id)
    {
        return UserCuestEstudio::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments', 'file_type','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }

    static function show($user_id)
    {
        return UserCuestEstudio::where("user_id",$user_id)->where("active",1)->first();
    }
    static function scshow($user_id)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($user_id);
        return UserCuestEstudio::where("user_id",$user_id)->where("user_cuest_episodio_id",$episode_id)->where("active",1)->first();
    }
    static function eliminar($id)
    {
        $model = UserCuestEstudio::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestEstudio::show($id));
    }

}
