<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_ubicacion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_user_ubicacion_id')->default(245);
            $table->unsignedBigInteger('user_id_paciente')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->text('value')->nullable();
            $table->longText('coments')->nullable();
            $table->char('prioridad', 0)->default(0);
            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id_paciente')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_ubicacion_id')->references('id')->on('cat_user_ubicacion')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cuest_ubicacion');
    }
}
