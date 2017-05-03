<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [ 'player_one_id', 'player_two_id' ];
}
