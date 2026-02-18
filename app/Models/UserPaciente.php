<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPaciente extends Model
{
    protected $table="user_paciente";
    public function userCatUserType(){
        return $this->hasOne('App\Models\UserCatUserType', 'user_id');
    }
    static function store(Request $request)
    {

        try {
            $model = new UserPaciente();
            $model->nombre = $request->nombre;
            $model->apellido = $request->apellido;
            $model->cedula = $request->cedula;
            $model->genero = $request->genero;
            $model->fnacimiento = $request->fnacimiento;
            $model->telefono_movil = $request->telefono_movil;
            $model->user_id = $request->user_id;
            $model->save();
            return true;
        } catch (\Throwable $th) {
            return dd($th->errorInfo[2]);
        }
    }
    static function show($id)
    {
        return UserPaciente::where("user_id",$id)
        ->join('user', 'user_paciente.user_id', '=', 'user.id')
        ->first();
    }
    static function getInfoPaciente($user_id)
    {
        $model = DB::select("
        SELECT
        (
            SELECT id
            FROM user_cuest_episodio
            WHERE user_id = user.id
            AND active=1
            ORDER BY id DESC
            LIMIT 1
        ) AS episodio,

        user_cuest_ubicacion.cat_user_ubicacion_id,

        CONCAT(
            user_profile.nacionalidad,
            '-',
            FORMAT(user_profile.cedula, 0, 'de_DE')
        ) AS cedula,

        user_profile.telefono_movil,

        user_profile.imagen,


        (TO_DAYS(NOW()) - TO_DAYS(user_cuest_ubicacion.created_at)) AS dias,

        CONCAT(
            user_profile.nombres,
            ' ',
            user_profile.apellidos
        ) AS paciente,

        user_profile.genero AS sexo,

        YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad,
        'medico_tratante',
        'medico_interconsultante',
        'medico_felow',
        'medico_residente',
        'medico_ramh'
    FROM user
    JOIN user_profile ON user.id = user_profile.user_id
    JOIN user_type ON user_profile.user_id = user_type.user_id
    JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
    JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
    WHERE user_profile.nombres IS NOT NULL
    AND user_profile.apellidos IS NOT NULL
    AND user_profile.fnacimiento IS NOT NULL
    AND user_profile.genero IS NOT NULL
    AND user.id = ".$user_id."
LIMIT 1
        ", [1]);



        return $model;
    }

}
