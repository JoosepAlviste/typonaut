<?php

namespace App\Http\Controllers;

use App\Game;
use App\Round;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    public function update(Game $game, Round $round)
    {
        $userId = request()->user_id;
        if ($game->player_one_id === $userId) {
            $round->player_one_time = request()->time;
        } else if ($game->player_two_id === $userId) {
            $round->player_two_time = request()->time;
        }

        $round->save();

        return $round;
    }
}
