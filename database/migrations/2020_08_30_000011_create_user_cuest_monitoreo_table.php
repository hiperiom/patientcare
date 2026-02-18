<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestMonitoreoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_monitoreo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_user_cuestionario_id');
            $table->text('value')->nullable();
            $table->longText('coments')->nullable();
            //$table->float('lpm', 8, 2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();

            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_cuestionario_id')->references('id')->on('cat_user_cuestionario')->onDelete('cascade');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
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
        Schema::dropIfExists('user_cuest_monitoreo');
    }
}
