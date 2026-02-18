<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestHistoriaMedicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_historia_medica', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('episode');
            $table->dateTime('inicio_episodio')->nullable();
            $table->dateTime('fin_episodio')->nullable();

            //ingreso
            $table->text('i_motivo_consulta')->nullable();
            $table->text('i_enfermedad_actual')->nullable();
            $table->text('i_examen_fisico')->nullable();
            $table->text('i_diagnostico')->nullable();
            $table->text('i_plan_trabajo')->nullable();
            //egreso
            $table->text('e_evolucion_area')->nullable();
            $table->text('e_examen_fisico')->nullable();
            $table->text('e_cond_general')->nullable();
            $table->text('e_diagnostico')->nullable();
            $table->text('e_tratamiento')->nullable();
            $table->text('e_interconsulta')->nullable();


            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->unsignedBigInteger('user_id_medico_tratante')->nullable();
            $table->unsignedBigInteger('cat_user_especialidad_id')->nullable();
            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id_medico_tratante')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_especialidad_id')->references('id')->on('cat_user_especialidad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cuest_historia_medica');
    }
}
