<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $seasons = [
            [
                'year' => 2021,
                'name' => 'Seizoen 2021/2022',
            ],
            [
                'year' => 2022,
                'name' => 'Seizoen 2022/2023',
            ],
        ];

        foreach($seasons as $season)
            Season::create($season);
    }
}
