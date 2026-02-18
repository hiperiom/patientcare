<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestFotografiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_fotografia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('value')->nullable();
            $table->longText('coments')->nullable();
            $table->char('active', 1)->default(1);
            $table->string('file_type')->nullable();
            $table->string('cod_cie')->nullable();
            $table->longText('cod_cie_description')->nullable();
            $table->unsignedBigInteger('cat_user_cuestionario_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_cita_id')->nullable();
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_cita_id')->references('id')->on('user_cita')->onDelete('cascade');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_cuestionario_id')->references('id')->on('cat_user_cuestionario')->onDelete('cascade');
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
        Schema::dropIfExists('user_cuest_fotografia');
    }
}
