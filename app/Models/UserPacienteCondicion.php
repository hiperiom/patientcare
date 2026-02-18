<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class UserPacienteCondicion extends Model
{
    protected $table ="user_paciente_condicion";
    static function store(Request $request)
    {
        try {
            for ($i=0; $i <20; $i++) {
                if(isset($request['condicion-salud-'.$i])){
                    $model = new UserPacienteCondicion();
                    $model->cat_condicion_salud_id = $request['condicion-salud-'.$i];
                    $model->observacion = $request['observacion'];
                    $model->user_id = $request['user_id'];
                    $model->save();
                }
            }
            return true;
        } catch (\Throwable $th) {
            return dd($th->errorInfo[2]);
        }
    }


}
