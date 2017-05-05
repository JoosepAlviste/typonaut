<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = factory('App\Game', 10)->create();
        $games->each(function ($g) {
            factory('App\Round', 10)->create([
                'game_id' => $g->id,
            ]);
        });
    }
}
