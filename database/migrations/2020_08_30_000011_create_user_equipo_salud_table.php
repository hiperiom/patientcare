<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEquipoSaludTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_equipo_salud', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_user_equipo_salud_id');
            $table->unsignedBigInteger('user_id');
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_equipo_salud_id')->references('id')->on('cat_user_equipo_salud')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_equipo_salud');
    }
}
