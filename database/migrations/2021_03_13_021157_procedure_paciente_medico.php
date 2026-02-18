<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ProcedurePacienteMedico extends Migration
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
            DROP PROCEDURE IF EXISTS paciente_covid_medico;
            DELIMITER //
                CREATE PROCEDURE paciente_covid_medico
                (
                    IN _medico INT (30)
                )
                BEGIN
                    declare filtro VARCHAR (500);
                    declare ordenarPor VARCHAR (100);

                    SET filtro = "";
                    SET ordenarPor = "ORDER BY ubicacion";

                    SET filtro  = CONCAT(filtro,' ',ordenarPor);

                    SET @query =CONCAT("
                        SELECT
                            DISTINCT user.id AS user_id,
                            (
                                SELECT description
                                FROM cat_user_ubicacion AS cuu
                                WHERE cuu.id = cat_user_ubicacion.parent_cat_user_ubicacion_id
                            ) AS area,

                            CONCAT(
                                cat_user_ubicacion.description,
                                ' | ',
                                cat_user_ubicacion.coments
                            ) AS ubicacion,

                            (TO_DAYS(NOW()) - TO_DAYS(user_cuest_ubicacion.created_at)) AS dias,

                            CONCAT(
                                user_profile.nombres,
                                ' ',
                                user_profile.apellidos
                            ) AS paciente,

                            user_profile.genero AS sexo,
                            YEAR(CURDATE())-YEAR(user_profile.fnacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(user_profile.fnacimiento,'%m-%d'), 0 , -1 ) AS edad,
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
                            (
                                SELECT
                                    CASE
                                        WHEN
                                            ucp.ofrecer = 0 AND
                                            ucp.aceptar = 0 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 0
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 0 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 1
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id IS NULL AND
                                            ucp.cat_aseguradora_id IS NULL AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 2
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id != 2 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 2
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id = 2 AND
                                            ucp.cat_aseguradora_id IS NOT NULL AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 3
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id != 2 AND
                                            ucp.pago_valido = 1
                                        THEN 4
                                        WHEN ucp.cat_fuente_f_id IS NOT NULL
                                            AND ucp.pago_valido = 1 THEN 4
                                        ELSE 5
                                    END
                                FROM user_cuest_pad AS ucp
                                WHERE ucp.user_id = user.id
                                AND ucp.active = 1
                            ) AS pad_covid,
                            (
                                SELECT
                                    CASE
                                        WHEN
                                            ucp.ofrecer = 0 AND
                                            ucp.aceptar = 0 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 'PAD por ofrecer'
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 0 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 'PAD ofrecido'
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id IS NULL AND
                                            ucp.cat_aseguradora_id IS NULL AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 'PAD Aceptado'
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id != 2 AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 'PAD Aceptado'
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id = 2 AND
                                            ucp.cat_aseguradora_id IS NOT NULL AND
                                            ucp.pago_valido IN (0,NULL)
                                        THEN 'PAD en espera de validación'
                                        WHEN
                                            ucp.ofrecer = 1 AND
                                            ucp.aceptar = 1 AND
                                            ucp.cat_fuente_f_id != 2 AND
                                            ucp.pago_valido = 1
                                        THEN 'PAD validado'
                                        WHEN ucp.cat_fuente_f_id IS NOT NULL  AND ucp.pago_valido = 1
                                        THEN 'PAD validado'


                                        ELSE 'Falta información por confirmar'
                                    END
                                FROM user_cuest_pad AS ucp
                                WHERE ucp.user_id = user.id
                                AND ucp.active = 1
                            ) AS pad_covid_descripcion,
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
                                            CONCAT(
                                                CASE
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Indeterminado' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'No sabe' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Indeterminado' AND user_cuest_prueba_covid.igm IS NULL) ||
                                                        (user_cuest_prueba_covid.value = 'No sabe' AND user_cuest_prueba_covid.igm IS NULL) OR
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm IS NULL) OR
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm IS NULL)
                                                    THEN
                                                        'IgM'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm = 1)
                                                    THEN
                                                        'IgM -'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm = 1)
                                                    THEN
                                                        'IgM +'
                                                    ELSE ''
                                                END,
                                                ' ',
                                                CASE
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Indeterminado' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'No sabe' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Indeterminado' AND user_cuest_prueba_covid.igg IS NULL) ||
                                                        (user_cuest_prueba_covid.value2 = 'No sabe' AND user_cuest_prueba_covid.igg IS NULL) OR
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg IS NULL) OR
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg IS NULL)
                                                    THEN
                                                        'IgG'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg = 1)
                                                    THEN
                                                        'IgG -'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg = 1)
                                                    THEN
                                                        'IgG +'
                                                    ELSE ''
                                                END
                                            )
                                        FROM
                                            user_cuest_prueba_covid
                                        WHERE user_cuest_prueba_covid.user_id = user.id
                                        AND user_cuest_prueba_covid.cat_user_cuestionario_id = 91
                                        AND user_cuest_prueba_covid.active = 1
                                    ) IS NOT NULL
                                THEN(
                                        SELECT
                                            CONCAT(
                                                CASE
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Indeterminado' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'No sabe' AND user_cuest_prueba_covid.igm = 0) OR
                                                        (user_cuest_prueba_covid.value = 'Indeterminado' AND user_cuest_prueba_covid.igm IS NULL) ||
                                                        (user_cuest_prueba_covid.value = 'No sabe' AND user_cuest_prueba_covid.igm IS NULL) OR
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm IS NULL) OR
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm IS NULL)
                                                    THEN
                                                        'IgM'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Negativo' AND user_cuest_prueba_covid.igm = 1)
                                                    THEN
                                                        'IgM -'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value = 'Positivo' AND user_cuest_prueba_covid.igm = 1)
                                                    THEN
                                                        'IgM +'
                                                    ELSE ''
                                                END,
                                                ' ',
                                                CASE
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Indeterminado' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'No sabe' AND user_cuest_prueba_covid.igg = 0) OR
                                                        (user_cuest_prueba_covid.value2 = 'Indeterminado' AND user_cuest_prueba_covid.igg IS NULL) ||
                                                        (user_cuest_prueba_covid.value2 = 'No sabe' AND user_cuest_prueba_covid.igg IS NULL) OR
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg IS NULL) OR
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg IS NULL)
                                                    THEN
                                                        'IgG'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Negativo' AND user_cuest_prueba_covid.igg = 1)
                                                    THEN
                                                        'IgG -'
                                                    WHEN
                                                        (user_cuest_prueba_covid.value2 = 'Positivo' AND user_cuest_prueba_covid.igg = 1)
                                                    THEN
                                                        'IgG +'
                                                    ELSE ''
                                                END
                                            )
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
                        JOIN user_cuest_medico_paciente ON user_profile.user_id = user_cuest_medico_paciente.user_id
                        JOIN user_especialidad ON user_cuest_medico_paciente.user_id_medico = user_especialidad.user_id
                        WHERE user_profile.nombres IS NOT NULL
                        AND user_cuest_medico_paciente.active = 1
                        AND user_cuest_medico_paciente.user_id_medico =",_medico,"
                        AND user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367)
                        AND user_profile.apellidos IS NOT NULL
                        AND user_profile.fnacimiento IS NOT NULL
                        AND user_profile.genero IS NOT NULL
                        AND user_cuest_ubicacion.active = 1
                        ",filtro,"

                    ");
                    prepare smt2 from @query;
                    execute smt2;
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
