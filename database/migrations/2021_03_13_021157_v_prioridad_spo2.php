<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VPrioridadSpo2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_prioridad_spo2 AS
                SELECT
                user.id AS user_id,
                'SPO2' AS signo,
                CONCAT(
                    user_profile.nombres,
                    ' ',
                    user_profile.apellidos
                ) AS paciente,
                CONCAT(
                (
                        SELECT
                            user_cuest_monitoreo.value
                        FROM user_cuest_monitoreo
                        WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                        AND user_cuest_monitoreo.user_id= user.id
                        AND user_cuest_monitoreo.active=1
                        LIMIT 1
                    ),
                    '%'
                ) AS value,
                CASE
                    WHEN
                        (
                            SELECT
                                user_cuest_monitoreo.value
                            FROM user_cuest_monitoreo
                            WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                            AND user_cuest_monitoreo.user_id= user.id
                            AND user_cuest_monitoreo.active=1
                            LIMIT 1
                        ) BETWEEN 91 AND 93.9 THEN 'warning'
                    ELSE
                        'danger'
                END AS prioridad,
                CONCAT(
                    (
                        SELECT
                            DATE_FORMAT(user_cuest_monitoreo.created_at, '%d')
                        FROM user_cuest_monitoreo
                        WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                        AND user_cuest_monitoreo.user_id= user.id
                        AND user_cuest_monitoreo.active=1
                        LIMIT 1
                    ),
                    '/',
                    (
                        SELECT
                            CASE
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 01 THEN 'ENE'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 02 THEN 'FEB'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 03 THEN 'MAR'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 04 THEN 'ABR'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 05 THEN 'MAY'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 06 THEN 'JUN'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 07 THEN 'JUL'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 08 THEN 'AGO'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 09 THEN 'SET'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 10 THEN 'OCT'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 11 THEN 'NOV'
                                WHEN
                                    DATE_FORMAT(user_cuest_monitoreo.created_at, '%m') = 12 THEN 'DIC'
                                ELSE ''
                            END
                        FROM user_cuest_monitoreo
                        WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                        AND user_cuest_monitoreo.user_id= user.id
                        AND user_cuest_monitoreo.active=1
                        LIMIT 1
                    ),
                    ' ',
                    (
                        SELECT
                            DATE_FORMAT(user_cuest_monitoreo.created_at, '%h:%i %p')
                        FROM user_cuest_monitoreo
                        WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                        AND user_cuest_monitoreo.user_id= user.id
                        AND user_cuest_monitoreo.active=1
                        LIMIT 1
                    )
                ) AS fecha,
                (
                    SELECT
                        CONCAT(
                            cat_user_ubicacion.description,
                            ' | ',
                            cat_user_ubicacion.coments
                        ) AS ubicacion
                    FROM user_cuest_ubicacion
                    INNER JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.user_id_paciente=user.id
                    AND user_cuest_ubicacion.active= 1
                ) AS ubicacion
            FROM user
            JOIN user_profile ON user.id = user_profile.user_id
            JOIN user_type ON user.id = user_type.user_id
            JOIN user_cuest_ubicacion ON user.id = user_cuest_ubicacion.user_id_paciente
            WHERE user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,358,359,360,361)
            AND (
                SELECT
                    user_cuest_monitoreo.value
                FROM user_cuest_monitoreo
                WHERE user_cuest_monitoreo.cat_user_cuestionario_id=73
                AND user_cuest_monitoreo.user_id= user.id
                AND user_cuest_monitoreo.active=1
                LIMIT 1
            ) < 94
            AND user_profile.nombres IS NOT NULL
            AND user_profile.apellidos IS NOT NULL
            AND user_profile.fnacimiento IS NOT NULL
            AND user_profile.genero IS NOT NULL
            AND user_cuest_ubicacion.active = 1
            ORDER BY value ASC
            ;

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_prioridad_spo2");
    }
}
