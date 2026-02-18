<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserCuestOxigenoterapia extends Model
{
    protected $table = "user_cuest_monitoreo";
    protected $fillable = [
        "user_cuest_cuestionario_id",
        "value",
        "coments",
        "user_id",
        "active",
        "user_medico",
        "user_cuest_episodio_id",

    ];
    static function index($user_id,$episodio_id)
    {
        $dispositivos_id = Arr::flatten(CatUserCuestionario::where('parent_cat_user_cuestionario_id',103)->select('id')->get()->toArray());
        return UserCuestOxigenoterapia::where('user_id',$user_id)
        ->join("cat_user_cuestionario","user_cuest_monitoreo.cat_user_cuestionario_id","cat_user_cuestionario.id")
        ->whereIn('user_cuest_monitoreo.cat_user_cuestionario_id',$dispositivos_id)
        ->where('user_cuest_monitoreo.user_cuest_episodio_id',$episodio_id)
        ->select(
            "user_cuest_monitoreo.id",
            "cat_user_cuestionario.description AS dispositivo",
            DB::raw("
                CASE
                    WHEN user_cuest_monitoreo.value IS NOT NULL THEN user_cuest_monitoreo.value
                    ELSE ''
                END AS lpm
            "),
            "user_cuest_monitoreo.coments",
            "user_cuest_monitoreo.created_at",
            "user_cuest_monitoreo.user_cuest_episodio_id"
        )
        ->orderBy("user_cuest_monitoreo.created_at","DESC")
        ->get();
    }
    static function store(Request $request)
    {
        UserCuestMonitoreo::where("user_id",$request->user_id)
        ->whereIn("cat_user_cuestionario_id",[104,106,110,109,108,105,107,111,112])
        ->where("active",1)
        ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

        //$episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);

        $model = new UserCuestMonitoreo();
        $model->cat_user_cuestionario_id = $request->value;
        $model->value = !is_null($request['value2'])?$request['value2']:null;
        $model->user_cuest_episodio_id = $request->episodio_id;

        $model->coments = (isset($request['model_observacion']))?$request['model_observacion']:null;

        $model->user_id = $request['user_id'];
        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
        $model->save();
        return UserCuestOxigenoterapia::show($request['user_id']);
    }
    static function show($id)
    {
        return UserCuestOxigenoterapia::where('user_cuest_monitoreo.user_id',$id)
        ->join("cat_user_cuestionario","user_cuest_monitoreo.cat_user_cuestionario_id","cat_user_cuestionario.id")

        ->whereIn("user_cuest_monitoreo.cat_user_cuestionario_id",[104,106,110,109,108,105,107,111,112])
        ->where("user_cuest_monitoreo.active",1)
        ->first();
    }
    static function eliminar(Request $request)
    {
        $model = UserCuestOxigenoterapia::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();

        $model = UserCuestOxigenoterapia::where('user_id',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestOxigenoterapia::where('id', $model[0]->id)
            ->update(['active' => 1]);
        }

        return UserCuestOxigenoterapia::show($user_id);
    }
    static function actualizar(Request $request)
    {

    }
}
