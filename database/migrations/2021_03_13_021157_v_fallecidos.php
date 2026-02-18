<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VFallecidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW v_fallecidos AS
            SELECT
                user.id AS user_id,
                (
                    SELECT cat_user_ubicacion.description
                    FROM user_cuest_ubicacion
                    JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.user_id_paciente = user.id
                    ORDER BY user_cuest_ubicacion.created_at DESC
                    LIMIT 1, 1
                ) AS ubicacion,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,

                UPPER(user_profile.genero) AS sexo,

                (YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 )) AS edad,
                (
                    SELECT DATE_FORMAT(user_cuest_ubicacion.created_at, '%d/%m/%Y')
                    FROM user_cuest_ubicacion
                    JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.user_id_paciente = user.id
                    ORDER BY user_cuest_ubicacion.created_at DESC
                    LIMIT 1, 1
                ) AS registro
            FROM user
            JOIN user_profile ON user.id = user_profile.user_id
            JOIN user_type ON user_profile.user_id = user_type.user_id
            JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
            WHERE user_profile.nombres IS NOT NULL
            AND cat_user_ubicacion.id IN (248)
            AND user_profile.apellidos IS NOT NULL
            AND user_profile.fnacimiento IS NOT NULL
            AND user_profile.genero IS NOT NULL
            AND user_cuest_ubicacion.active = 1
            ORDER BY registro DESC;
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_fallecidos");
    }
}
