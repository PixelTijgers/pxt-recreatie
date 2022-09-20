<?php

// Facades.
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
        Schema::create('games', function (Blueprint $table) {
            // Generate ID.
            $table->id();

            // Relations.
            $table->bigInteger('season_id')->unsigned();
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');

            $table->bigInteger('team_home_id')->unsigned();
            $table->foreign('team_home_id')->references('id')->on('teams')->onDelete('cascade');

            $table->bigInteger('team_away_id')->unsigned();
            $table->foreign('team_away_id')->references('id')->on('teams')->onDelete('cascade');

            $table->bigInteger('referee_id')->unsigned();
            $table->foreign('referee_id')->references('id')->on('teams')->onDelete('cascade');

            // Table content.
            $table->integer('field')->unsigned();
            $table->dateTime('game_date');

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
        Schema::dropIfExists('games');
    }
};
