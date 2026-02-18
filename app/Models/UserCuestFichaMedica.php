<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserCuestFichaMedica extends Model
{
    protected $table = "user_cuest_ficha_medica";

    static function store(Request $request)
    {
        UserCuestFichaMedica::where("user_id",$request->user_id)
            ->where("type",$request->type)
            ->where("active",1)
            ->update([
                "active"=>0,
                "deleted_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
            ]);

        $model = new UserCuestFichaMedica();
        $model->user_id = $request->user_id;
        $model->type = $request->type;
        $model->value = $request->value;
        $model->user_id_medico = Auth::id();
        $model->user_id_medico = Auth::id();
        $model->created_at = date('Y-m-d H:i:s', strtotime($request->created_at));
        $model->save();
        $request->merge(["user_cuest_ficha_medica_id"=>$model->id]);

        return UserCuestFichaMedica::show($request);
        /*
        try {
            if(isset($request['cat_user_cuestionario_61'])){
                UserCuestFichaMedica::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_61'])
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                $model = new UserCuestFichaMedica();
                $model->cat_user_cuestionario_id = 61;
                $model->value = $request['cat_user_cuestionario_61'];
                $model->coments = (is_null($request['cat_user_cuestionario_61_coment']))?null:$request['cat_user_cuestionario_61_coment'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
            if(isset($request['cat_user_cuestionario_62'])){
                UserCuestFichaMedica::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_62'])
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                $model = new UserCuestFichaMedica();
                $model->cat_user_cuestionario_id = 62;
                $model->value = $request['cat_user_cuestionario_62'];
                $model->coments = (is_null($request['cat_user_cuestionario_62_coment']))?null:$request['cat_user_cuestionario_62_coment'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
            if(
                isset($request['cat_user_cuestionario_63']) &&
                $request['cat_user_cuestionario_63']=="Si"
            ){
                for ($i=64; $i < 71; $i++) {
                    if(isset($request['cat_user_cuestionario_'.$i])){
                        UserCuestFichaMedica::where("user_id",$request->user_id)
                        ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_'.$i])
                        ->where("active",1)
                        ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                        $model = new UserCuestFichaMedica();
                        $model->cat_user_cuestionario_id = $i;
                        $model->value = $request['cat_user_cuestionario_'.$i];
                        $model->coments = null;
                        $model->user_id = $request['user_id'];
                        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                        $model->save();
                    }
                }

            }else{
                UserCuestFichaMedica::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_63'])
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                $model = new UserCuestFichaMedica();
                $model->cat_user_cuestionario_id = 63;
                $model->value = $request['cat_user_cuestionario_63'];
                $model->coments = null;
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
            if(isset($request['cat_user_cuestionario_71'])){
                UserCuestFichaMedica::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_71'])
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                $model = new UserCuestFichaMedica();
                $model->cat_user_cuestionario_id = 71;
                $model->value = $request['cat_user_cuestionario_71'];
                $model->coments = (is_null($request['cat_user_cuestionario_71_coment']))?null:$request['cat_user_cuestionario_71_coment'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
            for ($i=72; $i < 86; $i++) {
                if(
                    isset($request['cat_user_cuestionario_'.$i]) &&
                    !is_null($request['cat_user_cuestionario_'.$i]) &&
                    $i != 84 &&
                    $i != 73
                ){
                    UserCuestFichaMedica::where("user_id",$request->user_id)
                    ->where("cat_user_cuestionario_id",$request['cat_user_cuestionario_'.$i])
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>Carbon::parse($request->input('created_at'))->format("Y-m-d h:m:s")]);

                    $model = new UserCuestFichaMedica();
                    $model->cat_user_cuestionario_id = $i;
                    $model->value = $request['cat_user_cuestionario_'.$i];
                    $model->coments = null;
                    $model->user_id = $request['user_id'];
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                }
            }
            return true;
        } catch (\Throwable $th) {

            return dd($th->errorInfo[2]);
        }*/
    }
    static function show(Request $request)
    {
        return UserCuestFichaMedica::where("id",$request->user_cuest_ficha_medica_id)->first();
    }
    static function getLastFichaMedica(Request $request)
    {
        return DB::select("
            SELECT
                (
                    SELECT value FROM user_cuest_ficha_medica WHERE user_id= 10 AND active=1 AND type=1
                ) AS  grupo_sanguineo,
                (
                    SELECT value FROM user_cuest_ficha_medica WHERE user_id= 10 AND active=1 AND type=2
                ) AS  peso,
                (
                    SELECT value FROM user_cuest_ficha_medica WHERE user_id= 10 AND active=1 AND type=3
                ) AS  talla,
                (
                    SELECT value FROM user_cuest_ficha_medica WHERE user_id= 10 AND active=1 AND type=4
                ) AS  estatura

        ", [1]);
    }
}
