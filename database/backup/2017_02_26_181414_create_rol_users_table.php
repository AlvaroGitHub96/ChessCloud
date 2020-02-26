<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::DropIfExists('rol_users');
        Schema::create('rol_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        /*Schema::table('rol_users', function (Blueprint $table) {
            $table->foreign('rol_id')->references('id')->on('rol');
            $table->foreign('user_id')->references('id')->on('users');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
  public function down()
    {
        Schema::dropIfExists('rol_users');
    }
}
