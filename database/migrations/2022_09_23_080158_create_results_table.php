<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            // Generate ID.
            $table->id();

            // Relations.
            $table->bigInteger('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->bigInteger('team_home_id')->unsigned();
            $table->foreign('team_home_id')->references('id')->on('teams')->onDelete('cascade');

            $table->bigInteger('team_away_id')->unsigned();
            $table->foreign('team_away_id')->references('id')->on('teams')->onDelete('cascade');

            $table->integer('team_home_score')->unsigned();
            $table->integer('team_away_score')->unsigned();

            // Generate timestamps (created_at, updated_at)
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
        Schema::dropIfExists('results');
    }
};
