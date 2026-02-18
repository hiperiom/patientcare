<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestAntecedenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cuest_antecedente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('cat_user_antecedente_id')->nullable();
            $table->string('type')->nullable();
            $table->char('active', 1)->default(1);
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->unsignedBigInteger('cita_id')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
            
            //$table->foreign('cita_id')->references('id')->on('cita')->onDelete('cascade');
            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('cat_user_antecedente_id')->references('id')->on('cat_user_antecedente')->onDelete('cascade');
        
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cuest_antecedente');
    }
}
