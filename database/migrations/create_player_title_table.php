<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('title_id');
            $table->foreign('title_id')->references('id')->on('title')->onDelete('cascade');
            $table->integer('player_id');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->timestamps();
            //$table->primary(array('player_id','title'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
  public function down()
    {
        Schema::dropIfExists('player_titles');
    }
}
