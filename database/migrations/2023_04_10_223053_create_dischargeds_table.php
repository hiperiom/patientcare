<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDischargedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dischargeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('El ID de usuario del médico que realizó el');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('token', 45)->unique();
            $table->unsignedBigInteger('user_cuest_episodio_id')->comment('ID del episodio asociado al alta.');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio');
            $table->boolean('sent_email')->default(false)->comment('La encuesta fue enviada por email');
            $table->boolean('sent_whatsapp')->default(false)->comment('La encuesta fue enviada por whatsapp');
            $table->dateTime('egress_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dischargeds');
    }
}
