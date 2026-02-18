<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VTotales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_totales AS
                SELECT
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id NOT BETWEEN 225 AND 251
                    AND active=1
                ) AS t_hospitalizados,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id IN(225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240,241,242,243,244,357)
                    AND active=1
                ) AS t_pad,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 225
                    AND active=1
                ) AS t_pad1,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 226
                    AND active=1
                ) AS t_pad2,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 227
                    AND active=1
                ) AS t_pad3,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 228
                    AND active=1
                ) AS t_pad4,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 229
                    AND active=1
                ) AS t_pad5,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    WHERE cat_user_ubicacion_id = 357
                    AND active=1
                ) AS t_padEmp,
                (
                    SELECT count(*) AS total
                    FROM user_cuest_ubicacion
                    JOIN user_profile ON user_cuest_ubicacion.user_id_paciente = user_profile.user_id
                    WHERE user_cuest_ubicacion.cat_user_ubicacion_id NOT IN (246,247,248,249,250,251,358,359,360,361)
                    AND user_profile.nombres IS NOT NULL
                    AND user_profile.apellidos IS NOT NULL
                    AND user_profile.fnacimiento IS NOT NULL
                    AND user_profile.genero IS NOT NULL
                    AND user_cuest_ubicacion.active=1
                ) AS t_pacientes_activo
            LIMIT 1

        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_totales");
    }
}
