<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lab_timeslot_id')->unsigned();
            $table->integer('lt_timeslot_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('sessions', function($table) {
            $table->foreign('lab_timeslot_id')->references('id')->on('lab_timeslots');
            $table->foreign('lt_timeslot_id')->references('id')->on('lt_timeslots');   
            $table->foreign('subject_id')->references('id')->on('subjects');      

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
