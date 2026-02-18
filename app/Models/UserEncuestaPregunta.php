<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEncuestaPregunta extends Model
{
    protected $table = "user_encuesta_pregunta";
    protected $fillable = [
        "id",
       "user_encuesta_id",
       "cat_encuesta_preg_id",
       "cat_encuesta_preg_value",
       "coment",
       "active",
       "user_id",
       "user_id_medico",
       "created_at",
    ];
    static function store(Request $request){
//dd($request->all());

        foreach (json_decode($request->user_encuesta_pregunta) as $key => $value) {
            if($value->cat_encuesta_preg_value > 0){


                $model = new UserEncuestaPregunta();
                $model->user_encuesta_id = $request->user_encuesta_id;
                $model->cat_encuesta_preg_id= $value->cat_encuesta_preg_id;
                $model->cat_encuesta_preg_value= $value->cat_encuesta_preg_value;
                $model->coment= $value->cat_encuesta_preg_coments;
                $model->user_id= $request->user_id;
                $model->user_id_medico= Auth::id();
                $model->created_at= date('Y-m-d H:i:s', strtotime($request['created_at']));
                $model->save();
            }
        }

        $model =    UserEncuestaPregunta::where("user_encuesta_id",$request->user_encuesta_id)->first();

        return Response()->json($model) ;
    }

}
