<?php

namespace App\Http\Controllers;

use App\Game;

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
}
