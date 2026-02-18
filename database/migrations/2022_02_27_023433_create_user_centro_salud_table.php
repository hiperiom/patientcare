<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCentroSaludTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_centro_salud', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');

            $table->unsignedBigInteger('centro_salud_id')->nullable();
            $table->unsignedBigInteger('user_id_paciente')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();

            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('centro_salud_id')->references('id')->on('centro_salud')->onDelete('cascade');
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
        Schema::dropIfExists('user_centro_salud');
    }
}
