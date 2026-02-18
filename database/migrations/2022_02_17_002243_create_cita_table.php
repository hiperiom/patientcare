<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id_paciente')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->unsignedBigInteger('cat_especialidad_id')->nullable();
            $table->unsignedBigInteger('agenda_id')->nullable();
            $table->year('year');
            $table->string('month');
            $table->string('day');
            $table->string('hour');
            $table->text('reason_for_consultation');
            $table->boolean('status')->default($value = false);
            $table->text('coment');
            $table->boolean('active')->default($value = true);
            $table->timestamps();
            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
            $table->foreign('cat_especialidad_id')->references('id')->on('cat_user_especialidad')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id_paciente')->references('id')->on('user')->onDelete('cascade');
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita');
    }
}
