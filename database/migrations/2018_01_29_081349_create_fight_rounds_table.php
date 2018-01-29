<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFightRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fight_rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fight_id');
            $table->unsignedInteger('question_id');
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fight_rounds');
    }
}
