<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cita', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id_paciente')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->unsignedBigInteger('cat_especialidad_id')->nullable();
            $table->unsignedBigInteger('centro_salud_id')->nullable();
            $table->unsignedBigInteger('cat_user_cita_status_id')->nullable();
            $table->year('year');
            $table->string('month');
            $table->string('day');
            $table->string('hour');
            $table->text('reason_for_consultation')->nullable();
            
            $table->text('coments')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->foreign('cat_especialidad_id')->references('id')->on('cat_user_especialidad')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('centro_salud_id')->references('id')->on('centro_salud')->onDelete('cascade');
            $table->foreign('user_id_paciente')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_cita_status_id')->references('id')->on('cat_user_cita_status')->onDelete('cascade');
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cita');
    }
}
