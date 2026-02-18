<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VLtsOxit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_lts_oxit AS
                SELECT
                    user.id AS user_id,
                    CONCAT(
                        cat_user_ubicacion.description,
                        ' | ',
                        cat_user_ubicacion.coments
                    ) AS ubicacion,
                    CONCAT(
                        user_profile.nombres,
                        ' ',
                        user_profile.apellidos
                    ) AS paciente,

                    user_profile.genero AS sexo,

                    (YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 )) AS edad,
                    CASE
                        WHEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        cat_user_cuestionario.description SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        cat_user_cuestionario.description SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                            )
                        ELSE ''
                    END AS oxit,
                    CASE
                        WHEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value BETWEEN 1 AND 5
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value BETWEEN 1 AND 5
                            )
                        ELSE ''
                    END AS 'rango1',
                    CASE
                        WHEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value BETWEEN 6 AND 10
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value BETWEEN 6 AND 10
                            )
                        ELSE ''
                    END AS 'rango2',
                    CASE
                        WHEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value > 10
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT
                                    GROUP_CONCAT(
                                        user_cuest_monitoreo.value SEPARATOR ', '
                                    ) AS `sintoma`
                                FROM user_cuest_monitoreo
                                JOIN cat_user_cuestionario ON user_cuest_monitoreo.cat_user_cuestionario_id = cat_user_cuestionario.id
                                WHERE user_cuest_monitoreo.user_id = user.id
                                AND cat_user_cuestionario.id IN
                                    (
                                        SELECT cat_user_cuestionario.id
                                        FROM cat_user_cuestionario
                                        WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 103

                                    )
                                AND user_cuest_monitoreo.value >10
                            )
                        ELSE ''
                    END AS 'rango3'
                FROM user
                JOIN user_profile ON user.id = user_profile.user_id
                JOIN user_type ON user_profile.user_id = user_type.user_id
                JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
                JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                WHERE cat_user_ubicacion.parent_cat_user_ubicacion_id IN (71,99,183,195)
                AND  user_profile.nombres IS NOT NULL
                AND user_profile.apellidos IS NOT NULL
                AND user_profile.fnacimiento IS NOT NULL
                AND user_profile.genero IS NOT NULL
                AND user_cuest_ubicacion.active = 1
                ORDER BY ubicacion
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
        DB::statement("DROP VIEW v_lts_oxit");
    }
}
