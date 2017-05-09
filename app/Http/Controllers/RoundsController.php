<?php

namespace App\Http\Controllers;

use App\Events\GameFinished;
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

            if (floatval($round->player_one_time) < floatval($round->player_two_time)) {
                $game->player_one_score += 1;
            } else if (floatval($round->player_two_time) < floatval($round->player_one_time)) {
                $game->player_two_score += 1;
            }
        }

        $game->save();
        $round->save();

        $gameOver = true;
        foreach ($game->rounds as $loopround) {
            if ($loopround->player_one_time === null || $loopround->player_two_time === null) {
                $gameOver = false;
                break;
            }
        }

        if ($gameOver) {
            event(new GameFinished($game->fresh()));
        }

        return $round;
    }
}
