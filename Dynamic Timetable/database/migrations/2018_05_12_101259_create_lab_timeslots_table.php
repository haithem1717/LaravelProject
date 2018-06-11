<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_timeslots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lab_id')->unsigned();
            $table->integer('slot_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('lab_timeslots', function($table) {
            $table->foreign('lab_id')->references('id')->on('labs');
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
        Schema::dropIfExists('lab_timeslots');
    }
}
