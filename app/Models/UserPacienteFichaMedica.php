<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;

class UserPacienteFichaMedica extends Model
{
    protected $table = "user_paciente_ficha_medica";
    static function store(Request $request)
    {
        try {
            for ($i=0; $i <20; $i++) {
                if(isset($request['cat_pregunta_'.$i])){
                    $model = new UserPacienteFichaMedica();
                    $model->cat_pregunta_al_paciente_id = $i;
                    $model->valor = $request['cat_pregunta_'.$i];
                    $model->comentario =  $request['cat_pregunta_val_'.$i];
                    $model->user_id = $request['user_id'];
                    $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));
                    $model->save();
                }
            }
            return true;
        } catch (\Throwable $th) {
            return dd($th->errorInfo[2]);
        }
    }
    static function getRespuesta($user_id,$pregunta_id)
    {
        return UserPacienteFichaMedica::where("user_id",$user_id)
                                    ->where("cat_pregunta_al_paciente_id",$pregunta_id)
                                    ->where("deleted_at",null)
                                    ->value("valor");
    }
}
