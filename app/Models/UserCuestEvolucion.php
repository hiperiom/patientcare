<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestEvolucion extends Model
{
    protected $table="user_cuest_evolucion";
    static function index_episodio($episodio_id)
    {
        return UserCuestEvolucion::where('user_cuest_episodio_id',$episodio_id)
        ->select('id', 'value', 'coments','user_id_medico','created_at')
        ->orderBy("id","DESC")
        ->get();
    }
    static function store(Request $request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
            try {
                UserCuestEvolucion::where("user_id",$request->user_id)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

                $model = new UserCuestEvolucion();
                $model->user_cuest_episodio_id = $episode_id;
                $model->cat_user_cuestionario_id = 175;
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
                $model->user_id_medico = Auth::id();
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();


            } catch (\Throwable $th) {
                return $th->errorInfo[2];
            }
            return Response()->json(UserCuestEvolucion::show($request->user_id));



    }
    static function show($user_id)
    {
        return UserCuestEvolucion::where("user_id",$user_id)->where("active",1)->first();
    }
    static function eliminar($id)
    {
        $model = UserCuestEvolucion::where('id',$id);
        $user_id = $model->value('user_id');
        $model->delete();
        return Response()->json(UserCuestEvolucion::show($id));
    }
}
