<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UserCuestEquipoSalud extends Model
{
    protected $table = "user_equipo_salud";

    static function store(Request $request)
    {

        try {
            $model = new UserCuestEquipoSalud();
            $model->user_id = $request->user_id;
            $model->cat_user_equipo_salud_id = $request->cat_user_equipo_salud_id;
            $model->save();
            return true;
        } catch (\Throwable $th) {
            dd($th->errorInfo[2]);
            return false;
        }
    }
}
