<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserEquipoSalud extends Model
{
    protected $table = "user_equipo_salud";
    protected $fillable=[
        "user_id",
        "cat_user_equipo_salud_id",
        "created_at",
        "updated_at",
    ];
    static function store(Request $request)
    {
        $model = new UserEquipoSalud();
        $model->cat_user_equipo_salud_id = $request->cat_user_equipo_salud_id;
        $model->user_id = $request->user_id;
        $model->created_at = $model->created_at = date('Y-m-d H:i:s', strtotime($request['created_at']));;
        $model->save();
        return UserEquipoSalud::show($request->user_id);
    }
    static function actualizar(Request $request)
    {
        $model = new UserEquipoSalud();
        $model::updateOrCreate([
                    'user_id'   => $request->user_id
                ],[
                    "cat_user_equipo_salud_id"=>$request->cat_user_equipo_salud_id,
                    "updated_at"=>date('Y-m-d H:i:s', strtotime($request['created_at']))
                ]);
        return UserEquipoSalud::show($request->user_id);
    }
    static function show($user_id)
    {
        return UserEquipoSalud::where("user_id",$user_id)->first();
    }
    static function medicosByArea(Request $request)
    {//
        //dd($request->all());
        $ubicacion = strtolower($request->area);

        switch ($ubicacion) {
            case 'ea':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (2,3,270)";
                break;
            case 'ecvd':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (6,7,10)";
                break;
            case 'aq':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (41)";
                break;
            case 'ep':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (29,32)";
                break;
            case 'hp2':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (42,43)";
                break;
            case 'hp3':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (70,71)";
                break;
            case 'hp4':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (99,98)";
                break;
            case 'hp5':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (126,127)";
                break;
            case 'hp6':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (154,155)";
                break;
            case 'utia':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (183,182)";
                break;
            case 'uticvd':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (194,195)";
                break;
            case 'utip':
                $ubicacion = "cat_user_ubicacion.parent_cat_user_ubicacion_id IN (212)";
                break;
            case '#':
                $ubicacion = "cat_user_ubicacion.id IN (223,224,225,226,227,228,229,357)";
                break;
            case 'pad1':
                $ubicacion = "cat_user_ubicacion.id IN (225)";
                break;
            case 'pad2':
                $ubicacion = "cat_user_ubicacion.id IN (226)";
                break;
            case 'pad3':
                $ubicacion = "cat_user_ubicacion.id IN (227)";
                break;
            case 'pad4':
                $ubicacion = "cat_user_ubicacion.id IN (228)";
                break;
            case 'pad5':
                $ubicacion = "cat_user_ubicacion.id IN (229)";
                break;
            case 'pademp':
                $ubicacion = "cat_user_ubicacion.id IN (357)";
                break;

            default:
                $ubicacion = "user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)";
                break;
        }
        return DB::select("
                SELECT
                DISTINCT ucm.user_id_medico AS user_id,
                user_profile.imagen,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS medico,
                cat_user_especialidad.description AS especialidad,
                cat_user_especialidad.image AS especialidad_imagen,
                (
                    SELECT
                        count(user_cuest_medico_paciente.user_id) AS total
                    FROM user_cuest_medico_paciente
                    JOIN user_cuest_ubicacion ON user_cuest_medico_paciente.user_id = user_cuest_ubicacion.user_id_paciente
                    WHERE user_cuest_medico_paciente.user_id_medico = ucm.user_id_medico
                    AND user_cuest_ubicacion.active = 1
                    AND user_cuest_medico_paciente.active = 1
                ) AS cantidad_pacientes
            FROM user_cuest_medico_paciente as ucm
            JOIN user_profile ON ucm.user_id_medico = user_profile.user_id
            JOIN user_especialidad ON ucm.user_id_medico = user_especialidad.user_id
            JOIN cat_user_especialidad ON user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
            JOIN user_cuest_ubicacion ON ucm.user_id = user_cuest_ubicacion.user_id_paciente
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE ".$ubicacion."
            AND user_cuest_ubicacion.active = 1
            AND ucm.active = 1
            ORDER BY medico ASC;
        ", [1]);
    }
    static function medicosByEspecialidad(Request $request)
    {//
        //dd($request->all());
        $ubicacion = strtolower($request->cat_especialidad_id);


        return DB::select("
                SELECT
                DISTINCT ucm.user_id_medico AS user_id,
                user_profile.imagen,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS medico,
                cat_user_especialidad.description AS especialidad,
                cat_user_especialidad.image AS especialidad_imagen,
                (
                    SELECT
                        count(user_cuest_medico_paciente.user_id) AS total
                    FROM user_cuest_medico_paciente
                    JOIN user_cuest_ubicacion ON user_cuest_medico_paciente.user_id = user_cuest_ubicacion.user_id_paciente
                    WHERE user_cuest_medico_paciente.user_id_medico = ucm.user_id_medico
                    AND user_cuest_ubicacion.active = 1
                    AND user_cuest_medico_paciente.active = 1
                ) AS cantidad_pacientes
            FROM user_cuest_medico_paciente as ucm
            JOIN user_profile ON ucm.user_id_medico = user_profile.user_id
            JOIN user_especialidad ON ucm.user_id_medico = user_especialidad.user_id
            JOIN cat_user_especialidad ON user_especialidad.cat_user_especialidad_id = cat_user_especialidad.id
            JOIN user_cuest_ubicacion ON ucm.user_id = user_cuest_ubicacion.user_id_paciente
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE user_especialidad.cat_user_especialidad_id = ".$ubicacion."
            AND user_cuest_ubicacion.active = 1
            AND ucm.active = 1
            ORDER BY medico ASC;
        ", [1]);
    }
}
