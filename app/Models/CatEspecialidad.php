<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatEspecialidad extends Model
{
    protected $table = "cat_user_especialidad";
    static function index()
    {
        return CatEspecialidad::where("active",1)->orderBy("description","ASC")->get();
    }
    static function index2()
    {
        //retorna especialidades con el total de pacientes activos
        return DB::select("
            SELECT
                cue.*,
                (
                    SELECT
                        count(DISTINCT user.id) AS total
                    FROM user
                    JOIN user_profile ON user.id = user_profile.user_id
                    JOIN user_type ON user_profile.user_id = user_type.user_id
                    JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
                    JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    JOIN user_cuest_medico_paciente ON user_profile.user_id = user_cuest_medico_paciente.user_id
                    JOIN user_especialidad ON user_cuest_medico_paciente.user_id_medico = user_especialidad.user_id
                    WHERE user_profile.nombres IS NOT NULL
                    AND user_especialidad.cat_user_especialidad_id = cue.id
                    AND user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)
                    AND user_profile.apellidos IS NOT NULL
                    AND user_profile.fnacimiento IS NOT NULL
                    AND user_profile.genero IS NOT NULL
                    AND user_cuest_ubicacion.active = 1
                    AND user_cuest_medico_paciente.active = 1
                ) AS total_pacientes
            FROM cat_user_especialidad AS cue
            WHERE cue.active = 1
            ORDER BY description ASC
        ", [1]);
    }
}
