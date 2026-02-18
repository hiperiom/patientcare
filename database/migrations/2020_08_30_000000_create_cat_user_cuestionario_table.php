<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatUserCuestionarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_user_cuestionario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('description');
            $table->unsignedBigInteger('parent_cat_user_cuestionario_id')->nullable();
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('parent_cat_user_cuestionario_id')->references('id')->on('cat_user_cuestionario')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_user_cuestionario');
    }
}
