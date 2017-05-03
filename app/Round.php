<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = [ 'game_id', 'word', 'player_one_time', 'player_two_time', 'start_time' ];
}
