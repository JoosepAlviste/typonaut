<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [ 'player_one_id', 'player_two_id' ];

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function playerOne()
    {
        return $this->belongsTo(User::class, 'player_one_id', 'id');
    }

    public function playerTwo()
    {
        return $this->belongsTo(User::class, 'player_two_id', 'id');
    }
}
