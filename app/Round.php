<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Round.
 *
 * @property int id
 * @property int game_id
 * @property string word
 * @property float player_one_time
 * @property float player_two_time
 * @property Game game
 *
 * @package App
 */
class Round extends Model
{
    protected $fillable = [ 'game_id', 'word', 'player_one_time', 'player_two_time' ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
