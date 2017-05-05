<?php

namespace App\Http\Controllers;

use App\Game;
use App\Round;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GamesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = Game::create([
            'player_one_id' => request()->challenger_id,
            'player_two_id' => request()->challenged_player_id,
        ]);

        $this->createRoundsForGame($game);

        return $game;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    private function getWordsForGame()
    {
        $badSymbols = '\',.!?;:';
        $faker = Factory::create();

        $words = Collection::make(explode(' ', $faker->realText(400)))->filter(function ($w) use ($badSymbols) {
            return strlen(trim($w, $badSymbols)) >= config('app.min_word_length');
        });
        $words = $words->chunk(config('app.rounds_per_game'))->first()->map(function ($w) use ($badSymbols) {
            return trim($w, $badSymbols);
        });

        return $words;
    }

    private function createRoundsForGame(Game $game)
    {
        $words = $this->getWordsForGame();
        $words->each(function ($w) use ($game) {
            $game->rounds()->create([
                'word' => $w,
            ]);
        });
    }
}
