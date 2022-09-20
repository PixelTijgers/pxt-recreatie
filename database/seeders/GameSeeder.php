<?php

namespace Database\Seeders;
// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'season_id' => 2,
                'team_home_id' => 3,
                'team_away_id' => 4,
                'referee_id' => 1,
                'field' => 1,
                'game_date' => '2021-09-30 20:00'
            ],
            [
                'season_id' => 2,
                'team_home_id' => 1,
                'team_away_id' => 2,
                'referee_id' => 3,
                'field' => 2,
                'game_date' => '2021-09-30 20:00'
            ],
            [
                'season_id' => 2,
                'team_home_id' => 5,
                'team_away_id' => 6,
                'referee_id' => 2,
                'field' => 1,
                'game_date' => '2021-09-30 21:00'
            ],
        ];

        foreach($games as $game)
            Game::create($game);
    }
}
