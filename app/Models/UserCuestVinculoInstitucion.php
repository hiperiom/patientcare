<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestVinculoInstitucion extends Model
{
    protected $table ="user_cuest_vinculo_institucion";
    protected $fillable= [
        "cat_user_cuestionario_id",
        "nombre",
        "telefono",
        "correo",
        "user_id",
        "active",
    ];

    static function store(Request $request)
    {
        //dd($request->all());
        try {
            if (isset($request['cat_user_cuestionario_1'])) {
                UserCuestVinculoInstitucion::where("user_id",$request->user_id)
                ->where("cat_user_cuestionario_id",1)
                ->where("active",1)
                ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);

                $model = new UserCuestVinculoInstitucion();
                $model->cat_user_cuestionario_id = 1;
                $model->value = $request['cat_user_cuestionario_1'];
                $model->user_id = $request['user_id'];
                $model->save();

                if ($request['cat_user_cuestionario_1']=="Si") {
                    UserCuestVinculoInstitucion::where("user_id",$request->user_id)
                    ->where("cat_user_cuestionario_id",2)
                    ->where("active",1)
                    ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);


                    $model = new UserCuestVinculoInstitucion();
                    $model->cat_user_cuestionario_id = 2;
                    $model->value = $request['cat_user_cuestionario_2'];
                    $model->user_id = $request['user_id'];
                    $model->save();
                    $model = new UserCuestVinculoInstitucion();
                    $model->cat_user_cuestionario_id = 3;
                    $model->value = $request['cat_user_cuestionario_3'];
                    $model->user_id = $request['user_id'];
                    $model->save();

                    if (
                        !empty($request['cat_user_cuestionario_4']) &&
                        !empty($request['cat_user_cuestionario_5']) &&
                        !empty($request['cat_user_cuestionario_6'])
                    ) {

                        UserCuestVinculoInstitucion::where("user_id",$request->user_id)
                        ->where("cat_user_cuestionario_id",4)
                        ->where("active",1)
                        ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);

                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 4;
                        $model->value = $request['cat_user_cuestionario_4'];
                        $model->user_id = $request['user_id'];
                        $model->save();
                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 5;
                        $model->value = $request['cat_user_cuestionario_5'];
                        $model->user_id = $request['user_id'];
                        $model->save();
                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 6;
                        $model->value = $request['cat_user_cuestionario_6'];
                        $model->user_id = $request['user_id'];
                        $model->save();
                    }

                    if (
                        !empty($request['cat_user_cuestionario_8']) &&
                        !empty($request['cat_user_cuestionario_9']) &&
                        !empty($request['cat_user_cuestionario_10'])
                    ) {
                        UserCuestVinculoInstitucion::where("user_id",$request->user_id)
                        ->where("cat_user_cuestionario_id",8)
                        ->where("active",1)
                        ->update(["active"=>0,"deleted_at"=>date("Y-m-d h:m:s")]);

                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 8;
                        $model->value = $request['cat_user_cuestionario_8'];
                        $model->user_id = $request['user_id'];
                        $model->save();
                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 9;
                        $model->value = $request['cat_user_cuestionario_9'];
                        $model->user_id = $request['user_id'];
                        $model->save();
                        $model = new UserCuestVinculoInstitucion();
                        $model->cat_user_cuestionario_id = 10;
                        $model->value = $request['cat_user_cuestionario_10'];
                        $model->user_id = $request['user_id'];
                        $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                        $model->save();
                    }


                }
            }

            return true;
        } catch (\Throwable $th) {

            return dd($th->errorInfo[2]);
        }
    }
    static function show(Request $request)
    {
        return UserCuestVinculoInstitucion::where("user_id",$request->user_id)->where("active",1)->get();
    }
}
