<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestInformeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_informe', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('value')->nullable();
            $table->longText('coments')->nullable();
            $table->dateTime('since', $precision = 0)->nullable();
            $table->dateTime('until', $precision = 0)->nullable();
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->char('enviado', 1)->default(0);
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_cita_id')->nullable();
            $table->unsignedBigInteger('cat_user_informe_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_cita_id')->references('id')->on('user_cita')->onDelete('cascade');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            //$table->foreign('cat_user_informe_id')->references('id')->on('cat_user_informe')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('user_cuest_informe');
    }
}
