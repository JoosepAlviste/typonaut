<?php

namespace App\Http\Controllers;

use App\Game;
use App\Round;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    public function update(Game $game, Round $round)
    {
        // Check word, request()->word

        $userId = request()->user_id;

        if ($game->player_one_id === $userId) {
            if ($round->player_one_time !== null) {
                return response([], 403);
            }

            $round->player_one_time = request()->time;
        } else if ($game->player_two_id === $userId) {
            if ($round->player_two_time !== null) {
                return response([], 403);
            }

            $round->player_two_time = request()->time;
        }

        if ($round->player_one_time !== null && $round->player_two_time !== null) {
            if ($round->player_one_time > $round->player_two_time) {
                $game->player_one_score += 1;
            } else if ($round->player_two_time > $round->player_one_time) {
                $game->player_two_score += 1;
            }
        }

        $game->save();
        $round->save();

        return $round;
    }
}
