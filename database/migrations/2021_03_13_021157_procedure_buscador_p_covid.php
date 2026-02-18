<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ProcedureBuscadorPCovid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    /*
        DB::statement("
            #USE qdvkztswjy;
            DROP PROCEDURE IF EXISTS buscador_p_covid;
            DELIMITER //
                CREATE PROCEDURE buscador_p_covid
                (
                    _parametro VARCHAR (100)
                )
                BEGIN
                    SELECT
                        DISTINCT user.id AS user_id,
                        (
                            SELECT
                                CONCAT(
                                    cat_user_ubicacion.description,
                                    ' | ',
                                    cat_user_ubicacion.coments
                                )
                            FROM user_cuest_ubicacion
                            JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                            WHERE user_cuest_ubicacion.user_id_paciente = user.id
                            AND user_cuest_ubicacion.active=1
                        ) AS ubicacion,

                        (TO_DAYS(NOW()) - TO_DAYS(user.created_at)) AS dias,

                        CONCAT(
                            user_profile.nombres,
                            ' ',
                            user_profile.apellidos
                        ) AS paciente,

                        user_profile.genero AS sexo,

                        (YEAR(CURDATE()) - YEAR(user_profile.fnacimiento)) AS edad,
                        (
                            SELECT value
                            FROM user_cuest_alert
                            WHERE user_id_paciente = user.id
                            AND active=1
                        ) AS alert,
                        (
                            SELECT value
                            FROM user_cuest_cal
                            WHERE user_id_paciente = user.id
                            AND active=1
                        ) AS cal,
                        (
                            SELECT count(*)
                            FROM user_cuest_pendiente
                            WHERE user_id = user.id
                            AND active=1
                        ) AS t_pendiente,
                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_monitoreo.value
                                    FROM user_cuest_monitoreo
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND user_cuest_monitoreo.cat_user_cuestionario_id = 84
                                    AND user_cuest_monitoreo.active = 1
                                    ORDER BY user_cuest_monitoreo.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_monitoreo.value
                                    FROM user_cuest_monitoreo
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND user_cuest_monitoreo.cat_user_cuestionario_id = 84
                                    AND user_cuest_monitoreo.active = 1
                                    ORDER BY user_cuest_monitoreo.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS temp,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_fc.value
                                    FROM user_cuest_fc
                                    WHERE user_cuest_fc.user_id_paciente = user.id
                                    AND user_cuest_fc.active = 1
                                    ORDER BY user_cuest_fc.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_fc.value
                                    FROM user_cuest_fc
                                    WHERE user_cuest_fc.user_id_paciente = user.id
                                    AND user_cuest_fc.active = 1
                                    ORDER BY user_cuest_fc.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS fc,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_fr.value
                                    FROM user_cuest_fr
                                    WHERE user_cuest_fr.user_id_paciente = user.id
                                    AND user_cuest_fr.active = 1
                                    ORDER BY  user_cuest_fr.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_fr.value
                                    FROM user_cuest_fr
                                    WHERE user_cuest_fr.user_id_paciente = user.id
                                    AND user_cuest_fr.active = 1
                                    ORDER BY  user_cuest_fr.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS fr,

                        CASE
                            WHEN
                                (
                                    SELECT
                                        CONCAT(
                                            user_cuest_ta.value,
                                            '/',
                                            user_cuest_ta.value2
                                        )
                                    FROM user_cuest_ta
                                    WHERE user_cuest_ta.user_id_paciente = user.id
                                    AND user_cuest_ta.active = 1
                                    ORDER BY user_cuest_ta.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT
                                        CONCAT(
                                            user_cuest_ta.value,
                                            '/',
                                            user_cuest_ta.value2
                                        )
                                    FROM user_cuest_ta
                                    WHERE user_cuest_ta.user_id_paciente = user.id
                                    AND user_cuest_ta.active = 1
                                    ORDER BY user_cuest_ta.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS ta,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_glic.value
                                    FROM user_cuest_glic
                                    WHERE user_cuest_glic.user_id_paciente = user.id
                                    AND user_cuest_glic.active = 1
                                    ORDER BY user_cuest_glic.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_glic.value
                                    FROM user_cuest_glic
                                    WHERE user_cuest_glic.user_id_paciente = user.id
                                    AND user_cuest_glic.active = 1
                                    ORDER BY user_cuest_glic.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS gl,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_monitoreo.value
                                    FROM user_cuest_monitoreo
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND user_cuest_monitoreo.cat_user_cuestionario_id = 73
                                    AND user_cuest_monitoreo.active = 1
                                    ORDER BY user_cuest_monitoreo.id DESC
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_monitoreo.value
                                    FROM user_cuest_monitoreo
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND user_cuest_monitoreo.cat_user_cuestionario_id = 73
                                    AND user_cuest_monitoreo.active = 1
                                    ORDER BY user_cuest_monitoreo.id DESC
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS oxi,

                        CASE
                            WHEN
                                (
                                    SELECT
                                        cat_user_cuestionario.description AS dispositivo
                                    FROM user_cuest_monitoreo
                                    JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                        )
                                    AND user_cuest_monitoreo.active=1
                                    LIMIT 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT
                                        cat_user_cuestionario.description AS dispositivo
                                    FROM user_cuest_monitoreo
                                    JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_monitoreo.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                        )
                                    AND user_cuest_monitoreo.active=1
                                    LIMIT 1
                                )
                            ELSE ''
                        END AS oxit,

                        CASE
                            WHEN
                                (
                                    SELECT
                                        GROUP_CONCAT(
                                            DISTINCT cat_user_cuestionario.description SEPARATOR ', '
                                        ) AS `sintoma`
                                    FROM user_cuest_sintoma
                                    JOIN cat_user_cuestionario ON user_cuest_sintoma.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_sintoma.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 11
                                        )
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT
                                        GROUP_CONCAT(
                                            DISTINCT cat_user_cuestionario.description SEPARATOR ', '
                                        ) AS `sintoma`
                                    FROM user_cuest_sintoma
                                    JOIN cat_user_cuestionario ON user_cuest_sintoma.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_sintoma.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 11
                                        )
                                )
                            ELSE ''
                        END AS sintoma,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_prueba_covid.value
                                    FROM user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id IN(96, 97, 98)
                                    AND user_cuest_prueba_covid.active = 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_prueba_covid.value
                                    FROM user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id IN(96, 97, 98)
                                    AND user_cuest_prueba_covid.active = 1
                                )
                            ELSE ''
                        END AS pcr,

                        CASE
                            WHEN
                                (
                                    SELECT
                                        user_cuest_prueba_covid.value
                                    FROM
                                        user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id = 91
                                    AND user_cuest_prueba_covid.active = 1
                                ) IS NOT NULL
                            THEN(
                                    SELECT
                                        user_cuest_prueba_covid.value
                                    FROM
                                        user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id = 91
                                    AND user_cuest_prueba_covid.active = 1
                                )
                            ELSE ''
                        END AS pdr,

                        CASE
                            WHEN
                                (
                                    SELECT user_cuest_prueba_covid.value
                                    FROM user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id IN(192)
                                    AND user_cuest_prueba_covid.active = 1
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT user_cuest_prueba_covid.value
                                    FROM user_cuest_prueba_covid
                                    WHERE user_cuest_prueba_covid.user_id = user.id
                                    AND user_cuest_prueba_covid.cat_user_cuestionario_id IN(192)
                                    AND user_cuest_prueba_covid.active = 1
                                )
                            ELSE ''
                        END AS antg,

                        CASE
                            WHEN
                                (
                                    SELECT
                                        GROUP_CONCAT(
                                            DISTINCT cat_user_cuestionario.description SEPARATOR ', '
                                        ) AS value
                                    FROM user_cuest_tac
                                    JOIN cat_user_cuestionario ON user_cuest_tac.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_tac.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 100
                                        )
                                ) IS NOT NULL
                            THEN
                                (
                                    SELECT
                                        GROUP_CONCAT(
                                            DISTINCT cat_user_cuestionario.description SEPARATOR ', '
                                        ) AS value
                                    FROM user_cuest_tac
                                    JOIN cat_user_cuestionario ON user_cuest_tac.cat_user_cuestionario_id = cat_user_cuestionario.id
                                    WHERE user_cuest_tac.user_id = user.id
                                    AND cat_user_cuestionario.id IN
                                        (
                                            SELECT cat_user_cuestionario.id
                                            FROM cat_user_cuestionario
                                            WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 100
                                        )
                                )
                            ELSE ''
                        END AS tac
                    FROM user
                    JOIN user_profile ON user.id = user_profile.user_id
                    JOIN user_type ON user_profile.user_id = user_type.user_id
                    JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
                    JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                    WHERE user_cuest_ubicacion.active=1
                    AND user.email LIKE CONCAT('%', _parametro , '%')
                    OR CONCAT(
                        user_profile.nombres,
                        ' ',
                        user_profile.apellidos
                    ) LIKE CONCAT('%', _parametro , '%')
                    OR user_profile.cedula LIKE CONCAT('%', _parametro , '%')
                    GROUP BY user_id
                    ;
                END
            //
        ");
    */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_utia");
    }
}
