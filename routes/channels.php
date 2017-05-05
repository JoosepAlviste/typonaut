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

    $game = Game::find($game_id);
    if ($user->id === $game->player_one_id || $user->id === $game->player_two_id) {
        return $user;
    }

    return false;
});

