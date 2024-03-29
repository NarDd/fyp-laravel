<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('attendance', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('event_has_dates_id');
          $table->integer('user_id');
          $table->boolean('attendance');
          $table->timestamp('pressed')->nullable();
          $table->timestamp('scanned')->nullable();
          $table->integer('noofclicks')->nullable();
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
        Schema::dropIfExists('attendance');
    }
}
