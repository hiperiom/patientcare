<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCuestMonitoreo extends Model
{
    protected $table ="user_cuest_monitoreo";
    protected $fillable = [
        "user_cuest_cuestionario_id",
        "value",
        "coments",
        "user_id",
        "active",
        "user_medico",
        "user_cuest_episodio_id",

    ];
    static function store(Request $request)
    {
        //dd($request->all());
        $episode_id = UserCuestEpisodio::ultimoEpisodio_id($request->user_id);
        //dd($user_cuest_historia_medica_id);
        if(
            isset($request['cat_user_cuestionario_84']) &&
            !is_null($request['cat_user_cuestionario_84'])
        ){
            UserCuestMonitoreo::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",84)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);


            $model = new UserCuestMonitoreo();
            $model->cat_user_cuestionario_id = 84;
            $model->value = $request['cat_user_cuestionario_84'];
            $model->user_cuest_episodio_id = $episode_id;
            $model->coments = (isset($request['sintoma_observacion']))?$request['sintoma_observacion']:null;
            $model->user_id = $request['user_id'];
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
        }
        if(
            isset($request['cat_user_cuestionario_73']) &&
            !is_null($request['cat_user_cuestionario_73'])
        ){
            UserCuestMonitoreo::where("user_id",$request->user_id)
            ->where("cat_user_cuestionario_id",73)
            ->where("active",1)
            ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);

            $model = new UserCuestMonitoreo();
            $model->cat_user_cuestionario_id = 73;
            $model->value = $request['cat_user_cuestionario_73'];
            $model->user_cuest_episodio_id = $episode_id;
            $model->coments = (isset($request['sintoma_observacion']))?$request['sintoma_observacion']:null;
            $model->user_id = $request['user_id'];
            $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
            $model->save();
        }
        $key=false;
        if(
            !isset($request['cat_user_cuestionario_73']) &&
            is_null($request['cat_user_cuestionario_73']) &&
            !isset($request['cat_user_cuestionario_84']) &&
            is_null($request['cat_user_cuestionario_84'])
        ){

            foreach (json_decode($request['value']) as $key => $value) {
                if  (
                    $value->value >=104 && $value->value <=113 ||
                    $value->value ==25
                    )
                {
                    $model = new UserCuestMonitoreo();
                    $model->cat_user_cuestionario_id = $value->value;
                    $model->value = !is_null($request['value2'])?$request['value2']:null;
                    $model->user_cuest_episodio_id = $episode_id;


                        $model->coments = (isset($request['model_observacion']))?$request['model_observacion']:null;


                    $model->user_id = $request['user_id'];
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                }

            }
        }
        /*
        for ($i=104; $i < 113 ; $i++) {
            if(
                isset($request['cat_user_cuestionario_'.$i]) &&
                !is_null($request['cat_user_cuestionario_'.$i])
            ){
                if(!$key){
                    UserCuestMonitoreo::where("user_id",$request->user_id)
                    ->where("cat_user_cuestionario_id",$i)
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))]);
                    $key=true;
                }



                $model = new UserCuestMonitoreo();
                $model->cat_user_cuestionario_id = $i;
                $model->value = "Activo";
                $model->user_cuest_historia_medica_id = $user_cuest_historia_medica_id;
                $model->coments = (isset($request['sintoma_observacion']))?$request['sintoma_observacion']:null;
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }else{
                /*
                UserCuestMonitoreo::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",$i)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>$request['created_at']]);
            }
        }*/
    }
    static function eliminar(Request $request)
    {

        $model = UserCuestMonitoreo::where('id',$request->id);
        $user_id = $model->value('user_id');
        $model->delete();
        $model = UserCuestMonitoreo::where('user_id',$user_id)->orderBy("id","DESC")->take(1)->get();
        if(count($model)>0){
            UserCuestMonitoreo::where('id', $model[0]->id)
            ->where('cat_user_cuestionario_id', 84)
            ->update(['active' => 1]);
        }
        return $model;
    }
    static function getTemperatura($user_id)
    {
       return UserCuestMonitoreo::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",84)
                                    ->where("active",1)
                                    ->value('value');
    }
    static function getOximetria($user_id)
    {
       return UserCuestMonitoreo::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",73)
                                    ->where("active",1)
                                    ->value('value');
    }
    static function getOxigenoterapia($user_id)
    {
        return UserCuestMonitoreo::where("user_id",$user_id)
        ->join("cat_user_cuestionario","user_cuest_monitoreo.cat_user_cuestionario_id","cat_user_cuestionario.id")
                                     ->whereBetween("user_cuest_monitoreo.cat_user_cuestionario_id",[104,112])
                                     ->where("user_cuest_monitoreo.active",1)
                                     ->select(
                                         "cat_user_cuestionario.description AS value",
                                         DB::raw("
                                            CASE
                                                WHEN user_cuest_monitoreo.value != 'Activo' THEN user_cuest_monitoreo.value
                                                WHEN user_cuest_monitoreo.value IS NULL THEN ''

                                                ELSE ''
                                            END AS value2
                                        "),

                                         "user_cuest_monitoreo.created_at",
                                         "user_cuest_monitoreo.id",
                                         "user_cuest_monitoreo.coments"

                                     )
                                     ->orderBy("user_cuest_monitoreo.created_at","desc")
                                     ->get();
    }
    static function getAllTemperatura($user_id)
    {
       return UserCuestMonitoreo::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",84)
                                    ->orderBy("created_at", "DESC")
                                    ->get();
    }
    static function getAllOximetria($user_id)
    {
       return UserCuestMonitoreo::where("user_id",$user_id)
                                    ->where("cat_user_cuestionario_id",73)
                                    ->orderBy("created_at", "DESC")
                                    ->get();
    }
    static function getAllOxigenoterapia($user_id)
    {
       return UserCuestMonitoreo::where("user_id",$user_id)
       ->join("cat_user_cuestionario","user_cuest_monitoreo.cat_user_cuestionario_id","cat_user_cuestionario.id")
                                    ->whereBetween("user_cuest_monitoreo.cat_user_cuestionario_id",[104,112])
                                    //->where("user_cuest_monitoreo.active",1)
                                    ->select(
                                        "cat_user_cuestionario.description AS value",
                                        "user_cuest_monitoreo.lpm AS value2",
                                        "user_cuest_monitoreo.created_at",
                                        "user_cuest_monitoreo.id",
                                        "user_cuest_monitoreo.coments"

                                    )
                                    ->orderBy("user_cuest_monitoreo.created_at","desc")
                                    ->get();
    }
}
