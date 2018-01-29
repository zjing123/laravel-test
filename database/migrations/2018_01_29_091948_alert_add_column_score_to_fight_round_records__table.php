<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertAddColumnScoreToFightRoundRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fight_round_records', function (Blueprint $table) {
            $table->unsignedInteger('score')->after('result')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fight_round_records', function (Blueprint $table) {
            //
        });
    }
}
