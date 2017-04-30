<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Game;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('lobby', function ($user) {
    return $user;
});

Broadcast::channel('game.{game_id}', function ($user, $game_id) {

    $game = Game::with('players')->find($game_id);
    foreach ($game->players as $player) {
        if ($player->id === $user->id) {
            return $user;
        }
    }

    return false;
});
