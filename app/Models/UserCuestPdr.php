<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestPdr extends Model
{
    protected $table ="user_cuest_prueba_covid";
    static function index($request)
    {
        return UserCuestPdr::where("user_id",$request->user_id)
        ->whereIn("cat_user_cuestionario_id",[91])
        ->orderBy("id", "DESC")
        ->get();
    }
    static function store($request)
    {

         $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        UserCuestPdr::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",91)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
        $model = new UserCuestPdr();
        $model->cat_user_cuestionario_id = 91;
        $model->value = $request->value;
        $model->value2 = $request->value2;
        $model->user_cuest_episodio_id = $episode_id;
        $model->igg = $request->igg=="false"?0:1;
        $model->igm = $request->igm=="false"?0:1;
        $model->user_id = $request->user_id;
        $model->coments = $request->coments;
        $model->fecha_prueba = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();
        return Response()->json(UserCuestPdr::show($model->id));
    }
    static function show($id)
    {
        return UserCuestPdr::where("id",$id)
        ->where("cat_user_cuestionario_id",91)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestPdr::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        $model = UserCuestPdr::where('user_id',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestPdr::where('id', $model[0]->id)
            ->where('cat_user_cuestionario_id', 91)
            ->update(['active' => 1]);
        }
        return Response()->json($model);
    }
}
