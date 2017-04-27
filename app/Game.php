<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Game.
 *
 * @property int id
 * @property string words
 * @property float time
 * @property int winner_id
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @package App
 */
class Game extends Model
{
    protected $fillable = ['words', 'time', 'winner_id'];

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function players()
    {
        return $this->belongsToMany(User::class, 'game_players', 'game_id', 'user_id');
    }
}
