<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestEpisodioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public $tableName ="user_cuest_episodio";

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->timestamp('ingreso')->nullable()->comment("Ultimo ingreso");
            $table->timestamp('egreso')->nullable()->comment("Fecha dia del alta");
            $table->timestamp('pre_alta')->nullable()->comment("Fecha prrobable de alta");
            $table->integer('dia_hos')->nullable()->comment("Dias de hospitalizacion");
            $table->unsignedBigInteger('cat_user_ubicacion_id')->nullable()->comment("Ubicación Actual");
            $table->unsignedBigInteger('cat_user_ubicacion_id_destino')->nullable()->comment("Ubicación Destino");
            $table->char('uti', 0)->nullable()->default(0);
            $table->char('uti_causa', 0)->nullable()->default(0);
            $table->boolean('codigo_azul')->nullable()->default(1);
            
            $table->boolean('atencion_emergencia')->nullable()->default(0);
            $table->integer('hospitalizacion')->nullable()->default(0);
            $table->boolean('terapia_intensiva')->nullable()->default(0);
            $table->boolean('caso_tipo_medico')->nullable()->default(0);
            $table->boolean('cirugia')->nullable()->default(0);
            $table->boolean('nivel_triaje')->nullable()->default(1);


            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('user_id_med_esp')->nullable();
            $table->unsignedBigInteger('user_id_med_res')->nullable();
            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('cat_user_ubicacion_id_destino')->references('id')->on('cat_user_ubicacion')->onDelete('cascade');
            $table->foreign('cat_user_ubicacion_id')->references('id')->on('cat_user_ubicacion')->onDelete('cascade');
            $table->foreign('user_id_med_res')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id_med_esp')->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists($this->tableName);
    }
}
