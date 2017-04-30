<?php

namespace App\Http\Middleware;

use App\Game;
use Closure;
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
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        $game = Game::with('players')->find($request->route('game'));
        foreach ($game->players as $player) {
            if ($player->id === auth()->id()) {
                return $next($request);
            }
        }

        throw new AuthenticationException();
    }
}
