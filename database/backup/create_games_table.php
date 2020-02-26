<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::DropIfExists('games');
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->int('id_white');
            $table->int('id_black');
            $table->string('tournament');
            $table->string('movements');
            $table->int('result');//0 white, 1 draw, 2 black
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
        Schema::dropIfExists('games');
    }
}
