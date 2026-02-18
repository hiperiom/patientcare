<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ProcedurePacienteCovid extends Migration
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
            DROP PROCEDURE IF EXISTS paciente_covid_area;
            DELIMITER //
                CREATE PROCEDURE paciente_covid_area
                (
                    IN _caso VARCHAR (30)
                )
                BEGIN
                    declare filtro VARCHAR (500);
                    declare ordenarPor VARCHAR (100);

                    SET filtro = "";
                    SET ordenarPor = "ORDER BY ubicacion";

                    if(_caso='alta') then
                        SET filtro = "AND user_cuest_ubicacion.created_at between date_add(CURDATE(), INTERVAL -15 DAY) AND date_add(CURDATE(), INTERVAL +1 DAY)";
                        SET ordenarPor = "ORDER BY user_cuest_ubicacion.created_at DESC";
                    end if;

                    SET filtro  = CONCAT(filtro,' ',ordenarPor);

                    SET @query =CONCAT("
                        SELECT
                            (
                                SELECT id
                                FROM user_cuest_episodio
                                WHERE user_id = user.id
                                AND active=1
                                ORDER BY id DESC
                                LIMIT 1
                            ) AS episodio,
                            (
                                SELECT ingreso
                                FROM user_cuest_episodio
                                WHERE user_id = user.id
                                AND active=1
                                ORDER BY id DESC
                                LIMIT 1
                            ) AS ingreso_episodio,

                            (
                                SELECT codigo_azul
                                FROM user_cuest_episodio
                                WHERE user_id = user.id
                                AND active=1
                                AND user_cuest_episodio.id = episodio
                                ORDER BY id DESC
                                LIMIT 1
                            ) AS codigo_azul,

                            CASE
                                WHEN cat_user_ubicacion.parent_cat_user_ubicacion_id = 1 THEN cat_user_ubicacion.id
                                ELSE cat_user_ubicacion.parent_cat_user_ubicacion_id
                            END AS parent_cat_user_ubicacion_id,

                            user_cuest_ubicacion.cat_user_ubicacion_id,

                            user_cuest_ubicacion.created_at AS ingreso,

                            CONCAT(
                                cat_user_ubicacion.description,
                                ' | ',
                                cat_user_ubicacion.coments
                            ) AS ubicacion,

                            user.id AS user_id,

                            user.email AS email,

                            CONCAT(
                                user_profile.nacionalidad,
                                user_profile.cedula
                            ) AS cedula,
                            CONCAT(
                                user_profile.nacionalidad,
                                '-',
                                FORMAT(user_profile.cedula, 0, 'de_DE')
                            ) AS cedula_formated,

                            user_profile.telefono_movil,

                            user_profile.imagen,

                            (TO_DAYS(NOW()) - TO_DAYS((SELECT ingreso
                                FROM user_cuest_episodio
                                WHERE user_id = user.id
                                AND active=1
                                AND user_cuest_episodio.id = episodio
                                ORDER BY id DESC
                                LIMIT 1))) AS dias,

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
                                AND user_cuest_alert.user_cuest_episodio_id = episodio
                                AND active=1
                            ) AS alert,

                            (
                                SELECT count(*)
                                FROM user_cuest_pendiente
                                WHERE user_id = user.id
                                AND user_cuest_pendiente.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_fc.user_cuest_episodio_id = episodio
                                        ORDER BY user_cuest_fc.id DESC
                                        LIMIT 1
                                    ) IS NOT NULL
                                THEN
                                    (
                                        SELECT user_cuest_fc.value
                                        FROM user_cuest_fc
                                        WHERE user_cuest_fc.user_id_paciente = user.id
                                        AND user_cuest_fc.active = 1
                                        AND user_cuest_fc.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_fr.user_cuest_episodio_id = episodio
                                        ORDER BY  user_cuest_fr.id DESC
                                        LIMIT 1
                                    ) IS NOT NULL
                                THEN
                                    (
                                        SELECT user_cuest_fr.value
                                        FROM user_cuest_fr
                                        WHERE user_cuest_fr.user_id_paciente = user.id
                                        AND user_cuest_fr.active = 1
                                        AND user_cuest_fr.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_ta.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_ta.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_glic.user_cuest_episodio_id = episodio
                                        ORDER BY user_cuest_glic.id DESC
                                        LIMIT 1
                                    ) IS NOT NULL
                                THEN
                                    (
                                        SELECT user_cuest_glic.value
                                        FROM user_cuest_glic
                                        WHERE user_cuest_glic.user_id_paciente = user.id
                                        AND user_cuest_glic.active = 1
                                        AND user_cuest_glic.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_monitoreo.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_sintoma.user_cuest_episodio_id = episodio
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
                                        AND user_cuest_sintoma.user_cuest_episodio_id = episodio
                                        AND cat_user_cuestionario.id IN
                                            (
                                                SELECT cat_user_cuestionario.id
                                                FROM cat_user_cuestionario
                                                WHERE cat_user_cuestionario.parent_cat_user_cuestionario_id = 11
                                            )
                                    )
                                ELSE ''
                            END AS sintoma

                        FROM user
                        JOIN user_profile ON user.id = user_profile.user_id
                        JOIN user_type ON user_profile.user_id = user_type.user_id
                        JOIN user_cuest_ubicacion ON user_profile.user_id = user_cuest_ubicacion.user_id_paciente
                        JOIN cat_user_ubicacion ON user_cuest_ubicacion.cat_user_ubicacion_id = cat_user_ubicacion.id
                        WHERE user_profile.nombres IS NOT NULL
                        AND CASE
                                WHEN '",_caso,"' = 'ea' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (2,3,270)
                                WHEN '",_caso,"' = 'ecvd' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (6,7,10)
                                WHEN '",_caso,"' = 'ep' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (29,32)
                                WHEN '",_caso,"' = 'aq' THEN
                                    user_cuest_ubicacion.cat_user_ubicacion_id IN (41)
                                WHEN '",_caso,"' = 'hcep' THEN
                                    cat_user_ubicacion.id IN (390,399,400,401,402,403,404)
                                WHEN '",_caso,"' = 'hp2' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (42,43)
                                WHEN '",_caso,"' = 'hp3' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (71,235)
                                WHEN '",_caso,"' = 'hp4' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (236,99)
                                WHEN '",_caso,"' = 'hp5' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (127,234)
                                WHEN '",_caso,"' = 'hp6' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (154,155)
                                WHEN '",_caso,"' = 'utia' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (182)
                                WHEN '",_caso,"' = 'uticvd' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (194,195)
                                WHEN '",_caso,"' = 'utip' THEN
                                    cat_user_ubicacion.parent_cat_user_ubicacion_id IN (211)

                                WHEN '",_caso,"' = 'evento1_1' THEN
                                    cat_user_ubicacion.id IN (232)
                                WHEN '",_caso,"' = 'evento1_2' THEN
                                    cat_user_ubicacion.id IN (233)

                                WHEN '",_caso,"' = 'evento2_2' THEN
                                    cat_user_ubicacion.id IN (428,427,426)

                                WHEN '",_caso,"' = 'pad_m_c_insuficiencia' THEN
                                    cat_user_ubicacion.id IN (388)
                                WHEN '",_caso,"' = 'pad_m_c_hipertension' THEN
                                    cat_user_ubicacion.id IN (389)

                                WHEN '",_caso,"' = 'pad_quiru' THEN
                                    cat_user_ubicacion.id IN (372)
                                WHEN '",_caso,"' = 'pad_postquirurgico_amb' THEN
                                    cat_user_ubicacion.id IN (373)
                                WHEN '",_caso,"' = 'pad_postquirurgico_hosp' THEN
                                    cat_user_ubicacion.id IN (374)


                                WHEN '",_caso,"' = 'pad_medic' THEN
                                    cat_user_ubicacion.id IN (379)
                                WHEN '",_caso,"' = 'pad_medico' THEN
                                    cat_user_ubicacion.id IN (382)


                                WHEN '",_caso,"' = 'pad_emergencia' THEN
                                    cat_user_ubicacion.id IN (224)
                                WHEN '",_caso,"' = 'pad_emergencia_pediatrica' THEN
                                    cat_user_ubicacion.id IN (228)
                                WHEN '",_caso,"' = 'pad_emergencia_adulto' THEN
                                    cat_user_ubicacion.id IN (229)


                                WHEN '",_caso,"' = 'alta' THEN
                                    cat_user_ubicacion.id IN (246)
                                WHEN '",_caso,"' = 'traslado' THEN
                                    cat_user_ubicacion.id IN (251)
                                WHEN '",_caso,"' = 'contraopinion' THEN
                                    cat_user_ubicacion.id IN (247)
                                WHEN '",_caso,"' = 'fallecido' THEN
                                    cat_user_ubicacion.id IN (248)
                                WHEN '",_caso,"' = 'reingreso' THEN
                                    cat_user_ubicacion.id IN (250)
                                WHEN '",_caso,"' = 'traslado' THEN
                                    cat_user_ubicacion.id IN (251)
                                WHEN '",_caso,"' = 'alta_otro' THEN
                                    cat_user_ubicacion.id IN (249)
                                WHEN '",_caso,"' = 'te' THEN
                                    cat_user_ubicacion.id IN (388,389)
                                WHEN '",_caso,"' = 'utin' THEN
                                    cat_user_ubicacion.id IN (391)
                                ELSE
                                    user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,364,365,366,367,371,386,387)
                            END
                        AND user_profile.apellidos IS NOT NULL
                        AND user_profile.fnacimiento IS NOT NULL
                        AND user_profile.genero IS NOT NULL
                        AND user_cuest_ubicacion.active = 1
                        AND user_type.cat_user_type_id = 1
                        ",filtro,"

                    ");
                    prepare smt2 from @query;
                    execute smt2;
                END
            //
        ");
        */

        /*CASE
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
                            END AS pcr,*/
                            /* (
                                SELECT value
                                FROM user_cuest_cal
                                WHERE user_id_paciente = user.id
                                AND user_cuest_cal.user_cuest_episodio_id = episodio
                                AND active=1
                            ) AS cal,
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
                                LIMIT 1
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
                                LIMIT 1
                            ) AS pad_covid_descripcion,

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
                            END AS tac*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW v_utia');
    }
}
