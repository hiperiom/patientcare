<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestConsulta extends Model
{
    protected $table = "user_cuest_consulta";
    static function store(Request $request)
    {

        try {
            if(
                isset($request['cat_user_cuestionario_87']) &&
                !is_null($request['cat_user_cuestionario_87'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",87)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 87;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_87'];
                $model->user_id = $request['user_id'];
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_88']) &&
                !is_null($request['cat_user_cuestionario_88'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",88)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 88;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_88'];
                $model->user_id = $request['user_id'];
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_89']) &&
                !is_null($request['cat_user_cuestionario_89'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",89)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 89;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_89'];
                $model->user_id = $request['user_id'];
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_90']) &&
                !is_null($request['cat_user_cuestionario_90'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",90)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 90;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_90'];
                $model->user_id = $request['user_id'];
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_100']) &&
                !is_null($request['cat_user_cuestionario_100'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",100)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 100;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_100'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_101']) &&
                !is_null($request['cat_user_cuestionario_101'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",101)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 101;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_101'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            }
            if(
                isset($request['cat_user_cuestionario_102']) &&
                !is_null($request['cat_user_cuestionario_102'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",102)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 102;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_102'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            }
            for ($i=113; $i < 122; $i++) {
                if(
                    isset($request['cat_user_cuestionario_'.$i])
                ){
                    UserCuestConsulta::where("user_id",$request->user_id)
                    ->where("cat_user_cuestionario_id",$i)
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);

                    $model = new UserCuestConsulta();
                    $model->cat_user_cuestionario_id = $i;
                    $model->value = "Activo";
                    $model->coments = null;
                    $model->user_id = $request['user_id'];
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();

                }
            }
            if(
                isset($request['cat_user_cuestionario_122'])
            ){
                UserCuestConsulta::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",122)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);
                $model = new UserCuestConsulta();
                $model->cat_user_cuestionario_id = 122;
                $model->value = null;
                $model->coments = $request['cat_user_cuestionario_122_otro'];
                $model->user_id = $request['user_id'];
                $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();

            }
            return true;
        } catch (\Throwable $th) {

            return dd($th->errorInfo[2]);
        }
    }
}
