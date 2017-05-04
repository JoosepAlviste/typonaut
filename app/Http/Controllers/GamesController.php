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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

        $words = $this->getWordsForGame();
        $words->each(function ($w) use ($game) {
            $game->rounds()->create([
                'word' => $w,
            ]);
        });

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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

    private function getWordsForGame()
    {
        $badSymbols = '\',.!?;:';
        $faker = Factory::create();

        $words = Collection::make(explode(' ', $faker->realText(400)))->filter(function ($w) use ($badSymbols) {
            return strlen(trim($w, $badSymbols)) >= 5;
        });
        $words = $words->chunk(10)->first()->map(function ($w) use ($badSymbols) {
            return trim($w, $badSymbols);
        });

        return $words;
    }
}
