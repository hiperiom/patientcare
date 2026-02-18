<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestPcr extends Model
{
    protected $table ="user_cuest_prueba_covid";
    static function index($request)
    {
        return UserCuestPcr::where("user_id",$request->user_id)
        ->whereIn("cat_user_cuestionario_id",[96])
        ->get();
    }
    static function store($request)
    {
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        UserCuestPcr::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",96)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        $model = new UserCuestPcr();
        $model->value = $request->value;
        $model->cat_user_cuestionario_id = 96;
        $model->user_id = $request->user_id;
        $model->user_cuest_episodio_id = $episode_id;
        $model->coments = $request->coments;
        $model->fecha_prueba = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();
        return Response()->json(UserCuestPcr::show($model->id));
    }
    static function show($id)
    {
        return UserCuestPcr::where("id",$id)
        ->where("cat_user_cuestionario_id",96)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestPcr::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        $model = UserCuestPcr::where('user_id',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestPcr::where('id', $model[0]->id)
            ->where('cat_user_cuestionario_id', 96)
            ->update(['active' => 1]);
        }
        return Response()->json($model);
    }
}
