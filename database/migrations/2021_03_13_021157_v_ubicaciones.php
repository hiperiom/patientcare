<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VUbicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("
            CREATE OR REPLACE VIEW v_ubicaciones AS
                SELECT
                    ucu.value AS 'Acción',
                    (
                        SELECT DATE_FORMAT(user_cuest_episodio.ingreso, '%d/%m/%Y')
                        FROM user_cuest_episodio
                        WHERE user_id = ucu.user_id_paciente
                        ORDER BY user_cuest_episodio.id DESC
                        LIMIT 1
                    ) AS ingreso,
                    (
                        SELECT DATE_FORMAT(user_cuest_episodio.egreso, '%d/%m/%Y')
                        FROM user_cuest_episodio
                        WHERE user_id = ucu.user_id_paciente
                        ORDER BY user_cuest_episodio.id DESC
                        LIMIT 1
                    ) AS egreso,
                    (
                        DATEDIFF(
                            ucu.created_at ,
                            (
                                SELECT user_cuest_episodio.ingreso
                                FROM user_cuest_episodio
                                WHERE user_id = ucu.user_id_paciente
                                ORDER BY user_cuest_episodio.id DESC
                                LIMIT 1
                            )
                        )
                    ) AS dias,
                    CONCAT(
                        cuu.description,
                        ' | ',
                        cuu.coments
                    ) AS ubicacion,
                    CONCAT(
                        up2.nacionalidad,
                        up2.cedula
                    ) AS cedula,
                    CONCAT(
                        up2.nombres,
                        ' ',
                        up2.apellidos
                    ) AS paciente,
                    CONCAT(
                        IF (up.prefijo IS NULL,'', CONCAT(up.prefijo,' ')),
                        up.apellidos,
                        ' ',
                        up.nombres
                    ) AS 'Médico que lo realizó',
                    DATE_FORMAT(ucu.created_at, '%d/%m/%Y') AS 'dia',
                    DATE_FORMAT(ucu.created_at, '%h:%i %p') AS 'hora'
                FROM user_cuest_ubicacion AS ucu
                INNER JOIN cat_user_ubicacion AS cuu ON ucu.cat_user_ubicacion_id = cuu.id
                INNER JOIN user_profile AS up ON ucu.user_id_medico =up.user_id
                INNER JOIN user_profile AS up2 ON ucu.user_id_paciente =up2.user_id
                WHERE ucu.created_at BETWEEN MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND NOW()+1
                ORDER BY ucu.created_at DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_prioridad_1");
    }
}
