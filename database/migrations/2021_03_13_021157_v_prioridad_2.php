<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VPrioridad2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("
            CREATE OR REPLACE VIEW v_prioridad_2 AS
                SELECT
                    DISTINCT user.id AS user_id,
                    CONCAT(
                        user_profile.nombres,
                        ' ',
                        user_profile.apellidos
                    ) AS paciente,
                    user_profile.telefono_movil AS celular,
                    cat_user_ubicacion.description AS ubicacion,
                    CASE
                        WHEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_monitoreo
                                WHERE user_id = user.id
                                AND user_cuest_monitoreo.cat_user_cuestionario_id = 84
                                ORDER BY id DESC LIMIT 1
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_monitoreo
                                WHERE user_id = user.id
                                AND user_cuest_monitoreo.cat_user_cuestionario_id = 84
                                ORDER BY id DESC LIMIT 1
                            )
                        ELSE ''
                    END AS temperatura,
                    CASE
                        WHEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_monitoreo
                                WHERE user_id = user.id
                                AND user_cuest_monitoreo.cat_user_cuestionario_id = 73
                                ORDER BY id DESC LIMIT 1
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_monitoreo
                                WHERE user_id = user.id
                                AND user_cuest_monitoreo.cat_user_cuestionario_id = 73
                                ORDER BY id DESC LIMIT 1
                            )
                        ELSE ''
                    END AS oximetria,
                    CASE
                        WHEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_prueba_covid
                                WHERE user_id = user.id
                                AND user_cuest_prueba_covid.cat_user_cuestionario_id = 60
                                ORDER BY id DESC LIMIT 1
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    value
                                FROM user_cuest_prueba_covid
                                WHERE user_id = user.id
                                AND user_cuest_prueba_covid.cat_user_cuestionario_id = 60
                                ORDER BY id DESC LIMIT 1
                            )
                        ELSE ''
                    END AS contacto_covid
                FROM user
                INNER JOIN user_profile ON user.id = user_profile.user_id
                INNER JOIN user_type ON user.id = user_type.user_id
                INNER JOIN user_cuest_ubicacion ON user.id = user_cuest_ubicacion.user_id_paciente
                INNER JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                WHERE user_cuest_ubicacion.cat_user_ubicacion_id IN (364,365,366,367,386)
                AND user_cuest_ubicacion.active = 1
                AND (
                    SELECT
                        value2
                    FROM user_cuest_prueba_covid
                    WHERE user_id = user.id
                    AND user_cuest_prueba_covid.cat_user_cuestionario_id = 60
                    ORDER BY id DESC LIMIT 1
                ) IN ('D','C','C.1')
                ORDER BY ubicacion

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_prioridad_2");
    }
}
