<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('event_has_dates', function (Blueprint $table) {
          $table->increments('id');
          $table->timestamps();
          $table->integer('event_id');
          $table->date('date');
          $table->time('from_time');
          $table->time('to_time');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('event_has_dates');
    }
}
