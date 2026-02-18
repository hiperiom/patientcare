<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class VMedicos extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW v_medicos AS
                SELECT
                    DISTINCT ut.user_id,
                    CONCAT(up.apellidos,', ',up.nombres) AS medico,
                    CASE
                        WHEN up.genero = 'm' THEN 'M'
                        WHEN up.genero = 'f' THEN 'F'
                        else ''
                    END AS genero,
                    CASE
                        WHEN up.cedula IS NOT NULL THEN FORMAT(up.cedula, 0, 'de_DE')
                        ELSE ''
                    END AS cedula,
                    CASE
                        WHEN cue.description IS NOT NULL THEN cue.description
                        else ''
                    END AS especialidad,user.email AS email,
                    CASE
                        WHEN cues.description  IS NOT NULL THEN cues.description
                        else ''
                    END equipo_salud,
                    up.telefono_movil,
                    up.prefijo,
                    up.imagen AS imagen,
                    up.telefono_movil AS celular,
                    date_format(user.created_at,'%d/%m/%Y') AS ingreso
                FROM user_type AS ut
                JOIN user_profile AS up on ut.user_id = up.user_id
                JOIN user ON ut.user_id = user.id
                LEFT JOIN user_especialidad AS ue ON ut.user_id = ue.user_id
                LEFT JOIN cat_user_especialidad AS cue ON ue.cat_user_especialidad_id = cue.id
                LEFT JOIN user_equipo_salud AS ues ON ut.user_id = ues.user_id
                LEFT JOIN cat_user_equipo_salud AS cues ON ues.cat_user_equipo_salud_id = cues.id
                LEFT JOIN user_medico_posicion AS ump ON ut.user_id = ump.user_id
                LEFT JOIN cat_user_medico_posicion AS cump ON ump.cat_user_medico_posicion_id = cump.id
                WHERE ut.cat_user_type_id IN(2)
                ORDER BY medico ASC ;

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
        DB::statement("DROP VIEW v_medicos");
    }
}
