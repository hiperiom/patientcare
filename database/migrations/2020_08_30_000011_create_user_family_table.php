<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_family', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('email')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->integer('cedula')->nullable();
            $table->char('genero')->nullable();
            $table->string('telefono_movil')->nullable();
            $table->unsignedBigInteger('cat_user_family_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_family_id')->references('id')->on('cat_user_family')->onDelete('cascade');
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
        Schema::dropIfExists('user_family');
    }
}
