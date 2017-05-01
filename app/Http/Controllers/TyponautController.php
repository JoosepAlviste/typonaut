<?php

namespace App\Http\Controllers;

use App\Events\GameWasFinished;
use App\Game;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TyponautController extends Controller
{
    /**
     * TyponautController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Game $game)
    {
        $opponent = $game->players->filter(function ($p) {
                return $p->id !== auth()->id();
            })->first();

        return view('game', [
            'game' => $game,
            'opponent' => $opponent,
        ]);
    }

    public function startGame(Game $game)
    {
//        if ($game->start_time !== null) {
//            // Some normal response when already started?
//            return response('', 400);
//        }

        $game->start_time = Carbon::now();
        $game->save();

        return $game;
    }

    public function finishGame(Game $game)
    {
        if ($game->winner !== null) {
            // Some normal response when already has winner?
            return response('', 400);
        }

        $game->winner_id = auth()->id();
        $duration = Carbon::now()->diffInSeconds(Carbon::parse($game->start_time));
        $game->time = $duration;
        $game->save();

        event(new GameWasFinished($game));

        return $game;
    }
}
