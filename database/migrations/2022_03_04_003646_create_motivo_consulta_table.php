<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivoConsultaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_consulta', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('value')->nullable();
            $table->string('coments')->nullable();
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_cita_id')->nullable();
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->unsignedBigInteger('user_id_paciente')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_cita_id')->references('id')->on('user_cita')->onDelete('cascade');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id_paciente')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivo_consulta');
    }
}
