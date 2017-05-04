<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function lobby()
    {
        return view('lobby');
    }

    public function game(Game $game)
    {
        $game->load('rounds');

        return view('game', [
            'game' => $game,
        ]);
    }
}
