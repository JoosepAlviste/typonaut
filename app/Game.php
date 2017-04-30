<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Game.
 *
 * @property int id
 * @property string words
 * @property float time
 * @property int winner_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection players
 * @property User winner
 * @property Carbon start_time
 *
 * @package App
 */
class Game extends Model
{
    protected $fillable = ['words', 'time', 'winner_id', 'start_time'];

    public $timestamps = ['created_at', 'updated_at', 'start_time'];

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function players()
    {
        return $this->belongsToMany(User::class, 'game_players', 'game_id', 'user_id');
    }
}
