<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     //1 means going 0 means not
    public function up()
    {
      Schema::create('event_has_users', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('event_id');
          $table->integer('user_id');
          $table->string('secret')->nullable();
          $table->string('major')->nullable();
          $table->string('minor')->nullable();
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
         Schema::dropIfExists('event_has_users');
    }
}
