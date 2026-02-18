<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VPadEmpleadoAltas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement("
        //     CREATE OR REPLACE VIEW v_pad_emp_altas AS
        //         SELECT
        //         DISTINCT ucu.user_id_paciente AS user_id,
        //         cuu.coments,
        //         CONCAT(
        //             up.nombres,
        //             ' ',
        //             up.apellidos
        //         ) AS paciente,

        //         CASE
        //             WHEN DATEDIFF(
        //                 (
        //                     SELECT
        //                         ucu1.created_at
        //                     FROM user_cuest_ubicacion AS ucu1
        //                     WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                     AND ucu1.active = 1
        //                 )
        //                 , ucu.created_at) BETWEEN 0 AND 10
        //             THEN
        //                 DATEDIFF(
        //                     (
        //                         SELECT
        //                             ucu1.created_at
        //                         FROM user_cuest_ubicacion AS ucu1
        //                         WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                         AND ucu1.active = 1
        //                     )
        //                     , ucu.created_at
        //                 )
        //             ELSE ''
        //         END AS '0 Y 10',
        //         CASE
        //             WHEN DATEDIFF(
        //                 (
        //                     SELECT
        //                         ucu1.created_at
        //                     FROM user_cuest_ubicacion AS ucu1
        //                     WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                     AND ucu1.active = 1
        //                 )
        //                 , ucu.created_at) BETWEEN 11 AND 14
        //             THEN
        //                 DATEDIFF(
        //                     (
        //                         SELECT
        //                             ucu1.created_at
        //                         FROM user_cuest_ubicacion AS ucu1
        //                         WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                         AND ucu1.active = 1
        //                     )
        //                     , ucu.created_at
        //                 )
        //             ELSE ''
        //         END AS '11 Y 14',
        //         CASE
        //             WHEN DATEDIFF(
        //                 (
        //                     SELECT
        //                         ucu1.created_at
        //                     FROM user_cuest_ubicacion AS ucu1
        //                     WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                     AND ucu1.active = 1
        //                 )
        //                 , ucu.created_at) > 14
        //             THEN
        //                 DATEDIFF(
        //                     (
        //                         SELECT
        //                             ucu1.created_at
        //                         FROM user_cuest_ubicacion AS ucu1
        //                         WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //                         AND ucu1.active = 1
        //                     )
        //                     , ucu.created_at
        //                 )
        //             ELSE ''
        //         END AS '> 14',
        //         CASE
        //             WHEN
        //                 (
        //                     SELECT
        //                         ucpc.value
        //                     FROM user_cuest_prueba_covid AS ucpc
        //                     WHERE ucpc.user_id = ucu.user_id_paciente
        //                     ORDER BY ucpc.created_at DESC
        //                     LIMIT 1
        //                 ) IS NOT NULL
        //             THEN
        //                 (
        //                     SELECT
        //                         ucpc.value
        //                     FROM user_cuest_prueba_covid AS ucpc
        //                     WHERE ucpc.user_id = ucu.user_id_paciente
        //                     ORDER BY ucpc.created_at DESC
        //                     LIMIT 1
        //                 )
        //             ELSE ''
        //         END AS PCR,
        //         CASE
        //             WHEN
        //                 (
        //                     SELECT
        //                         DATE_FORMAT(ucpc.created_at, '%d/%m/%Y')
        //                     FROM user_cuest_prueba_covid AS ucpc
        //                     WHERE ucpc.user_id = ucu.user_id_paciente
        //                     ORDER BY ucpc.created_at DESC
        //                     LIMIT 1
        //                 ) IS NOT NULL
        //             THEN
        //                 (
        //                     SELECT
        //                         DATE_FORMAT(ucpc.created_at, '%d/%m/%Y')
        //                     FROM user_cuest_prueba_covid AS ucpc
        //                     WHERE ucpc.user_id = ucu.user_id_paciente
        //                     ORDER BY ucpc.created_at DESC
        //                     LIMIT 1
        //                 )
        //             ELSE ''
        //         END AS fecha_PCR,

        //         DATE_FORMAT(ucu.created_at, '%d/%m/%Y') AS fecha_ingreso,
        //         (
        //             SELECT
        //                 DATE_FORMAT(ucu1.created_at, '%d/%m/%Y')
        //             FROM user_cuest_ubicacion AS ucu1
        //             WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //             AND ucu1.active = 1
        //         ) AS fecha_egreso,
        //         (
        //             SELECT
        //                 cuu1.coments
        //             FROM user_cuest_ubicacion AS ucu1
        //             INNER JOIN cat_user_ubicacion AS cuu1 ON ucu1.cat_user_ubicacion_id = cuu1.id
        //             INNER JOIN user_profile AS up1 ON ucu1.user_id_paciente = up1.user_id
        //             WHERE ucu1.user_id_paciente = ucu.user_id_paciente
        //             AND ucu1.active = 1
        //         ) AS ubicacacion_actual

        //     FROM user_cuest_ubicacion AS ucu
        //     INNER JOIN cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
        //     INNER JOIN user_profile AS up ON ucu.user_id_paciente = up.user_id
        //     WHERE ucu.cat_user_ubicacion_id=357
        //     AND ucu.active=0
        //     AND ucu.user_id_paciente NOT IN (466,2236)
        //     GROUP BY user_id
        //     ORDER BY paciente ASC

        // ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("DROP VIEW v_totales");
    }
}
