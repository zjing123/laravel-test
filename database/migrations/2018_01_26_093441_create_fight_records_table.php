<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFightRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fight_records', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fight_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('question_id');
            $table->text('result')->nullable();
            $table->boolean('completed');
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
        Schema::dropIfExists('fight_records');
    }
}
