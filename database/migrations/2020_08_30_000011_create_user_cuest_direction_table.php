<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestDirectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_direction', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_estado_id')->nullable();
            $table->unsignedBigInteger('cat_municipio_id')->nullable();
            $table->string('description')->nullable();
            $table->string('domicilio')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_estado_id')->references('id')->on('cat_estado')->onDelete('cascade');
            $table->foreign('cat_municipio_id')->references('id')->on('cat_municipio')->onDelete('cascade');
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
        Schema::dropIfExists('user_cuest_direction');
    }
}
