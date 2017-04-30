<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasChallenged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User */
    public $challenger;
    /** @var User */
    public $userChallenged;

    /**
     * Create a new event instance.
     *
     * @param User $challenger
     * @param User $userChallenged
     */
    public function __construct(User $challenger, User $userChallenged)
    {
        $this->challenger = $challenger;
        $this->userChallenged = $userChallenged;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('lobby');
    }
}
