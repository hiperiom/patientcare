<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToDischargeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dischargeds', function (Blueprint $table) {
            $table->integer('status')->default(0)->comment('0: creada|no enviada, 1: enviada, 2:contestada')->default(0)->after('egress_date'); // 0: creada|no enviada, 1: enviada, 2:contestada
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
            $table->dropColumn('status');
        });
    }
}
