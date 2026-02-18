<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestOrdenMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_orden_medicas', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->timestamps();
            $table->foreign('user_cita_id')->references('id')->on('user_cita')->onDelete('cascade');
            $table->unsignedBigInteger('user_cita_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cuest_orden_medicas');
    }
}
