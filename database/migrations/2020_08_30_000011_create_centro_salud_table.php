<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentroSaludTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_salud', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->string('coments')->nullable();
            $table->string('image')->nullable();
            $table->longText('location')->nullable();
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('cat_grupo_centro_salud_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('cat_grupo_centro_salud_id')->references('id')->on('cat_grupo_centro_salud')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro_salud');
    }
}
