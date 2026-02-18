<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->integer('cedula')->unique();
            $table->string('nacionalidad')->default('V');
            $table->date('fnacimiento')->nullable();
            $table->char('genero')->nullable();
            $table->string('telefono_movil')->nullable();
            $table->string('telefono_hogar')->nullable();
            $table->string('tipo_sangre')->nullable();
            $table->string('imagen')->default('/image/system/patient.svg')->nullable();
            $table->string('sello')->default('/image/system/sello.svg')->nullable();
            $table->string('firma')->default('/image/system/firma.svg')->nullable();
            $table->string('mpps')->default('No Disponible')->nullable();
            $table->string('prefijo')->nullable();
            $table->string('colegio_medico')->nullable();

            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
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
        Schema::dropIfExists('user_profile');
    }
}
