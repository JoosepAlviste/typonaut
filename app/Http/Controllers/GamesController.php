<?php

namespace App\Http\Controllers;

use App\Game;
use Faker\Factory;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::with(['players', 'winner'])
                     ->latest()
                     ->where('winner_id', '!=', null)
                     ->where('time', '!=', null)
                     ->get();

        return $games;
    }

    public function show(Game $game)
    {
        return $game;
    }

    public function store()
    {
        $faker = Factory::create();

        /** @var Game $game */
        $game = Game::create([
            'words' => $faker->realText(200, 1),
        ]);
        $game->players()->attach(auth()->id());
        $game->players()->attach(request()->challenger_id);

        return $game;
    }
}
