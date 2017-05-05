<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function lobby()
    {
        return view('pages.lobby');
    }

    public function game(Game $game)
    {
        $game->load(['rounds', 'playerOne', 'playerTwo']);
        $game->setHidden(['player_one_id', 'player_two_id', 'game_id']);

        return view('pages.game', [
            'game' => $game,
        ]);
    }

    public function history()
    {
        return view('pages.history', [
            'games' => Game::latest()->get(),
        ]);
    }
}
