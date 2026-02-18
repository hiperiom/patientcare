<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCuestComorbilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName ="user_cuest_comorbilidad";

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('description')->nullable();
            $table->text('coment')->nullable();
            $table->string('cod_cie')->nullable();
            $table->unsignedBigInteger('user_cuest_episodio_id')->nullable();
            $table->longText('cod_cie_description')->nullable();
            
            $table->unsignedBigInteger('user_cita_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('user_id_medico')->nullable();
            $table->char('active', 1)->default(1);
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_cuest_episodio_id')->references('id')->on('user_cuest_episodio')->onDelete('cascade');
            $table->foreign('user_id_medico')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');


            $table->foreign('user_cita_id')->references('id')->on('user_cita')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
