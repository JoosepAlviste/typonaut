<?php

namespace App\Http\Middleware;

use App\Game;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;

class PlaysInGame
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     *
     * @throws AuthenticationException
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        $game = $request->route('game');
        $game->load('players');

        if ($game->time || $game->winner_id) {

            throw new AuthorizationException();
        }

        foreach ($game->players as $player) {
            if ($player->id === auth()->id()) {
                return $next($request);
            }
        }

        throw new AuthenticationException();
    }
}
