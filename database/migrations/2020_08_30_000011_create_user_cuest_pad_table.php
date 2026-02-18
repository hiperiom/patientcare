<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestPadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_pad', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->char('ofrecer', 0)->nullable();
            $table->char('aceptar', 0)->nullable();
            $table->unsignedBigInteger('cat_fuente_f_id')->nullable();
            $table->unsignedBigInteger('cat_aseguradora_id')->nullable();
            $table->unsignedBigInteger('cat_user_pad_id')->nullable();
            $table->text('value1')->nullable();
            $table->text('value2')->nullable();
            $table->date('ingreso')->nullable();
            $table->date('egreso')->nullable();
            $table->char('pago_valido', 1)->nullable()->default(0);
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();


            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');

            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_pad_id')->references('id')->on('cat_user_pad')->onDelete('cascade');
            //$table->foreign('cat_user_ubicacion_id')->references('id')->on('cat_user_ubicacion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cuest_pad');
    }
}
