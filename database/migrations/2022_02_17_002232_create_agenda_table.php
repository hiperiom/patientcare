<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('agenda');
            $table->string('agenda_year');
            $table->unsignedBigInteger('cat_especialidad_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->boolean('active')->default($value = true);

            $table->timestamps();
            $table->foreign('cat_especialidad_id')->references('id')->on('cat_user_especialidad')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            //$table->charset = 'utf8mb4';
            //$table->collation = 'utf8mb4_spanish_ci';

            //$table->index(['agenda', 'agenda_year', 'created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
