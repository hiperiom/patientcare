<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMotivosToDischargeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dischargeds', function (Blueprint $table) {
            $table->string('motivo_email')->nullable()->comment('Motivo por el cual se revertió el estatus de sent_email')->after('sent_email');
            $table->string('motivo_whatsapp')->nullable()->comment('Motivo por el cual se revertió el estatus de sent_whatsapp')->after('sent_whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dischargeds', function (Blueprint $table) {
            $table->dropColumn('motivo_email');
            $table->dropColumn('motivo_whatsapp');
        });
    }
}
