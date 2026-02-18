<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_incidencia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('titulo')->nullable();
            $table->integer('avance')->default(0);
            $table->integer('carpeta')->default(1);
            $table->unsignedBigInteger('cat_system_incidencia_type_id');
            $table->binary('description')->nullable();//blob field
            $table->unsignedBigInteger('cat_tipo_prioridad_id');
            $table->timestamp('finalizacion')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->char('active', 1)->default(1);

            $table->timestamps();
            $table->softDeletesTz();
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
        Schema::dropIfExists('system_incidencia');
    }
}
