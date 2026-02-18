<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCuestValoracion extends Model
{
    protected $table ="user_cuest_valoracion";
    static function store(Request $request)
    {
        $user = User::getByEmail($request->email);
        try {
            $model = new UserCuestValoracion();
            $model->user_id = $user->id;
            $model->value = $request->value;
            $model->cat_user_cuestionario_id = isset($request->cat_user_cuestionario_id)?$request->cat_user_cuestionario_id:null;
            $model->coments = $request->coments;
            $model->type = $request->type;
            $model->save();

        } catch (\Throwable $th) {
            dd($th->errorInfo[2]);
            return false;
        }
        return Response()->json(UserCuestValoracion::show($user->id,$request->type));
    }
    static function show($user_id,$type){
        return UserCuestValoracion::where("user_id",$user_id)->where("type",$type)->get();
    }
}
