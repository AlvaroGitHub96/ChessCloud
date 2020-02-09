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
        Schema::create('rol_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id');
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            //$table->primary(array('user_id','rol'));
        });
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
