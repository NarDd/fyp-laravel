<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('api_token', 60)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('isadmin')->nullable();
            $table->string('status')->nullable();
            $table->boolean('status_updated_by')->nullable();
            $table->dateTimeTz('status_updated_at')->nullable();
            $table->string('provider_user_id')->nullable();
            $table->string('provider')->nullable();
            $table->integer('company_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
