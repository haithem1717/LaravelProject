<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLtTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_timeslots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lt_id')->unsigned();
            $table->integer('slot_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('lt_timeslots', function($table) {
            $table->foreign('lt_id')->references('id')->on('lecture_theatres');
            $table->foreign('slot_id')->references('id')->on('timeslots');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_timeslots');
    }
}
